<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MyFirstModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
        ];
    }
}
