@extends('layouts.dashboard.dashboard')
@section('title', 'Edit order')
@section('content')
    <form action="{{ route('dashboard.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <x-card title="Order details">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order type</th>
                                <th>Table number</th>
                                <th>Customer name</th>
                                <th>Phone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $order->order_type }}</td>
                                <td>{{ $order->table_number }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </x-card>
                <x-card title="Items">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $orderItem)
                                <tr>
                                    <td>
                                        <div class="d-flex gap-1 align-items-center">
                                            <img src="{{ $orderItem->menuItem->thumbnail() }}" alt="" style="width: 60px;">
                                            <div>
                                                <h6>{{ $orderItem->item_name }}</h6>
                                                @if ($orderItem->attribute)
                                                    <small class="text-body-secondary">{{ $orderItem->attribute['name'] }}</small>
                                                    <br>
                                                @endif
                                                @if ($orderItem->addons)
                                                    @foreach ($orderItem->addons as $addon)
                                                        <small class="text-body-secondary">{{ $addon['name'] }} |</small>
                                                    @endforeach
                                                    <br>
                                                @endif
                                                @if ($orderItem->notes)

                                                    <small class="text-body-secondary">{{ __('Notes:') }}
                                                        {{ $orderItem->notes }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $orderItem->quantity }}</td>
                                    <td>{{ $orderItem->unit_price }}</td>
                                    <td>{{ $orderItem->total }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                             <tr>
                                <td>Service fee</td>
                                <td>{{ $order->service_fee }}</td>
                            </tr>
                             <tr>
                                <td>Delivey fee</td>
                                <td>{{ $order->delivery_fee }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>{{ $order->total }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </x-card>
            </div>
            <div class="col-md-4">
                <x-card title="Update order">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected($status === $order->status)>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-dark">Save</button>
                </x-card>
            </div>
        </div>
    </form>
@endsection