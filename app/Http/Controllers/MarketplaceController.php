<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Order;
use App\Models\Region;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketplaceController extends Controller
{
    public function marketplace()
    {
        $listings = Listing::with(['images' => function ($query) {
            $query->where('is_main', true);
        }])->paginate(10);
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
        $order->status = 'Pending';


        $order->save();


        return redirect()->route('orders.pending')->with('success', 'Order placed successfully!');
    }
    public function pending()
    {
        $authId = Auth::id();

        $pending_orders = Order::with(['Orderlisting', 'seller', 'buyer'])
            ->where('status', 'Pending')
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
        // $cityId = $request->input('city_id');
        // $listings = Listing::with(['images' => function ($query) {
        //     $query->where('is_main', true);
        // }])
        //     ->where('city_id', $cityId)
        //     ->get();

        // return response()->json(['listings' => $listings]);


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

        return response()->json(['listings' => $listings->get()]);
    }

    public function searchListings(Request $request)
    {
        $headline = $request->input('search');
        $listings = Listing::with(['images' => function ($query) {
            $query->where('is_main', true);
        }])
            ->where('headline', 'LIKE', $headline . '%')
            ->get();

        return response()->json(['listings' => $listings]);
    }
}