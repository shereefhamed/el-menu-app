@extends('layouts.dashboard.dashboard')
@section('title', 'Update user')
@section('content')
    <form action="{{ route('dashboard.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
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
                                value="{{ old('name', $user->name) }}">
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
                                value="{{ old('email', $user->email) }}">
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
                                    <option 
                                        value="{{ $role->id }}"
                                        {{ $user->role()?->id === $role->id ? 'selected' : ''}}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark my-3">Save</button>
    </form>
    <form action="{{ route('dashboard.users.update-password', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="password" class="form-label">New password</label>
                            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
                            
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-danger mt-3">Change password</button>
    </form>
@endsection