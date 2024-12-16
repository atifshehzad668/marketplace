<?php

namespace App\Console\Commands;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ListingBumpAt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:listing-bump-at';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $listingsUpdatedCount = Listing::where('last_bump_at', '<', Carbon::now()->subDay(1))
            ->update(['last_bump_at' => Carbon::now()]);

        $this->info('Listings updated: ' . $listingsUpdatedCount);
    }
}
