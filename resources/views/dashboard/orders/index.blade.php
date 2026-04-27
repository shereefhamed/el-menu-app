@extends('layouts.dashboard.dashboard')
@section('title', 'Orders')
@section('content')

    <div class="dashboard-fitler">
       
            <form action="{{ route('dashboard.orders.index') }}" method="GET">
                <label for="customer" class="form-label">Customer</label>
                <select name="customer" id="user" class="form-control">
                    <option value="all">All</option>
                    @foreach ($users as $user)
                        <option 
                            value="{{ $user->id }}"
                            {{ request()->input('customer') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <label for="from" class="form-label">From</label>
                <input type="date" name="from" class="form-control" value="{{ request()->input('from')??'' }}">
                <label for="to" class="form-label">To</label>
                <input type="date" name="to" class="form-control" value="{{ request()->input('to')??'' }}">
                @can('isAdmin')
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
                @endcan 
                
                <button type="submit" class="btn btn-outline-dark">Filter</button>
            </form>
        
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Orders</h3>
                </div>
                <div class="col-6">
                    
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Total</th>
                        @can ('isAdmin')
                            <th>Reataurant</th>
                        @endcan
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="align-middle">
                            <td>{{ $order->orderId() }}</td>
                            <td>
                                <a href="{{ route('dashboard.orders.edit', $order) }}">
                                    {{ $order->user->name }}
                                </a>
                            </td>
                            <td>
                                {{ $order->status }}
                              
                            </td>
                            <td>{{ $order->total }}</td>

                            @can ('isAdmin')
                                <td>{{ $order->restaurant->name }}</td>
                            @endcan
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $orders->links() }}</div>
        </div>
    </div>

@endsection