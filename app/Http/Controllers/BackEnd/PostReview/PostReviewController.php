<?php

namespace App\Http\Controllers\BackEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Comment_like;
use App\Models\Post_Review_Shop_Tag;
use App\Models\PostReview;
use App\Models\PostReviewImage;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostReviewController extends Controller
{
    public function getListPostReview(Request $request)
    {
        $post_reviews = PostReview::with('user:id,name', 'shop:id,name');
        if (!empty($request->get('text'))) {
            $post_reviews =   $post_reviews->where('title', 'LIKE', '%' . $request->get('text') . '%');
        } else {
            $post_reviews = $post_reviews->orderBy('created_at');
        }
        $post_reviews = $post_reviews->paginate(5);
        return response()->json($post_reviews, 200);
    }

    public function approve(Request $request, $id)
    {
        $post_review = PostReview::findOrFail($id);
        $post_review->is_approve = $request->status;
        $post_review->save();
        return response()->json($post_review, 200);
    }

    public function getListBlock(Request $request)
    {
        $post_reviews = PostReview::where('is_approve', -1)->with('user:id,name', 'shop:id,name');
        if (!empty($request->get('text'))) {
            $post_reviews =   $post_reviews->where('title', 'LIKE', '%' . $request->get('text') . '%');
        } else {
            $post_reviews = $post_reviews->orderBy('created_at');
        }
        $post_reviews = $post_reviews->paginate(5);
        return response()->json($post_reviews, 200);
    }

    public function getListWaiting(Request $request)
    {
        $post_reviews = PostReview::where('is_approve', 0)->with('user:id,name', 'shop:id,name');
        if (!empty($request->get('text'))) {
            $post_reviews =   $post_reviews->where('title', 'LIKE', '%' . $request->get('text') . '%');
        } else {
            $post_reviews = $post_reviews->orderBy('created_at');
        }
        $post_reviews = $post_reviews->paginate(5);
        return response()->json($post_reviews, 200);
    }

    public function getPostReview($id)
    {
        $post_review = PostReview::findOrFail($id);
        $post_review->post_review_images;
        $post_review->user->city;
        $post_review->shop;

        $post_review->user->district;
        return response()->json($post_review, 200);
    }

    public function getListRequestDelete(Request $request)
    {
        $post_reviews = PostReview::where('is_approve', -2)->with('user:id,name', 'shop:id,name');
        if (!empty($request->get('text'))) {
            $post_reviews =   $post_reviews->where('title', 'LIKE', '%' . $request->get('text') . '%');
        } else {
            $post_reviews = $post_reviews->orderBy('created_at');
        }
        $post_reviews = $post_reviews->paginate(5);
        return response()->json($post_reviews, 200);
    }

    public function delete($id)
    {
        $post_review = PostReview::findOrFail($id);
        $images = PostReviewImage::where('post_review_id', $post_review->id)->delete();
        $tags = Post_Review_Shop_Tag::where('post_review_id', $post_review->id);
        $comments = Comment::where('post_review_id', $post_review->id)->get();
        foreach ($tags as $key => $value) {
            Tag::where('id', $value->id)->delete();
        }
        foreach ($comments as $key => $value) {
            Comment_like::where('comment_id', $value->id)->delete();
        }
        $tags->delete();
        $comments->delete();
        $post_review->delete();
        return response()->json(200);
    }
}
