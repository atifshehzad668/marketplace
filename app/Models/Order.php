<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'listing_id',
        'seller_id',
        'buyer_id',
        'status',
        'seller_status',
        'buyer_status',
    ];

    /**
     * Get the listing that owns the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Orderlisting()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    /**
     * Get the seller associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /**
     * Get the buyer associated with the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    public function order_wallet_transaction()
    {
        return $this->belongsTo(WalletTransaction::class, 'order_id');
    }
}
