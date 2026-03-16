<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = Restaurant::all();
        $citiesCount = City::all()->count();

        $restaurants->each(function (Restaurant $restaurant) use ($citiesCount) {
            $number = random_int(0, $citiesCount);
            $citites = City::all()->random($number);
            $restaurant->cities()->attach($citites->pluck('id'), [
                'address' => fake()->address(),
                'phone' => fake()->phoneNumber(),
            ]);
        });
    }
}
