<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantMenuItemController extends Controller
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
    public function show(string $locale, Restaurant $restaurant, MenuItem $menuItem)
    {
        abort_if($restaurant->user->subscription->end_at <= now(), 404);

        $related = MenuItem::where('category_id', $menuItem->category_id)
            ->where('id', '<>', $menuItem->id)
            ->get();
        return view(
            'front.menu-items.show',
            [
                'menuItem' => $menuItem,
                'restaurant' => $restaurant,
                'related' => $related,
            ],
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
