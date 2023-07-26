@extends('layouts.theme.layouts.admin')

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
@include('layouts.theme.layouts.includes.breadcrumbs')
<div class="card-body">
                  <fullcalendar-component></fullcalendar-component>
                </div>
@endsection

@section('foot')

@endsection
