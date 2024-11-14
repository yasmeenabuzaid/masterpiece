<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Salon;

class SalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // استخدام الـ Factory لإنشاء 30 صالون
        Salon::factory()->count(30)->create();
    }
}
