<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;

class LandlordRegistered extends Event
{
    use SerializesModels;

     public $userID;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $userID)
    {
        $this->id = $userID;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
