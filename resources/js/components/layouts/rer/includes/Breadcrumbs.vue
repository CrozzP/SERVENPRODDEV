<template>
	

	<div class="row" >
		<div class="page-header col-10 col-md-10">
			<h4 class="page-title"> <slot name="titulo_breadcrumbs"></slot></h4>
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
				
				
			    	<slot name="prueba"></slot>
			  	
			</ul>
		</div>
		

		<div>
  
		  <b-dropdown id="dropdown-right" right text="Acciones" variant="primary" class="m-2">

		    <slot name="pruebaLink"></slot>

		  </b-dropdown>
		</div>


</div>
</template>