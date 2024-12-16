<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_image',
      
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function listings()
    {
        return $this->hasMany(Listing::class);
    }


    public function ordersAsSeller()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }

    /**
     * Get all of the orders where the User is the buyer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordersAsBuyer()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }




    public function admin_wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }




    /**
     * Get all of the admin_wallet_transactions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function admin_wallet_transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'user_id');
    }
    public function seller_wallet_transactions()
    {
        return $this->hasMany(WalletTransaction::class, 'user_id');
    }


    /**
     * Get all of the point_transactions for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function point_transactions()
    {
        return $this->hasMany(PointTransaction::class);
    }



    public function seller_points()
    {
        return $this->hasMany(PointTrade::class, 'seller_id');
    }

    /**
     * Get the listings where the user is the buyer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function buyer_points()
    {
        return $this->hasMany(PointTrade::class, 'buyer_id');
    }
}