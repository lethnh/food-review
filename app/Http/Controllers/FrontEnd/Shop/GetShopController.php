<?php

namespace App\Http\Controllers\FrontEnd\Shop;

use App\Http\Controllers\Controller;
use App\Models\Post_Review_Shop_Tag;
use App\Models\PostReview;
use App\Models\Shop;
use App\Models\Tag;
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
        $shop_post_review = Shop::with('city:id,name', 'district:id,name,city_id')->withCount(['postReviews' => function ($query) {
            $query->where('is_approve', 1);
        }])->orderBy('post_reviews_count', 'DESC')->take(4)->get();
        foreach ($shop_post_review as $key => $value) {
            if ($value['post_reviews_count'] == 0) {
                unset($shop_post_review[$key]);
            }
        }
        return response()->json($shop_post_review, 200);
    }

    public function getShopHasPostReviewInDay()
    {
        $shop_post_review = Shop::with('city:id,name', 'district:id,name,city_id')->withCount(['postReviews' => function ($query) {
            $query->where('is_approve', 1);
        }])->orderBy('post_reviews_count', 'DESC')->orderBy('post_reviews_count', 'DESC')->take(4)->get();
        return response()->json($shop_post_review, 200);
    }

    public function getShopNew()
    {
        $posts =  PostReview::where('is_approve', 1)->where('created_at', '>=', Carbon::now()->subDays(7))->with(['shop' => function ($query) {
            $query->with('city:id,name', 'district:id,name,city_id');
        }])->get();
        $shop = [];
        foreach ($posts as $key => $value) {
            array_push($shop, $value['shop']);
        }
        return response()->json($shop);
    }

    public function getPostReview($id)
    {
        $post_reviews =  PostReview::join('users', 'users.id', '=', 'post_reviews.user_id')
            ->where('users.status', 1)
            ->where('post_reviews.is_approve', 1)
            ->where('post_reviews.shop_id', $id)->get();
        return response()->json($post_reviews, 200);
    }

    public function getImages($id)
    {
        $images = PostReview::select(
            'post_review_images.link',
            'post_review_images.post_review_id',
        )->join('users', 'users.id', '=', 'post_reviews.user_id')
            ->join('post_review_images', 'post_review_images.post_review_id', '=', 'post_reviews.id')
            ->where('users.status', 1)
            ->where('post_reviews.is_approve', 1)
            ->where('post_reviews.shop_id', $id)->get();
        return response()->json($images, 200);
    }

    public function getShopRelate($id)
    {
        $shop = Shop::findOrFail($id);
        $list_post = Shop::where('city_id', $shop->city_id)->where('district_id', $shop->district_id)->get();
    }

    public function getComments($id)
    {
        $comments = PostReview::select(
            'comments.content',
            'users.name',
            'post_reviews.title',
            'post_reviews.id',
            'users.avatar',
        )->join('users', 'users.id', '=', 'post_reviews.user_id')
            ->join('comments', 'comments.post_review_id', '=', 'post_reviews.id')
            ->where('users.status', 1)
            ->where('post_reviews.is_approve', 1)
            ->where('post_reviews.shop_id', $id)->get();
        return response()->json($comments, 200);
    }

    public function getShop($id)
    {
        $shop = Shop::where('id', $id)->with('city', 'district')->withCount('postReviews')->first();
        return response()->json($shop, 200);
    }
    public function getShopTags($id)
    {
        $tags = Post_Review_Shop_Tag::select([
            'tags.name'
        ])->join('tags', 'tags.id', '=', 'post_review_tags.tag_id')
            ->join('post_reviews', 'post_reviews.id', '=', 'post_review_tags.post_review_id')
            ->where('post_review_tags.shop_id', $id)->where('post_reviews.is_approve', 1)->get();
        return response()->json($tags, 200);
    }
}
