<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'thumbnail'=>Storage::put('public/thumbnails',$data['thumbnail'])
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

        array_key_exists('tags',$data) ? $post->Tags()->sync($data['tags']):null;

        if(array_key_exists('thumbnail',$data)){
            Storage::delete( $post->thumbnail);
            $post->thumbnail = Storage::put('/thumbnails',$data['thumbnail']);
        }

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
        Storage::delete( $post->thumbnail);
        $post->delete();
    }



}
