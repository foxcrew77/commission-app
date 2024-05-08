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
        Lorry::create([
            'id' => 11,
            'plate_no' => 'SAB 9946 C',
            'outlet' => 'KKIP',
            'capacity' => 4500,
            'status' => 'ACTIVE',
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
        Lorry::create([
            'id' => 12,
            'plate_no' => 'SAB 9946',
            'outlet' => 'KK2',
            'capacity' => 6000,
            'status' => 'ACTIVE',
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
        Lorry::create([
            'id' => 13,
            'plate_no' => 'SAB 9946 T',
            'outlet' => 'KKIP',
            'capacity' => 6500,
            'status' => 'ACTIVE',
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
        Lorry::create([
            'id' => 14,
            'plate_no' => 'SAB 9946 E',
            'outlet' => 'KKIP',
            'capacity' => 8000,
            'status' => 'ACTIVE',
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
        Lorry::create([
            'id' => 15,
            'plate_no' => 'SAB 9946 T',
            'outlet' => 'KKIP',
            'capacity' => 12000,
            'status' => 'ACTIVE',
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
        Lorry::create([
            'id' => 16,
            'plate_no' => 'SAB 9946 W',
            'outlet' => 'KKIP',
            'capacity' => 13000,
            'status' => 'ACTIVE',
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
        Lorry::create([
            'id' => 17,
            'plate_no' => 'W 337',
            'outlet' => 'KKIP',
            'capacity' => 16900,
            'status' => 'ACTIVE',
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
    }
}
