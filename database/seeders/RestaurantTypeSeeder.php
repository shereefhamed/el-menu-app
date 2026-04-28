<?php

namespace Database\Seeders;

use App\Models\RestaurantType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // RestaurantType::factory()->count(10)->create();
        $foodTypes = [
            ['name_en' => 'Italian', 'name_ar' => 'ايطالى'],
            ['name_en' => 'Indian', 'name_ar' => 'هندى'],
            ['name_en' => 'Fast Food', 'name_ar' => 'الوجبات السريعة'],
            ['name_en' => 'Seafood', 'name_ar' => 'المأكولات البحرية'],
            ['name_en' => 'Pizzerias', 'name_ar' => 'مطاعم البيتزا'],
            ['name_en' => 'Cafés', 'name_ar' => 'المقاهي'],
            ['name_en' => 'Bakery & Doughnut Shops', 'name_ar' => 'محلات المخبوزات والدونات'],
            ['name_en' => 'Crepe', 'name_ar' => 'كريب'],
        ];

        foreach ($foodTypes as $foodType) {
            RestaurantType::create([
                'name_en' => $foodType['name_en'],
                'name_ar' => $foodType['name_ar'],
            ]);
        }
    }
}
