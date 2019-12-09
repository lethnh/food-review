<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>
        <meta name="description" content="{{ config('app.description') }}">
        <meta name="keywords" content="{{ config('app.keywords') }}">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
            integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

        <!-- Styles -->
        <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">
        <link href="/js/owl.carousel.min.css" rel="stylesheet">
        <link href="/js/owl.theme.default.min.css" rel="stylesheet">
        @yield('styles')
    </head>

    <body>
        <div id="app" class="site-wrapper">
            <router-view></router-view>
        </div>

        <!-- Scripts -->
        <script src="{{ asset('frontend/js/app.js') }}"></script>
        <script src="/js/owl.carousel.min.js"></script>
        <script src="{{ asset('/js/animsition.min.js') }}"></script>
        <script src="{{ asset('frontend/js/main.js') }}"></script>
        @yield('scripts')
    </body>

</html>