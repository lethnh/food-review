<?php

namespace App\Http\Controllers\FrontEnd\Shop;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GetShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        return response()->json($shops);
    }

    public function getShopHasManyPostReview()
    {
        $shop_post_review = Shop::with('city:id,name', 'district:id,name,city_id')->withCount('postReviews')->orderBy('post_reviews_count', 'DESC')->take(4)->get();
        return response()->json($shop_post_review, 200);
    }

    public function getShopHasPostReviewInDay()
    {
        $shop_post_review = Shop::with('city:id,name', 'district:id,name,city_id')->withCount('postReviews')->orderBy('post_reviews_count', 'DESC')->orderBy('post_reviews_count', 'DESC')->take(4)->get();
        return response()->json($shop_post_review, 200);
    }

    public function getShopNew()
    {
        $post =  PostReview::where('created_at', '>=', Carbon::now()->subDays(7))->with('shop')->get();
        $shop = $post;
        return response()->json($shop);
    }

    public function getPostReview($id)
    {
        $post_reviews =  PostReview::join('users', 'users.id', '=', 'post_reviews.user_id')
            ->where('user.status', 1)
            ->where('is_approve', 1)
            ->where('shop_id', $id)->paginate(5);
        return response()->json($post_reviews, 200);
    }

    public function getImages($id)
    {
        $images = PostReview::select(
            'post_review_images.link',
            'post_review_images.post_review_id',
        )->join('users', 'users.id', '=', 'post_reviews.user_id')
            ->join('post_review_images', 'post_review_images.post_review_id', '=', 'post_reviews.id')
            ->where('user.status', 1)
            ->where('is_approve', 1)
            ->where('shop_id', $id)->get();
        return response()->json($images, 200);
    }

    public function getShopRelate($id)
    { }

    public function getComments($id)
    {
        $comments = PostReview::select(
            'comments.content',
            'users.name',
            'post_reviews.title',
            'post_reviews.id'
        )->join('users', 'users.id', '=', 'post_reviews.user_id')
            ->join('comments', 'comments.post_review_id', '=', 'post_reviews.id')
            // ->where('user.status', 1)
            // ->where('is_approve', 1)
            ->where('shop_id', $id)->get();
        return response()->json($comments, 200);
    }

    public function getShop($id)
    {
        $shop = Shop::where('id', $id)->with('city', 'district')->first();
        return response()->json($shop, 200);
    }
}
