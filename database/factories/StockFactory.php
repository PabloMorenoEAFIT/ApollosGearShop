<?php

namespace Database\Factories;

use App\Models\Instrument;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    //protected $model = Stock::class;

    public function definition()
    {
        return [
            'quantity' => $this->faker->numberBetween(1, 100),
            'type' => $this->faker->word,
            'comments' => $this->faker->optional()->sentence,
            'instrument_id' => Instrument::inRandomOrder()->first()->id,
        ];
    }
}
