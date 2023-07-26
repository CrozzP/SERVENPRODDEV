<div class="row" >
	<div class="page-header col-10 col-md-10">
		<h4 class="page-title">@yield('titulo_breadcrumbs')</h4>
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="#">
					<i class="flaticon-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Panel de administracion</a>
			</li>
			@yield('breadcrumbs')
		</ul>
	</div>
	<div class="dropdown show col-2 col-md-2">
		<a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Acciones
		</a>




		<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			@yield('dropdown_settings')
			
		</div>
	</div>
</div>
