@extends('frontoffice.layouts.admin')

@section('title','para el titulo')

@section('head')

@endsection

@section('titulo_breadcrumbs')

@endsection
@section('breadcrumbs')

@endsection

@section('dropdown_setting')

@endsection

@section('content')
@include('frontoffice.layouts.includes.breadcrumbs')

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
