@extends('layouts.dashboard.dashboard')
@section('title', 'Create user')
@section('content')


    <form action="{{ route('dashboard.users.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input 
                                type="text" 
                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                                id="name" 
                                name="name"
                                value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input 
                                type="email" 
                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                id="email" 
                                placeholder="name@example.com" 
                                name="email" 
                                autocomplete="off"
                                value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input 
                                type="password" 
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                id="password" 
                                name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input 
                                type="password" 
                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                id="password_confirmation"
                                name="password_confirmation">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <label for="role" class="form-label">Role</label>
                            <select name="role_id" id="role" class="form-control">
                                <option>Select role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark mt-3">Save</button>
    </form>
@endsection