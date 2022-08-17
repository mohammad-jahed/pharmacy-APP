<?php

namespace App\Console\Commands;

use App\Events\Medicine\QuantityEvent;

use App\Models\Medicine;
use App\Models\MedicineUser;
use App\Models\User;
use Illuminate\Console\Command;

class QuantityMedicine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quantity:medicine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check the medicine quantity and notify the pharmacy';

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
            if ($medicinesUser->quantity <= 5) {
                $user = $medicinesUser->pharmacy;
                $medicine = $medicinesUser->medicine;
                event(new QuantityEvent($user, $medicine));
            }
        }
    }
}
