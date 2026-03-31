@extends('layouts.dashboard.dashboard')
@section('title', 'Attributes')
@section('content')
   <div class="dashboard-fitler">
    <div></div>
        <x-dashboard-search-form route="dashboard.social-media.index" :filters="[]" />
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Attributes</h3>
                </div>
                <div class="col-6">
                <a href="{{ route('dashboard.social-media.create') }}" class="btn btn-dark float-end">Add new</a>
            </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Icon</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($socialMedia as $media)
                        <tr class="align-middle">
                            <td>{{ $media->id }}</td>
                            <td>
                                {{ $media->name }}
                                <x-dashboard-action-links 
                                    :model="$media"
                                    editRoute="dashboard.social-media.edit"
                                    deleteRoute="dashboard.social-media.destroy"/>
                            </td>
                            <td><i class="fa-brands {{ $media->icon }}"></i></td>
                            <td>{{ $media->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $socialMedia->links() }}</div>
        </div>
    </div>

@endsection