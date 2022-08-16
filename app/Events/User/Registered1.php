<?php

namespace App\Events\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Registered1
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public Authenticatable $user;
    public User $admin;


    public function __construct(User $admin , Authenticatable $user)
    {
        $this->admin = $admin;
        $this->user = $user;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */

}
