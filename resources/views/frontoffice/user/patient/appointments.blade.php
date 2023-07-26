@extends('theme.frontoffice.layouts.admin')

@section('title','Mis citas')

@section('head')

@endsection

@section('titulo_breadcrumbs')

@endsection
@section('breadcrumbs')

@endsection

@section('dropdown_setting')

@endsection

@section('content')
@include('theme.frontoffice.layouts.includes.breadcrumbs')
<h1>demo frontoffice</h1>




<div class="container">
	<div class="row row row-demo-grid">

		@include('theme.frontoffice.user.includes.nav')

		<div class="col-md-8 ml-auto mr-auto">
			<div class="card text">
				<div class="card-header">
					<h5 class="card-title">@yield('title')</h5>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Especialista</th>
								<th>Fecha</th>
								<th>Hora</th>
								<th>Estado</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>1</th>
								<th>especialista</th>
								<th>10-12-1999</th>
								<th>21:51:00</th>
								<th>normal</th>
							</tr>
						</tbody>
					</table>

					
					
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
