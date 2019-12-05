<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function postSearch(Request $request)
    {
        $data = $request->all();
        $text = $request->searchText;
        $city = $request->city_id;
        if ($city === "null") {
            $post_reviews = PostReview::where('title', 'like', '%' . $text . '%')
                ->where('post_reviews.is_approve', 1)
                ->with('user:id,name')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
            $shops = Shop::where('name', 'like', '%' . $text . '%')
                ->with('city', 'district')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        } elseif ($text === "null") {
            $post_reviews = DB::table('post_reviews')->join('shops', 'post_reviews.shop_id', '=', 'shops.id')
                ->where('post_reviews.is_approve', 1)
                ->where('shops.city_id', $city)->paginate(5);
            $shops = Shop::where('city_id',  $city)
                ->with('city', 'district')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        } else {
            $post_reviews = DB::table('post_reviews')->join('shops', 'post_reviews.shop_id', '=', 'shops.id')
                ->where('post_reviews.is_approve', 1)
                ->where('shops.city_id', $city)
                ->where('name', 'like', '%' . $text . '%')->paginate(5);
            $shops = Shop::where('city_id',  $city)
                ->where('name', 'like', '%' . $text . '%')
                ->with('city', 'district')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        }
        return response()->json([
            'post_reviews' => $post_reviews,
            'shops' => $shops,
        ], 200);
    }

    public function postSearchFilTer(Request $request)
    {
        $data =  $request->only(['rating', 'money', 'city', 'district']);
        $shop_post_review = Shop::whereHas('city', function ($query) use ($data) {
            if ($data['city'] !== null) {
                $query->where('id', $data['city']);
            }
        })->whereHas('district', function ($query) use ($data) {
            if ($data['district'] !== null) {
                $query->where('id', $data['district']);
            }
        })->with('city:id,name', 'district:id,name,city_id')
            ->withCount(['postReviews' => function ($query) {
                $query->where('is_approve', 1);
            }])
            ->orderBy('post_reviews_count', 'DESC')
            ->take(4)->get();

        foreach ($shop_post_review as $key => $value) {
            $value->stars;
            $value->money;
        }
        if ($data['money'] === "0") {
            $shop_post_review = $shop_post_review->where('stars', $data['rating']);
        } else {
            $shop_post_review = $shop_post_review->where('stars', $data['rating'])->where('money', $data['money']);
        }


        $shop_new = Shop::whereHas('city', function ($query) use ($data) {
            if ($data['city'] !== null) {
                $query->where('id', $data['city']);
            }
        })->whereHas('district', function ($query) use ($data) {
            if ($data['district'] !== null) {
                $query->where('id', $data['district']);
            }
        })->with('city:id,name', 'district:id,name,city_id')
            ->whereHas('postReviews', function ($query) {
                $query->where('created_at', '>=', Carbon::now()->subDays(7))->where('is_approve', 1);
            })
            ->take(4)->get();

        foreach ($shop_new as $key => $value) {
            $value->stars;
            $value->money;
        }
        if ($data['money'] === "0") {
            $shop_new = $shop_new->where('stars', $data['rating']);
        } else {
            $shop_new = $shop_new->where('stars', $data['rating'])->where('money', $data['money']);
        }
        $shop_new_relesae = [];
        foreach ($shop_new as $key => $value) {
            if (!empty($value['postReviews'])) {
                array_push($shop_new_relesae, $value);
            }
        }

        return response()->json(['shop_post_review' => $shop_post_review, 'shop_new' => $shop_new_relesae], 200);
    }
}
