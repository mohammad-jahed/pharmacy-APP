<?php

namespace App\Listeners\Reservation;

use App\Events\Reservation\ReservationEvent;
use App\Models\Medicine;
use App\Models\Period;
use App\Notifications\ReservationNotification;
use JetBrains\PhpStorm\NoReturn;

class Reservationlistner
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
     * @param ReservationEvent $event
     * @return void
     */
    #[NoReturn]
    public function handle(ReservationEvent $event)
    {
        //
        /**
         * @var Medicine $medicine;
         * @var Period $period;

         */
        $medicine = Medicine::query()->findOrFail($event->reservation->medicine->id);
        $period = Period::query()->findOrFail($event->reservation->period->id);
        $reservationData = [
            'body' => "You have a new user booked $medicine->name ($period->name) .",
            'reservationText' => $event->reservation,
            'reservationUrl' => url('/'),
            'reservation_id' => $event->reservation->id
        ];
        $event->pharmacy->notify(new ReservationNotification($reservationData));
    }
}
