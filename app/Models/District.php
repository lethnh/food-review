<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'city_id'];

    public function city()
    {
        return $this->belongTo(City::class, 'city_id', 'id');
    }
}