@extends('layouts.master')
@section('pagecss')
    <style>
        body, html {
            height:100%;
        }
    </style>
@stop
@section('content')
<div class="d-flex align-items-center justify-content-center h-100">
    <div class="col-12 col-sm-10 col-lg-8 col-xl-6">
        <div class="card">
            <h5 class="card-header">Passwort vergessen</h5>
            <div class="card-body">
                <form action="{{ route('user-lost-password') }}" enctype="multipart/form-data" method="post" class="form-horizontal" id="resetform">
                    @csrf
                    @include('partials.messages')
                    @if($resetDelay > 0)
                    <div class="alert alert-info form-group" id="resetDelayNote">
                        Bitte warten Sie <span>{{ $resetDelay }}</span> Sekunden bevor Sie eine neue Anfrage starten können.
                    </div>
                    @endif
                    <p>Geben Sie Ihre E-Mail Adresse an um Instruktionen zum zurücksetzen Ihres Passwortes zu erhalten.</p>
                    <div class="form-group">
                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" required placeholder="E-Mail Adresse">
                    </div>
                    <div class="form-group mb-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                                <button class="btn btn-primary">
                                    <span class="fas fa-sign-in-alt"></span> Absenden
                                </button>
                            </div>
                            <div class="col-12 col-sm-6 text-sm-right">
                                <a href="{{ route('user-login-page') }}">
                                    <span class="fas fa-sign-in-alt"></span>
                                    Zurück zur Anmeldung
                                </a>
                            </div>
                        </div>
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

