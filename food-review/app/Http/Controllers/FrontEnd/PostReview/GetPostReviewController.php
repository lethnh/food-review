<?php

namespace App\Http\Controllers\FrontEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetPostReviewController extends Controller
{
    public function getPostReviewById(Request $request, $id)
    {
        $post_review = PostReview::findOrFail($id);
        $post_review->post_review_images;
        return response()->json($post_review, 200);
    }

    public function getPostReviewByUser(Request $request, $user_id)
    {  

        // $post_review = PostReview::findOrFail($);
        // $post_review->post_review_images;
        // return response()->json($post_review, 200);
    }
}
