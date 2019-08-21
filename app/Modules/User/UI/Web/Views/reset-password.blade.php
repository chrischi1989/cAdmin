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
            <h4 class="card-header">Passwort ändern</h4>
            <div class="card-body">
                <form action="{{ route('user-reset-password') }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                    @include('partials.messages')
                    @csrf
                    <input type="hidden" name="token" id="token" value="{{ $token }}">
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Neues Passwort" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password_confirmation" placeholder="Neues Passwort bestätigen" autocomplete="off" required>
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
                        <button class="btn btn-primary">Passwort ändern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
