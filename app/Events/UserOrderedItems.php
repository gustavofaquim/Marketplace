<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\UserOrder;

class UserOrderedItems
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userOrder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserOrder $userOrder)
    {
        $this->userOrder = $userOrder;
        
    }

    /*public function get_products(){
        return $this->products;
    }*/

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
