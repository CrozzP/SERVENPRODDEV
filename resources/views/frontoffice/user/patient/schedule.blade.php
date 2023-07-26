@extends('theme.frontoffice.layouts.admin')

@section('title','Agendar una cita')

@section('head')				

	<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/pickadate/themes/default.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/pickadate/themes/default.date.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/pickadate/themes/default.time.css') }}">
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
					@yield('title')
				</div>
				<div class="card-body">
					
					<form class="col-md-12 col-lg-12" action="#" method="POST">
						{{ csrf_field() }}
						<div class="row">
							<div class="form-group form-floating-label col-md-1 ml-auto mr-auto">
								
									<i class="fas fa-user-friends fa-2x" style="color: #339af0;"></i>
									
								
							</div>

							<div class="form-group has-success col-md-11 ml-auto mr-auto">
								

								<div class="form-group form-floating-label">
									<select class="form-control input-border-bottom" id="doctor" name="doctor" required="">
										<option></option>
										<option value="1">Raul</option>
										<option value="2">Carlos</option>
										<option value="3">Ulices</option>
									</select>
									<label for="doctor" class="placeholder">Seleccione al doctor</label>
								</div>

							</div>
						
						</div>
						<div class="row">
							<div class="form-group form-floating-label col-md-6 ml-auto mr-auto">
								<span class="input-icon-addon">
									<i class="far fa-calendar-alt fa-lg" style="color: #339af0;"></i>
								</span>

								<input id="datepicker" type="text" name="date" class="input-border-bottom datepicker" required="" placeholder="Seleccione una fecha">
								
							</div>

							<div class="form-group has-success col-md-6 ml-auto mr-auto">
								<span class="input-icon-addon">
									<i class="far fa-clock fa-lg" style="color: #339af0;"></i>
								</span>
								<input id="timepicker" type="text" name="time" class="input-border-bottom timepicker" placeholder="Seleccione un horario">
							</div>
							


						</div>
					
				</div>
				<div class="card-footer text-muted">
					
					<button type="submit" class="btn btn-primary">Agendar</button>
				</div></form>
			</div>
		</div>

	</div>
</div>


@endsection

@section('foot')
	<script type="text/javascript" src="{{ asset('assets/plugins/pickadate/picker.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/plugins/pickadate/picker.date.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/plugins/pickadate/picker.time.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/plugins/pickadate/legacy.js') }}"></script>

	<script type="text/javascript">
	
		var input_date = $('.datepicker').pickadate({
			min: true
		});
		$('.datepicker').pickadate({

		});
		var input_time = $('.timepicker').pickatime({
			min: 4
		});
		$('.timepicker').pickatime({

		});

	</script>
@endsection
