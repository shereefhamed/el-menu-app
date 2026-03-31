<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantTypeRequest;
use App\Models\RestaurantType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardRestaurantTypeController extends Controller
{
    public function __construct() {
        $this->authorizeResource(RestaurantType::class, 'restaurant_type');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('search');

        $types = RestaurantType::filter($search)->paginate(10);

        return view(
            'dashboard.restaurant-types.index',
            ['restaurantTypes' => $types]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.restaurant-types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantTypeRequest $request)
    {
        $data = $request->validated();
        RestaurantType::create($data);
        return redirect()->route('dashboard.restaurant-types.index')
            ->with('status', 'Restaurant type created');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantType $restaurantType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantType $restaurantType)
    {
        return view(
            'dashboard.restaurant-types.edit',
            ['restaurantType' => $restaurantType]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RestaurantType $restaurantType)
    {

        $data = $request->validate([
            'name_en' => ['required', 'max:255', Rule::unique('restaurant_types')->ignore($restaurantType->id)],
            'name_ar' => ['required', 'max:255', Rule::unique('restaurant_types')->ignore($restaurantType->id)],
        ]);
        $restaurantType->fill($data);
        $restaurantType->save();
        return redirect()->route('dashboard.restaurant-types.index')
            ->with('status', 'Restaurant type updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantType $restaurantType)
    {
        $restaurantType->delete();
        return redirect()->route('dashboard.restaurant-types.index')
            ->with('status', 'Restaurant deleted');
    }
}
