<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-overrides.min.css') }}">
        <style>
            .nav ul { padding:0 0 0 20px; margin:0; }
            .nav .hide { display:none; }
            .nav > nav > ul li > ul { display:none; }
        </style>
        @yield('pagecss')
        <title>{{ env('APP_NAME') }} :: @yield('pagetitle')</title>
    </head>
    <body>
        <div class="container-fluid">
            <header class="row">
                <div class="branding">

                </div>
            </header>
            <div class="row">
                <div class="col-12 nav">
                    <nav>
                        <span id="back" class="hide"></span>
                        <ul>
                            @each('partials.panel.navigation-item', $navigationsItems, 'item')
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        @yield('content')

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/navigation.js') }}"></script>
        @yield('pagejs')

    </body>
</html>
