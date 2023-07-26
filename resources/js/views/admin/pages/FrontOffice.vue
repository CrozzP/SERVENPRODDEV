<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Panel de administracion
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		
		

		<li>Usuario Crozz3</li>
  	</template>
</Breadcrumbs>
	
	<h1>hola desde PRUEBA. vue</h1>

</base-layout>
</template>

<script>
	import Breadcrumbs from '../../../components/layouts/fornt/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';

export default{
		components: {
			Breadcrumbs
			
		},
		}
</script>