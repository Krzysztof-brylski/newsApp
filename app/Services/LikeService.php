<?php

namespace App\Services;

use App\Models\Likes;
use App\Models\User;

class LikeService
{
    public function like(User $liker, mixed $resource):bool
    {
        $check=$resource->Likes()->where('author_id',$liker->id);
        if($check->exists()){
            $check->delete();
            return false;
        }
        $like = new Likes();
        $like->Author()->associate($liker);
        $resource->Likes()->save($like);
        return true;
    }
}
