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
            $attributes = Attribute::inRandomOrder()->take(3);
            $menuItem->attribures()->attach($attributes->pluck('id'), [
                'price' => fake()->randomFloat(nbMaxDecimals: 2, max: 200),
            ]);
        });
    }
}
