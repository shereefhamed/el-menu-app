<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginUser;
use App\Events\MergeCartEvent;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'signup_as' => ['required', 'in:restaurant-owner,customer'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $signupAs = $request->input('signup_as');
        $role = Role::customer()->first();
        if($signupAs==='restaurant-owner'){
            $role = Role::owner()->first();
        }
        $user->roles()->attach($role->id);

        event(new MergeCartEvent($user));
        event(new Registered($user));

        Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);
        return redirect($user->getRedirectRoute());
    }
}
