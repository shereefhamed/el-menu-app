@extends('layouts.dashboard.dashboard')
@section('title', 'Categories')
@section('content')
    <x-dashboard-trashed-filter route="dashboard.categories.index" :model="App\Models\Category::class" />
    <div class="dashboard-fitler">
        @can('isAdmin')
            <form action="{{ route('dashboard.categories.index') }}" method="GET">
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
        <x-dashboard-search-form route="dashboard.categories.index" :filters="['filter',]" />
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Categories</h3>
                </div>
                <div class="col-6">
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-dark float-end">Add new</a>
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
                        @can ('isAdmin')
                            <th>Reataurant</th>
                        @endcan
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="align-middle">
                            <td>{{ $category->id }}</td>
                            <td>
                                {{ $category->name_en }}
                                <x-dashboard-action-links :model="$category" editRoute="dashboard.categories.edit"
                                    deleteRoute="dashboard.categories.destroy" restoreRoute="dashboard.categories.restore"
                                    forceDeleteRoute="dashboard.categories.force-delete" />
                            </td>
                            <td>{{ $category->name_ar }}</td>
                            @can ('isAdmin')
                                <td>{{ $category->restaurant->name }}</td>
                            @endcan
                            <td>{{ $category->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $categories->links() }}</div>
        </div>
    </div>

@endsection