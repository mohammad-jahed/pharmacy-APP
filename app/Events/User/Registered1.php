<?php

namespace App\Events\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use JetBrains\PhpStorm\ArrayShape;

class Registered1 implements ShouldBroadcast
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
    public function broadcastOn(): Channel
    {
        return new Channel('channel-name');
    }

    public function broadcastAs(): string
    {
        return "user_notifications";
    }

    #[ArrayShape(['title' => "string", 'subject' => "mixed", 'user_id' => "mixed"])]
    public function broadcastWith(): array
    {
        return [
            //
            'title'=>"You have a new registered user",
            'subject'=>$this->user->username,
            'user_id'=>$this->user->getAuthIdentifier()
        ];
    }
}
