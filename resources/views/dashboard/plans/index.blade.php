@extends('layouts.dashboard.dashboard')
@section('title', 'Plans')
@section('content')
    <x-dashboard-trashed-filter route="dashboard.plans.index" :model="App\Models\Plan::class" />
    <div class="card mt-2">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Plans</h3>
                </div>
                <div class="col-6">
                    <a href="{{ route('dashboard.plans.create') }}" class="btn btn-dark float-end">Add new</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>English Name </th>
                        <th>Arabic Name</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr class="align-middle">
                            <td>{{ $plan->id }}</td>
                            <td>
                                {{ $plan->name_en }}
                                <x-dashboard-action-links :model="$plan" editRoute="dashboard.plans.edit"
                                    deleteRoute="dashboard.plans.destroy" restoreRoute="dashboard.plans.restore"
                                    forceDeleteRoute="dashboard.plans.force-delete" />
                            </td>
                            <td>{{ $plan->name_ar }}</td>
                            <td>{{ $plan->amount }}</td>
                            <td>{{ $plan->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $plans->links() }}</div>
        </div>
    </div>

@endsection