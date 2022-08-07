<?php

namespace App\Providers;

use App\Events\Medicine\ExpirationDateEvent;
use App\Events\Medicine\QuantityEvent;
use App\Events\Prescription\PrescriptionCreateEvent;
use App\Events\Prescription\UserPrescriptionEvent;
use App\Listeners\Medicine\ExpirationDateListener;
use App\Listeners\Medicine\QuantityListener;
use App\Listeners\Prescription\PrescriptionCreateListener;
use App\Listeners\Prescription\UserPrescriptionListener;
use App\Listeners\User\UserRegisteredListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            UserRegisteredListener::class,
        ],
        PrescriptionCreateEvent::class =>[
            PrescriptionCreateListener::class,
        ],
        ExpirationDateEvent::class =>[
            ExpirationDateListener::class,
        ],
        QuantityEvent::class =>[
            QuantityListener::class,
        ],
        UserPrescriptionEvent::class=>[
            UserPrescriptionListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
