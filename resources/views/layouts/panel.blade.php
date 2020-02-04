<!doctype html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <div class="col-12 col-lg-10 header-right">
                    <div class="row align-items-center">
                        <div class="col-10">@yield('breadcrumb')</div>
                        <div class="col-2 text-right">
                            <div class="row justify-content-end">
                            <div class="dropdown">
                                <button type="button"
                                        class="btn btn-primary dropdown-toggle"
                                        id="user-top-menu"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    <span class="fas fa-fill-drip"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-top-menu">
                                    <div class="dropdown-item">
                                        <div class="row flex-wrap w-50">
                                            <div class="col-1 h-50" style="background-color:#272d36;">&nbsp;</div>
                                            <div class="col-1 h-50" style="background-color:#5d6777;">&nbsp;</div>
                                            <div class="col-1 h-50" style="background-color:#eff1f4;">&nbsp;</div>
                                            <div class="col-1 h-50" style="background-color:#ffffff;">&nbsp;</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown mx-2">
                                <button type="button"
                                        class="btn btn-primary dropdown-toggle"
                                        id="user-top-menu"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                    <span class="fas fa-user"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user-top-menu">
                                    <div class="dropdown-item">
                                        <a href="{{ route('user-profile-page') }}" class="btn btn-transparent">
                                            <span class="fas fa-user-edit"></span> Mein Profil
                                        </a>
                                    </div>
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
                    @yield('content')
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/bootbox.all.min.js') }}"></script>
        <script src="{{ asset('js/panel.min.js') }}"></script>
        @yield('pagejs')

    </body>
</html>
