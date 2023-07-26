<div class="card" style="width: 18rem;">
	<ul class="list-group list-group-flush">
		{{--<li class="list-group-item active card-link"></li>--}}
<li class="list-group-item active card-link active"> Acciones</li>
		<a href=" " class=" list-group-item card-link active">{{$user->name }}</a>
		<a href="{{ route('user.assign_role',$user) }}" class=" list-group-item card-link ">Asignar roles</a>
	<a href="{{ route('user.assign_permission',$user) }}" class=" list-group-item card-link ">Asignar permisos</a>

	</ul>
</div>