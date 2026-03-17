<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['./resources/css/app.css', './resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body>
    <nav class="navbar sticky-top bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand">{{ $restaurant->name }}</a>
            <div class="header-icons">
                <div class="header-icon"><a
                        href="{{ App\Helper\LocaleHelper::url(app()->getLocale() === 'en' ? 'ar' : 'en') }}"><i
                            class="fa-solid fa-globe"></i></a></div>
                <div class="header-icon"><a href="#"><i class="fa-solid fa-cart-shopping"></i></a></div>
                <div class="header-icon"><a href="#"><i class="fa-regular fa-heart"></i></a></div>
                <div class="header-icon"><a href="#"><i class="fa-solid fa-magnifying-glass"></i></a></div>
            </div>

        </div>
    </nav>
    @yield('content')
</body>

</html>