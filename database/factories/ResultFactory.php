<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1,10),
            'quiz_id' => rand(1,10),
            'point' => rand(0,100),
            'correct' => rand(1,20),
            'wrong' => rand(1,20)
        ];
    }
}
