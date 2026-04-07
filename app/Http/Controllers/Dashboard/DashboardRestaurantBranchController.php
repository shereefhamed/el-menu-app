<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branche;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DashboardRestaurantBranchController extends Controller
{
    public function store(Request $request, Restaurant $restaurant)
    {
        $data = $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
        ]);
        $restaurant->branches()->create($data);
        return back()->with('status', 'branche created');
    }

    public function update(Request $request, Restaurant $restaurant, string $branchId)
    {
        $branch = Branche::findOrFail($branchId);
        $data = $request->validate([
            'address' => 'required',
            'phone' => 'required',
            'city_id' => 'required',
        ]);
        $branch->fill($data);
        $branch->save();
        return back()->with('status', 'branche updated');

    }

    public function destroy(Restaurant $restaurant, string $branchId)
    {
        $branch = Branche::findOrFail($branchId);
        $branch->delete();
        return back()->with('status', 'branche deleted');
    }
}
