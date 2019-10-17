<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostReviewImage extends Model
{
    protected $table = 'post_review_images';

    protected $fillable = ['post_review_id', 'link'];
}
