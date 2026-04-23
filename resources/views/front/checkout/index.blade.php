@extends('layouts.landingpage.app')
@section('title', 'Checkout')
@section('content')
    <section>
        <div class="container vh-100">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        
                        @endforeach
                    </ul>
                </div>
            @endif
            @if ($cartItems->count() == 0)
                <div class="empt-cart-wraper">
                    <div class="text-center">
                        <h3>Your cart is currently empty!</h3>
                        <a href="{{ route('restaurants.index') }}" class="btn btn-success">{{ __('Start eating') }}</a>
                    </div>

                </div>
            @else
                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        @include('front.checkout.partials.order-details')
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <form action="{{ route('checkout.store') }}" method="POST" id="checkout-form">
                            @csrf
                            @include('front.checkout.partials.order-type')
                            @include('front.checkout.partials.address')
                            @include('front.checkout.partials.table-number')

                        </form>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection