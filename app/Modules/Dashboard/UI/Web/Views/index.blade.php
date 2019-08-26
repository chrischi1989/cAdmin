@extends('layouts.panel')
@section('content')
    <form action="{{ route('user-logout') }}" enctype="multipart/form-data" method="post">
        @csrf
        <button class="btn btn-primary">Abmelden</button>
    </form>
@stop
