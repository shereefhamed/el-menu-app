@extends('layouts.app')
@section('title', 'Register')

@section('content')
    <section class="singin-signup">
        <div class="card border-light singin-signup-card">

            <div class="card-body bg-white">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <h3 class="text-center">{{ __('Get started') }}</h3>
                    <p class="text-center">{{ __('Create your account to get started') }}</p>
                    <div class="mb-3">
                        <label for="signup-as" class="form-label">{{ __('Signup as') }}</label>
                        <select name="signup_as" id="signup-as" class="form-control">
                            <option 
                                value="restaurant-owner"
                                @selected(old('signup_as' == 'restaurant-owner'))>
                                {{ __('Restaurant owner') }}
                            </option>
                            <option 
                                value="customer"
                                @selected(old('signup_as', request()->input('signup-as')??null) === 'customer')>
                                {{ __('Customer') }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input 
                            type="text" 
                            class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                            id="name" 
                            value="{{ old('name') }}"
                            name="name">
                        @error('name')
                            <div class="invalid-feedback">{{ __($message) }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input 
                            type="email" 
                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                            id="email" 
                            placeholder="name@example.com" 
                            value="{{ old('email') }}"
                            name="email">
                        @error('email')
                            <div class="invalid-feedback">{{ __($message) }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input  
                            type="password" 
                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                            id="password" 
                            name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ __($message) }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100">{{ __('Register') }}</button>
                    <p class="mt-3 text-center">{{ __('Have an account?') }} <a href="{{ route('login') }}">{{ __('Login') }}</a></p>
                </form>
            </div>
        </div>
    </section>

@endsection