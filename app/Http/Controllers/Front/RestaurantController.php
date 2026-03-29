<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $locale, string $slug)
    {
        // $fakerAr = \Faker\Factory::create('ar_SA');
        // dd($fakerAr->address());

        $restaurant = Restaurant::with('categories.menuItems')
            ->whereRelation('user.subscription', 'end_at', '>=', now())
            ->where('slug', $slug)
            ->first();

        abort_if(!$restaurant, 404);
        
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
