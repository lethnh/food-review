<?php

namespace App\Http\Controllers\BackEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;

class PostReviewController extends Controller
{
    public function getListPostReview(Request $request)
    {
        $post_reviews = PostReview::with('user:id,name', 'shop:id,name')->orderBy('created_at')->paginate(5);
        return response()->json($post_reviews, 200);
    }

    public function approve(Request $request, $id)
    {
        $post_review = PostReview::findOrFail($id);
        $post_review->is_approve = $request->status;
        $post_review->save();
        return response()->json($post_review, 200);
    }
}
