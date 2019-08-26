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
        <script>
            var $history   = [];
            var $backTexts = [];
            var $current   = null;
            var $previous  = null;

            $(document).ready(function() {
                $('body').on('click', 'nav ul li', function($event) {
                    if($(this).find('ul').length > 0) {
                        $history.push($(this).parent().clone(true));
                        $backTexts.push($($event.target).text());
                        $current = $(this).children('ul');
                        $(this).parent().remove();
                        $('.nav nav').append($current);

                        if($history.length > 0) {
                            $('#back').html('<span class="fas fa-angle-double-left"></span> ' + $($event.target).text());
                            document.querySelector('#back').classList.remove('hide');
                        } else {
                            document.querySelector('#back').classList.add('hide');
                        }
                    }
                });

                $('body').on('click', '#back', function() {
                    $backTexts.pop();
                    $previous = $history.pop();
                    $current.remove();
                    $current = $previous;
                    $('.nav nav').append($previous);

                    if($history.length > 0) {
                        $('#back').html($backTexts.pop());
                        document.querySelector('#back').classList.remove('hide');
                    } else {
                        document.querySelector('#back').classList.add('hide');
                    }
                });
            });
        </script>
        @yield('pagejs')

    </body>
</html>
