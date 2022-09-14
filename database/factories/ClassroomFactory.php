<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'teacher_id' => 1,
            'type_id' => 1,
            'name' => "Classroom ". \Illuminate\Support\Str::random(5),
            'date' => now()->addDays(2)->format('Y-m-d'), // return string date
            'time_start' => now()->addHour()->toTimeString(), // return string time
            'time_end' => now()->addHours(2)->toTimeString(), // return string
        ];
    }
}
