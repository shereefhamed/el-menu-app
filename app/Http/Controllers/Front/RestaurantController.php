<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Plan;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foodType = request()->input('food_type');
        $country = request()->input('country');
        $city = request()->input('city');

        $restaurants = Restaurant::restaurantSearch(foodType: $foodType, country: $country, city: $city)
            ->latest()
            ->get();

        return view(
            'front.restaurants.index',
            [
                'restaurants' => $restaurants,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foodTypes = RestaurantType::all();
        $currencies = Currency::all();

        return view(
            'front.restaurants.create',
            [
                'foodTypes' => $foodTypes,
                'currencies' => $currencies,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:restaurants'],
            'restaurant_type_id' => ['required', 'exists:restaurant_types,id'],
            'currency_id' => ['required', Rule::exists('currencies', 'id')],
        ]);
        $currentUser = $request->user();
        $currentUser->restaurant()->create($data);
        $freePlan = Plan::free()->first();
        $currentUser->subscription()->create([
            'plan_id' => $freePlan->id,
            'start_at' => now(),
            'end_at' => now()->addMonth(),
        ]);
        return redirect()->route('dashboard.index')
            ->with('status', 'Your restaurnat created with free plan, you can change your plan at any time');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $locale, string $slug)
    {
        $restaurant = Restaurant::subscripedRestaturant($slug)->firstOrFail();
        return view(
            'front.restaurants.show',
            ['restaurant' => $restaurant]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }
}
