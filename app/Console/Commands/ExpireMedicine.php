<?php

namespace App\Console\Commands;

use App\Events\Medicine\ExpirationDateEvent;
use App\Models\Medicine;
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
         * @var User $user;
         * @var Medicine $medicines;
         * @var Medicine $medicine;
         */

        /**
         * @var Medicine $medicine;
         * @var User $user ;
         * @var Medicine $medicine1;
         */

        $medicines = Medicine::all();

        foreach ($medicines as $medicine) {
            if (Date::now()->diffInDays($medicine->expiration_date) <= 30) {
                $users = $medicine->users;

            }

        }
        /** @var User[] $users */
        foreach ($users as $user) {
            $targetMedicines = $user->medicines;
            foreach ($targetMedicines as $medicine1){
                if(Date::now()->diffInDays($medicine1->expiration_date) <= 30){
                    event(new ExpirationDateEvent($user, $medicine1));
                }
            }
        }

    }
}
