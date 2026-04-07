<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Currency;
use App\Models\RestaurantType;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardInfoController extends Controller
{
    public function index()
    {
        $restaurant = request()->user()->restaurant;
        $foodTypes = RestaurantType::all();
        $cities = City::all();
        $currencies = Currency::all();
        $socialMedia = SocialMedia::all();

        return view(
            'dashboard.info.index',
            [
                'restaurant' => $restaurant,
                'foodTypes' => $foodTypes,
                'cities' => $cities,
                'currencies' => $currencies,
                'socialMedia' => $socialMedia,
            ]
        );
    }

    public function store(Request $request)
    {
        $restaurant = request()->user()->restaurant;
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('restaurants')->ignore($restaurant->id)],
            'restaurant_type_id' => ['required', 'exists:restaurant_types,id'],
            'logo' => ['image', 'max:1024', 'mimes:png,jpg,jpeg'],
            'currency_id' => ['required', Rule::exists('currencies', 'id')],
        ]);
        $restaurant->fill($data);
        $restaurant->save();
        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $path = $file->store('logos');
            $restaurant->logo = $path;
            $restaurant->save();
        }
        return back()->with('status', 'Updated');
    }
}

