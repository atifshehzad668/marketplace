<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'vehicle',
        'vehicle_brand',
        'model',
        'year',
        'mileage',
        'date_of_sale',
        'sale_rep',
        'lead_id',
    ];
}