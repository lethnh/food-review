<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $table = 'shops';
    protected $fillable = ['name', 'description', 'address', 'lat', 'lng', 'type', 'city_id', 'district_id', 'feature_image', 'google_map_id', 'begin_time', 'close_time'];
    protected $appends = ['stars', 'money'];

    public function postReviews()
    {
        return $this->hasMany(PostReview::class, 'shop_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function getStarsAttribute()
    {
        $stars = PostReview::where('shop_id', $this->id)->sum('stars');
        if ($this->post_reviews_count !== null && $this->post_reviews_count !== 0) {
            $avg = round(($stars /  $this->post_reviews_count), 2);
        } else {
            $avg = 0;
        }
        return $avg;
    }

    public function getMoneyAttribute()
    {
        $money = PostReview::where('shop_id', $this->id)->avg('money');
        return $money;
    }
}
