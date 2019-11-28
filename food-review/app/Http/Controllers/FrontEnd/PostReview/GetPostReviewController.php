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
        $post_review->total_view = $post_review->increment('total_view');
        $post_review->save();
        $post_review->post_review_images;
        $post_review->user->city;
        $post_review->shop;
        $post_review->user->district;
        return response()->json($post_review, 200);
    }

    public function getPostReviewByUser(Request $request, $user_id)
    {

        // $post_review = PostReview::findOrFail($);
        // $post_review->post_review_images;
        // return response()->json($post_review, 200);
    }
    public function getPostReviewLatestNew()
    {
        $post_reviews = PostReview::where('is_approve', 1)->with(['user' => function ($query) {
            $query->select('id','name')->where('status', 1);
        }])->orderBy('created_at', 'DESC')->paginate(5);
        return response()->json($post_reviews, 200);
    }

    public function getPostReviewTopView()
    {
        $post_reviews = PostReview::where('is_approve', 1)->with(['user' => function ($query) {
            $query->select('id','name')->where('status', 1);
        }])->orderBy('total_view', 'DESC')->take(4)->get();
        return response()->json($post_reviews, 200);
    }

    public function getPostReviewTopComment()
    {
        $post_reviews = PostReview::where('is_approve', 1)->with(['user' => function ($query) {
            $query->select('id','name')->where('status', 1);
        }])->withCount('comments')
            ->orderBy('comments_count', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->take(4)
            ->get();
        return response()->json($post_reviews, 200);
    }
}
