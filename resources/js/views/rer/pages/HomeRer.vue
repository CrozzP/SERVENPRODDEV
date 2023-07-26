<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Home
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema RER</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario</li>
  	</template>
</Breadcrumbs>
	
	<b-card
	


         
    img-src="/assets/img/examples/example9.jpeg"
    img-alt="Card Image"
    
    text-variant="white"
    title="Bienvenido a..."
    sub-title="SerVen"
    class="mx-2 text-center text-dark"
      >
        <b-card-text >
          La Aplicacion Web que te ayudara en tu dia a dia
          <br>
         Servicion de Ventanilla
        </b-card-text>

        
      </b-card>

</base-layout>
</template>

<script>
	import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';

export default{
		components: {
			Breadcrumbs
			
		},
		}
</script>