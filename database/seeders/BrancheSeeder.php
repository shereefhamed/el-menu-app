<?php

namespace Database\Seeders;

use App\Models\Branche;
use App\Models\City;
use App\Models\Restaurant;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = Restaurant::all();
        $cities = City::all();

        $restaurants->each(function(Restaurant $restaurant) use($cities){
            $number = random_int(1, 3);
            $city = $cities->random();
            Branche::factory()->count($number)->create([
                'restaurant_id' => $restaurant->id,
                'city_id' => $city->id,
            ]);
        });
    }
}
