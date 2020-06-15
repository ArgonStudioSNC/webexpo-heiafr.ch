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
    <script src="{{ mix('storage/js/manifest.js') }}"></script>
    <script src="{{ mix('storage/js/vendor.js') }}" defer></script>
    <script src="{{ mix('storage/js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('storage/css/app.css') }}" rel="stylesheet" type="text/css">
</head>

<body style="display: none;">
    <main>
        <div id="app">
            <div style="mix-blend-mode: multiply;">
                <a style="opacity: 0.3;">
                    <h1>Some text</h1>
                </a>
            </div>
        </div>
    </main>

    <script></script>
</body>
</html>
