@extends('layouts.panel')
@section('pagetitle') Benutzer &raquo; Benutzer {{ isset($user) ? 'bearbeiten' : 'erstellen' }} @stop
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.multiselect.min.css') }}">
@stop
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title' => 'Benutzer',
                'href'  => route('user-index'),
            ],
            [
                'title'  => 'Benutzer ' . (isset($user) ? 'bearbeiten' : 'erstellen'),
                'active' => true,
            ]
        ]
    ])
@stop
@section('content')
@include('partials.messages')
<div class="card card-default shadow">
    <div class="card-body">
        <form action="{{ route(isset($user) ? 'user-update' : 'user-store') }}" enctype="multipart/form-data" method="post">
            @csrf
            {!! isset($user) ? '<input type="hidden" name="uuid" id="uuid" value="' . $user->uuid . '">' : '' !!}
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-row">
                        <div class="col-12{{ !is_null($tenants) ? ' col-lg-6' : null }}">
                            <label for="email" class="col-form-label required">E-Mail Adresse</label>
                            <input name="email"
                                   id="email"
                                   class="form-control shadow{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                   placeholder="info@test.loc"
                                   value="{{ old('email', $user->email_encrypted ?? null) }}">
                        </div>
                        @if(!is_null($tenants))
                        <div class="col-12 col-lg-6">
                            <label for="tenant" class="col-form-label">Mandant</label>
                            <select name="tenant" id="tenant" class="form-control shadow custom-select">
                                <option value="">&mdash; Kein &mdash;</option>
                                @foreach($tenants as $tenant)
                                    <option value="{{ $tenant->uuid }}"{{ isset($user) && $user->tenant_uuid == $tenant->uuid ? ' selected' : '' }}>{{ $tenant->tenant }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-12 col-lg-6">
                            <label for="password" class="col-form-label required">Passwort</label>
                            <div class="input-group shadow">
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}">
                                <div class="input-group-append">
                                    <button type="button" name="pw-generate" class="btn btn-primary">
                                        <span class="fas fa-sync"></span>
                                    </button>
                                    <button type="button" name="pw-show" class="btn btn-primary">
                                        <span class="fas fa-eye"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="password_confirmation" class="col-form-label required">Passwort bestätigen</label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   class="form-control shadow">
                        </div>
                        @if(!isset($user) || $user->uuid == $currentUser->uuid || $currentUser->priority >= $user->accesslayer->max('priority'))
                        <div class="col-12 mt-2">
                            <select id="pre-selected-options" multiple="multiple" name="accesslayer[]">
                                @foreach($accesslayer as $layer)
                                <option value="{{ $layer->uuid }}"{{ (!is_null(old('accesslayer')) && in_array($layer->uuid, old('accesslayer'))) || (isset($user) && $user->accesslayer->contains('uuid', $layer->uuid)) ? ' selected' : '' }}>{{ $layer->layer }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        <div class="col-6 mt-3">
                            <label for="password_expires_days" class="col-form-label">Ablaufzeit des Passwortes (Tage)</label>
                            <input name="password_expires_days"
                                   id="password_expires_days"
                                   class="form-control shadow"
                                   value="{{ old('password_expires_days', $user->password_expires_days ?? config('User.password_expires')->setting_value) }}"
                                {{ isset($user) && !$user->password_expires ? ' disabled' : '' }}>
                        </div>
                        <div class="col-6 mt-3">
                            <label for="failed_logins_max" class="col-form-label">Anmeldeversuche vor Sperrung</label>
                            <input name="failed_logins_max"
                                   id="failed_logins_max"
                                   class="form-control shadow"
                                   value="{{ old('failed_logins_max', $user->failed_logins_max ?? config('User.failed_logins_max')->setting_value) }}">
                        </div>
                        <div class="col-12 mt-3">
                            <div class="d-flex no-block align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="password_expires" name="password_expires"{{ isset($user) ? ($user->password_expires ? ' checked' : '') : ' checked' }}>
                                    <label class="custom-control-label" for="password_expires">Passwort läuft ab</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex no-block align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="disabled" name="disabled"{{ isset($user) ? (!is_null($user->deactivated_at) ? ' checked' : '') : ' checked' }}>
                                    <label class="custom-control-label" for="disabled">Zugang gesperrt</label>
                                </div>
                            </div>
                        </div>
                        @empty($user)
                        <div class="col-12">
                            <div class="d-flex no-block align-items-center">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="senddata" name="senddata">
                                    <label class="custom-control-label" for="senddata">Zugangsdaten bei Erstellen versenden</label>
                                </div>
                            </div>
                        </div>
                        @endisset
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-row">
                        <div class="col-6">
                            <label for="salutation" class="col-form-label required">Anrede</label>
                            <select name="salutation" id="salutation" class="custom-select form-control shadow{{ $errors->has('salutation') ? ' is-invalid' : '' }}">
                                <option value="">&mdash; Auswahl &mdash;</option>
                                <option value="Frau"{{ old('salutation', $user->profile->salutation ?? null) == 'Frau' ? ' selected' : '' }}>Frau</option>
                                <option value="Herr"{{ old('salutation', $user->profile->salutation ?? null) == 'Herr' ? ' selected' : '' }}>Herr</option>
                                <option value="Divers"{{ old('salutation', $user->profile->salutation ?? null) == 'Divers' ? ' selected' : '' }}>Divers</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="title" class="col-form-label">Titel</label>
                            <input name="title" id="title" class="form-control shadow" placeholder="Prof. Dr." value="{{ old('title', $user->profile->title ?? null) }}">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="firstname" class="col-form-label required">Vorname</label>
                            <input name="firstname"
                                   id="firstname"
                                   class="form-control shadow{{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                                   placeholder="Max"
                                   value="{{ old('firstname', $user->profile->firstname ?? null) }}">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="lastname" class="col-form-label required">Nachname</label>
                            <input name="lastname"
                                   id="lastname"
                                   class="form-control shadow{{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                                   placeholder="Mustermann"
                                   value="{{ old('lastname', $user->profile->lastname ?? null) }}">
                        </div>
                        <div class="col-8">
                            <label for="street" class="col-form-label">Straße</label>
                            <input name="street" id="street" class="form-control shadow" placeholder="Feldweg" value="{{ old('street', $user->profile->street ?? null) }}">
                        </div>
                        <div class="col-4">
                            <label for="housenumber" class="col-form-label">Hausnummer</label>
                            <input name="housenumber" id="housenumber" class="form-control shadow" placeholder="123" value="{{ old('housenumber', $user->profile->housenumber ?? null) }}">
                        </div>
                        <div class="col-4">
                            <label for="postalcode" class="col-form-label">Postleitzahl</label>
                            <input name="postalcode" id="postalcode" class="form-control shadow" placeholder="12345" value="{{ old('postalcode', $user->profile->postalcode ?? null) }}">
                        </div>
                        <div class="col-8">
                            <label for="location" class="col-form-label">Ort</label>
                            <input name="location" id="location" class="form-control shadow" placeholder="Hintermwald" value="{{ old('location', $user->profile->location ?? null) }}">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="telephone" class="col-form-label">Telefon</label>
                            <input name="telephone" id="telephone" class="form-control shadow" placeholder="0123 456789" value="{{ old('telephone', $user->profile->telephone ?? null) }}">
                        </div>
                        <div class="col-12 col-lg-6">
                            <label for="cellphone" class="col-form-label">Mobil</label>
                            <input name="cellphone" id="cellphone" class="form-control shadow" placeholder="0123 456789" value="{{ old('cellphone', $user->profile->cellphone ?? null) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row mt-5">
                <div class="col-12">
                    <button class="btn btn-primary"><span class="fas fa-save"></span> Speichern</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
@section('pagejs')
<script src="{{ asset('js/jquery.multiselect.min.js') }}"></script>
<script>
    $('#pre-selected-options').multiSelect({
        selectableHeader: '<label class="col-form-label">Zugriffsebenen</label>',
        selectionHeader: '<label class="col-form-label">Ausgewählt</label>',
    });

    $('button[name="pw-generate"]').on('click', function() {
        $.getJSON('{{ route('user-generate-password') }}', function($response) {
            $('#password').val($response.password);
            $('#password_confirmation').val($response.password);
        });
    });

    $('button[name="pw-show"]').on('click', function() {
        $('#password').attr('type',  $('#password').attr('type') === 'password' ? 'text' : 'password');
        $('#password_confirmation').attr('type',  $('#password_confirmation').attr('type') === 'password' ? 'text' : 'password');
    });

    $('#password_expires').on('click', function() {
        !$(this).is(':checked') ? $('#password_expires_days').attr('disabled', 'disabled') : $('#password_expires_days').removeAttr('disabled');
    })
</script>
@stop
