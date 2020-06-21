<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ocean</title>
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="{{ mix('css/plugins.css') }}" rel="stylesheet">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>
    @yield('header')
</head>
    <body class="font-sans antialiased text-gray-900 bg-gray-100">
        <div id="app">
            <x-admin.main-navigation/>
            @yield('content')
        </div>
        
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @yield('footer')
        <script type="text/javascript" src="{{ asset('admin/js/main.js') }}"></script>
    </body>
</html>
