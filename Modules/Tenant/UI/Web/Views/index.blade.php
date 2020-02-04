@php use Modules\Tenant\Models\Tenant; @endphp
@extends('layouts.panel')
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title'  => 'Mandanten',
                'icon'   => 'far fa-building',
                'active' => true,
            ]
        ]
    ])
@stop
@section('content')
@include('partials.messages')
<div class="row">
    @include('partials.panel.item-create-button', [
        'item' => Tenant::class,
        'section' => 'tenant',
        'text' => 'Mandant erstellen'
    ])
</div>
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
                                <button class="btn btn-transparent btn-block text-left" formaction="">
                                    <span class="far fa-trash-alt"></span> Löschen
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
                <div class="col-lg-5 offset-lg-1">Mandant</div>
                <div class="col-lg-2 text-lg-center">Benutzer</div>
                <div class="col-lg-2 text-lg-center">Datenbank</div>
            </li>
            @forelse($tenants as $tenant)
            <li class="row" data-uuid="{{ $tenant->uuid }}">
                <div class="col-12 col-lg-1">
                    <div class="custom-control custom-checkbox">
                        <input id="tenant-{{ $tenant->id }}" class="custom-control-input js-select-item" type="checkbox">
                        <label for="tenant-{{ $tenant->id }}" class="custom-control-label">&nbsp;</label>
                    </div>
                </div>
                <div class="col-12 col-lg-5" data-title="Mandant:">{{ $tenant->tenant }}</div>
                <div class="col-12 col-lg-2 text-lg-center" data-title="Benutzer:">{{ $tenant->user_quota }}</div>
                <div class="col-12 col-lg-2 text-lg-center" data-title="Datenbank:">
                    @if($tenant->database->schema_created)
                    <button type="button" class="btn btn-transparent" data-toggle="tooltip" title="Datenbank ist bereits migriert">
                        <span class="fas fa-check"></span>
                    </button>
                    @else
                    <form action="{{ route('tenant-database') }}" enctype="multipart/form-data" method="post">
                        @csrf
                        <input type="hidden" name="uuid" value="{{ $tenant->database->uuid }}">
                        <button class="btn btn-transparent" data-toggle="tooltip" title="Datenbank migrieren">
                            <span class="fas fa-level-up-alt"></span>
                        </button>
                    </form>
                    @endif
                </div>
                <div class="col-12 col-lg-2" data-title="Optionen:">
                    @include('partials.panel.item-options', [
                        'section' => 'tenant',
                        'item' => $tenant,
                        'deleteMessage' => 'Wollen Sie diesen Mandanten wirklich löschen?'
                    ])
                </div>
            </li>
            @empty
            <li class="row">
                <div class="col-12 text-center p-3">
                    Es sind keine Mandanten in der Datenbank vorhanden
                </div>
            </li>
            @endforelse
        </ul>
    </div>
</div>
<div class="row">
    @include('partials.panel.item-create-button', [
        'item' => Tenant::class,
        'section' => 'tenant',
        'text' => 'Mandant erstellen'
    ])
</div>
@stop
