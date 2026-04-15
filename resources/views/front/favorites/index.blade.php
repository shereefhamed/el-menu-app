@extends('layouts.app')
@section('title', 'Favorites')
@section('content')
    <div class="container">
        <h3>Favorites</h3>
        @foreach ($favorites as $favorite)
            @include('front.menu-items.partials.menu-item-card')
        @endforeach
    </div>
@endsection