@extends('layouts.landingpage.app')
@section('title', 'Checkout')
@section('content')
    <section class="">
        <div class="container">
            <h1 class="text-center">Thank you for your order!</h1>
            <p class="text-center">
                Your order has been placed successfully and is being processed. We've sent a confirmation email to your
                inbox.
            </p>
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3>Order Details</h3>
                        <span class="badge text-bg-secondary">{{ $order->status }}</span>
                    </div>
                    <x-card>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Order ID</h6>
                                <p>{{ $order->orderId() }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6>Order status</h6>
                                <p>{{ $order->status }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6>Order status</h6>
                                <p>{{ $order->status }}</p>
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

                    <h3>Order Summary</h3>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Subtotal</span>
                            <strong>{{ $order->restaurant->currency->symbol }} {{ $order->subtotal }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Delivery fee</span>
                            <strong>{{ $order->restaurant->currency->symbol }} {{ $order->delivery_fee }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Service fee</span>
                            <strong>{{ $order->restaurant->currency->symbol }} {{ $order->service_fee }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong>{{ $order->restaurant->currency->symbol }} {{ $order->total }}</strong>
                        </li>
                    </ul>
                    <a class="w-100 btn btn-success btn-lg" href="{{ route('restaurants.index') }}">
                        Explore more restaurants
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection