<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Region;
use App\Models\Listing;
use App\Models\ListingImage;
use App\Models\Payment;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class MarketplaceController extends Controller
{
    public function marketplace()
    {
        $listings = Listing::with(['images' => function ($query) {
            $query->where('is_main', true);
        }])
            ->where('user_id', '!=', Auth::id())
            ->where('quantity', '>', 0)
            ->paginate(10);
        $cities = City::all();
        $regions = Region::all();

        return view('marketplace.marketplace', get_defined_vars());
    }
    public function listings_view($id)
    {
        $listing = Listing::findOrFail($id);
        $images = ListingImage::where('listing_id', $listing->id)->get();
        return view('marketplace.view_listing', get_defined_vars());
    }
    public function buy($id)
    {

        $listing = Listing::findOrFail($id);
        $order = new Order();
        $order->listing_id = $id;
        $order->seller_id = $listing->user_id;
        $order->buyer_id = Auth::id();
        $order->status = 'Paid';
        $order->seller_status = 'Pending';
        $order->buyer_status = 'Paid';
        $order->save();

        $listing_quantity = Listing::findOrfail($id);
        $listing_quantity->quantity -= 1;
        $listing_quantity->save();


        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $listing->price
                    ]
                ]
            ]
        ]);


        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $link) {
                if ($link['rel'] === "approve") {
                    session()->put('listing_id', $listing->id);
                    session()->put('order_id', $order->id);
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('cancel');
        }
    }
    public function pending()
    {
        $authId = Auth::id();

        $pending_orders = Order::with(['Orderlisting', 'seller', 'buyer'])
            ->where('buyer_status', 'Pending')
            ->orWhere('buyer_status', 'Paid')
            ->orWhere('seller_status', 'Pending')
            ->where(function ($query) use ($authId) {
                $query->where('seller_id', $authId)
                    ->orWhere('buyer_id', $authId);
            })
            ->get();

        return view('orders.pending_order', get_defined_vars());
    }

    public function filterRegionsByCity(Request $request)
    {
        $cityId = $request->input('city_id');
        $regions = Region::where('city_id', $cityId)->get(); // Fetch regions based on city_id

        return response()->json(['regions' => $regions]);
    }

    public function filterlistingsbycity(Request $request)
    {
        $cityId = $request->input('city_id');
        $regionId = $request->input('region_id');

        $listings = Listing::with(['images' => function ($query) {
            $query->where('is_main', true);
        }]);

        // Add filtering based on city and region
        if ($cityId) {
            $listings->where('city_id', $cityId);
        }

        if ($regionId) {
            $listings->where('region_id', $regionId);
        }

        // Apply the condition to the listings for quantity > 0
        $listings->where('quantity', '>', 0);

        return response()->json(['listings' => $listings->get()]);
    }
    // public function filterlistingsbycity(Request $request)
    // {
    //     $cityId = $request->input('city_id');
    //     $regionId = $request->input('region_id');

    //     $listings = Listing::with(['images' => function ($query) {
    //         $query->where('is_main', true);
    //     }]);

    //     // Add filtering based on city and region
    //     if ($cityId) {
    //         $listings->where('city_id', $cityId);
    //     }

    //     if ($regionId) {
    //         $listings->where('region_id', $regionId);
    //     }

    //     // Apply the condition to the listings for quantity > 0
    //     $listings->where('quantity', '>', 0);

    //     // Get the listings and include the image URL in the response
    //     $listings = $listings->get()->map(function ($listing) {
    //         // Assume images are directly stored in the 'public/images/listings/' directory
    //         $listing->image_url = $listing->images->first() ?
    //             asset('uploads/listings_image/' . $listing->images->first()->image_url) : null;
    //         return $listing;
    //     });

    //     return response()->json(['listings' => $listings]);
    // }


    public function searchListings(Request $request)
    {
        $headline = $request->input('search');
        $listings = Listing::with(['images' => function ($query) {
            $query->where('is_main', true);
        }])->where('quantity', '>', 0)
            ->where('headline', 'LIKE', $headline . '%')
            ->get();

        return response()->json(['listings' => $listings]);
    }
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $listingId = session('listing_id');
            $order_id = session('order_id');
            $listing = Listing::find($listingId);
            $transactionId = $response['id'];
            $status = $response['status'];
            $payerEmail = $response['payer']['email_address'];
            $payerName = $response['payer']['name']['given_name'] . ' ' . $response['payer']['name']['surname'];
            $grossAmount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $netAmount = $response['purchase_units'][0]['payments']['captures'][0]['seller_receivable_breakdown']['net_amount']['value'];

            // Prepare a detailed transaction description
            $description = json_encode([
                'transaction_for_listing' => $listing->headline,
                'payer' => [
                    'name' => $payerName,
                    'email' => $payerEmail
                ],
                'receiver' => [
                    'name' => $listing->user->name,
                    'role' => 'Listing owner'
                ],
                'amount' => "{$grossAmount} USD",
                'net_amount_after_fees' => "{$netAmount} USD"
            ]);





            //wallet insertion
            $superAdmin = User::role('Super Admin')->first();
            if ($superAdmin) {

                $wallet = Wallet::where('user_id', $superAdmin->id)->first();

                if ($wallet) {

                    $wallet->balance += $grossAmount;
                } else {

                    $wallet = new Wallet();
                    $wallet->user_id = $superAdmin->id;
                    $wallet->balance = $grossAmount;
                }
                $wallet->save();

                $wallet_transaction = new  WalletTransaction();
                $wallet_transaction->user_id = $superAdmin->id;
                $wallet_transaction->wallet_id = $wallet->id;
                $wallet_transaction->order_id = $order_id;
                $wallet_transaction->amount = $grossAmount;
                $wallet_transaction->type = "Credit";
                $wallet_transaction->balance = $wallet->balance;
                $wallet_transaction->transaction_ref = $transactionId;
                $wallet_transaction->description = $description;
                $wallet_transaction->save();

                $payment = new Payment();
                $payment->trx_id = $transactionId;
                $payment->amount = $grossAmount;
                $payment->payment_method = "paypal";
                $payment->status = "successful";
                $payment->gateway_response = $description;
                $payment->order_id = $order_id;
                $payment->save();

                session()->forget('listing_id');
                session()->forget('order_id');


                return redirect()->route('orders.pending')->with('success', 'Order placed successfully!');
            } else {
                return redirect()->route('cancel');
            }
        }
    }

    public function cancel()
    {
        return "payment is cancel";
    }
}