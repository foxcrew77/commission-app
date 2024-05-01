<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lorry>
 */
class LorryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\FakeCar($faker));
        return [
            'plate_no' => $faker->vehicleRegistration,
            'outlet' => $this->faker->randomElement(['KKIP', 'KK2']),
            'user_id' => User::inRandomOrder()->first()->id,
            // 'user_id' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
