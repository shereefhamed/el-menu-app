<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('email', 'admin@test.com')->get()->first();
        $owners = User::where('email', '<>', 'admin@test.com')->get();
        $ownerRole = Role::where('name', 'owner')->first();
        $adminRole = Role::where('name', 'admin')->first();

        $adminUser->roles()->sync([$adminRole->id]);
        $owners->each(function (User $user) use ($ownerRole) {
            $user->roles()->sync([$ownerRole->id]);
        });
    }
}
