@php use psnXT\Modules\Navigation\Models\Item; @endphp
@extends('layouts.panel')
@section('pagetitle')
    Navigation &raquo; Element {{ isset($item) ? 'bearbeiten' : 'erstellen' }}
@stop
@section('pagecss')
<style>
.icon-item.selected { background:#dedede; border-radius:4px; }
.icon-item:hover { cursor:pointer; background:#dedede; border-radius:4px; }
</style>
@stop
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title' => 'Navigation',
                'href'  => route('navigation-index'),
            ],
            [
                'title'  => 'Element ' . (isset($item) ? 'bearbeiten' : 'erstellen'),
                'active' => true,
            ]
        ]
    ])
@stop
@section('content')
<div class="card card-default shadow">
    <div class="card-body">
        @include('partials.messages')
        <form action="{{ route(isset($item) ? 'navigation-update' : 'navigation-store') }}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="hidden" name="icon" id="icon" value="{{ old('icon', isset($item) ? $item->icon : '') }}">
            @isset($item)
            <input type="hidden" name="uuid" id="uuid" value="{{ $item->uuid }}">
            @endisset
            <div class="form-row align-items-end">
                <div class="col-12 col-md-5">
                    <label class="col-form-label required" for="title">Text für Navigationspunkt</label>
                    <div class="input-group shadow">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary btn-block" type="button" data-target="#modal-icons" data-toggle="modal">
                                {!! isset($item) ? '<span class="' . $item->icon . '"></span>' : 'Icon' !!}
                            </button>
                        </div>
                        <input name="title" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', isset($item) ? $item->title : '') }}">
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <label class="col-form-label required" for="href">URL</label>
                    <select name="href" id="href" class="custom-select form-control shadow">
                        <option value="">&mdash; Leer &mdash;</option>
                        @foreach($routes as $route)
                        <option value="{{ env('APP_URL') . '/' . $route->uri }}"{{ isset($item) && $item->href == env('APP_URL') . '/' . $route->uri ? ' selected' : '' }}>
                            {{ env('APP_URL') . '/' . $route->uri }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-2">
                    <button class="btn btn-primary">
                        <span class="fas fa-save"></span> Speichern
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-icons">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <input name="icon-search" id="icon-search" class="form-control" placeholder="Suche">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach(config('setting.icons') as $class => $unicode)
                    <div class="col-6 col-lg-4 py-2 icon-item text-center{{ isset($item) && $item->icon == $class ? ' selected' : '' }}" data-icon="{{ $class }}">
                        <span class="fa-2x fa-fw {{ $class }}"></span><br>
                        {{ $class }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('pagejs')
<script>
    $('.icon-item').on('click', function() {
        var $this = $(this);
        var $icon = $this.data('icon');

        $('.icon-item').removeClass('selected');
        $this.addClass('selected');

        $('#icon').val($icon);
        $('[data-target="#modal-icons"]').html('').append($('<span>', {
            'class': $icon
        }));

        $('#modal-icons').modal('hide');
    });

    $('#icon-search').on('keyup', function() {
        var $searchQuery = $(this).val();

        if($searchQuery.length > 0) {
            $('.icon-item:not([data-icon*="' + $searchQuery + '"])').hide();
            $('.icon-item[data-icon*="' + $searchQuery + '"]').show();
        } else {
            $('.icon-item').show();
        }
    });

    $('#modal-icons').on('shown.bs.modal', function() {
        $('#icon-search').focus();
    });
</script>
@stop
