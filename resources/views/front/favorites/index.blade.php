@extends('layouts.app')
@section('title', 'Favorites')
@section('content')
    <div class="container vh-100">
        <h3>Favorites</h3>
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
    </div>
@endsection
