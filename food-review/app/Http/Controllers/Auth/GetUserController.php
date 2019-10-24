<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetUserController extends Controller
{
    public function getUser()
    {
        try {
            $user = Auth::user();
            return response()->json($user, 200);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getPostReview()
    {
        $user_id = Auth::id();
        $post_review = PostReview::where('user_id', $user_id)->orderBy('created_at')->get();
        return response()->json($post_review, 200);
    }
}
