<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Delivery_trip;
use App\Models\Lorry;
use App\Models\Driver;
use App\Models\Workman;

use Database\Factories\Delivery_tripFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call([
        //     UserSeeder::class,
        // ]);
        // $faker = (new \Faker\Factory())::create();
        // $faker->addProvider(new \Faker\Provider\FakeCar($faker));
        // User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@test.com',
        //     'password' => '12345678',
        //     // 'is_admin' => true,
        //     'email_verified_at' => $faker->dateTime(),
        //     'remember_token' => '78x6c35esh2Ya0g4fb1d9'
        // ]);
        User::factory(4)->create();
        Lorry::factory(10)->create();
        Driver::factory(10)->create();
        Workman::factory(28)->create();
        Delivery_trip::factory(6000)->create();

        foreach (Delivery_trip::all() as $delivery){
            // $lorry = \App\Models\Lorry::inRandomOrder()->take(rand(1,3))->pluck('id');
            $lorry = \App\Models\Lorry::inRandomOrder()->first()->id;
            $delivery->lorries()->attach($lorry);
            $driver = \App\Models\Driver::inRandomOrder()->first()->id;
            $delivery->drivers()->attach($driver);
            $workmen = \App\Models\Workman::inRandomOrder()->take(rand(1,2))->pluck('id');
            $delivery->workmen()->attach($workmen);
        }
    }
}
