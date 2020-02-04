@php use Modules\Setting\Models\Setting @endphp
@extends('layouts.panel')
@section('pagetitle') Einstellungen @stop
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title'  => 'Einstellungen',
                'active' => true
            ]
        ]
    ])
@stop
@section('content')
@include('partials.messages')
<div class="row">
    @include('partials.panel.item-create-button', [
        'item' => Setting::class,
        'section' => 'setting',
        'text' => 'Einstellung erstellen'
    ])
</div>
<div class="card card-default shadow">
    <div class="card-body">
        <div class="form-row">
            <div class="col-12 col-lg-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab">
                    <a class="nav-link active" id="settings-common-tab" data-toggle="pill" href="#settings-common">Allgemein</a>
                    <a class="nav-link" id="settings-user-tab" data-toggle="pill" href="#settings-user">Benutzer</a>
                    <a class="nav-link" id="settings-media-tab" data-toggle="pill" href="#settings-media">Medien</a>
                </div>
            </div>
            <div class="col-12 col-lg-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="settings-common">
                        <div class="form-row">
                            <div class="col-12 col-md-6">
                                <label class="col-form-label required" for="env[APP_NAME]">Name der Anwendung</label>
                                <input type="text"
                                       name="env[APP_NAME]"
                                       id="env[APP_NAME]"
                                       class="form-control{{ $errors->has('env.APP_NAME') ? ' is-invalid' : ''}}"
                                       value="{{ old('env.APP_NAME', env('APP_NAME')) }}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="col-form-label required" for="env[APP_CUSTOMER]">Name des Mandanten:</label>
                                <input id="env[APP_CUSTOMER]"
                                       name="env[APP_CUSTOMER]"
                                       class="form-control{{ $errors->has('env.APP_CUSTOMER') ? ' is-invalid' : ''}}"
                                       value="{{ old('env.APP_CUSTOMER', env('APP_CUSTOMER')) }}">
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="col-form-label required" for="env[APP_URL]">Vollständige URL der Installation:</label>
                                <div class="input-group">
                                    <input id="env[APP_URL]"
                                           name="env[APP_URL]"
                                           class="form-control{{ $errors->has('env.APP_URL') ? ' is-invalid' : '' }}"
                                           value="{{ old('env.APP_URL', env('APP_URL')) }}">
                                    <div class="input-group-append">
                                        <label class="input-group-text pl-4">
                                            <input class="form-check-input" type="checkbox" value="1" name="env[APP_DEBUG]" id="env[APP_DEBUG]"{{ old('env.APP_DEBUG', env('APP_DEBUG')) ? ' checked' : '' }}> Debugmodus?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="col-form-label required">Logo des Mandanten:</label>
                                <div class="custom-file">
                                    <input type="file"
                                           name="env[APP_CUSTOMER_BRANDING]"
                                           id="env[APP_CUSTOMER_BRANDING]"
                                           lang="de"
                                           class="form-control custom-file-input{{ $errors->has('env.APP_CUSTOMER_BRANDING') ? ' is-invalid' : '' }}">
                                    <label class="custom-file-label" for="env[APP_CUSTOMER_BRANDING]">Datei auswählen</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="col-form-label required" for="env[APP_SUPPORT]">Empfängeradresse für Supportanfragen</label>
                                <input type="text"
                                       name="env[APP_SUPPORT]"
                                       id="env[APP_SUPPORT]"
                                       class="form-control{{ $errors->has('env.APP_SUPPORT') ? ' is-invalid' : '' }}"
                                       value="{{ old('env.APP_SUPPORT', env('APP_SUPPORT')) }}">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="settings-user">
                        Benutzer
                    </div>
                    <div class="tab-pane fade" id="settings-media">
                        Medien
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop