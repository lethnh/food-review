<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadImageService
{
    public function uploadImage($data_image, $post_id)
    {
        $link = [];
        $data = [];
        $image_data = $data_image;
        foreach ($image_data as $k => $value) {
            // Mã hóa chuỗi base  thành ảnh
            $base64_str = substr($value, strpos($value, ",") + 1);
            //decode base64 string
            $image = base64_decode($base64_str);
            $safeName = Str::random(10) . '.' . 'png';
            $pathImage = Storage::disk('public')->put('post-review/' . $post_id . 'images/' . $safeName, $image);
            $image = Storage::disk('public')->url($safeName);
            $data['post_review_id'] = $post_id;
            $data['link'] = $image;
            $link[] = $data;
        }
        $image =  \DB::table('post_review_images')->insert($link);
        if ($image === false) {
            throw new \Exception('Upload ảnh không thành công');
        }
    }
}
