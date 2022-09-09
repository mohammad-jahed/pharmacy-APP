<?php

namespace App\Events\Prescription;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserPrescriptionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
        public User $user;
        public array $msg;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user,array $msg)
    {
        $this->user = $user;
        $this->msg=$msg;
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
