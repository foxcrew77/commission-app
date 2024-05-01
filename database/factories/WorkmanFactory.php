<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workman>
 */
class WorkmanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'position' => 'workman',
            'outlet' => $this->faker->randomElement(['KKIP', 'KK2']),
            'user_id' => User::inRandomOrder()->first()->id,
            // 'user_id' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
