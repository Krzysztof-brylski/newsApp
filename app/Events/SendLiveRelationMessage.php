<?php

namespace App\Events;

use App\Models\LiveRelationMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendLiveRelationMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $liveRelationId;
    private LiveRelationMessage $message;


    /**
     * Create a new event instance.
     */
    public function __construct(LiveRelationMessage $message)
    {
        $this->liveRelationId=$message->prev_message;
        $this->message=$message;
    }


    public function broadcastAs(){
        return "LiveRelation_{$this->liveRelationId}";
    }

    public function broadcastWith(){
        return array(
            'liveTitle'=>$this->message->relation_title,
            'title'=>$this->message->title,
            'content'=>$this->message->content,
        );
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel("App.LiveRelation.1"),
        ];
    }
}
