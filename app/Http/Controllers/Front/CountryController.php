<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function cities(string $locale, string $countryId)
    {
        $country = Country::findOrFail($countryId);
        return $country->cities;
    }
}
