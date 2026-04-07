<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = User::whereHas(
            'roles',
            function($query){
                $query->where('name', 'owner');
            }
        );

        $currencies = Currency::all();
        $restaurantTypes = RestaurantType::all();

        $owners->each(function(User $owner) use($currencies, $restaurantTypes){
            $resturantType = $restaurantTypes->random();
            $currency = $currencies->random();
            Restaurant::factory()->create([
                'user_id' => $owner->id,
                'restaurant_type_id' => $resturantType->id,
                'currency_id' => $currency->id,
            ]);
        });
    }
}
