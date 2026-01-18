<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'LuhurCamp'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Vite - CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- PWA Manifest -->
    <!-- <link rel="manifest" href="{{ asset('manifest.json') }}"> -->
    <meta name="theme-color" content="#0F172A">

    @stack('styles')
</head>

<body class="antialiased bg-background text-gray-800">
    @yield('content')

    <!-- <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js');
            });
        }
    </script> -->
    @stack('scripts')
</body>

</html>