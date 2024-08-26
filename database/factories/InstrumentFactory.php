<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'price' => $this->faker->numberBetween($min = 10000, $max = 5000000),
        ];
    }
}
