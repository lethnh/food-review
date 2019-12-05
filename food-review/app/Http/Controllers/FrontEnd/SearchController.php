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
        $shops = Shop::whereHas('city', function ($query) use($data) {
            if( $data['city'] !== null){
                $query->where('id', $data['city']);
            }
        })->whereHas('district' , function ($query) use($data) {
            if($data['district'] !== null){
                $query->where('id', $data['district']);
            }
        })->with('city:id,name','district:id,name,city_id')
        ->take(4)->get();

        foreach ($shops as $key => $value) {
            $value->stars;
            $value->money;
        }
        if($data['money'] === "0"){
            $shops = $shops->where('stars', $data['rating']);
        }else{
            $shops = $shops->where('stars', $data['rating'])->where('money',$data['money']);
        }
        return response()->json($shops, 200);
    }
}
