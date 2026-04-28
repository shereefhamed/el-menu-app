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
        // $plans = ['free', 'pro', 'enterprise'];
        // foreach ($plans as $plan) {
        //     Plan::factory()->create([
        //         'name_en' => $plan,
        //         'name_ar' => $plan,
        //         'options' => [],
        //     ]);
        // }

        $plans = [
            [
                'name' => 'free',
                'price' => 0,
                'options' => [
                    "create_qr_code" => "1",
                    "number_of_items" => "5",
                    "number_of_categories" => "5"
                ]
            ],
            [
                'name' => 'pro',
                'price' => 100,
                'options' => [
                    "create_qr_code" => "1", 
                    "number_of_items"=> "10", 
                    "number_of_categories"=> "10"
                ]
            ],
            [
                'name' => 'pro',
                'price' => 200,
                'options' => [
                    "create_qr_code" => "1", 
                    "number_of_items"=> "unlimited", 
                    "number_of_categories"=> "unlimited"
                ]
            ],
        ];
        foreach ($plans as $plan) {
            Plan::factory()->create([
                'name_en' => $plan['name'],
                'name_ar' => $plan['name'],
                'options' => $plan['options'],
            ]);
        }

    }
}
