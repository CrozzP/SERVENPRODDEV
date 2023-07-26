@extends('layouts.theme.layouts.admin')

@section('title','Asignar roles')

@section('head')

@endsection

@section('titulo_breadcrumbs')
Asignar roles
@endsection

@section('breadcrumbs')
	<li class="separator">
		<i class="flaticon-right-arrow"></i>
	</li>
	<li><a href="{{ route('user.index') }}">Usuarios del sistema</a></li>
	<li class="separator">
		<i class="flaticon-right-arrow"></i>
	</li>
	<li><a href="{{ route('user.show',$user) }}">{{ $user->name}}</a></li>
	<li class="separator">
		<i class="flaticon-right-arrow"></i>
	</li>
	<li>Asignar roles</li>
@endsection

@section('dropdown_settings')
 
 	
@endsection

@section('content')

@include('layouts.theme.layouts.includes.breadcrumbs')
  
<div class="row">

	<div class="col-md-8  ml-auto mr-auto">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Asignar roles</div><h3>Selecciona los roles que desea asignar</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<form class="col-md-12 col-lg-12" method="post" action="{{ route('user.role_assignment',$user) }}">
						{{ csrf_field() }}

						@foreach($roles as $role)

						<p>
							
							<input type="checkbox" name="roles[]" id="{{ $role->id }}" value="{{ $role->id}}" @if($user->has_role($role->id)) checked @endif />
							<label for="{{ $role->id}}">
								<span>{{ $role->roleName}}</span>
							</label>

						</p>
						@endforeach
						

						<button type="submit" class="btn btn-primary">Crear</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4  ml-auto mr-auto">
		@include('admin.user.includes.user_nav')
		
	</div>
</div>





@endsection

@section('foot')

@endsection
