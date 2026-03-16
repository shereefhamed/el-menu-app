<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMedia = [
            [
                'name' => 'facebook',
                'icon' => 'fa-facebook-f',
            ],
            [
                'name' => 'x',
                'icon' => 'fa-x-twitter'
            ],
            [
                'name' => 'youtube',
                'icon' => 'fa-youtube'
            ]
        ];
        
        foreach($socialMedia as $social){
            SocialMedia::factory()->create([
                'name' => $social['name'],
                'icon'  =>  $social['icon'],
            ]);
        }
    }
}
