@php use psnXT\Modules\User\Models\User @endphp
@extends('layouts.panel')
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title'  => 'Benutzer',
                'active' => true
            ]
        ]
    ])
@stop
@section('content')
@include('partials.messages')
<div class="row">
    @can('create', User::class)
    <div class="col-6 text-right ml-lg-auto">
        <a href="{{ route('user-create') }}" class="btn btn-primary">
            <span class="fas fa-plus"></span> Benutzer erstellen
        </a>
    </div>
    @endcan
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
                                <button class="btn btn-transparent btn-block text-left">
                                    <span class="fas fa-power-off"></span> Deaktivieren
                                </button>
                            </div>
                            <div class="dropdown-item">
                                <button class="btn btn-transparent btn-block text-left">
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
                <div class="col-lg-5 offset-lg-1">Benutzername</div>
                <div class="col-lg-4">Mandant</div>
            </li>
            @foreach($users as $user)
            <li class="row" data-uuid="{{ $user->uuid }}">
                <div class="col-12 col-lg-1">
                    <div class="custom-control custom-checkbox">
                        <input id="user-1" class="custom-control-input js-select-item" type="checkbox">
                        <label for="user-1" class="custom-control-label">&nbsp;</label>
                    </div>
                </div>
                <div class="col-12 col-lg-5" data-title="Benutzername:">{{ $user->email_encrypted }}</div>
                <div class="col-12 col-lg-4" data-title="Mandant:">{{ $user->tenant->tenant ?? 'Kein' }}</div>
                <div class="col-12 col-lg-2" data-title="Optionen:">
                    <form action="{{ route('user-destroy') }}" enctype="multipart/form-data" method="post" class="form-inline justify-content-end options">
                        @csrf
                        <input id="uuid" name="uuid" value="{{ $user->uuid }}" type="hidden">
                        <div class="form-row align-items-center">
                            <div class="dropdown" data-toggle="tooltip" title="Informationen">
                                <button class="btn btn-transparent" data-toggle="dropdown">
                                    <span class="fas fa-info-circle"></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item">
                                        <div>
                                            <strong>Erstellt:</strong> {{ $user->created_at->format('d.m.Y - H:i') }} Uhr<br>
                                            <strong>von:</strong> {{ is_null($user->createdBy) ? 'Installation' : $user->createdBy->email_encrypted }}
                                        </div>
                                        <div>
                                            <strong>Bearbeitet:</strong> {{ $user->updated_at->format('d.m.Y - H:i') }} Uhr<br>
                                            <strong>von:</strong> {{ is_null($user->createdBy) ? 'Installation' : $user->createdBy->email_encrypted }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('edit', $user)
                            <a href="{{ route('user-edit', ['uuid' => $user->uuid]) }}" class="btn btn-transparent" data-toggle="tooltip" data-title="Bearbeiten">
                                <span class="far fa-edit"></span>
                            </a>
                            @endcan
                            @can('destroy', $user)
                            <button class="btn btn-transparent delete" data-toggle="tooltip" data-title="Löschen" data-message="Wollen Sie diesen Benutzer wirklich löschen?">
                                <span class="far fa-trash-alt"></span>
                            </button>
                            @endcan
                        </div>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row">
    @can('create', User::class)
        <div class="col-6 text-right ml-lg-auto">
            <a href="{{ route('user-create') }}" class="btn btn-primary">
                <span class="fas fa-plus"></span> Benutzer erstellen
            </a>
        </div>
    @endcan
</div>
@stop
