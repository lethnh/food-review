<?php

namespace App\Http\Controllers\FrontEnd\Shop;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\District;
use App\Models\Shop;
use Illuminate\Http\Request;

class CreateShopController extends Controller
{
    public function createShop(Request $request)
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
        $this->tagService->storeTag($data_post_review['tags'], $post_review->id, $shop->id);
        return response()->json($shop, 200);
    }
}