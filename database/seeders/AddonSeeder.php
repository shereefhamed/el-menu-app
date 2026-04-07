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
        $ownerRole = Role::where('name', 'owner')->first();
        $owners = User::whereHas('roles', function (Builder $query) use ($ownerRole) {
            $query->where('roles.id', $ownerRole->id);
        })->get();

        $owners->each(function (User $user) {
            Addon::factory()->count(5)->create([
                'user_id' => $user->id,
            ]);
        });
        // Addon::factory()->count(10)->create();
        
    }
}
