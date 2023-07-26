<template>
	
		
	
	<main>
	<body data-background-color="bg3">
		<div class="wrapper">
				
		<Header/>
		
		<Sidebar>
			
			

		</Sidebar>
		
				
		
<Breadcrumbs>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario Crozz3---FRONTOFFICE</li>
  	</template>
</Breadcrumbs>
	<div class="main-panel">

			<div class="content">
				
				<div class="container">
					
					<router-view> </router-view>

				</div>
				
			</div>
			<Footer/>
			
		</div>
	</div>
	
</body>

	

	</main>
	
</template>
<script>

	import Header from './components/layouts/front/includes/Header.vue';
	import Sidebar from './components/layouts/front/includes/Sidebar.vue';
	import Footer from './components/layouts/front/includes/Footer.vue';
	export default{
		components: {
			Header,
			Sidebar,
			Footer  
		},

		

		
	}
</script>
