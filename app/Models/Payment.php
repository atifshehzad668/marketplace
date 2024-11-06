<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'trx_id',
        'amount',
        'payment_method',
        'status',
        'gateway_response',
    ];
}
