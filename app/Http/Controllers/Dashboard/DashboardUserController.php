<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;


class DashboardUserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::with('roles')->latest()->paginate(10);
        $search = request()->input('search');
        $filter = request()->input('filter');
        $users = User::filter($search, $filter)->paginate(10);
        return View(
            'dashboard.users.index',
            ['users' => $users],
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view(
            'dashboard.users.create',
            ['roles' => $roles]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        $user->roles()->sync([$data['role_id']]);
        return redirect()->route('dashboard.users.index')
            ->with('status', 'User created');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view(
            'dashboard.users.edit',
            [
                'user' => $user,
                'roles' => $roles,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'role_id' => ['required', 'exists:roles,id']
        ]);
        $user->fill($validated);
        $user->save();
        $user->roles()->sync([$validated['role_id']]);
        return redirect()->route('dashboard.users.index')
            ->with('status', 'User updated');
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $validated = $request->validate([
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('dashboard.users.index')->with('status', 'password updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        abort_if($user->id === Auth::user()->id, 403);
        $user->delete();
        return redirect()->route('dashboard.users.index')
            ->with('status', 'User deleted');
    }

    public function restore(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $user);
        $user->restore();
        return redirect()->route('dashboard.users.index')
            ->with('status', 'User restored');
    }

    public function forceDelete(string $id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $user);
        $user->forceDelete();
        return redirect()->route('dashboard.users.index')
            ->with('status', 'User deleted');
    }
}
