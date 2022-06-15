<?php

namespace App\Console\Commands;

use App\Events\Medicine\ExpirationDateEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

class ExpirMedicine extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expir:medicine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check the expir medicine and notify the pharmacy';

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
        $user = auth('api')->user();
        $medicines = $user->medicines;
        foreach ($medicines as $medicine) {
            if ($medicine->expiration_date < Date::now()) {
                //$response[] = $medicine;
                event(new ExpirationDateEvent($user, $medicine));
            }
        }

    }
}
