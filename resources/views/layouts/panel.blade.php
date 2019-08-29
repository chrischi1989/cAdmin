<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-overrides.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/panel.min.css') }}">
        <style>

        </style>
        @yield('pagecss')
        <title>{{ env('APP_NAME') }} :: @yield('pagetitle')</title>
    </head>
    <body>
        <div class="container-fluid wrapper">
            <header class="row header shadow">
                <div class="col-12 col-lg-2 header-left branding">
                    <h1><a href="{{ route('dashboard') }}">{{ env('APP_NAME') }}</a></h1>
                </div>
                <div class="col-12 col-lg-10 header-right text-right">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-user"></span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('user-profile-page') }}">
                                <span class="fas fa-user-edit"></span> Mein Profil
                            </a>
                            <div class="dropdown-item">
                                <form action="{{ route('user-logout') }}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <button class="btn btn-transparent">
                                        <span class="fas fa-sign-out-alt"></span> Abmelden
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <div class="row main">
                <div class="col-12 col-lg-2 navigation">
                    <nav>
                        <span id="back">Menü</span>
                        <ul>
                            @each('partials.panel.navigation-item', $navigationsItems, 'item')
                        </ul>
                    </nav>
                </div>
                <div class="col-12 col-lg-10 content">

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
                $('body').on('click', '.navigation nav ul li', function($event) {
                    if($(this).find('ul').length > 0) {
                        $history.push($(this).parent().clone(true));
                        $backTexts.push($(this).find('span[data-backhtml]').data('backhtml'));
                        $current = $(this).children('ul');
                        $(this).parent().remove();
                        $('.navigation nav').append($current);

                        if($history.length > 0) {
                            $('#back').html($(this).find('span[data-backhtml]').data('backhtml'));
                            //document.querySelector('#back').classList.remove('hide');
                        } else {
                            //document.querySelector('#back').classList.add('hide');
                        }
                    }
                });

                $('body').on('click', '#back', function() {
                    console.log($history.length);
                    if($history.length > 0) {
                        $backTexts.pop();
                        $previous = $history.pop();
                        $current.remove();
                        $current = $previous;
                        $('.navigation nav').append($previous);


                        $('#back').html($backTexts.pop());
                        //document.querySelector('#back').classList.remove('hide');
                    } else {
                        $history   = [];
                        $backTexts = [];
                        $current   = null;
                        $previous  = null;

                        $('#back').html('Menü');
                        //document.querySelector('#back').classList.add('hide');
                    }
                });
            });
        </script>
        @yield('pagejs')

    </body>
</html>
