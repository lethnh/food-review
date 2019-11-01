<?php

namespace App\Http\Controllers\FrontEnd\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
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
}
