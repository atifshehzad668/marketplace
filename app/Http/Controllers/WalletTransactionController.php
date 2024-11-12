<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletTransactionController extends Controller
{
    public function admin_wallet()
    {
        $wallet_balance = Wallet::where('user_id', Auth::id())->first();

        $wallet_transactions = WalletTransaction::with('admin_wallet_transaction', 'order')
            ->where('user_id', Auth::id())
            ->where(function ($query) {
                $query->where('type', 'Credit')
                    ->orWhere('type', 'Debit');
            })
            ->paginate(5);


        return view('admin_wallet.admin_wallet', get_defined_vars());
    }
    public function admin_orders()
    {
        $orders = Order::with(['Orderlisting' => function ($query) {
            $query->select('id', 'headline', 'price');
        }, 'seller', 'buyer'])
            ->paginate(10);
        return view('admin_wallet.admin_order', get_defined_vars());
    }
    public function description(Request $request)
    {
        $transactionRef = $request->input('transaction_ref');


        $transaction = WalletTransaction::where('transaction_ref', $transactionRef)->first();

        if ($transaction) {

            $descriptionData = json_decode($transaction->description, true);

            // Return the dec
            return response()->json($descriptionData);
        } else {
            return response()->json(['error' => 'Transaction not found'], 404);
        }
    }
    public function seller_wallet()
    {
        $orders = Order::with(['Orderlisting' => function ($query) {
            $query->select('id', 'headline', 'price');
        }, 'seller', 'buyer'])
            ->where('buyer_status', 'Received')
            ->paginate(10);
        return view('seller_wallet.buyer_received_order', get_defined_vars());
    }

    public function order_details(Request $request)
    {

        $orderId = $request->input('order_id');


        $order = Order::with(['Orderlisting', 'seller'])->find($orderId);


        if ($order) {

            $orderPrice = $order->Orderlisting->price;
            $withoutCommissionPrice = $orderPrice;


            return response()->json([
                'success' => true,
                'data' => $order,
                'without_commission_price' => $withoutCommissionPrice
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.'
            ], 404);
        }
    }
    public function pay_to_seller(Request $request)
    {

        $paymentAmount = $request->input('payment_amount');
        $orderId = $request->input('order_id');
        $order = Order::findOrFail($orderId);
        $seller_id = $order->seller_id;
        $seller_name = $order->seller->name;
        $sellerWallet = Wallet::where('user_id', $seller_id)->firstOrFail();


        if ($sellerWallet->balance >= $paymentAmount) {
            $sellerWallet->balance -= $paymentAmount;
            $sellerWallet->save();
        } else {
            throw new \Exception("Insufficient funds in admin wallet");
        }
        $seller_wallet_balance = $sellerWallet->balance;
        $imagePath = null;
        if ($request->hasFile('payment_image')) {
            $file = $request->file('payment_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $fileType = $file->getClientOriginalExtension();
            $file_Path = 'seller_payment_details';


            $file->move(public_path($file_Path), $fileName);

            $imagePath = $file_Path . '/' . $fileName;
            // $file_Path = 'public/seller_payment_details';
            // $file->move(storage_path('app/' . $file_Path), $fileName);
            // $imagePath = 'storage/seller_payment_details/' . $fileName;
        }
        $description = json_encode([
            'message' => "This amount of $paymentAmount has been deducted from the wallet of seller: $seller_name.",
            'order_id' => $orderId,
            'seller_name' => $seller_name,
            'payment_amount' => $paymentAmount,
            'new_balance' => $seller_wallet_balance
        ]);



        $wallet_transaction = new  WalletTransaction();
        $wallet_transaction->user_id = $seller_id;
        $wallet_transaction->wallet_id = $sellerWallet->id;
        $wallet_transaction->order_id = $orderId;
        $wallet_transaction->amount = $paymentAmount;
        $wallet_transaction->type = "Debit";
        $wallet_transaction->balance = $seller_wallet_balance;
        $wallet_transaction->transaction_ref = "internal";
        $wallet_transaction->description = $description;
        $wallet_transaction->image = $imagePath;
        $wallet_transaction->save();
        return response()->json([
            'success' => true,
            'message' => "Payment of $paymentAmount has been successfully made to seller: $seller_name.",
            'order_id' => $orderId,
            'seller_name' => $seller_name,

            'payment_amount' => $paymentAmount,


        ]);
    }

    public function seller_wallet_balance()
    {

        $seller_wallet_balance = Wallet::where('user_id', Auth::id())->first();
        // $wallet_transaction_order_seller_id = WalletTransaction::with('order')->get();


        $seller_wallet_transactions = WalletTransaction::with(['seller_wallet_transaction', 'order'])
            ->where('user_id', Auth::id())
            ->where(function ($query) {
                $query->where('type', 'Credit')
                    ->orWhere('type', 'Debit');
            })
            ->paginate(5);



        return view('seller_wallet.seller_waller_balance', get_defined_vars());
    }
}