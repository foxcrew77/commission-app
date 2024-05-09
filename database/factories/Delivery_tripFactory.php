<?php

namespace Database\Factories;
use App\Models\User;
use Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Delivery_tripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   
        $faker = Faker\Factory::create();
        static $id = 1;
        return [
            // 'id' => unique()->mt_rand(1,100),
            // 'id' => $this->faker->unique()->numberBetween(1, 100),
            // 'id' => User::inRandomOrder()->first()->id,
            'id' => $id++,
            'slug' => Str::random(5),
            // 'id' => User::inRandomOrder()->first()->id,
            'trip_date' => $this->faker->dateTimeBetween('-3 month', '+3 month'),
            // 'total_weight' => $this->faker->randomFloat(2),
            'total_weight' => $faker->randomFloat(1,100,17000),
            'user_id' => User::inRandomOrder()->first()->id,
            // 'lorry_id' => Lorry::inRandomOrder()->first()->id,
            // 'driver_id' => Driver::inRandomOrder()->first()->id,
            // 'workmen_id' => Workman::inRandomOrder()->first()->id,
            'details' => json_encode($this->faker->sentence(mt_rand(2,8))),
        ];
    }
}
