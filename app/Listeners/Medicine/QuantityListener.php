<?php

namespace App\Listeners\Medicine;

use App\Events\Medicine\QuantityEvent;
use App\Notifications\MedicineNotification;
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
     * @param QuantityEvent $event
     * @return void
     */
    public function handle(QuantityEvent $event)
    {
        $medicineData = [
            'body' => "{$event->medicine->name} will be run out after {$event->medicine->quantity} days",
            'medicineText' => $event->medicine->name,
            'medicineUrl' => url('/'),
            'medicine_id' => $event->medicine->id
        ];
        $event->user->notify(new MedicineNotification($medicineData));
    }
}
