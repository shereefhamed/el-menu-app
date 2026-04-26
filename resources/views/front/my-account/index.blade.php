@extends('layouts.landingpage.app')
@section('title', 'My account')

@section('content')
   <div class="container vh-100">
      
      <x-errors />
      <x-alert />
      <div class="my-account">
         <div class="nav nav-pills me-3 my-account-nav" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            <button class="nav-link active " id="v-pills-profile-tab" data-bs-toggle="pill"
               data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
               aria-selected="true">
               Profile
            </button>

            <button class="nav-link" id="v-pills-security-tab" data-bs-toggle="pill" data-bs-target="#v-pills-security"
               type="button" role="tab" aria-controls="v-pills-security" aria-selected="false">
               Security
            </button>

            <button class="nav-link" id="v-pills-orders-tab" data-bs-toggle="pill" data-bs-target="#v-pills-orders"
               type="button" role="tab" aria-controls="v-pills-orders" aria-selected="false">
               {{ __('Orders') }}
            </button>

            <button class="nav-link" id="v-pills-address-tab" data-bs-toggle="pill" data-bs-target="#v-pills-address"
               type="button" role="tab" aria-controls="v-pills-address" aria-selected="false">
               {{ __('Address') }}
            </button>

         </div>
         <div class="tab-content my-account-content-body" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
               aria-labelledby="v-pills-profile-tab" tabindex="0">
               @include('front.my-account.profile')
            </div>

            <div class="tab-pane fade" id="v-pills-security" role="tabpanel" aria-labelledby="v-pills-security-tab"
               tabindex="0">
               @include('front.my-account.security')
            </div>

            <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab"
               tabindex="0">
               @include('front.my-account.orders')
            </div>

            <div class="tab-pane fade" id="v-pills-address" role="tabpanel" aria-labelledby="v-pills-address-tab"
               tabindex="0">
               @include('front.my-account.address')
            </div>

         </div>
      </div>
   </div>
@endsection