@extends('layouts.panel')
@section('pagetitle') Module @stop
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title'  => 'Module',
                'active' => true
            ]
        ]
    ])
@stop
@section('content')
@include('partials.messages')
<div class="card card-default card-table shadow my-3">
    <div class="card-header d-none d-lg-block">
        <div class="row justify-content-between">
            <div class="col-1">
                <div class="custom-control custom-checkbox">
                    <input id="user-all" class="custom-control-input js-select-all" type="checkbox">
                    <label for="user-all" class="custom-control-label">&nbsp;</label>
                </div>
            </div>
            <div class="col-2 text-right">
                <form enctype="multipart/form-data" method="post">
                    <input type="hidden" name="uuids" value="">
                    <div class="btn-group dropleft">
                        <button type="button" class="btn btn-default disabled dropdown-toggle js-bulk-actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fas fa-play"></span>
                        </button>
                        <div class="dropdown-menu">
                            <div class="dropdown-item">
                                <button class="btn btn-transparent btn-block text-left">
                                    <span class="far fa-trash-alt"></span> Deinstallieren
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <ul class="table">
            <li class="row head d-none d-lg-flex">
                <div class="col-lg-9 offset-lg-1">Installiert</div>
            </li>
            @foreach($installedModules as $module)
            <li class="row" data-uuid="{{ $module->uuid }}">
                <div class="col-12 col-lg-1">
                    <div class="custom-control custom-checkbox">
                        <input id="module-{{ $module->id }}" class="custom-control-input js-select-item" type="checkbox">
                        <label for="module-{{ $module->id }}" class="custom-control-label">&nbsp;</label>
                    </div>
                </div>
                <div class="col-12 col-lg-9" data-title="Modul:">{{ $module->public_name }}</div>
                <div class="col-12 col-lg-2" data-title="Optionen:">
                    @include('partials.panel.item-options', [
                        'section' => 'module',
                        'item' => $module,
                        'deleteMessage' => 'Wollen Sie dieses Modul wirklich löschen?'
                    ])
                </div>
            </li>
            @endforeach
            <li class="row head d-none d-lg-flex">
                <div class="col-lg-9 offset-lg-1">Verfügbar</div>
            </li>
            @foreach($availableModules as $module)
            <li class="row">
                <div class="col-12 col-lg-1">
                    <div class="custom-control custom-checkbox">
                        <input id="module-{{ Str::slug($module['name']) }}" class="custom-control-input js-select-item" type="checkbox">
                        <label for="module-{{ Str::slug($module['name']) }}" class="custom-control-label">&nbsp;</label>
                    </div>
                </div>
                <div class="col-12 col-lg-9" data-title="Modul:">{{ $module['name'] }}</div>
                <div class="col-12 col-lg-2" data-title="Optionen:">

                </div>
            </li>
            @if(!is_null($module['modules']))
            @foreach($module['modules'] as $module)
            <li class="row">
                <div class="col-12 col-lg-1">
                    <div class="custom-control custom-checkbox">
                        <input id="module-{{ Str::slug($module['name']) }}" class="custom-control-input js-select-item" type="checkbox">
                        <label for="module-{{ Str::slug($module['name']) }}" class="custom-control-label">&nbsp;</label>
                    </div>
                </div>
                <div class="col-12 col-lg-8 offset-lg-1" data-title="Modul:">{{ $module['name'] }}</div>
                <div class="col-12 col-lg-2" data-title="Optionen:">

                </div>
            </li>
            @endforeach
            @endif
            @endforeach
        </ul>
    </div>
</div>
@stop