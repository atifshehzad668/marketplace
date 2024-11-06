<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\PointTransaction;
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
            ->where('status', 'Delivered')
            ->whereHas('Orderlisting')
            ->get();

        return view('orders.index', get_defined_vars());
    }

    public function archived()
    {
        $orders = Order::with(['Orderlisting' => function ($query) {
            $query->select('id', 'headline', 'price');
        }, 'seller', 'buyer'])
            ->where('buyer_id', Auth::id())
            ->where('status', 'Delivered')
            ->whereHas('Orderlisting')
            ->get();

        return view('orders.purchase_order', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}
    public function processing($id)
    {
        $order = Order::findOrFail($id);


        $listing = Listing::findOrFail($order->listing_id);

        if ($listing->quantity <= 0) {
            return redirect()->back()->with('error', 'Order cannot be delivered because the quantity is zero.');
        }


        $listing->decrement('quantity', 1);


        $order->status = 'Delivered';
        $order->save();
        $transaction = PointTransaction::create([
            'seller_id' => $order->seller_id,
            'buyer_id' => $order->buyer_id,
            'listing_id' => $order->listing_id,
            'order_id' => $order->id,
            'description' => 'Listing Delivered',
            'type' => 'bonus',
        ]);


        if ($transaction) {
            DB::table('users')
                ->where('id', $order->seller_id)
                ->increment('points_balance', 1);
        }
        return redirect()->route('orders.index')->with('success', 'Ordered Delivered  Successfully');
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
