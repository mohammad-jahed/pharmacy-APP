<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('areas')->insert([
            ['city_id' => 1, 'name_ar' => 'باب توما', 'name_en' => 'Bab Touma'],
            ['city_id' => 1, 'name_ar' => 'القيمرية', 'name_en' => 'Al-Qemaryah'],
            ['city_id' => 1, 'name_ar' => 'الحميدية', 'name_en' => 'Al-Hamedyah'],
            ['city_id' => 1, 'name_ar' => 'الحريقة', 'name_en' => 'Al-Hareqah'],
        ]);
    }
}
