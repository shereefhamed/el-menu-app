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
        // $restaurants = Restaurant::with('categories')->get();

        // $restaurants->each(function (Restaurant $restaurant) {
        //     $restaurant->categories->each(function (Category $category) use ($restaurant) {
        //         MenuItem::factory()->count(10)->create([
        //             'restaurant_id' => $restaurant->id,
        //             'category_id' => $category->id,
        //         ]);
        //     });
        // });

        $menuItems = [
            ['name_en' => 'Beef Pasta', 'name_ar' => 'مركونة باللحم'],
            ['name_en' => 'Seafood Pasta', 'name_ar' => 'معكرونة بالمأكولات البحرية'],
            ['name_en' => 'Classic Beef Burger', 'name_ar' => 'برجر لحم بقري كلاسيكي'],
            ['name_en' => 'Grilled Chicken', 'name_ar' => 'قراخ مشوية'],
            ['name_en' => 'Lemonade', 'name_ar' => 'عصير لمون'],
            ['name_en' => 'Caffe Latte', 'name_ar' => 'حليب بالقهوة'],
            ['name_en' => 'Fresh Juice', 'name_ar' => 'عصير طازج'],
            ['name_en' => 'Lentil Soup', 'name_ar' => 'شوربة عدس'],
            ['name_en' => 'Salad', 'name_ar' => 'سلطة'],
        ];

        $restaurants = Restaurant::with('categories')->get();

        $restaurants->each(function (Restaurant $restaurant) use ($menuItems) {
            $restaurant->categories->each(function (Category $category) use ($restaurant, $menuItems) {
                foreach ($menuItems as $menuItem) {
                    MenuItem::factory()->create([
                        'name_en' => $menuItem['name_en'],
                        'name_ar' => $menuItem['name_ar'],
                        'restaurant_id' => $restaurant->id,
                        'category_id' => $category->id,
                    ]);
                }
            });
        });
    }
}
