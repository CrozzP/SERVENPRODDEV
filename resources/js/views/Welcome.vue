<template>
	
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Titulo Prueba
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario Crozz</li>
  	</template>
	
</Breadcrumbs>


</template>
<script>
	import Breadcrumbs from '../components/layouts/back/includes/Breadcrumbs.vue';
	export default{
		components: {
			Breadcrumbs
			
		}
	}
</script>
