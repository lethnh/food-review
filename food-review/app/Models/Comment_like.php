<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_like extends Model
{
    protected $table = 'comment_likes';
    protected $fillable = ['comment_id', 'user_id', 'status'];

    public function comments(){
        
    }
}
