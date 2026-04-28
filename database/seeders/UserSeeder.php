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
        User::factory()->adminUser()->create();
        User::factory()->demoUser()->create();
        User::factory()->count(2)->create();
        // if($this->command->confirm('For deployment?')){
        //     User::factory()->demoUser()->create();
        // }else{
        //     User::factory()->count(2)->create();
        // }
        // User::factory()->adminUser()->create();
        // User::factory()->count(2)->create();
    }
}
