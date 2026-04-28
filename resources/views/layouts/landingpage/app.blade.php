<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--font-awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--end-of-fontawsome-->

    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">
    <!--end-of-google-fonts-->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
    <style>
        html,
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="{{ app()->getLocale() }}">
    @if (isset($nav) && $nav)
        @include('layouts.landingpage.navigation')
    @endif
    @yield('content')
    <x-back-to-top />
    <footer class="bg-body-tertiary px-3">
        <p class="text-center">© Copyright Elafcorp. All right reserved.</p>
    </footer>
</body>

</html>