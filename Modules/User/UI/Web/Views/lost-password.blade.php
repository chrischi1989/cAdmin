@extends('layouts.master')
@section('pagetitle') Passwort vergessen @stop
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
            <h2 class="text-center mt-5 mb-3">Passwort vergessen</h2>
            <div class="card-body">
                <form action="{{ route('user-lost-password') }}" enctype="multipart/form-data" method="post" class="form-horizontal" id="resetform">
                    @csrf
                    @include('partials.messages')
                    @if($resetDelay > 0)
                    <div class="alert alert-info form-group" id="resetDelayNote">
                        Bitte warten Sie <span>{{ $resetDelay }}</span> Sekunden bevor Sie eine neue Anfrage starten können.
                    </div>
                    @endif
                    <p>Geben Sie Ihre E-Mail Adresse an um Instruktionen zum Zurücksetzen Ihres Passwortes zu erhalten.</p>
                    <div class="form-group">
                        <label for="email" class="col-form-label required">E-Mail Adresse:</label>
                        <input class="form-control shadow{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary">
                            <span class="fas fa-paper-plane"></span> Absenden
                        </button>
                    </div>
                    <div class="form-group text-sm-right mb-0">
                        <a href="{{ route('user-login-page') }}">
                            <span class="fas fa-sign-in-alt"></span>
                            Zurück zur Anmeldung
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
@section('pagejs')
<script>
    let $resetTimer          = null;
    let $resetDelay          = {{ $resetDelay }};
    let $resetDelayNote      = $('#resetDelayNote');
    let $resetTimerContainer = $resetDelayNote.find('span');

    $('#resetform').find('input').prop('disabled', true);

    setTimeout(function() {
        $('#resetform').find('input').prop('disabled', false);
    }, $resetDelay * 1000);

    $resetTimer = setInterval(function() {
        $resetDelay--;
        if ($resetDelay > 0) {
            $resetTimerContainer.html($resetDelay);
        } else {
            window.clearInterval($resetTimer);
            $resetDelayNote.slideUp();
        }
    }, 1000);
</script>
@stop

