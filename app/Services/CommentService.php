<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\User;

class CommentService
{

    public function update(array $data, Comment $comment):void
    {
        $comment->update(['content'=>$data['content']]);
    }

    public function delete(Comment $comment):void
    {
        $comment->delete();
    }
    public function comment(array $data,User $commenter, $resource):void
    {
        $comment = new Comment(['content'=>$data['content']]);
        $comment->Author()->associate($commenter);

        $resource->Comments()->save($comment);
    }
}
