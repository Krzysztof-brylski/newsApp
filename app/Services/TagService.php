<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagService
{

    /**
     * create tag
     * @param array $data
     * @return void
     */
    public function createTag(array $data):void
    {
        Tag::create($data);
    }
    /**
     * updated specified tag
     * @param array $data
     * @return void
     */
    public function updateTag(array $data, Tag $tag):void
    {
        array_key_exists('name',$data)? $tag->name=$data['name']:null;
        $tag->save();
    }

    /**
     * delete specified tag
     * @param Tag $tag
     * @return void
     */
    public function deleteTag(Tag $tag):void
    {
        if(DB::table('posts_tags')->where('tag_id',$tag->id)->exists()){
            throw new \Exception('tag in use');
        }
        $tag->delete();

    }



}
