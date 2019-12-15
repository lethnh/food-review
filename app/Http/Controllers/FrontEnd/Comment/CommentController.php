<?php

namespace App\Http\Controllers\FrontEnd\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentPostReview(Request $request)
    {
        try {
            if (!Auth::user()) {
                return response()->json(['error' => 'Bạn cần đăng nhập để bình luận'], 500);
            }
            $data_comment = $request->only('content', 'post_review_id', 'parent_id', 'content2');
            $content =  $data_comment['content'] === "" ||  $data_comment['content'] === null  ?  $data_comment['content2'] : $data_comment['content'];
            $user_id = Auth::id();
            $comment = Comment::create([
                'content' => $content,
                'user_id' => $user_id,
                'post_review_id' => $data_comment['post_review_id'],
                'parent_id' => $data_comment['parent_id'],
            ]);
            return response()->json($comment, 200);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }

    public function getCommentByPostReview(Request $request, $id)
    {
        try {
            $comments = Comment::where('post_review_id', $id)
                ->where('parent_id', 0)
                ->with('user:id,name,avatar')->with(['sub_comment' => function ($query) {
                    $query->with('user:id,name,avatar');
                }])
                ->with(['likes' => function ($query) {
                    $query->whereIn('status', [1, -1]);
                }])->get();
            return response()->json($comments, 200);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
}
