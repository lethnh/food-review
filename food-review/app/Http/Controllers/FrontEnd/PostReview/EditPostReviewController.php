<?php

namespace App\Http\Controllers\FrontEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;

class EditPostReviewController extends Controller
{
    public function editPostReview(Request $request, $id)
    { }
    public function showPostReview($id)
    {
        $post_review = PostReview::findOrFail($id)->first();
        return response()->json($post_review, 200);
    }
}
