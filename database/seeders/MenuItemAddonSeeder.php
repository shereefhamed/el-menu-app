<?php

namespace Database\Seeders;

use App\Models\Addon;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemAddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuItems = MenuItem::all()->random(10);

        $menuItems->each(function (MenuItem $menuItem) {
            $addons = Addon::inRandomOrder()->take(3);
            $menuItem->addons()->sync($addons->pluck('id'));
        });
    }
}
