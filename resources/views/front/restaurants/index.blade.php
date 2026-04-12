@extends('layouts.app')
@section('title', 'Resturants')

@section('content')
    <div class="container restaurant-search-content vh-100">
        @include('front.home.partials.search')
        <div class="search-result mt-5">
            <div class="row">
                @foreach ($restaurants as $restaurant)
                    <div class="col-md-3">
                        @include('front.restaurants.partials.restaurant-card')
                    </div>
                @endforeach
            </div>
        </div>
    </div>


@endsection