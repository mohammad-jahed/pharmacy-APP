<?php

namespace App\Events\Reservation;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReservationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public Reservation $reservation;
    public User $pharmacy;
    public function __construct(User $pharmacy, Reservation $reservation)
    {
        //
        $this->pharmacy = $pharmacy;
        $this->reservation = $reservation;


    }


}
