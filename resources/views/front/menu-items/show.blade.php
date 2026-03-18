@extends('layouts.menu')
@section('title', $menuItem->name)
@section('content')
    <div class="container my-5">

        <div class="row">
            <div class="col-md-6">
                <img src="{{ $menuItem->thumbnail() }}" alt="" class="img-fluid">
            </div>
            <div class="col md-6">
                <h3>{{ $menuItem->name }}</h3>
                <p>{{ $menuItem->description }}</p>
                <ul class="menu-item-variations">
                    @foreach ($menuItem->attributes as $attribute)
                        <li>{{ $attribute->name}} - {{ $attribute->pivot->price }}</li>
                    @endforeach
                </ul>
                <div class="menu-item-addons">
                    @foreach ($menuItem->addons as $addon)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkChecked" >
                            <label class="form-check-label" for="checkChecked">
                                {{ $addon->name}}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection