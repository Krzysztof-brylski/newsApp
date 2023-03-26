<?php

namespace App\Observers;

use App\Models\Logs;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $log= new Logs(['action'=>'post_created']);
        $log->actionMaker()->associate(Auth::user());
        $post->Logs()->associate($log);
    }

    /**
     * Handle the Post "liked" event.
     */
    public function like(Post $post): void
    {
        $log= new Logs(['action'=>'post_liked']);
        $log->actionMaker()->associate(Auth::user());
        $post->Logs()->associate($log);
    }

    /**
     * Handle the Post "comment" event.
     */
    public function comment(Post $post): void
    {
        $log= new Logs(['action'=>'post_commented']);
        $log->actionMaker()->associate(Auth::user());
        $post->Logs()->associate($log);
    }
}
