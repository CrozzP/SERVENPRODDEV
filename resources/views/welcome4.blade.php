@extends('layouts.theme.layouts.admin')

@section('title','Panel de Administracion')

@section('head')

@endsection

@section('titulo_breadcrumbs')
Panel de Administracion
@endsection
@section('breadcrumbs')

    
@endsection

@section('dropdown_setting')

@endsection

@section('content')
@include('layouts.theme.layouts.includes.breadcrumbs')


<div id="app">
      <!--  {{--@if(Auth::check())}}
            <app-template :user="{{Auth::user()}}" :permission="{{Auth::user()->role->permission}}"></app-template>
        <h1>zs</h1>
        @else
            <app-template :user="false"></app-template>

        @endif--}}
        -->
        <app-template ></app-template>

    </div>
@endsection

@section('foot')

@endsection
