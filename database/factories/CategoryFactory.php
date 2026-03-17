<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'name_en' => fake()->word(),
            'name_ar' => $fakerAr->realText(10),
            //'name_ar' => fake()->randomElement(['بيتزا', 'برجر', 'مكرونة', 'مشروبات']),
        ];
    }
}
