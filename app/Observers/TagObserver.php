<?php

namespace App\Observers;

use App\Models\Logs;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class TagObserver
{
    /**
     * Handle the Tag "created" event.
     */
    public function created(Tag $tag): void
    {
        $log= new Logs(['action'=>'tag_created']);
        $log->actionMaker()->associate(Auth::user());
        $tag->Logs()->associate($log);
    }

}
