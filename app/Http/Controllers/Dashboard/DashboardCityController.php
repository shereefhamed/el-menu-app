<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class DashboardCityController extends Controller
{
    public function __construct() {
        $this->authorizeResource(City::class, 'city');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $country = request()->input('country');
        $filter = request()->input('filter');
        $search = request()->input('search');

        $cities = City::filter(country: $country, filter: $filter, search: $search)->paginate(10);
        $countries = Country::all();

        return view(
            'dashboard.cities.index',
            [
                'cities' => $cities,
                'countries' => $countries,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view(
            'dashboard.cities.create',
            [
                'countries' => $countries
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request)
    {
        $data = $request->validated();
        City::create($data);
        return redirect()->route('dashboard.cities.index')
            ->with('status', 'City created');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        $countries = Country::all();
        return view(
            'dashboard.cities.edit',
            [
                'city' => $city,
                'countries' => $countries,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, City $city)
    {
        $data = $request->validated();
        $city->fill($data);
        $city->save();
        return redirect()->route('dashboard.cities.index')->with('status', 'City updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('dashboard.cities.index')
            ->with('status', 'City deleted');
    }

    public function forceDelete(string $id)
    {
        $city = City::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $city);
        $city->forceDelete();
        return redirect()->route('dashboard.cities.index')
            ->with('status', 'City deleted');
    }

    public function restore(string $id)
    {
        $city = City::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $city);
        $city->restore();
        return redirect()->route('dashboard.cities.index')
            ->with('status', 'City restored');
    }
}
