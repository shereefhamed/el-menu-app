@extends('layouts.menu')
@section('title', $menuItem->name)
@section('content')
<div class="container mt-5">

    <div class="row">
        <div class="col-md-6">
            <img src="{{ $menuItem->thumbnail() }}" alt="" class="img-fluid">
        </div>
        <div class="col md-6">
            <h3>{{ $menuItem->name }}</h3>
            <p>{{ $menuItem->description_en }}</p>
           
            @foreach ($menuItem->variations as $variation)
                <p>{{ $variation->attribute->name_en }} {{ $variation->price }}</p>
            @endforeach
            <p>is vaiable: {{ $menuItem->isVariable() }}</p>
        </div>

    </div>
</div>
@endsection