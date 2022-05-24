<?php

namespace App\Providers;

use App\Models\Medicine;

use App\Models\User;
use App\Policies\MedicinePolicy;
use App\Policies\PharmacyPolicy;
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
        Gate::define('createMedicine',[MedicinePolicy::class,'create']);
        Gate::define('updateMedicine',[MedicinePolicy::class,'update']);
        Gate::define('deleteMedicine',[MedicinePolicy::class,'delete']);
        Gate::define('viewMedicine',[MedicinePolicy::class,'viewAny']);
        Gate::define('showMedicine',[MedicinePolicy::class,'view']);
        //
    }
}
