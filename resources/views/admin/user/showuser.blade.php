@extends('layouts.theme.layouts.admin')

@section('title',$user->name)

@section('head')

@endsection

@section('titulo_breadcrumbs')
{{ $user->name}}
@endsection

@section('breadcrumbs')
	<li class="separator">
		<i class="flaticon-right-arrow"></i>
	</li>
	<li><a href="">Usuarios del sistema</a></li>
	<li class="separator">
		<i class="flaticon-right-arrow"></i>
	</li>

	<li>{{ $user->name}}</li>
@endsection

@section('dropdown_settings')
 
<a class="dropdown-item" href="">Editar Usuario</a>
 	
@endsection


@section('content')

@include('layouts.theme.layouts.includes.breadcrumbs')

<div class="row">


	<div class="col-md-8  ml-auto mr-auto">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Usuario: {{ $user->name}}</div>
			</div>
			<div class="card-body">
				<div class="row">
					<p><strong>Edad:</strong> {{ $user->created_at }}</p>
				</div>
			</div>
			<div class="card-footer text-muted">
				<a href=" " class="card-link">Editar</a>
				<a href="#" style="color: red" onclick="enviar_formulario()" class="card-link">Eliminar</a>
			</div>
		</div>
	</div>
	<div class="col-md-4  ml-auto mr-auto">
		@include('admin.user.includes.user_nav')
	</div>
</div>



<form method="post" action="" name="delete_form">
	{{ csrf_field() }}
	{{ method_field('DELETE') }}
</form>
@endsection

@section('foot')

	<script>
		function enviar_formulario(){
		const swalWithBootstrapButtons = Swal.mixin({
		  customClass: {
		    confirmButton: 'btn btn-success',
		    cancelButton: 'btn btn-danger'
		  },
		  buttonsStyling: false
		})

		swalWithBootstrapButtons.fire({
		  title: '¿Deseas eliminar este usuario?',
		  text: "Esta accion no se puede deshacer!",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonText: 'Si, continuar!',
		  cancelButtonText: 'No, cancelar!',
		  reverseButtons: true
		}).then((result) => {
		  if (result.value) {
		  	document.delete_form.submit();
		    
		  } else if (
		    /* Read more about handling dismissals below */
		    result.dismiss === Swal.DismissReason.cancel
		  ) {
		    swalWithBootstrapButtons.fire(
		      'Cancelado!',
		      'Usted no elimino el usuario :)',
		      'error'
		    )
		  }
		})




		}



	</script>

@endsection



