<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InstrumentFactory extends Factory
{
    public function definition(): array
    {
        $categories = [
            'strings', 
            'woodwind', 
            'brass', 
            'percussion', 
            'keyboards_pianos', 
            'ethnic_traditional', 
            'electronic_dj', 
            'accessories', 
            'studio_recording', 
            'sheet_music_books', 
            'bowed_strings'
        ];
        
        $numberOfReviews = $this->faker->numberBetween(0, 100);

        return [
            'name' => $this->faker->company,
            'description' => $this->faker->text(100), 
            'category' => $this->faker->randomElement($categories),
            'brand' => $this->faker->word, 
            'price' => $this->faker->numberBetween(10000, 5000000),
            'reviewSum' => $this->faker->randomFloat(2, 1, 5)*$numberOfReviews, 
            'numberOfReviews' => $numberOfReviews, 
            'image' => $this->faker->imageUrl(640, 480, 'instruments'), 
            'created_at' => $this->faker->dateTimeThisDecade, 
            'updated_at' => $this->faker->dateTimeThisDecade, 
        ];
    }
}
