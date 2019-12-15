<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post_Review_Shop_Tag extends Model
{
    protected $table = 'post_review_tags';
    protected $fillable = ['post_review_id', 'tag_id', 'shop_id'];

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }

    public function post_review()
    {
        return $this->belongsTo(PostReview::class, 'post_review_id', 'id');
    }
}
