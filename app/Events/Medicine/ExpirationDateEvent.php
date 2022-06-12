<?php

namespace App\Events\Medicine;

use App\Models\Medicine;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExpirationDateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Medicine $medicine;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Medicine $medicine)
    {
        //
        $this->medicine = $medicine;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|PrivateChannel|array
     */
    public function broadcastOn(): Channel|PrivateChannel|array
    {
        return new PrivateChannel('channel-name');
    }
}
