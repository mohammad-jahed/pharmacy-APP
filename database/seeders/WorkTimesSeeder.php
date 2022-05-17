<?php

namespace Database\Seeders;

use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkTimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //WorkTime::factory()->create();
//        DB::table('work_times')->insert([
//            'day'=> carbon::now()->dayOfWeek,
//            'from'=> carbon::now()->hour,
//            'to' => carbon::tomorrow()->hour
//        ]);
//
//        DB::table('work_times')->insert([
//            'day'=> carbon::now(1)->dayOfWeek,
//            'from'=> carbon::now()->hour(8),
//            'to' => carbon::yesterday()->hour(12)
//        ]);

    }
}
