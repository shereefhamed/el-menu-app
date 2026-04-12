@extends('layouts.app')
@section('title', 'Create your restaurant')
@section('content')
    <section class="singin-signup">
        <div class="card border-light singin-signup-card">

            <div class="card-body bg-white">
                <form action="{{ route('restaurants.store') }}" method="POST">
                    @csrf
                    <h3 class="text-center">{{ __('Welcome') }}</h3>
                    <p class="text-center">{{ __('Please add your restaurant details') }}</p>
                    <div class="mb-3">
                        <label for="name" class="form-label">Restaurant name</label>
                        <input 
                            type="text"
                            name="name"
                            id="name"
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="restaurant_type_id" class="form-label">Food type</label>
                        <select 
                            name="restaurant_type_id" 
                            id="restaurant_type_id"
                            class="form-control {{ $errors->has('restaurant_type_id') }}">
                            @foreach ($foodTypes as $type)
                                <option 
                                    value="{{ $type->id }}" 
                                    @selected($type->id == old('restaurant_type_id'))>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="currency_id" class="form-label">Currency</label>
                        <select 
                            name="currency_id" 
                            id="currency_id"
                            class="form-control {{ $errors->has('currency_id') }}">
                            @foreach ($currencies as $currency)
                                <option 
                                    value="{{ $currency->id }}" 
                                    @selected($currency->id == old('currency_id'))>
                                    {{ $currency->symbol }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success w-100">{{ __('Create') }}</button>
                </form>
            </div>
        </div>
    </section>
@endsection