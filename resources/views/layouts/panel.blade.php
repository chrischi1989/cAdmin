<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-overrides.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/panel.min.css') }}">
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
                        <span id="back" class="empty">
                            <span class="fas fa-bars fa-fw mr-0"></span> Menü
                        </span>
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
        <script src="{{ asset('js/navigation.min.js') }}"></script>
        @yield('pagejs')

    </body>
</html>
