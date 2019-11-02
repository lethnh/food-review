<?php


namespace App\Services;

use App\Models\Post_Review_Shop_Tag;
use App\Models\Tag;

class TagService
{
    public function storeTag($data, $post_review_id)
    {
        
        if (!empty($data)) {
            $arr = array_map(function ($item) {
                return $item['text'];
            }, $data);
            $test_tag = $this->getTagName($arr);
            $tag_name = array_map(function ($item) {
                return $item['name'];
            }, $test_tag);

            $result = array_diff($arr, $tag_name);

            $insert_tag =  array_map(function ($value) {
                $list = [
                    'name' => $value,
                    'slug' => str_slug($value, '-')
                ];
                return $list;
            }, $result);
            foreach ($insert_tag as $key => $value) {
                $tag = Tag::create([
                    'name' => $value['name'],
                    'slug' => $value['slug'],
                ]);
                Post_Review_Shop_Tag::create([
                    'post_review_id' => $post_review_id,
                    'tag_id' => $tag->id,
                ]);
            };
            $list_tag = $this->getTagName($arr);
            $list_id = array_map(function ($value) {
                return $value['id'];
            }, $list_tag);
            return $list_id;
        }
    }


    public function getTagName($arr)
    {
        return Tag::whereIn('tags.name', $arr)->get()->toArray();
    }

    public function getListPostByTag($tag)
    { }
}
