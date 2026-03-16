<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PlanSeeder::class,
            PaymentSeeder::class,
            SubscriptionSeeder::class,
            RestaurantTypeSeeder::class,
            RestaurantSeeder::class,
            CategorySeeder::class,
            MenuItemSeeder::class,
            AttributeSeeder::class,
            VariationSeeder::class,
            SocialMediaSeeder::class,
            RestaurantSocialMediaSeeder::class,
            CitySeeder::class,
            RestaurantCitySeeder::class,
        ]);
    }
}
