@extends('layouts.dashboard.dashboard')
@section('title', 'Users')
@section('content')
   
    <div class="card mt-2">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Users</h3>
                </div>
                <div class="col-6">
                    <!-- <a href="{{ route('dashboard.payments.create') }}" class="btn btn-dark float-end">Add new</a> -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="align-middle">
                            <td>{{ $user->id }}</td>
                            <td>
                                {{ $user->name }}

                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role ? $user->role->name :'' }}</td>
                            <td>{{ $user->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $users->links() }}</div>
        </div>
    </div>

@endsection