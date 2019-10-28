<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImageService
{
    public function uploadImage($data_image, $post_review)
    {
        $link = [];
        $data = [];
        $post_id = $post_review->id;
        $image_data = $data_image;
        foreach ($image_data as $k => $value) {
            // Mã hóa chuỗi base  thành ảnh
            $base64_str = substr($value, strpos($value, ",") + 1);
            //decode base64 string
            $image = base64_decode($base64_str);
            $safeName = Str::random(10) . '.' . 'png';
            $pathImage = Storage::disk('public')->put('post-review/' . $post_id . '/' . $safeName, $image);
            $image = Storage::disk('public')->url('post-review/' . $post_id . '/' .  $safeName);
            $data['post_review_id'] = $post_id;
            $data['link'] = $image;
            $link[] = $data;
        }
        $image =  \DB::table('post_review_images')->insert($link);
        if (empty($post_review->feature_image)) {
            $post_review->update([
                'feature_image' => $link[0]['link'],
            ]);
        };
        // $users = \DB::select('select f from users where active = ?', [1]);
        if ($image === false) {
            throw new \Exception('Upload ảnh không thành công');
        }
    }
}
