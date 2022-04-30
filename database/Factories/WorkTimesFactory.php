<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkTimesFactory extends Factory
{
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
