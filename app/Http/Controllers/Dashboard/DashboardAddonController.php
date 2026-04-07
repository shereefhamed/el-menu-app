<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddonRequest;
use App\Models\Addon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAddonController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Addon::class, 'addon');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('search');
        $user_id = request()->input('user');
        $addons = Addon::filter($search, $user_id)->latest()->paginate(10);
        $owners = User::owners()->get();
        return view(
            'dashboard.addons.index',
            [
                'addons' => $addons,
                'users' => $owners,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $owners = User::owners()->get();
        return view(
            'dashboard.addons.create',
            [
                'users' => $owners,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddonRequest $request)
    {
        $data = $request->validated();
        if(Auth::user()->isOwner()){
           $data['user_id']  = Auth::user()->id;
        }
        Addon::create($data);
        return redirect()->route('dashboard.addons.index')
            ->with('status', 'Addon created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Addon $addon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Addon $addon)
    {
        $owners = User::owners()->get();
        return view(
            'dashboard.addons.edit',
            [
                'addon' => $addon,
                'users' => $owners,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddonRequest $request, Addon $addon)
    {
        $data = $request->validated();
        $addon->fill($data);
        // $user = $request->user();
        $addon->save();
        return redirect()->route('dashboard.addons.index')
            ->with('status', 'Addon updates');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Addon $addon)
    {
        $addon->delete();
        return redirect()->route('dashboard.addons.index')
            ->with('status', 'Addon deleted');
    }
}
