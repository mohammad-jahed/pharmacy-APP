<?php

namespace App\Providers;

use App\Models\Component;
use App\Models\Material;
use App\Models\Medicine;

use App\Models\Reservation;
use App\Models\User;
use App\Policies\ComponentPolicy;
use App\Policies\MaterialPolicy;
use App\Policies\MedicinePolicy;
use App\Policies\PharmacyPolicy;
use App\Policies\ReservationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        User::class => PharmacyPolicy::class,
        Medicine::class => MedicinePolicy::class,
        Component::class => ComponentPolicy::class,
        Material::class => MaterialPolicy::class,
        Reservation::class => ReservationPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Medicines
        Gate::define('createMedicine', [MedicinePolicy::class, 'create']);
        Gate::define('updateMedicine', [MedicinePolicy::class, 'update']);
        Gate::define('deleteMedicine', [MedicinePolicy::class, 'delete']);
        Gate::define('viewMedicine', [MedicinePolicy::class, 'viewAny']);
        Gate::define('showMedicine', [MedicinePolicy::class, 'view']);
        //Components
        Gate::define('showComponent', [ComponentPolicy::class, 'view']);
        Gate::define('createComponent', [ComponentPolicy::class, 'create']);
        Gate::define('updateComponent', [ComponentPolicy::class, 'update']);
        Gate::define('deleteComponent', [ComponentPolicy::class, 'delete']);
        //Materials
        Gate::define('showMaterial', [MaterialPolicy::class, 'view']);
        Gate::define('createMaterial', [MaterialPolicy::class, 'create']);
        Gate::define('updateMaterial', [MaterialPolicy::class, 'update']);
        Gate::define('deleteMaterial', [MaterialPolicy::class, 'delete']);
        //Reservations
        Gate::define('showReservation', [MaterialPolicy::class, 'view']);
        Gate::define('createReservation', [MaterialPolicy::class, 'create']);
        Gate::define('updateReservation', [MaterialPolicy::class, 'update']);
        Gate::define('deleteReservation', [MaterialPolicy::class, 'delete']);

    }
}
