<?php

namespace Database\Factories;

use App\Models\WorkTime;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkTimesFactory extends Factory
{

    protected $model = WorkTime::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'day'=> carbon::now()->dayOfWeek,
            'from'=> carbon::now()->hour,
            'to' => carbon::tomorrow()->hour
        ];
    }
}
