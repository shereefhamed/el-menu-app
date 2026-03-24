<div class="card restaurant-card mb-3">
    <a href="{{ route('restaurants.menuItems.show', ['restaurant' => $restaurant, 'menuItem' => $menuItem]) }}">
        <img src="{{ $menuItem->thumbnail() }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $menuItem->name }}</h5>
            <p class="card-text">{{ Str::words($menuItem->description, 15, ) }}</p>
            <div class="d-flex justify-content-between">
                <p>EGP {{ $menuItem->price }}</p>
                <a href="#"><i class="fa-regular fa-heart"></i></a>
            </div>

        </div>
    </a>
</div>