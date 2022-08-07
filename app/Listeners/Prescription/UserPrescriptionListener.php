<?php

namespace App\Listeners\Prescription;

use App\Events\Prescription\UserPrescriptionEvent;
use App\Notifications\UserPrescriptionNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserPrescriptionListener
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
     * @param  \App\Events\UserPrescriptionEvent  $event
     * @return void
     */
    public function handle(UserPrescriptionEvent $event)
    {

        $event->user->notify(new UserPrescriptionNotification($event->msg));
    }
}
