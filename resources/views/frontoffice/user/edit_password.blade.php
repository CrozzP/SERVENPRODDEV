@extends('theme.frontoffice.layouts.admin')

@section('title','Editar contraseña')

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
					<div class="row">
					<form class="col-md-12 col-lg-12" method="post" action="{{ route('frontoffice.user.change_password') }}">

						{{ csrf_field() }}
						{{ method_field('PUT') }}



						<div class="form-group form-floating-label">
							<input id="old_password" type="password" class="form-control input-border-bottom" name="old_password">
							<label for="old_password" class="placeholder">Contraseña actual</label>
							  @error('old_password')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
						<div class="form-group form-floating-label">
							<input id="password" type="password" class="form-control input-border-bottom" name="password" >
							<label for="password" class="placeholder">Nueva contraseña</label>
							  @error('password')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
						<div class="form-group form-floating-label">
							<input id="password-confirm" type="password" class="form-control input-border-bottom" name="password_confirmation">
							<label for="password-confirm" class="placeholder">Confirmar contraseña</label>
							  @error('password-confirm')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>

						

						


						


						<button type="submit" class="btn btn-primary">Actualizar</button>
					</form>
				</div>

					
					
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
