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
        // $restaurants = Restaurant::all();
        // $restaurants->each(function (Restaurant $restaurant) {
        //     Category::factory()->count(10)->create([
        //         'restaurant_id' => $restaurant->id,
        //     ]);
        // });

        $restaurants = Restaurant::all();
        $categories = [
            ['name_en' => 'Starters', 'name_ar' => 'مقبلات'],
            ['name_en' => 'Pasta', 'name_ar' => 'مكرنة'],
            ['name_en' => 'Burgers', 'name_ar' => 'برجر'],
            ['name_en' => 'Grill', 'name_ar' => 'مشاوي'],
            ['name_en' => 'Sushi', 'name_ar' => 'سوشى'],
            ['name_en' => 'Beverages', 'name_ar' => 'مشروبات']
        ];

        $restaurants->each(function (Restaurant $restaurant) use ($categories) {
            foreach ($categories as $category) {
                Category::create([
                    'name_en' => $category['name_en'],
                    'name_ar' => $category['name_ar'],
                    'restaurant_id' => $restaurant->id,
                ]);
            }
        });
    }
}
