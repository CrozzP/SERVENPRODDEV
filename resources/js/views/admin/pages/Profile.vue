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
  	<template v-slot:pruebaLink>

  		<button class="btn btn-primary btn-sm" @click="showEditModal(users)" v-if="isUpdatePermitted">
  			<span class="fa fa-edit"></span>
  		</button>
  		<button class="btn btn-primary btn-sm" @click="showEditModalPassword(users)" v-if="isUpdatePermitted">
  			<span class="fa fa-delete"></span>
  		</button>

  		<b-dropdown-item href="#">Action</b-dropdown-item>
	    <b-dropdown-item href="#">Another action</b-dropdown-item>
	    <b-dropdown-item href="#">Something else here</b-dropdown-item>
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
					

					<p><strong>Usurio: </strong>{{users.name}}</p>
					<p><strong>Nombre Completo: </strong>{{users.fullName}}</p>
					<p><strong>Email: </strong>{{users.email}}</p>
					<p><strong>Miembro desde: </strong>{{users.created_at}}</p>
					
				</div>
				<div class="card-footer text-muted">
					2 days ago
				</div>
			</div>
		</div>

	</div>
</div>

	<b-modal hide-footer v-model="editModal" title="Editar Usuario" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="editUsuario">
        	<div class="form-group">
			    <label for="name">Enter Name</label>
			    <input type="text" v-model="editData.name" class="form-control" id="name" >
			</div>

			<div class="form-group">
			    <label for="fullName">Enter Name</label>
			    <input type="text" v-model="editData.fullName" class="form-control" id="fullName" >
			</div>

			<div class="form-group">
			    <label for="email">Enter Name</label>
			    <input type="text" v-model="editData.email" class="form-control" id="email" >
			</div>

			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Editing..' : 'Edit tag'}}</button>
				
			</div>
        	</form>
        
      </div>
	</b-modal>

	<b-modal hide-footer v-model="editModalPass" title="Editar PAssword" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="editPassword">
        	<div class="form-group">
			    <label for="old_password">Contraseña actual</label>
			    <input type="password" v-model="editDataPassword.old_password" class="form-control" id="old_password" >
			</div>

			<div class="form-group">
			    <label for="password">Nueva contraseñae</label>
			    <input type="password" v-model="editDataPassword.password" class="form-control" id="password" required>
			</div>

			<div class="form-group">
			    <label for="password_confirmation">Nueva contraseñae</label>
			    <input type="password" v-model="editDataPassword.password_confirmation" class="form-control" id="password_confirmation" required>
			</div>

			

			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editModalPass=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Editing..' : 'Edit tag'}}</button>
				
			</div>
        	</form>
        
      </div>
	</b-modal>

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
			editModalPass : false,

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
			editDataPassword : {
				
				id: '',
				password: '',
				old_password: '',

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

		async editUsuario(editData){
			
			if (this.editData.name.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Nombre del usuario requerido',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.fullName.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Nombres completos son requeridos',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.email.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Email requeridar',
					  showConfirmButton: false,
					  timer: 5000
					});

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/user/${editData.id}`, this.editData)
			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.users[this.index] = this.editData
				this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
				this.editModal = false
				
			} else {
				if (res.status==422) {
					for(let i in res.data.errors){
						this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: res.data.errors[i][0],
					  showConfirmButton: false,
					  timer: 5000
					});
					}
				} else {
					this.$swal('Any fool can use a computer','de','error')
				}
			}
		},
		showEditModal(user){
			console.log(user)
			let obj ={
				id : user.id,
				name : user.name,
				fullName : user.fullName,
				email : user.email,
				fullName : user.fullName,

			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},

		async editPassword(editDataPassword){
			
			
			

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/profile/change_password`, this.editDataPassword)
			//front/app/profile/change_password
			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.users[this.index] = this.editDataPassword
				this.$swal('Excelent !','Tu contraseña fue actualizada','success')
				this.editModalPass = false
				
			} else {
				if (res.status==422) {
					for(let i in res.data.errors){
						this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: res.data.errors[i][0],
					  showConfirmButton: false,
					  timer: 5000
					});
					}
				} else {
					this.$swal('Ocurrio algun problema','Intentelo nuevamente','error')
				}
			}
		},
		showEditModalPassword(user){
			console.log(user)
			let obj ={
				id : user.id,
				
				password : user.password,

			}
			this.editDataPassword = obj
			this.editModalPass = true
			this.index = index
		},



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