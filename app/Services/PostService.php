<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;

class PostService
{
    /**
     * create post with specified data and associate to specified author
     * @param array $data
     * @param User $author
     * @return void
     */
    public function createPost(array $data,User $author):void
    {

       $post= new Post([
            'title'=>$data['title'],
            'content'=>$data['content'],
            'thumbnail'=>$data['thumbnail'],
       ]);

       $post->Author()->associate($author);
       $post->save();
       $post->Tags()->attach($data['tags']);

    }

    /**
     * update specified post with specified data
     * @param array $data
     * @param Post $post
     * @return void
     */
    public function updatePost(array $data,Post $post):void
    {

        array_key_exists('title',$data) ? $post->title = $data['title']:null;
        array_key_exists('content',$data) ? $post->content =$data['content']:null;
        array_key_exists('thumbnail',$data) ? $post->thumbnail =$data['thumbnail']:null;
        array_key_exists('tags',$data) ? $post->Tags()->sync($data['tags']):null;


        $post->save();

    }
    /**
     * delete specified resource with pivot table rows
     * @param Post $post
     * @return void
     */
    public function deletePost(Post $post):void
    {
        $post->Tags()->delete();
        $post->delete();
    }


}
