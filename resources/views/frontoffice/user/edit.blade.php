@extends('theme.frontoffice.layouts.admin')

@section('title','Editar perfil')

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
					<form class="col-md-12 col-lg-12" method="post" action="{{ route('frontoffice.user.update',[$user, 'view=frontoffice']) }}">

						{{ csrf_field() }}
						{{ method_field('PUT') }}



						<div class="form-group form-floating-label">
							<input id="name" type="text" class="form-control input-border-bottom" name="name" value="{{ $user->name }}">
							<label for="name" class="placeholder">Nombre del usuario</label>
							  @error('name')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>

						<div class="form-group form-floating-label">
							<input id="dob" type="date" class="form-control input-border-bottom" name="dob" value="{{ $user->dob->format('Y-d-m') }}">
							<label for="dob" class="placeholder">Fecha de nacimiento</label>
							  @error('dob')
                                    <span class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>

						<div class="form-group form-floating-label">
							<input id="email" type="email" class="form-control input-border-bottom" name="email" value="{{ $user->email }}">
							<label for="email" class="placeholder">Correo electronico</label>
							  @error('email')
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
