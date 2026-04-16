<nav class="navbar navbar-expand-lg sticky-top bg-white landing-page-nav-bar" aria-label="Offcanvas navbar large">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
            aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar2"
            aria-labelledby="offcanvasNavbar2Label">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbar2Label">El-menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
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
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
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
                    @endauth
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success">{{ __('Login') }}</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-success">{{ __('Register') }}</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>