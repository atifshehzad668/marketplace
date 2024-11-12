<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointTransaction extends Model
{
    protected $fillable = [
        'seller_id',
        'buyer_id',
        'listing_id',
        'order_id',
        'description',
        'type',
    ];

    /**
     * Get the user that owns the PointTransaction
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
    public function listings()
    {
        return $this->belongsTo(Listing::class, 'listing_id', 'id');
    }
}