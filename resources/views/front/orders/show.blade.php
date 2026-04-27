@extends('layouts.landingpage.app')
@section('title', "Order: " . $order->orderId())

@section('content')
    <div class="container vh-100">
        <x-alert />
        <div class="row mt-5">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center">
                <h3>{{ __('Order Details') }}</h3>
                <span class="badge text-bg-secondary">{{ __($order->status) }}</span>
            </div>
            <x-card>
                <div class="row">
                    <div class="col-md-4">
                        <h5>{{ __('Order ID') }}</h5>
                        <p>{{ $order->orderId() }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>{{ __('Order status') }}</h5>
                        <p>{{ __($order->status) }}</p>
                    </div>
                    <div class="col-md-4">
                        <h5>{{ __('Order type') }}</h5>
                        <p>{{ $order->order_type }}</p>
                    </div>
                </div>
                <hr>
                @foreach ($order->orderItems as $orderItem)
                    <div class="row border-bottom mb-1 align-items-center">
                        <div class="col-md-2">
                            <img class="" src="{{ $orderItem->menuItem->thumbnail() }}" />
                        </div>

                        <div class="col-md-6">
                            <h6 class="">{{ $orderItem->item_name }}</h6>
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

                                <small class="text-body-secondary">{{ __('Notes:') }} {{ $orderItem->notes }}</small>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <span>× {{ $orderItem->quantity }}</span>
                        </div>
                        <div class="col-md-2">
                            <span>{{ $order->restaurant->currency->symbol }} {{ $orderItem->total }}</span>
                        </div>
                    </div>

                @endforeach
            </x-card>
        </div>
        <div class="col-md-4">

            <h3>{{ __('Order summary') }}</h3>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ __('Subtotal') }}</span>
                    <strong>{{ $order->restaurant->currency->symbol }} {{ $order->subtotal }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ __('Delivery fee') }}</span>
                    <strong>{{ $order->restaurant->currency->symbol }} {{ $order->delivery_fee }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ __('Service fee') }}</span>
                    <strong>{{ $order->restaurant->currency->symbol }} {{ $order->service_fee }}</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ __('Total') }}</span>
                    <strong>{{ $order->restaurant->currency->symbol }} {{ $order->total }}</strong>
                </li>
            </ul>
            @if ($order->orderCanCancelled())
                <form action="{{ route('orders.update', ['order' => $order]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="w-100 btn btn-danger btn-lg" >
                        {{ __('Cancel') }}
                    </button>
                </form>
            @endif
            
        </div>
    </div>
    </div>
@endsection