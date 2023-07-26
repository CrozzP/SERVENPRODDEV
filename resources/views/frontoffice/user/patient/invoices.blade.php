@extends('theme.frontoffice.layouts.admin')

@section('title','Mis facturas')

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
								<th>Concepto</th>
								<th>Monto</th>
								<th>Estado</th>
								<th>Accion</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th>1</th>
								<th>Consulta con el Dr. Jorge</th>
								<th>400 S/.</th>
								<th>Pagado</th>
								
								<th><a href="#" onclick="Mostrar(1);" data-toggle="modal" data-target="#modal" class="btn btn-success btn-xs">Ver2</a></th>

								
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				Titulo
			</div>
			<div class="modal-body">
				<div id='message-error'  class="alert alert-danger danger" role='alert' style="display: none">
		          <strong id="error"></strong>
		        </div>

				Conternido

				
			</div>
			<div class="modal-footer">
				
				
			</div>
		</div>
	</div>
</div>
@endsection

@section('foot')
	<script type="text/javascript">
	function Mostrar(id){
		$('.modal').modal();
		
	}

	</script>
@endsection
