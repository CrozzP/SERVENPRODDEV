@extends('theme.frontoffice.layouts.admin')

@section('title','Perfil de '. $user->name )

@section('head')

@endsection

@section('titulo_breadcrumbs')
frontoffice
@endsection
@section('breadcrumbs')

@endsection

@section('dropdown_setting')

@endsection

@section('content')
@include('theme.frontoffice.layouts.includes.breadcrumbs')
<h1>hoolita</h1>

<div class="container">
	<div class="row row row-demo-grid">

		@include('theme.frontoffice.user.includes.nav')

		<div class="col-md-8 ml-auto mr-auto">
			<div class="card text">
				<div class="card-header">
					<h5 class="card-title">@yield('title')</h5>
				</div>
				<div class="card-body">
					

					<p><strong>Nombre: </strong>{{ $user->name }}</p>
					<p><strong>Edad: </strong>{{ $user->age() }}</p>
					<p><strong>Email: </strong>{{ $user->email }}</p>
					<p><strong>Miembro desde: </strong>{{ $user->created_at->diffForHumans() }}</p>
					
				</div>
				<div class="card-footer text-muted">
					2 days ago
				</div>
			</div>
		</div>

	</div>
</div>


@endsection

@section('foot')

@endsection
