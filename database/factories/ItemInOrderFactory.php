<?php

namespace Database\Factories;

use App\Models\Instrument;
use App\Models\ItemInOrder;
use App\Models\Lesson;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemInOrderFactory extends Factory
{
    protected $model = ItemInOrder::class;

    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->randomNumber(2),
            'instrument_id' => Instrument::factory(),
            'lesson_id' => Lesson::factory(),
            'order_id' => Order::factory(),
        ];
    }
}
