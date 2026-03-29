@extends('layouts.dashboard.dashboard')
@section('title', 'Countries')
@section('content')
    <div class="dashboard-countries-fitler">
        <x-dashboard-trashed-filter route="dashboard.countries.index" :model="App\Models\Country::class"/>
        <x-dashboard-search-form route="dashboard.countries.index" :filters="['filter']" />
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Countries</h3>
                </div>
                <div class="col-6">
                <a href="{{ route('dashboard.countries.create') }}" class="btn btn-dark float-end">Add new</a>
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
                    @foreach ($countries as $country)
                        <tr class="align-middle">
                            <td>{{ $country->id }}</td>
                            <td>
                                {{ $country->name_en }}
                                <x-dashboard-action-links 
                                    :model="$country"
                                    editRoute="dashboard.countries.edit"
                                    deleteRoute="dashboard.countries.destroy"
                                    restoreRoute="dashboard.countries.restore"
                                    forceDeleteRoute="dashboard.countries.force-delete"/>
                            </td>
                            <td>{{ $country->name_ar }}</td>
                            <td>{{ $country->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $countries->links() }}</div>
        </div>
    </div>

@endsection