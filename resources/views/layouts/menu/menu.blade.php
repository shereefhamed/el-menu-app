<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- end-of-fontawsom -->

    <!--Google Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <!--end-of-goole-font-->
    <script>
        window.i18n = {
            added_to_favorites: @json(__('Menu item added to favorites')),
            removed_from_favorites: @json(__('Menu item removed from favorites')),
        };
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>

<body class="{{ app()->getLocale() }}">
    @include('layouts.menu.navigation')
    @yield('content')
    @include('layouts.menu.bottom-navigation')
    <x-back-to-top />
    <footer class="bg-body-tertiary">
        <h5>{{ $restaurant->name }}</h5>
        <p>Created by: <a href="https://elafcorp.com">Elafcorp</a></p>
    </footer>
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">{{ __('Favorites') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">

            </div>
        </div>
    </div>
</body>

</html>