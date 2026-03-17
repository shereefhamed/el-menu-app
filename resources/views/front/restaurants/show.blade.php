@extends('layouts.menu')
@section('title', $restaurant->name)

@section('content')
    <nav id="navbar-example2" class="categories navbar px-3 mb-3 sticky-top bg-body-tertiary">

        <ul class="nav nav-pills">

            @foreach ($restaurant->categories as $category)
                <li class="nav-item">
                    <a class="nav-link" href="#{{ Str::slug($category->name_en) }}">{{ $category->name }}</a>
                </li>
            @endforeach()
        </ul>
    </nav>
    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%"
        data-bs-smooth-scroll="true" class="scrollspy-example  p-3 rounded-2 container" tabindex="0">
        @foreach ($restaurant->categories as $category)

                <div class="row" id="{{ Str::slug($category->name_en) }}">
                    <h4>{{ $category->name}}</h4>
                    @foreach ($category->menuItems as $menuItem)
                            <div class="col-md-3">
                                <div class="card">
                                    <a
                                        href="{{ route('restaurants.menuItems.show', ['restaurant' => $restaurant, 'menuItem' => $menuItem]) }}">
                                        <img src="{{ $menuItem->thumbnail() }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $menuItem->name }}</h5>
                                            <p class="card-text">{{ $menuItem->description_en }}</p>
                                            <p>EGP {{ $menuItem->price }}</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
        @endforeach()
    </div>
@endsection