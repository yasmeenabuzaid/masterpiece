<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        // Get all categories
        $categories = \App\Models\Categorie::all();

        // Add services for each category
        foreach ($categories as $category) {
            $services = $this->getServicesForCategory($category->name);

            foreach ($services as $service) {
                DB::table('services')->insert([
                    'categories_id' => $category->id,
                    'name' => $service['name'],
                    'duration' => $service['duration'],
                    'description' => $service['description'],
                    'price' => $service['price'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    // Function to get services for each category
    private function getServicesForCategory($categoryName)
    {
        $services = [];

        switch ($categoryName) {
            case 'Hair Cutting':
                $services = [
                    ['name' => 'Men\'s Haircut', 'duration' => 30, 'description' => 'Haircut services for men in various styles', 'price' => 50.00],
                    ['name' => 'Women\'s Haircut', 'duration' => 45, 'description' => 'Haircut services for women of all lengths', 'price' => 70.00],
                    ['name' => 'Kids\' Haircut', 'duration' => 20, 'description' => 'Gentle and quick haircut for children', 'price' => 30.00],
                    ['name' => 'Short Haircut', 'duration' => 30, 'description' => 'Stylish short haircut for modern looks', 'price' => 45.00],
                    ['name' => 'Long Haircut', 'duration' => 60, 'description' => 'Trendy and fashionable long hair cuts', 'price' => 80.00],
                    ['name' => 'Layered Haircut', 'duration' => 45, 'description' => 'Haircut with layers for volume and texture', 'price' => 65.00],
                    ['name' => 'Buzz Cut', 'duration' => 15, 'description' => 'A simple and clean buzz cut', 'price' => 25.00],
                    ['name' => 'Undercut Haircut', 'duration' => 40, 'description' => 'Modern undercut for a bold look', 'price' => 55.00],
                    ['name' => 'Trim and Shape', 'duration' => 20, 'description' => 'Trimming and shaping the hair to maintain style', 'price' => 35.00],
                    ['name' => 'Curly Haircut', 'duration' => 50, 'description' => 'Special haircut for curly hair to maintain shape', 'price' => 75.00],
                ];
                break;

            case 'Hairstyling':
                $services = [
                    ['name' => 'Bridal Hairstyling', 'duration' => 90, 'description' => 'Elegant bridal hairstyles for your special day', 'price' => 150.00],
                    ['name' => 'Party Hairstyling', 'duration' => 60, 'description' => 'Stylish party hairstyles for any event', 'price' => 85.00],
                    ['name' => 'Updo Hairstyling', 'duration' => 60, 'description' => 'Classic updo for formal occasions', 'price' => 100.00],
                    ['name' => 'Casual Hairstyling', 'duration' => 40, 'description' => 'Relaxed and easy hairstyles for daily wear', 'price' => 50.00],
                    ['name' => 'Braided Hairstyling', 'duration' => 50, 'description' => 'Braided hairstyles for a chic look', 'price' => 60.00],
                    ['name' => 'Curly Hairstyling', 'duration' => 45, 'description' => 'Enhancing natural curls for a bouncy look', 'price' => 55.00],
                    ['name' => 'Flat Iron Hairstyling', 'duration' => 30, 'description' => 'Sleek and smooth hairstyle with flat iron', 'price' => 45.00],
                    ['name' => 'Blowout Styling', 'duration' => 50, 'description' => 'Perfect blowout for voluminous and smooth hair', 'price' => 70.00],
                    ['name' => 'Hollywood Waves', 'duration' => 60, 'description' => 'Elegant and glamorous waves for a red carpet look', 'price' => 90.00],
                    ['name' => 'Messy Bun Hairstyling', 'duration' => 40, 'description' => 'Casual yet stylish messy bun for a trendy look', 'price' => 40.00],
                ];
                break;

            case 'Skincare':
                $services = [
                    ['name' => 'Deep Facial Cleansing', 'duration' => 60, 'description' => 'Thorough cleansing to remove impurities from skin', 'price' => 80.00],
                    ['name' => 'Acne Treatment Facial', 'duration' => 75, 'description' => 'Facial treatment targeted for acne-prone skin', 'price' => 90.00],
                    ['name' => 'Anti-Aging Facial', 'duration' => 90, 'description' => 'Facial that targets fine lines and wrinkles', 'price' => 100.00],
                    ['name' => 'Hydrating Facial', 'duration' => 60, 'description' => 'Facial to deeply hydrate and nourish the skin', 'price' => 85.00],
                    ['name' => 'Brightening Facial', 'duration' => 60, 'description' => 'Facial treatment to brighten dull and tired skin', 'price' => 95.00],
                    ['name' => 'Exfoliating Facial', 'duration' => 50, 'description' => 'Exfoliation to remove dead skin cells and reveal fresh skin', 'price' => 70.00],
                    ['name' => 'Microdermabrasion Facial', 'duration' => 75, 'description' => 'Exfoliating treatment to reduce skin imperfections', 'price' => 120.00],
                    ['name' => 'Chemical Peel', 'duration' => 60, 'description' => 'Chemical exfoliation for smooth and rejuvenated skin', 'price' => 110.00],
                    ['name' => 'Collagen Facial', 'duration' => 90, 'description' => 'Facial treatment designed to stimulate collagen production', 'price' => 130.00],
                    ['name' => 'Signature Facial', 'duration' => 60, 'description' => 'Tailored facial to meet your specific skin needs', 'price' => 95.00],
                ];
                break;

            case 'Manicure & Pedicure':
                $services = [
                    ['name' => 'Basic Manicure', 'duration' => 30, 'description' => 'Basic nail care, including shaping and polishing', 'price' => 25.00],
                    ['name' => 'Gel Manicure', 'duration' => 45, 'description' => 'Long-lasting gel nail polish', 'price' => 40.00],
                    ['name' => 'Basic Pedicure', 'duration' => 40, 'description' => 'Basic foot care, including nail trimming and exfoliation', 'price' => 30.00],
                    ['name' => 'Luxury Pedicure', 'duration' => 60, 'description' => 'Pedicure with relaxing massage and exfoliation', 'price' => 50.00],
                    ['name' => 'Manicure with Nail Art', 'duration' => 60, 'description' => 'Customized nail art with manicure service', 'price' => 55.00],
                    ['name' => 'French Manicure', 'duration' => 40, 'description' => 'Classic French tips with a polished finish', 'price' => 35.00],
                    ['name' => 'Shellac Manicure', 'duration' => 45, 'description' => 'Durable and shiny Shellac manicure', 'price' => 45.00],
                    ['name' => 'Paraffin Pedicure', 'duration' => 50, 'description' => 'Pedicure with warm paraffin wax for soft skin', 'price' => 55.00],
                    ['name' => 'Spa Manicure', 'duration' => 50, 'description' => 'Manicure with hydrating mask and massage', 'price' => 40.00],
                    ['name' => 'Nail Repair', 'duration' => 20, 'description' => 'Nail repair services for broken nails', 'price' => 15.00],
                ];
                break;

            // Repeat the same for other categories...

            // Add more categories and services as needed
        }

        return $services;
    }
}
