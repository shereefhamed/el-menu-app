@extends('layouts.dashboard.dashboard')
@section('title', 'Payments')
@section('content')
    <form action="{{ route('dashboard.payments.index') }}" method="GET">
        <div class="d-flex align-items-center w-50 gap-1">
            <label class="form-label" for="from">From</label>
            <input type="date" class="form-control" name="from" id="from" value="{{ request()->input('from') ? request()->input('from') : '' }}">
            <label class="form-label" for="to">To</label>
            <input type="date" class="form-control" name="to" id="to" value="{{ request()->input('to') ? request()->input('to') : '' }}">
            <button type="submit" class="btn btn-dark">Filter</button>
        </div>
    </form>
    <div class="card mt-2">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h3 class="card-title">Payments</h3>
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
                        <th>Transaction ID</th>
                        <th>User</th>
                        <th>Plan</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr class="align-middle">
                            <td>{{ $payment->transaction_id }}</td>
                            <td>
                                {{ $payment->user->name }}

                            </td>
                            <td>{{ $payment->plan->name }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <div class="float-end">{{ $payments->links() }}</div>
        </div>
    </div>

@endsection