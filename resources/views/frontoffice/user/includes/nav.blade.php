<div class="col-md-4 ml-auto mr-auto">
	<div class="card" style="width:  18rem;" >
		
		<ul class="list-group list-group-flush">
	

			<a 
				href="{{ route('frontoffice.user.profile') }}" 
				class="list-group-item {!! active_class(route('frontoffice.user.profile')) !!}">
				Perfil
			</a>
			@if(auth()->user()->has_role(config('app.patient_role')))
				<a 
					href="{{ route('frontoffice.patient.schedule') }}" 
					class="list-group-item {!! active_class(route('frontoffice.patient.schedule')) !!}">
					Agendar cita
				</a>
				<a 
					href="{{ route('frontoffice.patient.appointments') }}" 
					class="list-group-item {!! active_class(route('frontoffice.patient.appointments')) !!}">
					Mis citas
				</a>
				<a 
					href="{{ route('frontoffice.patient.prescriptions') }}" 
					class="list-group-item {!! active_class(route('frontoffice.patient.prescriptions')) !!}">
					Recetas
				</a>
				<a 
					href="{{ route('frontoffice.patient.invoices') }}" 
					class="list-group-item {!! active_class(route('frontoffice.patient.invoices')) !!}">
					Facturacion
				</a>
			@endif
			<a 
				href="{{ route('frontoffice.user.edit',[auth()->user(),'view=frontoffice']) }}" 
				class="list-group-item {!! active_class(route('frontoffice.user.edit',auth()->user())) !!}">
				Editar perfil
			</a>
			<a 
				href="{{ route('frontoffice.user.edit_password') }}" 
				class="list-group-item {!! active_class(route('frontoffice.user.edit_password')) !!}">
				Modificar contraseña
			</a>
			
		</ul>
	</div>
</div>