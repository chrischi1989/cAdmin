@extends('layouts.master')
@section('pagetitle') Anmeldung @stop
@section('pagecss')
<style>
    body, html {
        height:100%;
    }

    .background {
        background-image:linear-gradient(to bottom, #194159 0%, #4094d1 50%, #eef0f4 50%, #eef0f4 100%);
    }
</style>
@stop
@section('content')
<div class="d-flex align-items-center justify-content-center h-100 background">
    <div class="col-12 col-sm-10 col-lg-8 col-xl-4">
        <div class="text-center my-5">
            <img src="{{ asset('storage/logo.png') }}">
        </div>
        <div class="card card-default shadow">
            <h2 class="text-center mt-5 mb-3">Willkommen</h2>
            <div class="card-body">
                <form action="{{ route('user-login') }}" enctype="multipart/form-data" method="post" id="loginform">
                    @csrf
                    @include('partials.messages', ['block' => true])
                    @if($loginDelay > 0)
                    <div class="alert alert-info form-group" id="loginDelayNote">
                        Bitte warten Sie <span>{{ $loginDelay }}</span> Sekunden bevor Sie sich erneut anmelden können.
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-form-label required" for="email">E-Mail Adresse:</label>
                        <input id="email" name="email" class="form-control shadow{{ $errors->has('email') ? ' is-invalid' : '' }}" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label required" for="password">Passwort:</label>
                        <input type="password" id="password" name="password" class="form-control shadow{{ $errors->has('password') ? ' is-invalid' : '' }}" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <div class="row align-items-center my-3">
                            <div class="col-12 col-sm-6">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" id="remember-me" name="remember-me" class="custom-control-input" value="1">
                                    <label class="custom-control-label" for="remember-me">Angemeldet bleiben?</label>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 text-sm-right">
                                <a href="{{ route('user-lost-password-page') }}">
                                    <span class="fas fa-key"></span>
                                    Passwort vergessen?
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-block btn-primary">
                            <span class="fas fa-sign-in-alt"></span> Anmelden
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('pagejs')
<script>
    let $loginTimer          = null;
    let $loginDelay          = {{ $loginDelay }};
    let $loginDelayNote      = $('#loginDelayNote');
    let $loginTimerContainer = $loginDelayNote.find('span');

    $('#loginform').find('input').prop('disabled', true);

    setTimeout(function() {
        $('#loginform').find('input').prop('disabled', false);
    }, $loginDelay * 1000);

    $loginTimer = setInterval(function() {
        $loginDelay--;
        if ($loginDelay > 0) {
            $loginTimerContainer.html($loginDelay);
        } else {
            window.clearInterval($loginTimer);
            $loginDelayNote.slideUp();
        }
    }, 1000);
</script>
@stop
