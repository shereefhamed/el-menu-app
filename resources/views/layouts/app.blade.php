<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @if (app()->getLocale() == 'ar')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body class="{{ app()->getLocale() }}">

</body>
@if (isset($nav) && $nav)
    <!-- <nav class="navbar navbar-expand-lg sticky-top bg-white">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">El-menu</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav main-navbar mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#hero">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#how-it-works">{{ __('How it works?') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">{{ __('Features') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#download">{{ __('Download') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Language') }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                        href="{{ App\Helper\LocaleHelper::url('en') }}">
                                        🇬🇧 English
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}"
                                        href="{{ App\Helper\LocaleHelper::url('ar') }}">
                                        🇸🇦 العربية
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div>
                        @auth()
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">{{ __('Logout') }}</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-success">{{ __('Register') }}</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav> -->
    <nav class="navbar navbar-expand-lg sticky-top bg-white" aria-label="Offcanvas navbar large">
        <div class="container"> 
            <a class="navbar-brand" href="{{ route('home') }}">El-menu</a> 
            <button
                class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
                aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
                aria-labelledby="offcanvasNavbar2Label">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbar2Label">El-menu</h5> 
                    <button type="button"
                        class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
                    </button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#hero">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#how-it-works">{{ __('How it works?') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">{{ __('Features') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#download">{{ __('Download') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('Language') }}
                            </a>
                            <ul class="dropdown-menu language-switcher">
                                <li>
                                    <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                        href="{{ App\Helper\LocaleHelper::url('en') }}">
                                        🇬🇧 English
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}"
                                        href="{{ App\Helper\LocaleHelper::url('ar') }}">
                                        🇸🇦 العربية
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div>
                        @auth()
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">{{ __('Logout') }}</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success">{{ __('Login') }}</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-success">{{ __('Register') }}</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endif
@yield('content')
<button type="button" class="btn btn-success btn-floating btn-lg" id="btn-back-to-top">
    <i class="fas fa-arrow-up"></i>
</button>
<footer class="bg-body-tertiary px-3">
    <p class="text-center">© Copyright Elafcorp. All right reserved.</p>
</footer>

</html>