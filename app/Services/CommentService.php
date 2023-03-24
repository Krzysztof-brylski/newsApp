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
    public function comment(string $content,User $commenter, $resource):void
    {
        $comment = new Comment(['content'=>$content]);
        $comment->Author()->associate($commenter);

        $resource->Comments()->save($comment);
    }
}
