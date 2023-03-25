<?php

namespace App\Services;

use App\Events\SendLiveRelationMessage;
use App\Models\LiveRelationMessage;

class LiveRelationService
{
    public function createRelation(array $data):void
    {
        $message=LiveRelationMessage::create([
            'relation_title'=>$data['title'],
            'title'=>$data['title'],
            'content'=>$data['content'],
        ]);
        $message->LiveRelation()->save($message);

        event(new SendLiveRelationMessage($message));
    }

    public function postMessage(array $data,LiveRelationMessage $liveRelation):void
    {
        $newMessage=LiveRelationMessage::create([
            'relation_title'=>$liveRelation->title,
            'title'=>$data['title'],
            'content'=>$data['content'],
        ]);
        $liveRelation->LiveRelation()->save($newMessage);
        event(new SendLiveRelationMessage($newMessage));
    }
}
