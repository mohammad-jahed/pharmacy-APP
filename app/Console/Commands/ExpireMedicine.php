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

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /**
         * @var User $user;
         * @var Medicine[] $medicines;
         * @var Medicine $medicine;
         */
        $user = auth()->user();
        $medicines = $user->medicines;
        foreach ($medicines as $medicine) {
            if ( Date::now() - $medicine->expiration_date <= 30  ) {
                event(new ExpirationDateEvent($user, $medicine));
            }
        }

    }
}
