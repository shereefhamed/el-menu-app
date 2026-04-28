<?php

namespace Database\Seeders;

use App\Models\Addon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $ownerRole = Role::where('name', 'owner')->first();
        // $owners = User::whereHas('roles', function (Builder $query) use ($ownerRole) {
        //     $query->where('roles.id', $ownerRole->id);
        // })->get();

        // $owners->each(function (User $user) {
        //     Addon::factory()->count(5)->create([
        //         'user_id' => $user->id,
        //     ]);
        // });

        $addons = [
            ['name_en' => 'Cheese', 'name_ar' => 'جبن'],
            ['name_en' => 'Vegetables', 'name_ar' => 'خضروات'],
            ['name_en' => 'Sauces', 'name_ar' => 'صلصة'],

        ];

        $ownerRole = Role::where('name', 'owner')->first();
        $owners = User::whereHas('roles', function (Builder $query) use ($ownerRole) {
            $query->where('roles.id', $ownerRole->id);
        })->get();

        $owners->each(function (User $user) use ($addons) {
            foreach ($addons as $addon) {
                Addon::factory()->create([
                    'name_en' => $addon['name_en'],
                    'name_ar' => $addon['name_ar'],
                    'user_id' => $user->id,
                ]);
            }
        });

    }
}
