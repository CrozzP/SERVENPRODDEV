


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
<div class="container">
    <div class="row justify-content-center">
         
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Laravelm Vue Js Live Search</div>
                     
                <div class="card-body">
                  <search-component></search-component>
                </div>
                 
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot')

@endsection
