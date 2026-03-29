@extends('layouts.app')
@section('title', 'Register')

@section('content')
    <section class="singin-signup">
        <div class="card border-light singin-signup-card">

            <div class="card-body bg-white">
                <form action="">
                    <h3 class="text-center">{{ __('Get started') }}</h3>
                    <p class="text-center">{{ __('Create your account to get started') }}</p>
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input type="text" class="form-control" id="name" >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Email') }}</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <input type="password" class="form-control" id="password" name="password">
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