<?php

namespace App\Listeners\Prescription;

use App\Events\Prescription\PrescriptionCreateEvent;
use App\Notifications\PrescriptionNotification;
use function url;

class PrescriptionCreateListener
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
     * @param PrescriptionCreateEvent $event
     * @return void
     */
    public function handle(PrescriptionCreateEvent $event)
    {
        //

        $prescriptionData = [
            'body' => 'You received a new prescription.',
            'prescriptionText' => $event->prescription->imagePath,
            'prescriptionUrl' => url('/'),
            'prescription_id' => $event->prescription->id
        ];
        $event->admin->notify(new PrescriptionNotification($prescriptionData));
    }
}
