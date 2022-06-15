<?php

namespace App\Console\Commands;

use App\Events\Medicine\ExpirationDateEvent;
use App\Events\Medicine\QuantityEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

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
            if ($medicine->quantity <= 5) {
                event(new QuantityEvent($user, $medicine));
            }
        }
    }
}
