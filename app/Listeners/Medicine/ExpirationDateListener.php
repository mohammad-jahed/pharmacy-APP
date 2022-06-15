<?php

namespace App\Listeners\Medicine;

use App\Events\Medicine\ExpirationDateEvent;
use App\Notifications\MedicineNotification;
use Illuminate\Support\Facades\Date;

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
        /**
         * @var int $date ;
         */
        $date = Date::now()->diffInDays($event->medicine->expiration_date);
        $medicineData = [
            'body' =>"This medicine will expire after {$date} days ",
            'medicineText' => $event->medicine->name,
            'medicineUrl' => url('/'),
            'medicine_id' => $event->medicine->id
        ];

        $event->user->notify(new MedicineNotification($medicineData));

    }
}
