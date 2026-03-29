<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = ['pro', 'premium'];
        foreach ($plans as $plan) {
            Plan::factory()->create([
                'name_en' => $plan,
                'name_ar' => $plan,
            ]);
        }

    }
}
