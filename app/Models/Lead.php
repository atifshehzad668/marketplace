<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'lead_date',
        'lead_number',
        'lead_vehicle',
        'lead_source',
        'customer_id',
        'saleman_id',
        'vehicle_id',
    ];
    /**
     * Get the customer t
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }


    /**
     * Get all of the conversations f
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'lead_id', 'id');
    }
}