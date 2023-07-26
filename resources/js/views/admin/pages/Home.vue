<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Home - Prod
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario</li>
  	</template>
</Breadcrumbs>
	
	<b-card
	


         
    img-src="/assets/img/examples/fondo.jpg"
    img-alt="Card Image"
    
    text-variant="white"
  
    class="mx-2 text-center text-dark"
      >
        <b-card-text >
          Manual del usuario
          <br>
         
         <b-button pill  variant="outline-success" href="/back/aprende" target="_blank"><span class="fas fa-user-graduate"></span> Aprende</b-button>

         <b-alert variant="success" show><strong> Seleccionar segun el siguiente detalle:</strong></b-alert>

         <b-breadcrumb>
          <b-breadcrumb-item href="#home">
            <b-icon icon="house-fill" scale="1.25" shift-v="1.25" aria-hidden="true"></b-icon>
            Gerencia Comercial
          </b-breadcrumb-item>
          <b-breadcrumb-item >Departamento de Atencion al Cliente</b-breadcrumb-item>
          <b-breadcrumb-item >Atencion al Cliente</b-breadcrumb-item>
          <b-breadcrumb-item active>Manual SerVen-Modulos</b-breadcrumb-item>
        </b-breadcrumb>



        </b-card-text>

        
      </b-card>

</base-layout>
</template>

<script>
	import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';


export default{
		components: {
			Breadcrumbs
			
		},
		}
</script>