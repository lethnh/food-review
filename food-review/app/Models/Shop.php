<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = ['name', 'description', 'address', 'lat', 'lng', 'type', 'city_id', 'district_id'];
}
