<?php

namespace App\Http\Controllers\FrontEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostReviewRequest;
use App\Models\PostReview;
use App\Models\Shop;
use App\Services\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatePostReviewController extends Controller
{
    protected $uploadImageService;

    public function __construct(UploadImageService $uploadImageService)
    {
        $this->uploadImageService = $uploadImageService;
    }

    public function storePostReview(PostReviewRequest $request)
    {
        $data = $request->all();
        if (empty($data['shop_id'])) {
            $shop = Shop::create([]);
        }



        $post_review = PostReview::create([
            'money' => $data['money'],
            'star' =>  $data['star'],
            'content' => $data['content'],
            'user_id' => Auth::user()->id,
            'shop_id' => empty($data['shop_id']) ? $shop->id : $data['shop_id'],
        ]);



        $this->uploadImageService->uploadImage(data['images'], $post_review->id);

        return 1;
    }
}
