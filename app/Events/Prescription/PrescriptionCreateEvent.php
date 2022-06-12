<?php

namespace App\Events\Prescription;

use App\Models\Prescription;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PrescriptionCreateEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Prescription $prescription;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($prescription)
    {
        //
        $this->prescription = $prescription;
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
