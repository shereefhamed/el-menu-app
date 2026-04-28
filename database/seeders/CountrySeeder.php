<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Country::factory()->count(10)->create();
        $countries = [
            ['name_en' => 'Egypt', 'name_ar' => 'مصر'],
            ['name_en' => 'Saudi Arabia', 'name_ar' => 'السعودية'],
            ['name_en' => 'Emirates ', 'name_ar' => 'الامارات'],
        ];

        foreach($countries as $country){
            Country::create([
                'name_en' => $country['name_en'],
                'name_ar' => $country['name_ar']
            ]);
        }
    }
}
