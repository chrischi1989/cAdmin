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
                <h5 class="card-header">Anmeldung</h5>
                <div class="card-body">
                    <form action="{{ route('user-login') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <input id="username" name="username" class="form-control" placeholder="Benutzername" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-12">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Passwort" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-12 col-sm-6 mb-3 mb-sm-0">
                                <button class="btn btn-primary">
                                    <span class="fas fa-sign-in-alt"></span> Anmelden
                                </button>
                            </div>
                            <div class="col-12 col-sm-6 text-sm-right">
                                <a href="{{ route('user-lost-password-page') }}">
                                    <span class="fas fa-key"></span>
                                    Passwort vergessen?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
