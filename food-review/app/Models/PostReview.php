<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostReview extends Model
{
    protected $table = 'post_reviews';

    protected $fillable = [
        'content', 'user_id', 'shop_id', 'feature_image', 'money', 'stars', 'title',
    ];

    public function post_review_images()
    {
        return $this->hasMany(PostReviewImage::class, 'post_review_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
