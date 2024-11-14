<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SubSalon;
use App\Models\User;

class FeedSeeder extends Seeder
{
    public function run()
    {
        $subSalons = SubSalon::all();

        $users = User::all();

        foreach ($subSalons as $subSalon) {
            for ($i = 0; $i < 5; $i++) {
                DB::table('feeds')->insert([
                    'feedback' => 'This is a great service! Highly recommend it!',  
                    'rating' => rand(1, 5),
                    'users_id' => $users->random()->id,
                    'sub_salons_id' => $subSalon->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
