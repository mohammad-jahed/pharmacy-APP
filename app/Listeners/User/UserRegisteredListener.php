<?php

namespace App\Listeners\User;

use App\Notifications\UserNotification;
use Illuminate\Auth\Events\Registered;
use function url;


class UserRegisteredListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        //
        $userData = [
            'body' => 'You have a new user registered.',
            'thanks' => 'Thank you',
            'userText' => $event->user->username,
            'userUrl' => url('/'),
            'user_id' => $event->user->id
        ];

        $event->user->notify(new UserNotification($userData));

    }
}
