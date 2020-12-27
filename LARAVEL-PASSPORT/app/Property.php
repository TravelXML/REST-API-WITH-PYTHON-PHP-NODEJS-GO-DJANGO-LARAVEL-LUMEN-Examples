<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'property_name', 'address', 'city', 'country', 'type','minimum_price','maximum_price','ready_to_sell'
    ];
}
