<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'priority'];

    public function districts()
    {
        return $this->hasMany(District::class, 'city_id', 'id');
    }
}
