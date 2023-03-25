<?php

namespace App\Listeners;

use App\Events\LiveRelationMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LiveRelationListerner
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
    public function handle(LiveRelationMessage $event): void
    {
        //todo push to admin logs via model observer
        //todo send notification to relation newsleater
        $event->save();
    }
}
