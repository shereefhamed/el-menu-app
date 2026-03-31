@extends('layouts.dashboard.dashboard')
@section('title', 'Attributes')
@section('content')
   <div class="dashboard-fitler">
    <div></div>
        <x-dashboard-search-form route="dashboard.attributes.index" :filters="[]" />
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Attributes</h3>
                </div>
                <div class="col-6">
                <a href="{{ route('dashboard.attributes.create') }}" class="btn btn-dark float-end">Add new</a>
            </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>English Name </th>
                        <th>Arabic Name</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attributes as $attribute)
                        <tr class="align-middle">
                            <td>{{ $attribute->id }}</td>
                            <td>
                                {{ $attribute->name_en }}
                                <x-dashboard-action-links 
                                    :model="$attribute"
                                    editRoute="dashboard.attributes.edit"
                                    deleteRoute="dashboard.attributes.destroy"/>
                            </td>
                            <td>{{ $attribute->name_ar }}</td>
                            <td>{{ $attribute->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $attributes->links() }}</div>
        </div>
    </div>

@endsection