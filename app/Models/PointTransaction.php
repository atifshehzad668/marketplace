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
}