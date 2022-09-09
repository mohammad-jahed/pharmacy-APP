<?php

namespace Database\Seeders;

use App\Models\Period;
use Illuminate\Database\Seeder;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Period::query()->create(
            ['name_en' => 'monthly', 'name_ar' => 'شهري']
        );
        Period::query()->create(
            ['name_en' => 'weekly', 'name_ar' => 'اسبوعي']
        );
    }
}
