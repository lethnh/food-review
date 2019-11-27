<?php

namespace App\Http\Controllers\FrontEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostReviewRequest;
use App\Models\City;
use App\Models\District;
use App\Services\TagService;
use App\Models\PostReview;
use App\Models\Shop;
use App\Services\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreatePostReviewController extends Controller
{
    protected $uploadImageService;
    protected $tagService;

    public function __construct(UploadImageService $uploadImageService, TagService $tagService)
    {
        $this->uploadImageService = $uploadImageService;
        $this->tagService          = $tagService;
    }

    public function storePostReview(Request $request)
    {
        try {
            
            DB::beginTransaction();
            $data_post_review = $request->only(['images', 'content', 'money', 'stars', 'shop_id', 'title', 'tags']);
            if (empty($data_post_review['shop_id'])) {
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
            }

            $post_review = PostReview::create([
                'title' => $data_post_review['title'],
                'money' => $data_post_review['money'],
                'stars' =>  $data_post_review['stars'],
                'content' => $data_post_review['content'],
                'user_id' => Auth::user()->id,
                'shop_id' => empty($data_post_review['shop_id']) ? $shop->id : $data_post_review['shop_id'],
            ]);



            $this->uploadImageService->uploadImage($data_post_review['images'], $post_review);
            $this->tagService->storeTag($data_post_review['tags'], $post_review->id, $shop->id);

            DB::commit();
            return response()->json($post_review, 200);
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
