<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Restaurant;

class DashboardCategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $filter = request()->input('filter');
        $search = request()->input('search');
        $restaurant = request()->input('restaurant');
        $categories = Category::filter($filter, $search, $restaurant)->latest()->paginate(10);

        $restaurants = Restaurant::all();
        return view(
            'dashboard.categories.index',
            [
                'categories' => $categories,
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
        return view(
            'dashboard.categories.create',
            ['restaurants' => $restaurants]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        $data = $request->validated();
        $user = $request->user();
        if ($user->isOwner()) {
            $data['restaurant_id'] = $user->restaurant->id;
        }
        $category = Category::create($data);
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = $file->store('categories');
            $category->image_url = $path;
            $category->save();
        }
        return redirect()->route('dashboard.categories.index')
            ->with('status', 'Category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $restaurants = Restaurant::all();
        return view(
            'dashboard.categories.edit',
            [
                'category' => $category,
                'restaurants' => $restaurants,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $user = $request->user();
        if ($user->isOwner()) {
            $data['restaurant_id'] = $user->restaurant->id;
        }
        $category->fill($data);
        $category->save();

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $path = $file->store('categories');
            $category->image_url = $path;
            $category->save();
        }
        return redirect()->route('dashboard.categories.index')
            ->with('status', 'Category updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')
            ->with('status', 'Category deleted');
    }

    public function restore(string $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $category);
        $category->restore();
        return redirect()->route('dashboard.categories.index')
            ->with('status', 'Category restored');
    }

    public function forceDelete(string $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $category);
        $category->forceDelete();
        return redirect()->route('dashboard.categories.index')
            ->with('status', 'Category deleted');
    }
}
