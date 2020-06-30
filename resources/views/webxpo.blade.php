<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('/js/manifest.js') }}"></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body style="display: none;">
    <main>
        <div id="app">
            <router-view></router-view>
        </div>
    </main>

    <script type="text/javascript">
        var MTUserId='b41c71fc-d9a9-4866-8bb1-02032336c5ef';
        var MTFontIds = new Array();

        MTFontIds.push("5664103"); // Neue Helvetica® W05 65 Medium
        MTFontIds.push("5664149"); // Neue Helvetica® W01 75 Bold
        (function() {
            var mtTracking = document.createElement('script');
            mtTracking.type='text/javascript';
            mtTracking.async='true';
            mtTracking.src='storage/fonts/mtiFontTrackingCode.js';

            (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(mtTracking);
        })();
    </script>
</body>
</html>
