<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_Review_Shop_Tag extends Model
{
    protected $table = 'post_review_tags';
    protected $fillable = ['post_review_id', 'tag_id'];
}
