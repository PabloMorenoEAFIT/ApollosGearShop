<?php

namespace Database\Factories;

use App\Models\Instrument;
use App\Models\Stock;
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
            'bowed_strings',
        ];

        $numberOfReviews = $this->faker->numberBetween(0, 100);

        $instrumentAttributes = [
            'name' => $this->faker->company,
            'description' => $this->faker->text(100),
            'category' => $this->faker->randomElement($categories),
            'brand' => $this->faker->word,
            'price' => $this->faker->numberBetween(10000, 5000000),
            'reviewSum' => $this->faker->randomFloat(2, 1, 5) * $numberOfReviews,
            'numberOfReviews' => $numberOfReviews,
            'image' => $this->faker->imageUrl(640, 480, 'instruments'),
            'created_at' => $this->faker->dateTimeThisDecade,
            'updated_at' => $this->faker->dateTimeThisDecade,
        ];

        $instrument = Instrument::create($instrumentAttributes);

        $stockAttributes = [
            'quantity' => $this->faker->numberBetween(1, 20),
            'type' => 'Add',
            'comments' => 'Initial stock for '.$instrument->name,
            'instrument_id' => $instrument->id,
            'created_at' => $instrument->created_at,
            'updated_at' => $instrument->updated_at,
        ];

        Stock::create($stockAttributes);

        return $instrumentAttributes;
    }
}
