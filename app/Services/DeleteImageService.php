<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DeleteImageService
{
    public function deleteImage($image, $post_review_id)
    {
        $link = str_replace(config('app.url') . '/storage/', '', $image);
        Storage::disk('public')->delete($link);
        $image =  \DB::table('post_review_images')->where('link', $image)->delete();
        if ($image === false) {
            throw new \Exception('Upload ảnh không thành công');
        }
    }
}
