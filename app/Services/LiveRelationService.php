<?php

namespace App\Services;

use App\Events\SendLiveRelationMessage;
use App\Models\LiveRelationMessage;
use Illuminate\Support\Facades\Cache;

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
        $lives=[];
        if(Cache::has('live_relations')){
            $lives=Cache::get('live_relations');
            Cache::forget('live_relations');
        }
        $lives[]=[
            'title'=>$data['title'],
            'id'=>$message->id,
        ];
        Cache::forever('live_relations',$lives);
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
