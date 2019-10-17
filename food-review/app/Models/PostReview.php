<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostReview extends Model
{
    protected $table = 'post_reviews';

    protected $fillable = [
        'content', 'user_id', 'shop_id', 'feature_image', 'money','stars',
    ];
}
