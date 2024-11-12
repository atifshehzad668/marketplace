<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wallet;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\PointTransaction;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['Orderlisting' => function ($query) {
            $query->select('id', 'headline', 'price');
        }, 'seller', 'buyer'])
            ->where('seller_id', Auth::id())
            ->where('status', 'Shipping')

            ->whereHas('Orderlisting')
            ->get();

        return view('orders.index', get_defined_vars());
    }
    public function delivered_orders()
    {
        $orders = Order::with(['Orderlisting' => function ($query) {
            $query->select('id', 'headline', 'price');
        }, 'seller', 'buyer'])
            ->where('seller_id', Auth::id())
            ->where('seller_status', 'Delivered')

            ->whereHas('Orderlisting')
            ->get();

        return view('orders.delivered_order', get_defined_vars());
    }
    public function received_orders($id)
    {
        $order = Order::findOrFail($id);
        $order->buyer_status = 'Received';
        $order->save();
        $sellerId = $order->seller->id;
        $admin_user = User::where('id', 1)->first();
        $admin_id = $admin_user->id;


        $walletTransaction = WalletTransaction::where('order_id', $order->id)->first();

        // $adminWalletId = Wallet::where('user_id', $admin_id)->first();

        $paidAmount = $walletTransaction->amount;



        // $percentagePaid = 80;
        // $percentageRemaining = 20;

        // $sellerpercentage = $paidAmount * ($percentagePaid / 100);
        // $adminpercentage = $paidAmount * ($percentageRemaining / 100);
        // $adminDescription = json_encode([

        //     "adminPercentage" => [
        //         "value" => $adminpercentage,
        //         "description" => "Admin's share based on 20% allocation of the paid amount, added to admin wallet."
        //     ]
        // ], JSON_PRETTY_PRINT);

        // $adminWallet = Wallet::where('user_id', $admin_id)->first();



        // if ($adminWallet->balance >= $sellerpercentage) {
        //     $adminWallet->balance -= $sellerpercentage;
        //     $adminWallet->save();
        // } else {
        //     throw new \Exception("Insufficient funds in admin wallet");
        // }
        // // dump("here");
        // // exit();

        // $wallet_transaction = new  WalletTransaction();
        // $wallet_transaction->user_id = $admin_id;
        // $wallet_transaction->wallet_id = $adminWallet->id;
        // $wallet_transaction->order_id = $order->id;
        // $wallet_transaction->amount = $sellerpercentage;
        // $wallet_transaction->type = "Debit";
        // $wallet_transaction->balance = $adminWallet->balance;
        // $wallet_transaction->transaction_ref = "internal";
        // $wallet_transaction->description = $adminDescription;
        // $wallet_transaction->image = 'no Image';
        // $wallet_transaction->save();




        $sellerWallet = Wallet::where('user_id', $sellerId)->first();
        if (!$sellerWallet) {

            $sellerWallet = new Wallet();
            $sellerWallet->user_id = $sellerId;
            $sellerWallet->balance = 0;
            $sellerWallet->save();
        }


        $sellerWallet->balance += $paidAmount;
        $sellerWallet->save();


        $sellerWalletTransaction1 = new WalletTransaction();
        $sellerWalletTransaction1->user_id = $sellerId;
        $sellerWalletTransaction1->wallet_id = $sellerWallet->id;
        $sellerWalletTransaction1->order_id = $order->id;
        $sellerWalletTransaction1->amount = $paidAmount;
        $sellerWalletTransaction1->type = "Credit";
        $sellerWalletTransaction1->balance = $sellerWallet->balance;
        $sellerWalletTransaction1->transaction_ref = "internal";
        $sellerWalletTransaction1->description = "Seller's share based on 100% allocation of the paid amount.";
        $sellerWalletTransaction1->image = 'no Image';
        $sellerWalletTransaction1->save();


        return redirect()->route('orders.pending')->with('success', 'Ordered Received  Successfully');
    }

    public function archived()
    {
        $orders = Order::with(['Orderlisting' => function ($query) {
            $query->select('id', 'headline', 'price');
        }, 'seller', 'buyer'])
            ->where('buyer_id', Auth::id())
            ->where(function ($query) {
                $query->where('buyer_status', 'Pending')
                    ->orWhere('buyer_status', 'Received');
            })
            ->whereHas('Orderlisting')
            ->get();

        return view('orders.purchase_order', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}
    public function delivered($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'Delivered';
        $order->seller_status = 'Delivered';
        $order->save();
        return redirect()->route('orders.index')->with('success', 'Ordered Delivered  Successfully');
    }
    public function shipping($id)
    {
        $order = Order::findOrFail($id);


        $listing = Listing::findOrFail($order->listing_id);

        // if ($listing->quantity <= 0) {
        //     return redirect()->back()->with('error', 'Order cannot be delivered because the quantity is zero.');
        // }


        // $listing->decrement('quantity', 1);


        $order->status = 'Shipping';
        $order->seller_status = 'Shipping';
        $order->save();
        $transaction = PointTransaction::create([
            'seller_id' => $order->seller_id,
            'buyer_id' => $order->buyer_id,
            'listing_id' => $order->listing_id,
            'order_id' => $order->id,
            'description' => 'Listing Shipped',
            'type' => 'bonus',
        ]);


        if ($transaction) {
            DB::table('users')
                ->where('id', $order->seller_id)
                ->increment('points_balance', 1);
        }
        return redirect()->route('orders.index')->with('success', 'Ordered Shipped  Successfully');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)

    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}