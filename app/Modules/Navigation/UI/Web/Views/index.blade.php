@php use psnXT\Modules\Navigation\Models\Item; @endphp
@extends('layouts.panel')
@section('pagetitle') Navigation @stop
@section('pagecss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.nestable.min.css') }}">
@stop
@section('breadcrumb')
    @include('partials.panel.breadcrumb', [
        'items' => [
            [
                'title'  => 'Navigation',
                'active' => true,
            ]
        ]
    ])
@stop
@section('content')
@include('partials.messages')
<div class="row">
    @can('create', Item::class)
    <div class="col-6 text-right ml-lg-auto">
        <a href="{{ route('navigation-create') }}" class="btn btn-primary">
            <span class="fas fa-plus"></span> Element erstellen
        </a>
    </div>
    @endcan
</div>
<div class="card card-default shadow my-3">
    <div class="card-body">
        <div class="dd" id="menu">
            <ol class="dd-list">
            @each('navigation::partials.navigation-item', $navigationsItems, 'item')
            </ol>
        </div>
    </div>
</div>
<div class="row">
    @can('create', Item::class)
    <div class="col-6 text-right ml-lg-auto">
        <a href="{{ route('navigation-create') }}" class="btn btn-primary">
            <span class="fas fa-plus"></span> Element erstellen
        </a>
    </div>
    @endcan
</div>
@stop
@section('pagejs')
<script src="{{ asset('js/jquery.nestable.min.js') }}"></script>
<script>
    $('#menu').nestable({
        'group': 1
    }).on('change', function() {
        var $data = {'data' : $(this).nestable('serialize')};

        $.post('{{ route('navigation-sort') }}', $data, function($response) { }, 'json');
    });
</script>
@stop
