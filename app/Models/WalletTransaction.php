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


    public function admin_wallet_transaction()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function seller_wallet_transaction()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}