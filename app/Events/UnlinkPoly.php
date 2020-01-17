<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UnlinkPoly
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $relation;
    public $foreign_type;
    public $foreign_key;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($relation, $foreign_type, $foreign_key)
    {
        $this->relation = $relation;
        $this->foreign_type = $foreign_type;
        $this->foreign_key = $foreign_key;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
