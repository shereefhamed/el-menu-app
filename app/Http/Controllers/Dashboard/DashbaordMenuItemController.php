<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Models\Addon;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DashbaordMenuItemController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(MenuItem::class, 'menu_item');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filter = request()->input('filter');
        $search = request()->input('search');
        $restaurant = request()->input('restaurant');
        $menuItems = MenuItem::filter($filter, $search, $restaurant)->latest()->paginate(10);

        $restaurants = Restaurant::all();

        return view(
            'dashboard.menu-items.index',
            [
                'menuItems' => $menuItems,
                'restaurants' => $restaurants,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        $currentUser = request()->user();
        $categories = $currentUser->isOwner() ? $currentUser->restaurant->categories : [];
        // $addons = Addon::all();
        $addons = $currentUser->isOwner() ? $currentUser->addons : Addon::all();
        $attributes = Attribute::all();

        return view(
            'dashboard.menu-items.create',
            [
                'restaurants' => $restaurants,
                'categories' => $categories,
                'addons' => $addons,
                'attributes' => $attributes,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuItemRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        if ($user->isOwner()) {
            $data['restaurant_id'] = $user->restaurant->id;
        }
        $menuItem = MenuItem::create($data);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = $file->store('menu-items');
            $menuItem->image_url = $path;
            $menuItem->save();
        }

        $syncData = [];
        if ($request->filled('attributes')) {
            foreach ($request->input('attributes') as $attr) {
                $syncData[$attr['id']] = [
                    'price' => $attr['price'] ?? 0
                ];
            }
            $menuItem->attributes()->attach($syncData);
        }


        if ($request->filled('addons')) {
            $menuItem->addons()->attach($request->input('addons'));
        }

        return redirect()->route('dashboard.menu-items.index')
            ->with('status', 'Menu item created');
    }

    /**
     * Display the specified resource.
     */
    public function show(MenuItem $menuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MenuItem $menuItem)
    {
        $restaurants = Restaurant::all();
        $currentUser = request()->user();
        $categories = $currentUser->isOwner() ? $currentUser->restaurant->categories : $menuItem->restaurant->categories;
        // $addons = Addon::all();
        $addons = $currentUser->isOwner() ? $currentUser->addons : Addon::all();
        $attributes = Attribute::all();

        return view(
            'dashboard.menu-items.edit',
            [
                'menuItem' => $menuItem,
                'restaurants' => $restaurants,
                'categories' => $categories,
                'addons' => $addons,
                'attributes' => $attributes,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MenuItemRequest $request, MenuItem $menuItem)
    {
        $data = $request->validated();
        $user = $request->user();
        if ($user->isOwner()) {
            $data['restaurant_id'] = $user->restaurant->id;
        }
        $menuItem = $menuItem->fill($data);
        $menuItem->save();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = $file->store('menu-items');
            $menuItem->image_url = $path;
            $menuItem->save();
        }

        $syncData = [];
        if ($request->filled('attributes')) {
            foreach ($request->input('attributes') as $attr) {
                if (isset($attr['id'])) {
                    $syncData[$attr['id']] = [
                        'price' => $attr['price'] ?? 0
                    ];
                }

            }

        }
        $menuItem->attributes()->sync($syncData);

        $menuItem->addons()->sync($request->input('addons') ?? []);

        return redirect()->route('dashboard.menu-items.index')
            ->with('status', 'Menu item created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();
        return redirect()->route('dashboard.menu-items.index')
            ->with('status', 'Menu item deleted');
    }

    public function restore(string $id)
    {
        
        $menuItem = MenuItem::onlyTrashed()->where('slug', $id)->firstOrFail();
        $this->authorize('restore', $menuItem);
        $menuItem->restore();
        return redirect()->route('dashboard.menu-items.index')
            ->with('status', 'Menu item restored');
    }

    public function forceDelete(string $id)
    {
        $menuItem = MenuItem::onlyTrashed()->where('slug', $id)->firstOrFail();
        $this->authorize('restore', $menuItem);
        $menuItem->forceDelete();
        return redirect()->route('dashboard.menu-items.index')
            ->with('status', 'Menu item deleted');
    }
}
