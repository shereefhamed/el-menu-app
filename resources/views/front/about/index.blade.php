@extends('layouts.menu')
@section('title', $restaurant->name)
@section('content')
    <div class="container mt-5 about vh-100">
        @foreach ($restaurant->branches as $branche)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $branche->city->name }}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ __('Address') }}</h5>
                    <p class="card-text"><i class="fa-solid fa-location-dot"></i> {{ $branche->address }}</p>
                    <p><i class="fa-solid fa-phone"></i> {{ $branche->phone }}</p>
                </div>
            </div>
        @endforeach
        <div class="social-media">
            @foreach ($restaurant->socialMedia as $socialMedia)
                <span class="social-media-icon"><a href="{{ $socialMedia->pivot->url }}" target="_blank"><i class="fa-brands {{ $socialMedia->icon }}"></i> </a></span>
            @endforeach
        </div>
    </div>
@endsection