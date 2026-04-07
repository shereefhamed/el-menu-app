@extends('layouts.dashboard.dashboard')
@section('title', 'Restaurants')
@section('content')
    <x-dashboard-trashed-filter route="dashboard.restaurants.index" :model="App\Models\Restaurant::class" />
    <div class="dashboard-fitler">
        <form action="{{ route('dashboard.restaurants.index') }}" method="GET">
            <label for="user" class="form-label">User</label>
            <select name="user" id="user" class="form-control">
                <option value="all">All</option>
                @foreach ($users as $user)
                    <option 
                        value="{{ $user->id }}"
                        {{ request()->input('user') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @if (request()->input('search'))
                <input type="hidden" name="search" value="{{ request()->input('search') }}">
            @endif
            <button type="submit" class="btn btn-outline-dark">Filter</button>
        </form>
        <x-dashboard-search-form route="dashboard.restaurants.index" :filters="['filter', 'user']" />
    </div>
    <div class="card mt-2">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Restaurants</h3>
                </div>
                <div class="col-6">
                    <a href="{{ route('dashboard.restaurants.create') }}" class="btn btn-dark float-end">Add new</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name </th>
                        <th>User</th>
                        <th>Food Type</th>
                        <th>Currency</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($restaurants as $restaurant)
                        <tr class="align-middle">
                            <td>{{ $restaurant->id }}</td>
                            <td>
                                {{ $restaurant->name }}
                                <x-dashboard-action-links 
                                    :model="$restaurant" 
                                    viewRoute="restaurants.show"
                                    :viewParams="[
                                        'locale' => 'en',
                                        'restaurant' => $restaurant
                                    ]"
                                    editRoute="dashboard.restaurants.edit"
                                    deleteRoute="dashboard.restaurants.destroy" 
                                    restoreRoute="dashboard.restaurants.restore"
                                    forceDeleteRoute="dashboard.restaurants.force-delete" />
                            </td>
                            <td>{{ $restaurant->user?->name }}</td>
                            <td>{{ $restaurant->type->name_en }}</td>
                            <td>{{ $restaurant->currency->symbol }}</td>
                            <td>{{ $restaurant->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $restaurants->links() }}</div>
        </div>
    </div>

@endsection