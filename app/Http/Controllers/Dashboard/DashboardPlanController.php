<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class DashboardPlanController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Plan::class, 'plan');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::latest()->paginate(10);
        if (request()->input('filter') === 'trashed') {
            $plans = Plan::onlyTrashed()->latest()->paginate(10);
        }
        return view(
            'dashboard.plans.index',
            ['plans' => $plans]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'dashboard.plans.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        $data = $request->validated();
        Plan::create($data);
        return redirect()->route('dashboard.plans.index')
            ->with('status', 'Plan created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        return view(
            'dashboard.plans.edit',
            [
                'plan' => $plan,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        $data = $request->validated();
        $plan->fill($data);
        $plan->save();
        return redirect()->route('dashboard.plans.index')
            ->with('status', 'Plan update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();
        return redirect()->route('dashboard.plans.index')
            ->with('status', 'Plan deleted');
    }

    public function restore(string $id)
    {
        $plan = Plan::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $plan);
        $plan->restore();
        return redirect()->route('dashboard.plans.index')
            ->with('status', 'Plan restored');
    }

    public function forceDelete(string $id)
    {
        $plan = Plan::onlyTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $plan);
        $plan->forceDelete();
        return redirect()->route('dashboard.plans.index')
            ->with('status', 'Plan deleted');
    }
}
