@extends('layouts.theme.layouts.admin')

@section('title','Asignar Permisos')

@section('head')

@endsection

@section('titulo_breadcrumbs')
Asignar permisos
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
	<li>Asignar permisos</li>
@endsection

@section('dropdown_settings')
 
 	
@endsection

@section('content')

@include('layouts.theme.layouts.includes.breadcrumbs')
  
<div class="row">

	<div class="col-md-8  ml-auto mr-auto">
		<div class="card">
			<div class="card-header">
				<div class="card-title">Asignar permisos</div><h3>Selecciona los permisos que desea asignar</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<form class="col-md-12 col-lg-12" method="post" action="{{ route('user.permission_assignment',$user) }}">
						{{ csrf_field() }}

						@foreach($roles as $role)
							<p>{{ $role->roleName }}</p>
							@foreach($role->permissions as $permission)
								<br>
									<input type="checkbox" id="{{ $permission->id }}" name="permissions[]"  value="{{ $permission->id }}" @if($user->has_permission($permission->id))  checked @endif  />
									<label for="{{ $permission->id }}"> 
										<span>{{ $permission->permissionName }}</span>
									</label>
								
							@endforeach
						@endforeach
						
						
						<br>

						<button type="submit" class="btn btn-primary">Asignar permisos</button>
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
