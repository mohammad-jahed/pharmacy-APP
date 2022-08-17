<?php

namespace App\Console\Commands;

use App\Events\Medicine\QuantityEvent;

use App\Models\Medicine;
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
         * @var Medicine $medicine;
         * @var User $user ;
         * @var Medicine $medicine1;
         */

        $medicines = Medicine::all();

        foreach ($medicines as $medicine) {
            if ($medicine->quantity <= 5) {
                $users = $medicine->users;

            }

        }
        /** @var User[] $users */
        foreach ($users as $user) {
            $targetMedicines = $user->medicines;
            foreach ($targetMedicines as $medicine1){
                if($medicine1->quantity <= 5){
                    event(new QuantityEvent($user, $medicine1));
                }
            }
        }

   }
}
