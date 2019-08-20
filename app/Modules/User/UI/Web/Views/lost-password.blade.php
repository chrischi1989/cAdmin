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
    <div class="col-12 col-sm-10 col-lg-6 col-xl-4">
        <div class="card">
            <h5 class="card-header">Passwort vergessen</h5>
            <div class="card-body">
                <form action="{{ route('user-lost-password') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                    @if($resetDelay > 0)
                    <div class="alert alert-info form-group" id="resetDelayNote">
                        Bitte warten Sie <span>{{ $resetDelay }}</span> Sekunden bevor Sie eine neue Anfrage starten können.
                    </div>
                    @endif
                    @csrf
                    <p>Geben Sie Ihre E-Mail Adresse an um Instruktionen zum zurücksetzen Ihres Passwortes zu erhalten.</p>
                    <div class="row">
                        <label class="col-form-label col-12 required" for="email">E-Mail Adresse:</label>
                        <div class="col-12">
                            <input class="form-control" name="email" required>
                        </div>
                    </div>
                    <div class="row align-items-center mt-3">
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
                </form>
            </div>
        </div>
    </div>
</div>
@stop
