@extends('layouts.dashboard.dashboard')
@section('title', 'Cities')
@section('content')
<x-dashboard-trashed-filter route="dashboard.cities.index" :model="App\Models\City::class"/>
    <div class="dashboard-countries-fitler">
        <form action="{{ route('dashboard.cities.index') }}" method="GET">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="country" class="form-control">
                    <option value="all">All</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->name }}" {{ request()->input('country') === $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
                @if (request()->input('search'))
                    <input type="hidden" name="search" value="{{ request()->input('search') }}">
                @endif
                <button type="submit" class="btn btn-outline-dark">Filter</button>

        </form>
        <x-dashboard-search-form route="dashboard.cities.index" :filters="['filter', 'country']" />
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Cities</h3>
                </div>
                <div class="col-6">
                <a href="{{ route('dashboard.cities.create') }}" class="btn btn-dark float-end">Add new</a>
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
                        <th>Coutry</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                        <tr class="align-middle">
                            <td>{{ $city->id }}</td>
                            <td>
                                {{ $city->name_en }}
                                <x-dashboard-action-links 
                                    :model="$city"
                                    editRoute="dashboard.cities.edit"
                                    deleteRoute="dashboard.cities.destroy"
                                    restoreRoute="dashboard.cities.restore"
                                    forceDeleteRoute="dashboard.cities.force-delete"/>
                            </td>
                            <td>{{ $city->name_ar }}</td>
                            <td>{{ $city->country->name }}</td>
                            <td>{{ $city->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $cities->links() }}</div>
        </div>
    </div>

@endsection