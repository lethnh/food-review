<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['content', 'user_id', 'post_review_id', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function postReview()
    {
        return $this->belongsTo(PostReview::class, 'post_review_id', 'id');
    }

    public function sub_comment()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
