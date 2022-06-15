<?php

namespace App\Listeners\Medicine;

use App\Events\Medicine\QuantityEvent;
use App\Notifications\QuantityNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class QuantityListener
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
     * @param  \App\Events\QuantityEvent  $event
     * @return void
     */
    public function handle(QuantityEvent $event)
    {
        $medicineData = [
            'body' => 'A new Medicine is About to RunOut',
            'thanks' => 'Thank you',
            'medicineText' => $event->medicine->name,
            'medicineQuantity'=>$event->medicine->quantity,
            'medicineUrl' => url('/'),
            'medicine_id' => $event->medicine->id
        ];
        $event->user->notify(new QuantityNotification($medicineData));
    }
}
