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

    public function storePostReview(Request $request)
    {
        $data = $request->all();
        if (empty($data['shop_id'])) {
            // $data_shop = $reque;
            $shop = Shop::create([
                // 'name' => ''
                    
            ]);
        }

        $post_review = PostReview::create([
            'money' => $data['money'],
            'stars' =>  $data['stars'],
            'content' => $data['content'],
            'user_id' => Auth::user()->id,
            'shop_id' => empty($data['shop_id']) ? $shop->id : $data['shop_id'],
        ]);


            
        $this->uploadImageService->uploadImage($data['images'], $post_review->id);

        return response()->json($post_review, 200);
    }
}
