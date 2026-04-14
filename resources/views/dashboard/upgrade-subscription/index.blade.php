@extends('layouts.dashboard.dashboard')
@section('title', 'Upgrade subscription')
@section('content')
    <div class="alert alert-danger">
        Your current plan is <strong>{{ auth()->user()->subscription->plan->name }}</strong> and will expire at {{ \Carbon\Carbon::parse(auth()->user()->subscription->end_at)->format('d-m-Y') }}
    </div>
    <div class="row">
        @foreach ($plans as $plan)
            <div class="col">
                <div class="card mb-4 rounded-3 shadow-sm border-dark">
                    <div class="card-header py-3 text-bg-dark border-dark">
                        <h4 class="my-0 fw-normal">{{ Str::ucfirst($plan->name) }}</h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">
                            ${{ $plan->price }}<small class="text-body-secondary fw-light">/mo</small>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            @if ($plan->canCreateQrCode())
                                <li>{{ __('Create QR code') }}</li>
                            @endif
                                <li>{{ $plan->landingpageCategoriesPrashe() }}</li>
                                <li>{{ $plan->landingpageItemsPrashe() }}</li>
                        </ul>
                        <a href="{{ route('dashboard.upgrade-subscription.subscripe', ['planId' => $plan->id]) }}" type="button" class="w-100 btn btn-lg btn-dark">Change</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection