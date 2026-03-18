<div class="card restaurant-card mb-3">
    <a href="{{ route('restaurants.menuItems.show', ['restaurant' => $restaurant, 'menuItem' => $menuItem]) }}">
        <img src="{{ $menuItem->thumbnail() }}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{ $menuItem->name }}</h5>
            <p class="card-text">{{ Str::words($menuItem->description, 15,) }}</p>
            <p>EGP {{ $menuItem->price }}</p>
        </div>
    </a>
</div>