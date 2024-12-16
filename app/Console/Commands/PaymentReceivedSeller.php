<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\PointTransaction;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Illuminate\Console\Command;

class PaymentReceivedSeller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payment-received-seller';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command will add amount in seller wallet';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $orders = Order::where('status', 'paid')
        //     ->where('created_at', '<', now())
        //     ->get();
        $this->info('Current server time: ' . now()->toDateTimeString());

        $orders = Order::where('status', 'Paid')
            ->where('days_until_payment', '<', now())
            ->where('points_deducted', '!=', 1)
            ->get();

        $this->info('Orders found: ' . $orders->count());

        if ($orders->isEmpty()) {
            $this->info('unable to find the order');
            return;
        }

        foreach ($orders as $order) {
            $order_id = $order->id;
            $order->buyer_status = 'Received';
            $order->save();
            $sellerId = $order->seller->id;
            $buyerId = $order->buyer->id;
            $listing_id = $order->Orderlisting->id;
            $listing_id = $order->Orderlisting->untuill;

            $admin_user = User::where('id', 1)->first();
            $admin_id = $admin_user->id;

            $walletTransaction = WalletTransaction::where('order_id', $order->id)->first();



            $paidAmount = $walletTransaction->amount;
            $adminWallet = Wallet::where('user_id', $admin_id)->first();



            if ($adminWallet->balance >= $paidAmount) {
                $adminWallet->balance -= $paidAmount;
                $adminWallet->save();
            } else {
                throw new \Exception("Insufficient funds in admin wallet");
            }
            // dump("here");
            // exit();

            $wallet_transaction = new  WalletTransaction();
            $wallet_transaction->user_id = $admin_id;
            $wallet_transaction->wallet_id = $adminWallet->id;
            $wallet_transaction->order_id = $order->id;
            $wallet_transaction->amount = $paidAmount;
            $wallet_transaction->type = "Debit";
            $wallet_transaction->balance = $adminWallet->balance;
            $wallet_transaction->transaction_ref = "internal";
            $wallet_transaction->description = "Money transfer to the seller";
            $wallet_transaction->image = 'no Image';
            $wallet_transaction->save();
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
            $sellerWalletTransaction1->description = "Seller (ID: $sellerId) received a payment of $paidAmount for the order (ID: $order->id). This amount is based on 100% allocation of the paid amount.";

            $sellerWalletTransaction1->image = 'no Image';
            $sellerWalletTransaction1->save();

            $update_order_point_deducted = Order::findOrFail($order_id);
            $update_order_point_deducted->increment('points_deducted');
            $update_order_point_deducted->save();
            $user_point = User::where('id', $sellerId)->first();
            $user_point->points_balance -= 1;
            $user_point->save();
            PointTransaction::create([
                'seller_id' => $sellerId,
                'buyer_id' => $buyerId,
                'listing_id' => $listing_id,
                'order_id' => $order_id,
                'description' => 'Late Delivery',
                'type' => 'penalty',
            ]);
        }
        $this->info('money transfer to the seller ');
    }
}