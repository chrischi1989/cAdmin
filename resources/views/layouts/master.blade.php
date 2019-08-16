<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-overrides.min.css') }}">
        @yield('pagecss')
        <title>{{ env('APP_NAME') }} :: @yield('pagetitle')</title>
    </head>
    <body>
        @yield('content')

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        @yield('pagejs')
    </body>
</html>
