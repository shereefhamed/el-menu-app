<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class DashboardCountryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Country::class, 'country');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $filter = $request->input('filter');
        $countries = Country::filter(search: $search, filter: $filter)->paginate(10);

        return view(
            'dashboard.countries.index',
            [
                'countries' => $countries,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'dashboard.countries.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $data = $request->validated();
        Country::create($data);
        return redirect()->route('dashboard.countries.index')
            ->with('status', 'Country created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view(
            'dashboard.countries.edit',
            ['country' => $country]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        $data = $request->validated();
        $country->fill($data);
        $country->save();
        return redirect()->route('dashboard.countries.index')
            ->with('status', 'Country updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('dashboard.countries.index')
            ->with('status', 'Country deleted');
    }

    public function forceDelete(string $id)
    {
        $country = Country::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $country);
        $country->forceDelete();
        return redirect()->route('dashboard.countries.index')
            ->with('status', 'Country deleted');

    }

    public function restore(string $id)
    {
        $country = Country::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $country);
        $country->restore();
        return redirect()->route('dashboard.countries.index')
            ->with('status', 'Country restored');
    }
}
