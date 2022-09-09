<?php

namespace Database\Factories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string|null
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /*
         * for localize translation
         */
        // $fakerMY = \Faker\Factory::create('ms_MY');

        return [
            'name' => $this->faker->name(),
            'secret' => 'password123'
        ];
    }

    /**
     * Capitalise the name
     * Called 'Factory State'
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function upTheNameLol()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => ucwords($attributes['name']),
            ];
        });
    }

}
