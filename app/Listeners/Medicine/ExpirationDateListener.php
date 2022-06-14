<?php

namespace App\Listeners\Medicine;

use App\Events\Medicine\ExpirationDateEvent;
use App\Notifications\MedicineNotification;

class ExpirationDateListener
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
     * @param ExpirationDateEvent $event
     * @return void
     */
    public function handle(ExpirationDateEvent $event)
    {
        //
        $medicineData = [
            'body' => 'A new Medicine is expired',
            'thanks' => 'Thank you',
            'medicineText' => $event->medicine->name,
            'medicineUrl' => url('/'),
            'medicine_id' => $event->medicine->id
        ];


        $event->admin->notify(new MedicineNotification($medicineData));

    }
}
