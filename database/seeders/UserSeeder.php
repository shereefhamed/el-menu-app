<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory()->create();
        User::factory()->adminUser()->create();
        // User::factory()->count(2)->ownerUser()->create();
        User::factory()->count(2)->create();
    }
}
