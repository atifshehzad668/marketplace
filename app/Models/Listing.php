<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{

    protected $fillable = [
        'user_id',
        'category_id',
        'city_id',
        'region_id',
        'headline',
        'description',
        'quantity',
        'expiration_date',

    ];
    /**
     * Get all of the images for the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ListingImage::class);
    }
    public function Orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the user that owns the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}