<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $fakerAr = \Faker\Factory::create('ar_EG');
        return [
            'name_en' => fake()->country(),
            'name_ar' => $fakerAr->country(),
        ];
    }
}
