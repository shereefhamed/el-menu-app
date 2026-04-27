<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;

class MyAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $currentUser = auth()->user();
        $orders = $currentUser->orders()->with(['restaurant', 'user'])->orderBy('created_at')->get();
        $address = $currentUser->address;
        return view(
            'front.my-account.index',
            [
                'orders' => $orders,
                'address' => $address,
            ]
        );
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        $data = $request->validated();
        $request->user()->fill($data);

        $request->user()->save();

        return redirect()->route('my-account.index')
            ->with('status', 'Profile updated');
    }

    public function updateAddress(Request $request)
    {
        $data = $request->validate([
            'phone' => ['string', 'max:255'],
            'address' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'country' => ['string', 'max:255']
        ]);
        $request->user()->address()->updateOrCreate(
            [],
            $data,
        );
        return redirect()->route('my-account.index')->with('status', 'User address updated');
    }
}
