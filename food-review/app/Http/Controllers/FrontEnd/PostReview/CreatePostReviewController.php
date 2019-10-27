<?php

namespace App\Http\Controllers\FrontEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostReviewRequest;
use App\Logic\TagService;
use App\Models\PostReview;
use App\Models\Shop;
use App\Services\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $data_post_review = $request->only(['images', 'content', 'money', 'stars', 'shop_id', 'title']);
        if (empty($data_post_review['shop_id'])) {
            $data_shop = $request->only(['begin_time', 'close_time', '']);
            $shop = Shop::create([
                'begin_time' => $data_shop['begin_time'],
                'close_time' => $data_shop['close_time'],

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
        $this->tagService->storeTag();

        return response()->json($post_review, 200);
    }
}
