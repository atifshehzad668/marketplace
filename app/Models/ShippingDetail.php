<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingDetail extends Model
{
    protected $fillable = [
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'shipping_method',

    ];
}