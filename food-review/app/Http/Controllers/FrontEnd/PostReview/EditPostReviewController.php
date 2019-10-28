<?php

namespace App\Http\Controllers\FrontEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;
use App\Services\DeleteImageService;
use App\Services\UploadImageService;

class EditPostReviewController extends Controller
{
    protected $deleteImageService;
    protected $uploadImageService;

    public function __construct(UploadImageService $uploadImageService, DeleteImageService $deleteImageService)
    {
        $this->deleteImageService = $deleteImageService;
        $this->uploadImageService = $uploadImageService;
    }

    public function editPostReview(Request $request, $id)
    {
        $data_post_review = $request->all();
        $post_review = PostReview::findOrFail($id);
        $post_review->update([
            'title' => $data_post_review['title'],
            'money' => $data_post_review['money'],
            'stars' =>  $data_post_review['stars'],
            'content' => $data_post_review['content'],
            'shop_id' => $data_post_review['shop_id'],
        ]);
        $post_review->save();
        $this->uploadImageService->uploadImage($data_post_review['images'], $post_review);
        
        return response()->json($post_review, 200);
    }
    public function showPostReview($id)
    {
        $post_review = PostReview::findOrFail($id)->first();
        return response()->json($post_review, 200);
    }
    public function deleteImage(Request $request, $id)
    {
        try {
            //code...
            $this->deleteImageService->deleteImage($request->link, $id);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th);
        }
    }
}
