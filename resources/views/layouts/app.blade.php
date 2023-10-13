<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="min-height:100vh;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="Le site Ramène Ta Fraise 🍓 propose un service de “Click & Drive” qui vous permet de visionner les produits que vous souhaitez acheter dans les commerces qui vous entourent pour ensuite venir les collecter en magasin.">

    <link rel="apple-touch-icon" sizes="57x57" HREF="/img/icon_favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" HREF="/img/icon_favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" HREF="/img/icon_favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" HREF="/img/icon_favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" HREF="/img/icon_favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" HREF="/img/icon_favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" HREF="/img/icon_favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" HREF="/img/icon_favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" HREF="/img/icon_favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  HREF="/img/icon_favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" HREF="/img/icon_favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" HREF="/img/icon_favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" HREF="/img/icon_favicon/favicon-16x16.png">
    <link rel="manifest" HREF="/img/icon_favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/icon_favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    @yield('admin_scripts')


    <!-- Styles -->

{{--    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.0/dist/leaflet.css">--}}
{{--    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css"/>--}}
{{--    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css"/>--}}
    <!--
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="{{ Route::currentRouteName() }}" style="min-height:100vh; display:flex; flex-direction:column">
    <div id="app" class="pb-5">
        @include('layouts.partials.nav')

        <main>
            @yield('content')
        </main>

    </div>
    @include('layouts.partials.footer')
    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>
</html>
