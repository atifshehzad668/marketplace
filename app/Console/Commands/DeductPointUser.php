<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DeductPointUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deduct-point-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Will Deduct Point On Late Delivery';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::where('status', 'paid')
            ->where('created_date', '>', Carbon::now()->subDays(20)) // 20 days ago
            ->where('points_deducted', '!=', 1)
            ->get();
    }
}