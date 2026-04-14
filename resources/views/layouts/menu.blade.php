<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @if (app()->getLocale() == 'ar')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>

</head>

<body class="{{ app()->getLocale() }}">
    <nav class="navbar sticky-top bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('restaurants.show', $restaurant) }}">{{ $restaurant->name }}</a>
            <!-- <input type="text" class="form-control" id="item-search"> -->
            <div class="header-icons">
                
                <div class="header-icon header-search-icon"><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a></div>
                <div class="header-icon">
                    <a href="{{ App\Helper\LocaleHelper::url(app()->getLocale() === 'en' ? 'ar' : 'en') }}">
                        <i class="fa-solid fa-globe"></i>
                    </a>
                </div>
                <div class="header-icon desktop-only"><a href="#"><i class="fa-solid fa-basket-shopping"></i></a></div>
                <div class="header-icon desktop-only"><a href="#"><i class="fa-regular fa-heart"></i></a></div>
                <div class="header-icon desktop-only"><a href="#"><i class="fa-regular fa-circle-user"></i></a></div>
                <div class="header-icon">
                    <a href="{{ route('about.index', $restaurant) }}">
                        <i class="fa-solid fa-info"></i>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    @yield('content')
    <nav class="bottom-navbar">
        <ul class="bottom-navbar-items">
            <li class="bottom-navbar-item border-end"><a href="{{ route('restaurants.show', $restaurant) }}"><i
                        class="fa-regular fa-house"></i></a></li>
            <li class="bottom-navbar-item border-end"><a href="#"><i class="fa-solid fa-basket-shopping"></i></a></li>
            <li class="bottom-navbar-item border-end"><a href="#"><i class="fa-regular fa-heart"></i></a></li>
            <li class="bottom-navbar-item">
                <a href="#"><i class="fa-regular fa-circle-user"></i></a>
            </li>
        </ul>
    </nav>
    <button type="button" class="btn btn-success btn-floating btn-lg" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <footer class="bg-body-tertiary">
        <h5>{{ $restaurant->name }}</h5>
        <p>Created by: <a href="https://elafcorp.com">Elafcorp</a></p>
    </footer>
</body>

</html>