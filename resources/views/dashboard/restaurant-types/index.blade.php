@extends('layouts.dashboard.dashboard')
@section('title', 'Restaurant types')
@section('content')
   <div class="dashboard-fitler">
    <div></div>
        <x-dashboard-search-form route="dashboard.restaurant-types.index" :filters="[]" />
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Restautant types</h3>
                </div>
                <div class="col-6">
                <a href="{{ route('dashboard.restaurant-types.create') }}" class="btn btn-dark float-end">Add new</a>
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
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurantTypes as $restaurantType)
                        <tr class="align-middle">
                            <td>{{ $restaurantType->id }}</td>
                            <td>
                                {{ $restaurantType->name_en }}
                                <x-dashboard-action-links 
                                    :model="$restaurantType"
                                    editRoute="dashboard.restaurant-types.edit"
                                    deleteRoute="dashboard.restaurant-types.destroy"/>
                            </td>
                            <td>{{ $restaurantType->name_ar }}</td>
                            <td>{{ $restaurantType->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $restaurantTypes->links() }}</div>
        </div>
    </div>

@endsection