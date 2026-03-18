<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(string $locale, string $slug)
    {
        $restaurant = Restaurant::subscripedRestaturant($slug)->first();
        abort_if(!$restaurant, 404);

        return view(
            'front.about.index',
            [
                'restaurant' => $restaurant,
            ]
        );
    }
}
