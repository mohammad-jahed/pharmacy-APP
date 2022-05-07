<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('cities')->insert([
            //Damascus
            ['state_id' => 1, 'name_ar' => 'دمشق القديمة', 'name_en' => 'Old Damascus'],
            ['state_id' => 1, 'name_ar' => 'ساروجة', 'name_en' => 'Saroja'],
            ['state_id' => 1, 'name_ar' => 'القنوات', 'name_en' => 'Al-Qanawat'],
            ['state_id' => 1, 'name_ar' => 'جوبر', 'name_en' => 'Jobar'],
            ['state_id' => 1, 'name_ar' => 'الميدان', 'name_en' => 'Almedan'],
            ['state_id' => 1, 'name_ar' => 'الشاغور', 'name_en' => 'Alshagour'],
            ['state_id' => 1, 'name_ar' => 'المزة', 'name_en' => 'Al mazzah'],
        ]);
    }
}
