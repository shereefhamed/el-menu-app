<div class="card menu-item-card mb-3">

    <a href="{{ route('restaurants.menuItems.show', ['restaurant' => $restaurant, 'menuItem' => $menuItem]) }}">
        <img src="{{ $menuItem->thumbnail() }}" class="card-img-top" alt="...">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">{{ $menuItem->name }}</h5>
            <p class="card-text">{{ Str::words($menuItem->description, 10, ) }}</p>
            <div class="d-flex justify-content-between price mt-auto">
                <p>{{ $restaurant->currency->symbol }} {{ $menuItem->price }}</p>
                <a href="#"><i class="fa-regular fa-heart"></i></a>
            </div>
        </div>
    </a>
</div>