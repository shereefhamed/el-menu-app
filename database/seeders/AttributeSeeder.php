<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Attribute::factory()->count(3)->create();
        $attributes = [
            ['name_en' => 'Large', 'name_ar' => 'كبير'],
            ['name_en' => 'Meduim', 'name_ar' => 'متوسط'],
            ['name_en' => 'Small', 'name_ar' => 'صغير'],
        ];

        foreach($attributes as $attribute){
            Attribute::create([
                'name_en' => $attribute['name_en'],
                'name_ar' => $attribute['name_ar'],
            ]);
        }
    }
}
