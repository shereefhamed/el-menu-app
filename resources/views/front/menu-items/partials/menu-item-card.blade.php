<div class="card menu-item-card mb-3">
    <a href="{{ route('restaurants.menuItems.show', ['restaurant' => $restaurant, 'menuItem' => $menuItem]) }}">
        <img src="{{ $menuItem->thumbnail() }}" class="card-img-top" alt="...">
    </a>
    <div class="card-body">
        <h5 class="card-title">{{ $menuItem->name }}</h5>
        <p class="card-text">{{ Str::words($menuItem->description, 5, ) }}</p>
        <p>{{ $restaurant->currency->symbol }} {{ $menuItem->price }}</p>
    </div>
    <div class="card-footer d-flex justify-content-between">
        <a href="#" class="favorite-btn" data-id="{{ $menuItem->id }}"><i class="fa-regular fa-heart"></i></a>
        <a href="#"><i class="fa-solid fa-cart-plus"></i></a>
    </div>
</div>