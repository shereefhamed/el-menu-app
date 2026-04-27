<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'delivery_fee' => fake()->randomFloat(nbMaxDecimals:2, min:1, max:200),
            'service_fee' => fake()->randomFloat(nbMaxDecimals:2, min:1, max:200),
        ];
    }
}
