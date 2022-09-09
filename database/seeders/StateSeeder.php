<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('states')->insert([
            ['name_ar' => 'دمشق', 'name_en' => 'Damascus'],
            ['name_ar' => 'حلب', 'name_en' => 'Aleppo'],
            ['name_ar' => 'حمص', 'name_en' => 'Al-Raqah'],
            ['name_ar' => 'دير الزور', 'name_en' => 'Homs'],
            ['name_ar' => 'الرقة', 'name_en' => 'Deir ez-Zur'],
            ['name_ar' => 'درعا', 'name_en' => 'Daraa'],
            ['name_ar' => 'حماه', 'name_en' => 'Hama'],
            ['name_ar' => 'أدلب', 'name_en' => 'Al Hasakah'],
            ['name_ar' => 'الحسكة', 'name_en' => 'Idlib'],
            ['name_ar' => 'طرطوس', 'name_en' => 'Tartus'],
            ['name_ar' => 'السويداء', 'name_en' => 'As Suwayda'],
        ]);
    }
}
