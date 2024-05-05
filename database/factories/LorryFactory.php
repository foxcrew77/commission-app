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
            'capacity' => $this->faker->randomElement([2200,2500,4000,8000]),
            'status' => $this->faker->randomElement(['ACTIVE', 'INACTIVE']),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
