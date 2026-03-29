@extends('layouts.app')
@section('title', 'Login')

@section('content')
    <section class="singin-signup">
        <div class="card border-light singin-signup-card">

            <div class="card-body bg-white">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h3 class="text-center">{{ __('Welcome back') }}</h3>
                    <p class="text-center">{{ __('Please sign in') }}</p>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email"
                            placeholder="name@example.com" name="email" autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ __($message) }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Password') }}</label>
                        <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ __($message) }}</div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="remember-me" name="remember">
                        <label class="form-check-label" for="remember-me">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-success w-100">{{ __('Login') }}</button>
                    <p class="mt-3 text-center">{{ __('Don\'t have an account?') }} <a
                            href="{{ route('register') }}">{{ __('Register') }}</a></p>
                </form>
            </div>
        </div>
    </section>

@endsection