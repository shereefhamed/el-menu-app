<nav class="navbar sticky-top bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('restaurants.show', $restaurant) }}">{{ $restaurant->name }}</a>
        <!-- <input type="text" class="form-control" id="item-search"> -->
        <div class="header-icons">
            <div class="header-icon header-search-icon"><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
            </div>
            <div class="header-icon">
                <a href="{{ App\Helper\LocaleHelper::url(app()->getLocale() === 'en' ? 'ar' : 'en') }}">
                    <i class="fa-solid fa-globe"></i>
                </a>
            </div>
            <div class="header-icon desktop-only"><a href="#"><i class="fa-solid fa-basket-shopping"></i></a></div>
            <div class="header-icon desktop-only favorites-icon">
                <a href="{{ route('favorites.index') }}">
                    <i class="fa-regular fa-heart"></i>
                </a>
                <span class="favorites-number"></span>
            </div>
            <div class="header-icon desktop-only"><a href="#"><i class="fa-regular fa-circle-user"></i></a></div>
            <div class="header-icon">
                <a href="{{ route('about.index', $restaurant) }}">
                    <i class="fa-solid fa-info"></i>
                </a>
            </div>
        </div>
    </div>
</nav>