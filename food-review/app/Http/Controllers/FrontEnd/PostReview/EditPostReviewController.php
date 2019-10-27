<?php

namespace App\Http\Controllers\FrontEnd\PostReview;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;
use App\Services\DeleteImageService;

class EditPostReviewController extends Controller
{
    protected $deleteImageService;

    public function __construct(DeleteImageService $deleteImageService)
    {
        $this->deleteImageService = $deleteImageService;
    }

    public function editPostReview(Request $request, $id)
    { }
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
