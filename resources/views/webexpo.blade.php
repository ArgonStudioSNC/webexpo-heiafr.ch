<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title', __('webexpo.online-exposition').' - '.__('webexpo.heiafr-fullname'))</title>
    <meta name="description"
    content="@yield('page-description', __('webexpo.description-home'))">

    <!-- Scripts -->
    @vite('resources/js/app.js')

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/storage/media/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/storage/media/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/storage/media/favicon/favicon-16x16.png">
    <link rel="manifest" href="/storage/media/favicon/site.webmanifest">
</head>

<body class="antialiased" style="visibility:hidden; overflow-y:hidden;">
    <div id="app"></div>

    <script type="text/javascript">

    var MTUserId='b41c71fc-d9a9-4866-8bb1-02032336c5ef';
    var MTFontIds = new Array();

    MTFontIds.push("5664103"); // Neue Helvetica® W05 65 Medium
    MTFontIds.push("5664149"); // Neue Helvetica® W01 75 Bold
    (function() {
        var mtTracking = document.createElement('script');
        mtTracking.type='text/javascript';
        mtTracking.async='true';
        mtTracking.src='/storage/mtiFontTrackingCode.js';

        (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(mtTracking);
    })();
    </script>

    <script>
    window.locale = "{{ App::getLocale() }}";
    window.default_locale = "{{ config('app.locale') }}";
    window.fallback_locale = "{{ config('app.fallback_locale') }}";
    window.messages = @json($messages);
    </script>
</body>
</html>
