<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\User;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name, // اسم المستخدم
            'email' => $this->faker->unique()->safeEmail, // البريد الإلكتروني
            'email_verified_at' => now(), // وقت التحقق من البريد الإلكتروني
            'password' => bcrypt('password'), // كلمة المرور
            'usertype' => $this->faker->randomElement(['super_admin', 'owner', 'employee', 'user']), // نوع المستخدم
            'image' => $this->faker->imageUrl(150, 150, 'people'), // صورة المستخدم
            'remember_token' => Str::random(10), // رمز التذكر
           
        ];
    }
}
