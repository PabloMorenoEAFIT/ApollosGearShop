<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'description' => $this->faker->text(100), 
            'category' => $this->faker->word, 
            'brand' => $this->faker->word, 
            'price' => $this->faker->numberBetween(10000, 5000000),
            'reviewSum' => $this->faker->randomFloat(2, 1, 5), 
            'numberOfReviews' => $this->faker->numberBetween(0, 100), 
            'quantity' => $this->faker->numberBetween(1, 100),
            'image' => $this->faker->imageUrl(640, 480, 'instruments'), 
            'created_at' => $this->faker->dateTimeThisDecade, 
            'updated_at' => $this->faker->dateTimeThisDecade, 
        ];
    }
}
