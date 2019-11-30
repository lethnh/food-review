<?php

namespace App\Http\Controllers\BackEnd\Shop;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Post_Review_Shop_Tag;
use App\Models\PostReview;
use App\Models\PostReviewImage;
use App\Models\Shop;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function getShops()
    {
        $shops = Shop::with('city', 'district')->paginate(5);
        return response()->json($shops, 200);
    }

    public function store(Request $request)
    {
        $data_shop = $request->only([
            'begin_time', 'close_time', 'shop_lat', 'shop_lng',
            'shop_name', 'shop_image', 'shop_google_map_id', 'shop_city',
            'shop_district', 'shop_address', 'shop_type'
        ]);
        $city = City::where('name', 'like', '%' . $data_shop['shop_city'] . '%')->first();
        $district = District::where('name', 'like', '%' . $data_shop['shop_district'] . '%')->first();
        $data_shop['shop_image'] = $data_shop['shop_image'] !== null ? $data_shop['shop_image'] : null;
        $shop = Shop::create([
            'begin_time' => $data_shop['begin_time'],
            'close_time' => $data_shop['close_time'],
            'google_map_id' => $data_shop['shop_google_map_id'],
            'lat' => $data_shop['shop_lat'],
            'lng' => $data_shop['shop_lng'],
            'address' => $data_shop['shop_address'],
            'type' => $data_shop['shop_type'],
            'feature_image' => $data_shop['shop_image'],
            'name' => $data_shop['shop_name'],
            'city_id' => $city->id,
            'district_id' => $district->id,
        ]);
        return response()->json($shop, 200);
    }
    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $shop = Shop::find($id);
            $shop->delete();
            $post_review = PostReview::where('shop_id');
            foreach ($post_review as $key => $value) {
                DB::delete('
            delete comments, comment_likes  from comments
            inner join comment_likes ON comment_likes.comment_id = comments.id 
            where comments.post_review_id = :id;', ['id', $value->id]);
                Post_Review_Shop_Tag::where('shop_id', $id)->delete();
                PostReviewImage::where('post_review_id', $value->id)->delete();
                DB::delete('
                delete post_review_tags, tags  from post_review_tags
                inner join tags ON tags.id = post_review_tags.tag_id 
                where post_review_tags.post_review_id = :id;', ['id', $value->id]);
            };
            $post_review->delete();
            DB::commit();
            return response()->json(200);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }
}
