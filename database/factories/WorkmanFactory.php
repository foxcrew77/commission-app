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
            'name' => fake()->name(1,15),
            'position' => 'workman',
            'outlet' => $this->faker->randomElement(['KKIP', 'KK2']),
            'status' => $this->faker->randomElement(['ACTIVE', 'INACTIVE']),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
