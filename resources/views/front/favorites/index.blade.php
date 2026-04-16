@extends('layouts.landingpage.app')
@section('title', 'Favorites')
@section('content')
    <div class="container vh-100">
        <h3>{{ __('Favorites') }}</h3>
        <div class="">
            <table class="table">
            <thead>
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Restaurant') }}</th>
                    <th>{{ __('Price') }}</th>
                    <th></th>
                </tr>
            </thead>
                <tbody class="favorites-items-wraper"></tbody>
            </table>
        </div>
        <a href="#" id="return-to-reaturant" class="btn btn-outline-success">{{ __('Return to restaurant') }}</a>
    </div>
@endsection
