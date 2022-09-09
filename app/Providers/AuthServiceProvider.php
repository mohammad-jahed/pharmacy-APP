<?php

namespace App\Providers;
use App\Models\Material;
use App\Models\Medicine;

use App\Models\Period;
use App\Models\Reservation;
use App\Models\User;
use App\Policies\MaterialPolicy;
use App\Policies\MedicinePolicy;
use App\Policies\PeriodPolicy;
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
        Material::class => MaterialPolicy::class,
        Reservation::class => ReservationPolicy::class,
        Period::class => PeriodPolicy::class
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
        //Materials
        Gate::define('showMaterial', [MaterialPolicy::class, 'view']);
        Gate::define('createMaterial', [MaterialPolicy::class, 'create']);
        Gate::define('updateMaterial', [MaterialPolicy::class, 'update']);
        Gate::define('deleteMaterial', [MaterialPolicy::class, 'delete']);
        Gate::define('viewMaterials',[MaterialPolicy::class,'viewAny']);
        //Reservations

        Gate::define('showReservation', [ReservationPolicy::class, 'view']);
        Gate::define('viewReservations', [ReservationPolicy::class, 'index']);
        Gate::define('viewPharmacyReservations', [ReservationPolicy::class, 'viewAnyPharmacy']);
        Gate::define('viewUserReservations', [ReservationPolicy::class, 'viewAnyUser']);
        Gate::define('createReservation', [ReservationPolicy::class, 'create']);
        Gate::define('updateReservation', [ReservationPolicy::class, 'update']);
        Gate::define('deleteReservation', [ReservationPolicy::class, 'delete']);
        //Periods
        Gate::define('indexPeriod', [PeriodPolicy::class, 'viewAny']);
        Gate::define('showPeriod', [PeriodPolicy::class, 'view']);
        Gate::define('createPeriod', [PeriodPolicy::class, 'create']);
        Gate::define('updatePeriod', [PeriodPolicy::class, 'update']);
        Gate::define('deletePeriod', [PeriodPolicy::class, 'delete']);


    }
}
