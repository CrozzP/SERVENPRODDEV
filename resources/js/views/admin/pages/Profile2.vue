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
	
	<div class="container">
	<div class="row row row-demo-grid">
		<div class="col-md-4 ml-auto mr-auto">
	<div class="card" style="width:  18rem;" >
		<p  v-for="(role, i) in roles" :key="i"  v-if="role.slug=='coordinador'|| role.slug=='coordinador'&&'administrador'">
			
			
			<a 
				href="" 
				class="list-group-item">
				Perfil xd
			</a>
		</p>
		<ul class="list-group list-group-flush">
	
			<div  >
			
			
			</div>
				<a 
					href="/back/role" 
					class="list-group-item  " >
					Agendar cita
				</a>

				
        
      
				<a 
					href="" 
					class="list-group-item ">
					Mis citas
				</a>
				<a 
					href="" 
					class="list-group-item ">
					Recetas
				</a>
				<a 
					href="" 
					class="list-group-item ">
					Facturacion
				</a>
			
			<a 
				href="" 
				class="list-group-item">
				Editar perfil
			</a>
			<a 
				href="" 
				class="list-group-item ">
				Modificar contraseña
			</a>
			  <a 
			  href="/front/app/profile" class="list-group-item {active:location.href}">tecto de prueba
			
      		</a>
      			
      		<li class="list-group-item active">
      		<route-link to="/">nueva prueba</route-link>
      		</li>
      		

			<b-list-group >
			  <b-list-group-item :to="{ path: '/front/profile'}" class="prueba">prueba</b-list-group-item>
			  <b-list-group-item :to="{ path: '/front/profile2'}" class="prueba" >prueba 2</b-list-group-item>
			  <b-list-group-item href="#" class="prueba">Action links are easy</b-list-group-item>
			  <b-list-group-item href="#foobar" class="prueba" >Disabled link</b-list-group-item>
			</b-list-group>

			
		</ul>
	</div>
</div>
		
		<div class="col-md-8 ml-auto mr-auto">
			<div class="card text">
				<div class="card-header">
					<h5 class="card-title">{{users.name}}</h5>
				</div>
				<div class="card-body">
					

					<p><strong>Nombre: </strong>{{users.name}}</p>
					<p><strong>Edad: </strong>33 años</p>
					<p><strong>Email: </strong>asddsa@gmaol.com</p>
					<p><strong>Miembro desde: </strong>{{users.created_at}}</p>
					
				</div>
				<div class="card-footer text-muted">
					2 days ago
				</div>
			</div>
		</div>

	</div>
</div>

</base-layout>
</template>

<script>
	import Breadcrumbs from '../../../components/layouts/front/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';

export default{
	components: {
		Breadcrumbs
		
	},

	data(){
		return {
			data : {
				name: '',
				fullName: '',
				email: '',
				
				password: '',
			},

			editarActivo: true,
			
			addModal : false,
			editModal : false,
			isAdding : false,
			users : [],
			roles : [],
			
			
			roles : {
				id: '',
				roleName: '',
				
			},
			
			editData : {
				name: '',
				fullName: '',
				email: '',
				id: '',
				
				
			},
			index : -1,
			showDeleteModal: false,
			isDeleing: false,
			deleteItem: {},
			deletingIndex: -1,
			websiteSettings: []
		}
	},

	methods : {

	},

	async created(){
	try	{
		//console.log(this.isWritePermitted)
//front/app/profile
		const res = await this.callApi('get', 'app/profile');
			this.users = res.data
			this.roles = res.data.roles
			//console.log(res.data.roles)
			//console.log(this.users)
			//console.log(this.users.roles)
			//console.log(this.users.roles)
		
	console.log('esto muestra',location.href)

			//console.log(this.users.roles[i++].slug)
		/*const [res, resRol] = await Promise.all([
				this.callApi('get', 'app/user'),
				this.callApi('get', 'app/role')
			])
		

			this.users = res.data
			this.roles = resRol.data*/

		} catch {
			this.$swal('Any fool can use a computer','de','error')
		}
		
		
	},



	}
</script>