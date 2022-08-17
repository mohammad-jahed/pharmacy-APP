<?php

namespace App\Console\Commands;

use App\Events\Medicine\ExpirationDateEvent;
use App\Events\Medicine\QuantityEvent;
use App\Models\Medicine;
use App\Models\MedicineUser;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

class ExpireMedicine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:medicine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check the expire medicine and notify the pharmacy';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {

        /**
         * @var Medicine $medicine ;
         * @var User $user ;
         * @var Medicine $medicine1 ;
         * @var MedicineUser $medicineUser ;
         */

        $medicinesUsers = MedicineUser::all();
        foreach ($medicinesUsers as $medicinesUser) {
            if (Date::now()->diffInDays($medicinesUser->expiration_date) <=30 ) {
                $user = $medicinesUser->pharmacy;
                $medicine = $medicinesUser->medicine;
                event(new ExpirationDateEvent($user, $medicine));
            }
        }

    }
}
