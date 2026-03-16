<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $categories = Category::all();

        // $categories->each(function(Category $categorie){
        //     MenuItem::factory()->count(10)->create([]);
        // });

        $restaurants = Restaurant::with('categories')->get();

        $restaurants->each(function (Restaurant $restaurant) {
            $restaurant->categories->each(function (Category $category) use ($restaurant) {
                MenuItem::factory()->count(10)->create([
                    'restaurant_id' => $restaurant->id,
                    'category_id' => $category->id,
                ]);
            });
        });
    }
}
