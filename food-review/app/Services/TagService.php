<?php


namespace App\Services;


use App\Models\Tag;

class TagService
{
    public function storeTag($data)
    {

        if (!empty($data['tags'])) {
            $arr = array_map(function ($item) {
                return $item['text'];
            }, $data['tags']);
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
            \DB::table('tags')->insert($insert_tag);
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
