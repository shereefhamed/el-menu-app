@extends('layouts.landingpage.app')
@section('title', 'Cart')
@section('content')
    <div class="container cart-page">
        @if ($cartItems->count() == 0)
            <div class="empt-cart-wraper">
                <div class="text-center">
                    <h3>Your cart is currently empty!</h3>
                    <a href="{{ route('restaurants.index') }}" class="btn btn-success">{{ __('Start eating') }}</a>
                </div>

            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    @include('front.cart.shoping-cart')
                    <div class="d-flex justify-content-between">
                        @if($restaurant)
                            <a href="{{ route('restaurants.show', ['restaurant' => $restaurant]) }}"
                                class="btn btn-outline-success">
                                {{ __('Return to restaurant') }}
                            </a>
                        @endif
                        <form action="{{ route('cart.update') }}" method="POST" id="shopping-cart-update-form">
                            @csrf
                            @foreach ($cartItems as $cartItem)
                                <input type="hidden" name="cart_items[{{ $cartItem['cartItemId'] }}]"
                                    value="{{ $cartItem['quantity'] }}" id="update-item-cart-form-{{ $cartItem['cartItemId'] }}">
                            @endforeach
                            <button type="submit" class="btn btn-success">{{ __('Udate cart') }}</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    @include('front.cart.order-summary')
                </div>
            </div>
        @endif
    </div>
@endsection