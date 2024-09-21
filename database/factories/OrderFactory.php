<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'creationDate' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'deliveryDate' => $this->faker->dateTimeBetween('now', '+1 year'),
            'totalPrice' => $this->faker->numberBetween(100, 10000),
        ];
    }
}
