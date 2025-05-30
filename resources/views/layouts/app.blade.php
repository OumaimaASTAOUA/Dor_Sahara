<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dor Sahara') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Dor Sahara CSS -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('css/intr.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('style.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('script.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen ">
        <!-- Navigation (hidden on auth pages) -->
        {{-- @unless(request()->is('auth*'))
            @include('layouts.navigation')
        @endunless --}}

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-8 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Dor Sahara JS -->
        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="{{ asset('js/intr.js') }}"></script>
        <script>
            var swiper = new Swiper('.swiper', {
                spaceBetween: 30,
                pagination: { el: '.swiper-pagination', clickable: true },
                autoplay: { delay: 3000, disableOnInteraction: false },
            });
        </script>
    </div>
</body>
</html>
