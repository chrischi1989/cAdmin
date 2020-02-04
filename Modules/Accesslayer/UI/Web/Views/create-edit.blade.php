@php
    /** @var \Modules\Accesslayer\Models\Layer $layer */
    $layerPermissions = isset($layer) ? $layer->permissions->pluck('uuid')->toArray() : [];
@endphp
@extends('layouts.panel')
@section('pagetitle') Zugriffsebenen &raquo; Zugriffsebene {{ isset($layer) ? 'bearbeiten' : 'erstellen' }} @stop
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title'  => 'Zugriffsebenen',
                'href'   => route('accesslayer-index')
            ],
            [
                'title'  => 'Zugrifssebene ' . (isset($layer) ? 'bearbeiten' : 'erstellen'),
                'active' => true,
            ]
        ]
    ])
@stop
@section('content')
@include('partials.messages')
<div class="card card-default shadow">
    <div class="card-body">
        <form action="{{ route(isset($layer) ? 'accesslayer-update' : 'accesslayer-store') }}" enctype="multipart/form-data" method="post">
            @csrf
            {!! isset($layer) ? '<input type="hidden" name="uuid" id="uuid" value="' . $layer->uuid . '">' : '' !!}
            <div class="form-row">
                <div class="col-6">
                    <label for="layer" class="col-form-label required">Zugriffsebene:</label>
                    <input name="layer"
                           id="layer"
                           class="form-control{{ $errors->has('layer') ? ' is-invalid' : ''}}"
                           value="{{ old('layer', isset($layer) ? $layer->layer : null) }}">
                </div>
                <div class="col-6">
                    <label for="priority" class="col-form-label required">Priorität:</label>
                    <input name="priority"
                           id="priority"
                           class="form-control{{ $errors->has('priority') ? ' is-invalid' : ''}}"
                           value="{{ old('priority', isset($layer) ? $layer->priority : 1) }}"
                           type="number">
                </div>
                <div class="col-12 mt-3">
                    <h3>Berechtigungen</h3>
                    <ul class="table">
                        <li class="row head">
                            <div class="col-12 col-sm-4">Modul</div>
                            <div class="col-3 col-sm-2 text-center">Zugriff</div>
                            <div class="col-3 col-sm-2 text-center">Erstellen</div>
                            <div class="col-3 col-sm-2 text-center">Bearbeiten</div>
                            <div class="col-3 col-sm-2 text-center">Löschen</div>
                        </li>
                        @foreach($modules as $module)
                        @if(!$module->permissions->isEmpty())
                        @php
                            $moduleTitle = !empty($module->public_name) ? $module->public_name : $module->module;
                            $moduleKey   = strtolower($module->module);
                            $show    = $module->permissions->where('permission', 'show')->first();
                            $create  = $module->permissions->where('permission', 'create')->first();
                            $edit    = $module->permissions->where('permission', 'edit')->first();
                            $destroy = $module->permissions->where('permission', 'destroy')->first();
                        @endphp

                        <li class="row">
                            <div class="col-12 col-sm-4">{{ $moduleTitle }}</div>
                            <div class="col-3 col-sm-2 text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           id="switch-{{ $show->uuid }}"
                                           name="permissions[{{ $moduleKey }}][]"
                                           value="{{ !is_null($show) ? $show->uuid : ''}}"
                                           class="custom-control-input"
                                            {{ in_array(!is_null($show) ? $show->uuid : null, old('permissions.' . $moduleKey, $layerPermissions)) ? ' checked' : '' }} />
                                    <label class="custom-control-label" for="switch-{{ $show->uuid }}"></label>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           id="switch-{{ $create->uuid }}"
                                           name="permissions[{{ $moduleKey }}][]"
                                           value="{{ !is_null($create) ? $create->uuid : ''}}"
                                           class="custom-control-input"
                                            {{ in_array(!is_null($create) ? $create->uuid : null, old('permissions.' . $moduleKey, $layerPermissions)) ? ' checked' : '' }} />
                                    <label class="custom-control-label" for="switch-{{ $create->uuid }}"></label>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           id="switch-{{ $edit->uuid }}"
                                           name="permissions[{{ $moduleKey }}][]"
                                           value="{{ !is_null($edit) ? $edit->uuid : ''}}"
                                           class="custom-control-input"
                                            {{ in_array(!is_null($edit) ? $edit->uuid : null, old('permissions.' . $moduleKey, $layerPermissions)) ? ' checked' : '' }} />
                                    <label class="custom-control-label" for="switch-{{ $edit->uuid }}"></label>
                                </div>
                            </div>
                            <div class="col-3 col-sm-2 text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox"
                                           id="switch-{{ $destroy->uuid }}"
                                           name="permissions[{{ $moduleKey }}][]"
                                           value="{{ !is_null($destroy) ? $destroy->uuid : ''}}"
                                           class="custom-control-input"
                                            {{ in_array(!is_null($destroy) ? $destroy->uuid : null, old('permissions.' . $moduleKey, $layerPermissions)) ? ' checked' : '' }} />
                                    <label class="custom-control-label" for="switch-{{ $destroy->uuid }}"></label>
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="form-row mt-3">
                <div class="col-12">
                    <button class="btn btn-primary">
                        <span class="fas fa-save"></span> Speichern
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop