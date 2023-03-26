<?php

namespace App\Listeners;
use App\Models\LiveRelationMessage;
use Illuminate\Support\Facades\Cache;
use App\Events\SendLiveRelationMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LiveRelationMessageListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendLiveRelationMessage $event): void
    {
        $id=$event->getLiveRelationId();
        Cache::forget("messages_{$id}");
        Cache::put("messages_{$id}",
            LiveRelationMessage::where('prev_message',$id)->get(),(60*60*24));
    }
}
