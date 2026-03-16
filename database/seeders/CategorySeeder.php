<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $owners = User::whereRelation('role', 'name', 'owner');

        // $owners->each(function(User $owner){
        //     Category::factory()->count(10)->create([
        //         'restaurant_id' => $owner->id,
        //     ]);
        // });

        $restaurants = Restaurant::all();
        $restaurants->each(function (Restaurant $restaurant) {
            Category::factory()->count(10)->create([
                'restaurant_id' => $restaurant->id,
            ]);
        });
    }
}
