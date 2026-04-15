@extends('layouts.app')
@section('title', 'El-menu')

@section('content')
    @include('front.home.partials.hero')
    @include('front.home.partials.search')
    @include('front.home.partials.demo')
    @include('front.home.partials.how-it-works')
    @include('front.home.partials.features')
    @include('front.home.partials.pricing')
    @include('front.home.partials.customer-sing-up')
    @include('front.home.partials.download')
    @include('front.home.partials.contact')
@endsection