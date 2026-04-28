<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerAr = \Faker\Factory::create('ar_SA');
        return [
           'name_en' => fake()->words(3, true),
           'name_ar' => fake()->randomElement(['بيتزا', 'برجر', 'مكرونة', 'مشروبات']),
           'description_en' => fake()->sentences(3, true),
           'image_url' => "https://placehold.net/" . rand(1,10) .".png",
           // 'https://placehold.net/400x400.png',
           'price' => fake()->randomFloat(nbMaxDecimals:2, min:1, max:200),
           
        ];
    }
}
