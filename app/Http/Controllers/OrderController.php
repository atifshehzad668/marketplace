<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wallet;
use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\PointTransaction;
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


        $walletTransaction = WalletTransaction::where('order_id', $order->id)->first();
        $adminWalletId = $walletTransaction->wallet_id;
        $paidAmount = $walletTransaction->amount;


        $amountToTransfer = $paidAmount * 0.80;


        $adminWallet = Wallet::findOrFail($adminWalletId);

        if ($adminWallet->balance >= $amountToTransfer) {
            $adminWallet->balance -= $amountToTransfer;
            $adminWallet->save();
        } else {
            throw new \Exception("Insufficient funds in admin wallet");
        }

        // Step 3: Check if a wallet exists for the seller; if not, create one
        $sellerWallet = Wallet::where('user_id', $sellerId)->first();

        if (!$sellerWallet) {
            // Create a new wallet for the seller if it doesn’t exist
            $sellerWallet = new Wallet();
            $sellerWallet->user_id = $sellerId;
            $sellerWallet->balance = 0;  // Initialize with 0 balance
            $sellerWallet->save();
        }

        // Step 4: Add the 80% amount to the seller's wallet
        $sellerWallet->balance += $amountToTransfer;
        $sellerWallet->save();



        // if ($order->buyer_status === 'Received') {



        //     if ($walletTransaction) {

        //     }
        // }
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