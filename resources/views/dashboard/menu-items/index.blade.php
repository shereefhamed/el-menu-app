@extends('layouts.dashboard.dashboard')
@section('title', 'Menu items')
@section('content')
    <x-dashboard-trashed-filter route="dashboard.menu-items.index" :model="App\Models\MenuItem::class" />
    <div class="dashboard-fitler">
        @can('isAdmin')
            <form action="{{ route('dashboard.menu-items.index') }}" method="GET">
                <label for="restaurant" class="form-label">Restaurant</label>
                <select name="restaurant" id="restaurant" class="form-control">
                    <option value="all">All</option>
                    @foreach ($restaurants as $restaurant)
                        <option 
                            value="{{ $restaurant->id }}"
                            {{ request()->input('restaurant') == $restaurant->id ? 'selected' : '' }}>
                            {{ $restaurant->name }}
                        </option>
                    @endforeach
                </select>
                @if (request()->input('search'))
                    <input type="hidden" name="search" value="{{ request()->input('search') }}">
                @endif
                <button type="submit" class="btn btn-outline-dark">Filter</button>
            </form>
        @endcan
        <x-dashboard-search-form route="dashboard.menu-items.index" :filters="['filter',]" />
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Menu items</h3>
                </div>
                <div class="col-6">
                    <a href="{{ route('dashboard.menu-items.create') }}" class="btn btn-dark float-end">Add new</a>
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
                        @can ('isAdmin')
                            <th>Reataurant</th>
                        @endcan
                        <th>Category</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menuItems as $menuItem)
                        <tr class="align-middle">
                            <td>{{ $menuItem->id }}</td>
                            <td>
                                {{ $menuItem->name_en }}
                                <x-dashboard-action-links 
                                    :model="$menuItem" 
                                    editRoute="dashboard.menu-items.edit"
                                    deleteRoute="dashboard.menu-items.destroy" 
                                    restoreRoute="dashboard.menu-items.restore"
                                    forceDeleteRoute="dashboard.menu-items.force-delete" />
                            </td>
                            <td>{{ $menuItem->name_ar }}</td>
                            <td>{{ $menuItem->price?? '-' }}</td>
                            @can ('isAdmin')
                                <td>{{ $menuItem->restaurant->name }}</td>
                            @endcan
                            <td>{{ $menuItem->category->name }}</td>
                            <td>{{ $menuItem->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $menuItems->links() }}</div>
        </div>
    </div>

@endsection