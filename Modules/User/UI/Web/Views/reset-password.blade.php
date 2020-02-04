@extends('layouts.master')
@section('pagetitle') Passwort zurücksetzen @stop
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
            <h2 class="text-center mt-5 mb-3">Passwort ändern</h2>
            <div class="card-body">
                <form action="{{ route('user-reset-password') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                    @include('partials.messages')
                    @csrf
                    <input type="hidden" name="token" id="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="password" class="col-form-label required">Neues Passwort:</label>
                        <input type="password" id="password" name="password" class="form-control shadow{{ $errors->has('password') ? ' is-invalid' : null }}" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="col-form-label required">Neues Passwort bestätigen:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control shadow{{ $errors->has('password') ? ' is-invalid' : null }}" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <h5>Bitte beachten Sie</h5>
                        <p>Ihr Passwort muss mindestens enthalten:</p>
                        <ul class="pl-3">
                            <li>12 Zeichen</li>
                            <li>1 Kleinbuchstaben</li>
                            <li>1 Großbuchstaben</li>
                            <li>1 Zahl</li>
                            <li>1 Sonderzeichen</li>
                        </ul>
                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-block btn-primary">
                            <span class="fas fa-sync"></span> Passwort ändern
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
