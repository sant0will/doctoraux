@extends('adminlte::page')

@section('title')

@section('content_header')
<p class="header-title">Dashboard</p>
@stop

@section('content')
    @if(session()->has('success'))
        @if(session()->get('success'))
            <div class="callout callout-success">
                {{ session()->get('success') }}
            </div>
        @endif
        @elseif(session()->has('error'))
        @if(session()->get('error')) 
            <div class="callout callout-danger">
                {{ session()->get('error') }}
            </div>
        @endif
    @endif
    <p>{{Auth::user()}}</p>
    <a href="/profiles">tamo ai</a>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop