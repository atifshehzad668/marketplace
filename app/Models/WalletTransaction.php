<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
    protected $fillable = [
        'user_id',
        'wallet_id',
        'amount',
        'type',
        'balance',
        'transaction_ref',
        'image',
        'description',
    ];
}
