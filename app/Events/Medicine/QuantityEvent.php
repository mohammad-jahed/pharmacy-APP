<?php

namespace App\Events\Medicine;

use App\Models\Medicine;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuantityEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Medicine $medicine;
    public Authenticatable $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Authenticatable $user, Medicine $medicine)
    {
        $this->user = $user;
        $this->medicine = $medicine;
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
