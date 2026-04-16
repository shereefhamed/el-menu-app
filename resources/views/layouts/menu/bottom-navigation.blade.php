<nav class="bottom-navbar">
    <ul class="bottom-navbar-items">
        <li class="bottom-navbar-item border-end"><a href="{{ route('restaurants.show', $restaurant) }}"><i
                    class="fa-regular fa-house"></i></a></li>
        <li class="bottom-navbar-item border-end"><a href="#"><i class="fa-solid fa-basket-shopping"></i></a></li>
        <li class="bottom-navbar-item border-end">
            <a href="{{ route('favorites.index') }}" class="favorites-icon">
                <i class="fa-regular fa-heart"></i>
                <span class="favorites-number"></span>
            </a>

        </li>
        <li class="bottom-navbar-item">
            <a href="#"><i class="fa-regular fa-circle-user"></i></a>
        </li>
    </ul>
</nav>
