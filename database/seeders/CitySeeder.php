<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $coutries = Country::all();
        // City::factory()->count(10)->create([
        //     'country_id' => $coutries->random()->id,
        // ]);

        $egypt = Country::where('name_en' , 'Egypt')->first();
        $cities = [
            ['name_en' => '6th of October', 'name_ar' => '6 اكتوبر'],
            ['name_en' => 'Giza', 'name_ar' => 'الجيزة'],
            ['name_en' => 'Nasr City', 'name_ar' => 'مدينة نصر'],
            ['name_en' => 'Alexandria', 'name_ar' => 'الاسكندرية'],
            
        ];

        foreach($cities as $city){
            City::create([
                'name_ar' => $city['name_ar'],
                'name_en' => $city['name_en'],
                'country_id' => $egypt->id,
            ]);
        }
    }
}
