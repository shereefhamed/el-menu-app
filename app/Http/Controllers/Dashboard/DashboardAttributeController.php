<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;

class DashboardAttributeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Attribute::class, 'attribute');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->input('search');
        $attributes = Attribute::filter($search)->paginate(10);
        return view(
            'dashboard.attributes.index',
            ['attributes' => $attributes]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $data = $request->validated();
        Attribute::create($data);
        return redirect()->route('dashboard.attributes.index')
            ->with('status', 'Attribute created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute)
    {
        return view(
            'dashboard.attributes.edit',
            ['attribute' => $attribute]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $data = $request->validated();
        $attribute->fill($data);
        $attribute->save();
        return redirect()->route('dashboard.attributes.index')
            ->with('status', 'Attribute updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('dashboard.attributes.index')
            ->with('status', 'Attribute deleted');
    }
}
