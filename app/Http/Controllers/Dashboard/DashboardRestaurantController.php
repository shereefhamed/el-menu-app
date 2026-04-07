<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantRequest;
use App\Models\Currency;
use App\Models\Restaurant;
use App\Models\RestaurantType;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardRestaurantController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Restaurant::class, 'restaurant');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $restaurants = Restaurant::with('user', 'currency', 'type')->latest()->paginate(10);
        //dd(Restaurant::with('user', 'currency', 'type')->latest()->first());

        $users = User::owners()->get();
        $filter = request()->input('filter');
        $userId = request()->input('user');
        $search = request()->input('search');

        $restaurants = Restaurant::filter($filter, $userId, $search)->latest()->paginate(10);

        return view(
            'dashboard.restaurants.index',
            [
                'restaurants' => $restaurants,
                'users' => $users,
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
        $owners = User::ownerWithoutRestaurant()->get();

        return view(
            'dashboard.restaurants.create',
            [
                'foodTypes' => $foodTypes,
                'currencies' => $currencies,
                'owners' => $owners,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $request)
    {
        $data = $request->validated();
        $restaurant = Restaurant::create($data);

        if ($request->hasFile('logo')) {
            $fille = $request->file('logo');
            $path = $fille->store('logos');
            $restaurant->logo = $path;
            $restaurant->save();
        }

        return redirect()->route('dashboard.restaurants.index')
            ->with('status', 'Restaurant created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
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
        $foodTypes = RestaurantType::all();
        $currencies = Currency::all();
        $owners = User::owners()->get();

        return view(
            'dashboard.restaurants.edit',
            [
                'restaurant' => $restaurant,
                'foodTypes' => $foodTypes,
                'currencies' => $currencies,
                'owners' => $owners,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RestaurantRequest $request, Restaurant $restaurant)
    {
        $restaurant->fill($request->validated());
        $restaurant->save();

        if ($request->hasFile('logo')) {
            $fille = $request->file('logo');
            $path = $fille->store('logos');
            $restaurant->logo = $path;
            $restaurant->save();
        }

        return redirect()->route('dashboard.restaurants.index')
            ->with('status', 'Restaurant updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('dashboard.restaurants.index')
            ->with('status', 'Restaurant deleted');
    }

    public function restore(string $slug)
    {
        $restaurant = Restaurant::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $this->authorize('restore', $restaurant);
        $restaurant->restore();
        return redirect()->route('dashboard.restaurants.index')
            ->with('status', 'Restaurant restored');
    }

    public function forceDelete(string $slug)
    {
        $restaurant = Restaurant::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $this->authorize('restore', $restaurant);
        $restaurant->forceDelete();
        return redirect()->route('dashboard.restaurants.index')
            ->with('status', 'Restaurant deleted');
    }

    public function categories(string $restaurant)
    {
        $restaurant = Restaurant::findOrFail($restaurant);
        return $restaurant->categories;
    }
}
