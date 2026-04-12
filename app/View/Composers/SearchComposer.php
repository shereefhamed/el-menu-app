<?php
namespace App\View\Composers;


use App\Models\City;
use App\Models\Country;
use App\Models\RestaurantType;
use Illuminate\View\View;



class SearchComposer
{
    public function compose(View $view)
    {
        $foodTypes = RestaurantType::all();
        $countries = Country::all();
        $cities = City::all();

        $view->with('foodTypes', $foodTypes);
        $view->with('countries', $countries);
        $view->with('cities', $cities);
    }
}