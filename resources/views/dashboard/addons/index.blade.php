@extends('layouts.dashboard.dashboard')
@section('title', 'Addons')
@section('content')
    
    <div class="dashboard-fitler">
        @can('isAdmin')
           <form action="{{ route('dashboard.addons.index') }}" method="GET">
                <label for="restaurant" class="form-label">User</label>
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
        @endcan
        <x-dashboard-search-form route="dashboard.addons.index" :filters="[]" />
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Addons</h3>
                </div>
                <div class="col-6">
                    <a href="{{ route('dashboard.addons.create') }}" class="btn btn-dark float-end">Add new</a>
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
                            <th>User</th>
                        @endcan
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addons as $addon)
                        <tr class="align-middle">
                            <td>{{ $addon->id }}</td>
                            <td>
                                {{ $addon->name_en }}
                                <x-dashboard-action-links 
                                    :model="$addon" 
                                    editRoute="dashboard.addons.edit"
                                    deleteRoute="dashboard.addons.destroy" />
                            </td>
                            <td>{{ $addon->name_ar }}</td>
                            <td>{{ $addon->price }}</td>
                            @can ('isAdmin')
                                <td>{{ $addon->user->name }}</td>
                            @endcan
                            <td>{{ $addon->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $addons->links() }}</div>
        </div>
    </div>

@endsection