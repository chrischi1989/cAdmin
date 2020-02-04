@php use Modules\Accesslayer\Models\Layer @endphp
@extends('layouts.panel')
@section('pagetitle') Zugriffsebenen @stop
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title'  => 'Zugriffsebenen',
                'active' => true
            ]
        ]
    ])
@stop
@section('content')
@include('partials.messages')
<div class="row">
    @include('partials.panel.item-create-button', [
        'item' => Layer::class,
        'section' => 'accesslayer',
        'text' => 'Zugriffsebene erstellen'
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
                <div class="col-lg-5 offset-lg-1">Zugriffsebene</div>
                <div class="col-lg-4">Priorität</div>
            </li>
            @foreach($accesslayers as $layer)
            <li class="row" data-uuid="{{ $layer->uuid }}">
                <div class="col-12 col-lg-1">
                    <div class="custom-control custom-checkbox">
                        <input id="user-{{ $layer->id }}" class="custom-control-input js-select-item" type="checkbox">
                        <label for="user-{{ $layer->id }}" class="custom-control-label">&nbsp;</label>
                    </div>
                </div>
                <div class="col-12 col-lg-5" data-title="Zugriffsebene:">{{ $layer->layer }}</div>
                <div class="col-12 col-lg-4" data-title="Priorität:">{!! $layer->priority ?? '&mdash;' !!}</div>
                <div class="col-12 col-lg-2" data-title="Optionen:">
                    @include('partials.panel.item-options', [
                        'section' => 'accesslayer',
                        'item' => $layer,
                        'deleteMessage' => 'Wollen Sie diese Zugriffsebene wirklich löschen?'
                    ])
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="row">
    @include('partials.panel.item-create-button', [
        'item' => Layer::class,
        'section' => 'accesslayer',
        'text' => 'Zugriffsebene erstellen'
    ])
</div>
@stop