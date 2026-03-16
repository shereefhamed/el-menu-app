<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\MenuItem;
use App\Models\Variation;
use Database\Factories\VariationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuItems = MenuItem::all()->random(10);
        $menuItems->each(function (MenuItem $menuItem) {

            // $menuItem->variations()->createMany([
            //     [
            //         'attribute_id' => Attribute::all()->random()->id,
            //     ],
            //     [
            //         'attribute_id' => Attribute::all()->random()->id,
            //     ],
            //     [
            //         'attribute_id' => Attribute::all()->random()->id,
            //     ]
            // ]);

            Variation::factory()->count(3)->create([
                'attribute_id' => Attribute::all()->random()->id,
                'menu_item_id' => $menuItem->id,
            ]);
        });
    }
}
