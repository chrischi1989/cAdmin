@extends('layouts.master')
@section('pagecss')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/smart_wizard.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/smart_wizard_theme_dots.min.css') }}">
    <style>
        body, html {
            height:100%;
        }

        .background {
            background-image:linear-gradient(to bottom, #194159 0%, #4094d1 50%, #eef0f4 50%, #eef0f4 100%);
        }

        #smartwizard {
            box-shadow: none;
            border:none;
        }
    </style>
@stop
@section('content')
<div class="d-flex align-items-center justify-content-center h-100 background">
    <div class="col-12 col-lg-10 col-xl-8 pt-5">
        <div class="text-center my-5">
            <img src="{{ asset('storage/logo.png') }}">
        </div>
        <form action="{{ route('install') }}" enctype="multipart/form-data" method="post">
            @csrf
            @include('partials.messages')
            <div class="card card-default shadow">
                <div class="card-body">
                    <div id="smartwizard">
                        <ul class="justify-content-sm-center">
                            <li><a href="#step-1">Installation<br><small>Informationen zum System</small></a></li>
                            <li><a href="#step-2">Datenbank<br><small>Verbindung zur Datenbank</small></a></li>
                            <li><a href="#step-3">Administrator<br><small>Zugang zum Panel</small></a></li>
                        </ul>
                        <div class="mt-5">
                            <div id="step-1" class="">
                                <div class="form-row">
                                      <div class="col-12 col-md-6">
                                        <label for="APP_NAME" class="col-form-label required">Name der Anwendung:</label>
                                        <input id="APP_NAME"
                                               name="APP_NAME"
                                               placeholder="cAdmin"
                                               value="{{ old('APP_NAME') }}"
                                               class="form-control shadow{{ $errors->has('APP_NAME') ? ' is-invalid' : ''}}">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="APP_CUSTOMER" class="col-form-label required">Name des Mandanten:</label>
                                        <input id="APP_CUSTOMER"
                                               name="APP_CUSTOMER"
                                               placeholder="AWO Sano"
                                               value="{{ old('APP_CUSTOMER') }}"
                                               class="form-control shadow{{ $errors->has('APP_CUSTOMER') ? ' is-invalid' : ''}}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-12 col-md-6">
                                        <label for="APP_URL" class="col-form-label required">Vollständige URL der Installation:</label>
                                        <div class="input-group">
                                            <input id="APP_URL"
                                                   name="APP_URL"
                                                   placeholder="https://hostname.name"
                                                   value="{{ old('APP_URL') }}"
                                                   class="form-control shadow{{ $errors->has('APP_URL') ? ' is-invalid' : '' }}">
                                            <div class="input-group-append shadow">
                                                <label class="input-group-text pl-4">
                                                    <input class="form-check-input" type="checkbox" value="1" name="APP_DEBUG" id="APP_DEBUG"{{ old('APP_DEBUG') ? ' checked' : '' }}> Debugmodus?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="col-form-label required">Logo des Mandanten:</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                   name="APP_CUSTOMER_BRANDING"
                                                   id="APP_CUSTOMER_BRANDING"
                                                   lang="de"
                                                   class="custom-file-input shadow{{ $errors->has('APP_CUSTOMER_BRANDING') ? ' is-invalid' : '' }}">
                                            <label class="custom-file-label" for="APP_CUSTOMER_BRANDING">Datei auswählen</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="APP_SUPPORT" class="col-form-label required">Support E-Mail:</label>
                                        <input id="APP_SUPPORT"
                                               name="APP_SUPPORT"
                                               placeholder="support@host.name"
                                               value="{{ old('APP_SUPPORT') }}"
                                               class="form-control shadow{{ $errors->has('APP_SUPPORT') ? ' is-invalid' : ''}}">
                                    </div>
                                </div>
                            </div>
                            <div id="step-2" class="">
                                <div class="form-row">
                                    <div class="col-12 col-lg-3">
                                        <label for="DB_CONNECTION" class="col-form-label required">Datenbanktyp:</label>
                                        <select name="DB_CONNECTION" id="DB_CONNECTION" class="form-control custom-select shadow{{ $errors->has('DB_CONNECTION') ? ' is-invalid' : '' }}">
                                            <option value="">&mdash; Auswahl &mdash;</option>
                                            <option value="mysql"{{ old('DB_CONNECTION') == 'mysql' ? ' selected' : '' }}>MySQL</option>
                                        </select>
                                    </div>
                                    <div class="col-9 col-lg-6">
                                        <label for="DB_HOST" class="col-form-label required">Hostname:</label>
                                        <input id="DB_HOST" name="DB_HOST" value="{{ old('DB_HOST') }}" class="form-control shadow{{ $errors->has('DB_HOST') ? ' is-invalid' : '' }}">
                                    </div>
                                    <div class="col-3">
                                        <label for="DB_PORT" class="col-form-label">Port:</label>
                                        <input id="DB_PORT" name="DB_PORT" placeholder="3306" value="{{ old('DB_PORT') }}" class="form-control shadow{{ $errors->has('DB_PORT') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-12 col-lg-4">
                                        <label for="DB_DATABASE" class="col-form-label required">Datenbank:</label>
                                        <input id="DB_DATABASE" name="DB_DATABASE" value="{{ old('DB_DATABASE') }}" class="form-control shadow{{ $errors->has('DB_DATABASE') ? ' is-invalid' : '' }}">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="DB_USERNAME" class="col-form-label required">Benutzername:</label>
                                        <input id="DB_USERNAME" name="DB_USERNAME" value="{{ old('DB_USERNAME') }}" class="form-control shadow{{ $errors->has('DB_USERNAME') ?  ' is-invalid' : '' }}">
                                    </div>
                                    <div class="col-12 col-lg-4">
                                        <label for="DB_PASSWORD" class="col-form-label required">Passwort:</label>
                                        <input type="password" id="DB_PASSWORD" name="DB_PASSWORD" value="{{ old('DB_PASSWORD') }}" class="form-control shadow{{ $errors->has('DB_PASSWORD') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div id="step-3" class="">
                                <div class="form-row">
                                    <div class="col-12">
                                        <label for="email" class="col-form-label required">E-Mail Adresse:</label>
                                        <input id="email" name="email" value="{{ old('email') }}" class="form-control shadow{{ $errors->has('email') ? ' is-invalid' : '' }}">
                                    </div>
                                </div>
                                <div class="form-row mt-3">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-lg btn-primary">
                                            <span class="fas fa-fw fa-check"></span> Jetzt Installieren
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@stop
@section('pagejs')
<script src="{{ asset('js/jquery.smartWizard.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#smartwizard').smartWizard({
            anchorSettings: {
                anchorClickable: true, // Enable/Disable anchor navigation
                enableAllAnchors: true, // Activates all anchors clickable all times
                markDoneStep: true, // add done css
                enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
            },
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'center', // left, right
                showNextButton: false, // show/hide a Next button
                showPreviousButton: false, // show/hide a Previous button
            },
            theme: 'dots',
            transitionEffect: 'fade', // Effect on navigation, none/slide/fade
        });
    });

    $('#smartwizard').on('click', '> ul li a', function() {
        $('#smartwizard > ul li:gt(' + $(this).parent().index() + ')').removeClass('done');
    });
    </script>
@stop
