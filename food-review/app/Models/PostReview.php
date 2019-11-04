<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostReview extends Model
{
    protected $table = 'post_reviews';

    protected $fillable = [
        'content', 'user_id', 'shop_id', 'feature_image', 'money', 'stars', 'title', 'total_view', 'is_approve', 'like', 'unlike'
    ];
    protected $appends = ['totalComment'];

    public function post_review_images()
    {
        return $this->hasMany(PostReviewImage::class, 'post_review_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_review_id', 'id');
    }

    public function tags()
    {
        return $this->hasMany(Post_Review_Shop_Tag::class, 'post_review_id', 'id');
    }

    public function getTotalCommentAttribute()
    {
        $totalComment = Comment::where('post_review_id', $this->id)->count();
        return $totalComment;
    }
}
