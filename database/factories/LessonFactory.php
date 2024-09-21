<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    protected $model = Lesson::class;

    protected $difficulty = [
        'easy',
        'medium',
        'hard',
    ];

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'difficulty' => $this->difficulty[array_rand($this->difficulty)],
            'schedule' => $this->faker->date($format = 'm-d-Y'),
            'totalHours' => $this->faker->numberBetween(1, 100),
            'location' => $this->faker->city(),
            'price' => $this->faker->numberBetween(50000, 900000),
            'teacher' => $this->faker->name(),
        ];
    }
}
