<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = Restaurant::all();
        $socialMedia = SocialMedia::all();

        $restaurants->each(function(Restaurant $restaurant) use($socialMedia){
            $number = random_int(0, $socialMedia->count());
            $media  = $socialMedia->random($number);
            $restaurant->socialMedia()->attach($media->pluck('id'),[
                'url' => 'https://facebook.com/myrestaurant'
            ]);
            //->sync($media->pluck('id'));
        });
    }
}
