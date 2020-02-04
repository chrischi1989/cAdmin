@php use Modules\Tenant\Models\Tenant; @endphp
@extends('layouts.panel')
@section('breadcrumb')
@include('partials.panel.breadcrumb', [
    'items' => [
        [
            'title' => 'Mandanten',
            'href'  => route('tenant-index'),
        ],
        [
            'title'  => 'Mandant ' . (isset($tenant) ? 'bearbeiten' : 'erstellen'),
            'active' => true,
        ]
    ]
])
@stop
@section('content')
@include('partials.messages')
<div class="card card-default shadow">
    <div class="card-body">
        <form action="{{ route(isset($tenant) ? 'tenant-update' : 'tenant-store') }}" enctype="multipart/form-data" method="post">
            @csrf
            {!! isset($tenant) ? '<input type="hidden" name="uuid" id="uuid" value="' . $tenant->uuid . '">' : '' !!}
            <div class="row">
                <div class="col-12 col-lg-6">
                    <label for="tenant" class="col-form-label required">Mandant</label>
                    <input name="tenant"
                           id="tenant"
                           class="form-control shadow{{ $errors->has('tenant') ? ' is-invalid' : '' }}"
                           placeholder="Mandant GmbH"
                           value="{{ old('tenant', $tenant->tenant ?? null) }}">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="user_quota" class="col-form-label required">max. Anzahl Benutzer</label>
                    <input name="user_quota"
                           id="user_quota"
                           class="form-control shadow{{ $errors->has('user_quota') ? ' is-invalid' : '' }}"
                           placeholder="10"
                           value="{{ old('user_quota', $tenant->user_quota ?? null) }}">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-4">
                    <label for="street" class="col-form-label">Straße</label>
                    <input name="street"
                           id="street"
                           class="form-control shadow{{ $errors->has('street') ? ' is-invalid' : '' }}"
                           placeholder="Mandantenstraße"
                           value="{{ old('street', $tenant->street ?? null) }}">
                </div>
                <div class="col-12 col-lg-2">
                    <label for="housenumber" class="col-form-label">HNr.</label>
                    <input name="housenumber"
                           id="housenumber"
                           class="form-control shadow{{ $errors->has('housenumber') ? ' is-invalid' : '' }}"
                           placeholder="12a"
                           value="{{ old('housenumber', $tenant->housenumber ?? null) }}">
                </div>
                <div class="col-12 col-lg-2">
                    <label for="postalcode" class="col-form-label">PLZ</label>
                    <input name="postalcode"
                           id="postalcode"
                           class="form-control shadow{{ $errors->has('postalcode') ? ' is-invalid' : '' }}"
                           placeholder="12345"
                           value="{{ old('postalcode', $tenant->postalcode ?? null) }}">
                </div>
                <div class="col-12 col-lg-4">
                    <label for="location" class="col-form-label">Ort</label>
                    <input name="location"
                           id="location"
                           class="form-control shadow{{ $errors->has('location') ? ' is-invalid' : '' }}"
                           placeholder="Hintermwalde"
                           value="{{ old('location', $tenant->location ?? null) }}">
                </div>
                <div class="col-12 col-lg-3">
                    <label for="email" class="col-form-label required">E-Mail Adresse</label>
                    <input name="email"
                           id="email"
                           class="form-control shadow{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           placeholder="info@mandant.gmbh"
                           value="{{ old('email', $tenant->email ?? null) }}">
                </div>
                <div class="col-12 col-lg-3">
                    <label for="telephone" class="col-form-label">Telefon</label>
                    <input name="telephone"
                           id="telephone"
                           class="form-control shadow{{ $errors->has('telephone') ? ' is-invalid' : '' }}"
                           placeholder="0123 456789"
                           value="{{ old('telephone', $tenant->telephone ?? null) }}">
                </div>
                <div class="col-12 col-lg-3">
                    <label for="mobile" class="col-form-label">Mobil</label>
                    <input name="mobile"
                           id="mobile"
                           class="form-control shadow{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                           placeholder="0123 456789"
                           value="{{ old('mobile', $tenant->mobile ?? null) }}">
                </div>
                <div class="col-12 col-lg-3">
                    <label for="website" class="col-form-label">Website</label>
                    <input name="website"
                           id="website"
                           class="form-control shadow{{ $errors->has('website') ? ' is-invalid' : '' }}"
                           placeholder="https://mandant.gmbh"
                           value="{{ old('website', $tenant->website ?? null) }}">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 col-lg-3">
                    <label for="connection" class="col-form-label required">Datenbank-Verbindung</label>
                    <input name="connection"
                           id="connection"
                           class="form-control shadow{{ $errors->has('connection') ? ' is-invalid' : '' }}"
                           placeholder="db_mandant_1"
                           value="{{ old('connection', $tenantDatabase->connection ?? null) }}">
                </div>
                <div class="col-12 col-lg-6">
                    <label for="hostname" class="col-form-label required">Datenbank-Hostname</label>
                    <input name="hostname"
                           id="hostname"
                           class="form-control shadow{{ $errors->has('hostname') ? ' is-invalid' : '' }}"
                           placeholder="localhost"
                           value="{{ old('hostname', $tenantDatabase->hostname ?? null) }}">
                </div>
                <div class="col-12 col-lg-3">
                    <label for="port" class="col-form-label required">Datenbank-Port</label>
                    <input name="port"
                           id="port"
                           class="form-control shadow{{ $errors->has('port') ? ' is-invalid' : '' }}"
                           placeholder="3306"
                           value="{{ old('port', $tenantDatabase->port ?? null) }}">
                </div>
                <div class="col-12 col-lg-4">
                    <label for="username" class="col-form-label required">Datenbank-Benutzername</label>
                    <input name="username"
                           id="username"
                           class="form-control shadow{{ $errors->has('username') ? ' is-invalid' : '' }}"
                           placeholder="web123"
                           value="{{ old('username', $tenantDatabase->username ?? null) }}">
                </div>
                <div class="col-12 col-lg-4">
                    <label for="password" class="col-form-label required">Datenbank-Passwort</label>
                    <input name="password"
                           id="password"
                           type="password"
                           class="form-control shadow{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           value="{{ old('password', $tenantDatabase->password ?? null) }}">
                </div>
                <div class="col-12 col-lg-4">
                    <label for="database" class="col-form-label required">Datenbank-Name</label>
                    <input name="database"
                           id="database"
                           placeholder="usr_web123_1"
                           class="form-control shadow{{ $errors->has('database') ? ' is-invalid' : '' }}"
                           value="{{ old('database', $tenantDatabase->database ?? null) }}">
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