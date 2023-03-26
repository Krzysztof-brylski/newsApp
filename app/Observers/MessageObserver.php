<?php

namespace App\Observers;

use App\Models\LiveRelationMessage;
use App\Models\Logs;
use Illuminate\Support\Facades\Auth;

class MessageObserver
{
    /**
     * Handle the LiveRelationMessage "created" event.
     */
    public function created(LiveRelationMessage $liveRelationMessage): void
    {
        $log= new Logs(['action'=>'live_relation_created']);
        $log->actionMaker()->associate(Auth::user());
        $liveRelationMessage->Logs()->associate($liveRelationMessage);
    }

    /**
     * Handle the LiveRelationMessage "updated" event.
     */
    public function updated(LiveRelationMessage $liveRelationMessage): void
    {
        $log= new Logs(['action'=>'live_relation_message_created']);
        $log->actionMaker()->associate(Auth::user());
        $liveRelationMessage->Logs()->associate($liveRelationMessage);
    }

}
