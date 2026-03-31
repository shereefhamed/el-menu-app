<?php

namespace Database\Seeders;

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

        $owners->each(function(User $owner){
            $resturantType = RestaurantType::all()->random();
            Restaurant::factory()->create([
                'user_id' => $owner->id,
                'restaurant_type_id' => $resturantType->id,
            ]);
        });
    }
}
