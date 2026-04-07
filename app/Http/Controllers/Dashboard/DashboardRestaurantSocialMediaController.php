<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DashboardRestaurantSocialMediaController extends Controller
{
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'social_media_id' => ['required', Rule::exists('social_media', 'id')],
            'url' => ['required', 'url'],
        ]);

        $restaurant->socialMedia()->attach($request->input('social_media_id'), ['url' => $request->input('url')]);
        return back()->with('status', 'Added');
    }

    public function update(Request $request, Restaurant $restaurant, string $socialMediaId)
    {
        $request->validate([
            'social_media_id' => ['required', Rule::exists('social_media', 'id')],
            'url' => ['required', 'url'],
        ]);
        
        $restaurant->socialMedia()->syncWithoutDetaching([
            $request->input('social_media_id') => ['url' => $request->input('url')]
        ]);
        return back()->with('status', 'updated');
    }

    public function destroy(Restaurant $restaurant, string $socialMediaId)
    {
        $restaurant->socialMedia()->detach($socialMediaId);
        return back()->with('status', 'deleted');
    }
}
