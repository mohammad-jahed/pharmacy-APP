<?php

namespace App\Listeners\User;

use App\Events\User\Registered1;
use App\Notifications\UserNotification;
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
     * @param Registered1 $event
     * @return void
     */
    public function handle(Registered1 $event)
    {
        //
        $userData = [
            'body' => 'You have a new user registered.',
            'userText' => $event->user->username,
            'userUrl' => url('/'),
            'user_id' => $event->user->id
        ];

        $event->admin->notify(new UserNotification($userData));

    }
}
