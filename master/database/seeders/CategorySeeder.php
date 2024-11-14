<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    public function run()
    {
        $subSalons = \App\Models\SubSalon::all();

        $categories = [
            ['name' => 'Hair Cutting', 'description' => 'Services related to haircuts for all lengths and styles.'],
            ['name' => 'Hairstyling', 'description' => 'Hair styling services for various occasions such as weddings, parties, and special events.'],
            ['name' => 'Skincare', 'description' => 'Includes facial treatments, cleansing, exfoliating, masks, and other skincare services.'],
            ['name' => 'Manicure & Pedicure', 'description' => 'Nail care services, including beautification, polishing, and massages for hands and feet.'],
            ['name' => 'Hair Coloring', 'description' => 'Services for changing hair color using various dyes, highlights, and temporary color treatments.'],
            ['name' => 'Facial Treatments', 'description' => 'Services for skin care like deep cleansing, blackhead removal, exfoliation, and other beauty treatments for the face.'],
            ['name' => 'Men\'s Grooming', 'description' => 'Grooming services specifically for men, including haircuts, shaving, and beard trimming.'],
            ['name' => 'Makeup', 'description' => 'Makeup application services for events such as weddings, photoshoots, or parties.'],
            ['name' => 'Massage Therapy', 'description' => 'Relaxation and therapeutic massage services like Swedish massage, aromatherapy, and deep tissue massages.'],
            ['name' => 'Hair Treatments', 'description' => 'Advanced hair care treatments such as keratin, protein treatments, and other restorative therapies to improve hair health.'],
        ];

        foreach ($subSalons as $subSalon) {
            foreach ($categories as $category) {
                $created_at = $subSalon->created_at ? Carbon::parse($subSalon->created_at) : Carbon::now(); // استخدم التاريخ الحالي إذا كان null
                $updated_at = $subSalon->updated_at ? Carbon::parse($subSalon->updated_at) : Carbon::now();

                DB::table(table: 'categories')->insert([
                    'name' => $category['name'],
                    'description' => $category['description'],
                    'sub_salons_id' => $subSalon->id,
                    'created_at' => $created_at,
                    'updated_at' => $updated_at,
                ]);
            }
        }
    }
}
