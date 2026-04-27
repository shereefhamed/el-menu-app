<form action="{{ isset($restaurant) ? route('dashboard.restaurants.update', $restaurant) : route('dashboard.restaurants.store') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
    @isset($restaurant)
        @method('PUT')
    @endisset
    <div class="row">
        <div class="col-md-8">
            @include('dashboard.restaurants.partials.main-info')
            @include('dashboard.restaurants.partials.fees')
        </div>
        <div class="col-md-4">
            @include('dashboard.restaurants.partials.logo')
            @include('dashboard.restaurants.partials.currency')
            @include('dashboard.restaurants.partials.owner')
        </div>
    </div>
    <button type="submit" class="btn btn-dark">Save</button>
</form>