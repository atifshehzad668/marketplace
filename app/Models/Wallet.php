<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'balance',

    ];



    public function admin_wallet()
    {
        return $this->belongsTo(User::class);
    }
}