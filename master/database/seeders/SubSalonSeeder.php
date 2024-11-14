<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class SubSalonSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            DB::table('sub_salons')->insert([
                'location' => $faker->city,
                'description' => $faker->sentence,
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'image' => $faker->imageUrl,
                'salon_id' => rand(1, 20),  // Assuming you have salons already in the 'salons' table
                'working_days' => json_encode(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
                'opening_hours_start' => Carbon::createFromFormat('H:i', '09:00')->format('H:i'),
                'opening_hours_end' => Carbon::createFromFormat('H:i', '18:00')->format('H:i'),
                'type' => $faker->randomElement(['women', 'men', 'mixed']),
                'is_available' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
