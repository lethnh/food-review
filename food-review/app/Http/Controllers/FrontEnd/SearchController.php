<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use App\Models\Shop;
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
                ->with('user:id,name')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
            $shops = Shop::where('name', 'like', '%' . $text . '%')
                ->with('city', 'district')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        } elseif ($text === "null") {
            // $post_reviews = PostReview::with(['shop' => function ($query, $text) {
            //     $query->where('city_id', $text);
            // }])
            //     ->where('title', 'like', '%' . $text . '%')
            //     ->with('user:id,name')
            //     ->orderBy('created_at', 'DESC')
            //     ->paginate(5);

            $post_reviews = DB::table('post_reviews')->join('shops', 'post_reviews.shop_id', '=', 'shops.id')->where('shops.city_id', $city)->paginate(5);
            $shops = Shop::where('city_id',  $city)
                ->with('city', 'district')
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        } else {
            $post_reviews = DB::table('post_reviews')->join('shops', 'post_reviews.shop_id', '=', 'shops.id')->where('shops.city_id', $city)->where('name', 'like', '%' . $text . '%')->paginate(5);
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
}
