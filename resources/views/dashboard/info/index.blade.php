@extends('layouts.dashboard.dashboard')
@section('title', 'Info')

@section('content')

    <form action="{{ route('dashboard.info.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                @include('dashboard.info.partials.main-info')
                <div class="d-flex gap-1">
                    <button class="btn btn-dark" type="submit">Save</button>
                    <a href="{{ route('restaurants.show', ['restaurant' => $restaurant, 'locale' => 'en']) }}"
                        class="btn btn-outline-dark" target="_blank">View</a>
                </div>
            </div>
            <div class="col-md-4">
                @include('dashboard.info.partials.currency')
                @include('dashboard.info.partials.logo')
                @include('dashboard.info.partials.qr-code')
                
            </div>
        </div>

    </form>
    <div>
        @include('dashboard.info.partials.branches')
        @include('dashboard.info.partials.social-media')
    </div>

@endsection