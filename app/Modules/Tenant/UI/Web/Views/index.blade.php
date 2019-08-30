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

@stop
