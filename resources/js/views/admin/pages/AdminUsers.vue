<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Admin Usuarios
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario Crozz3</li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Usuarios
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true"><span class="fa fa-plus"></span> Nuevo</button>
		 <b-button @click="popToast">Show Toast with custom content</b-button>
		</div>
		<div class="card-body">
			<table class="table">
				
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Email</td>
						<td>User typie</td>
						<td>Created at</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(user, i) in users" :key="i" v-if="users.length">
						<td>{{i+1}}</td>
						<td>{{user.fullName}}</td>
						<td>{{user.email}}</td>
						<td>{{user.userType}}</td>
						
						<td>{{user.created_at}}</td>
						<td>
							<button class="btn btn-primary btn-sm" @click="showEditModal(user, i)"><span class="fa fa-edit"></span></button>
							<button class="btn btn-danger btn-sm" @click="showdeletingModal(user, i)" :loading="user.isDeleting"><span class="fa fa-trash"></span>Delete</button>
							
						</td>
					</tr>
				</tbody>
			</table>

			

		</div>

	</div>

	<b-modal  hide-footer v-model="addModal" title="Add admin" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="addAdmin">

			
			 <b-form-group 
			 	id="input-group-1" 
			 	label="Full Name:" 
			 	label-for="fullName">
		        <b-form-input
		          id="fullName"
		          v-model="data.fullName"
		          
		          placeholder="Enter name"
		        ></b-form-input>
		     </b-form-group>

			<b-form-group
		        id="input-group-1"
		        label="Email address:"
		        label-for="email"
		        description="We'll never share your email with anyone else."
		      >
		        <b-form-input
		          id="email"
		          v-model="data.email"
		          type="email"
		          
		          placeholder="Enter email"
		        ></b-form-input>
		     </b-form-group>

		     <b-form-group id="input-group-1" label="Password:" label-for="password">
		        <b-form-input

		          id="password"
		          type="password"
		          v-model="data.password"
		          
		          placeholder="Enter name"
		        ></b-form-input>
		     </b-form-group>

		     <b-form-group id="input-group-1" label="Select Admin Type:" label-for="role_id">
		        <b-form-select v-model="data.role_id" :options="options" class="mb-3">
			      
			        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
			      
			      <b-form-select-option :value="role.id" v-for="(role, i) in roles" :key="i" v-if="roles.length">{{role.roleName}}</b-form-select-option>
			      
			    </b-form-select>
		      </b-form-group>

			

			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add admin'}}</button>
			</div>
        	
        	</form>
        
      </div>
	</b-modal>

	<b-modal hide-footer v-model="editModal" title="Editar tag" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="editAdmin">
        	<b-form-group 
			 	id="input-group-1" 
			 	label="Full Name:" 
			 	label-for="fullName">
		        <b-form-input
		          id="fullName"
		          v-model="editData.fullName"
		          
		          placeholder="Enter name"
		        ></b-form-input>
		     </b-form-group>

			<b-form-group
		        id="input-group-1"
		        label="Email address:"
		        label-for="email"
		        description="We'll never share your email with anyone else."
		      >
		        <b-form-input
		          id="email"
		          v-model="editData.email"
		          type="email"
		          
		          placeholder="Enter email"
		        ></b-form-input>
		     </b-form-group>

		     <b-form-group id="input-group-1" label="Password:" label-for="password">
		        <b-form-input

		          id="password"
		          type="password"
		          v-model="editData.password"
		          
		          placeholder="Enter name"
		        ></b-form-input>
		     </b-form-group>

		     <b-form-group id="input-group-1" label="Select Admin Type:" label-for="role_id">
		        <b-form-select v-model="editData.role_id" :options="options" class="mb-3">
			      
			        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
			      
			      <b-form-select-option :value="role.id" v-for="(role, i) in roles" :key="i" v-if="roles.length">{{role.roleName}}</b-form-select-option>
			      
			    </b-form-select>
		      </b-form-group>

        	
			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Editing..' : 'Edit admin'}}</button>
				
			</div>
        	</form>
        
      </div>
	</b-modal>


<!--
	
	<b-modal v-model="showDeleteModal" hide-footer width="360" title="Delete confirmation">
      <div class="d-block text-center">
        <h3>Esta seguro de eliminar?</h3>
      </div>
      
      <b-button class="mt-2" variant="outline-danger" block long :loading="isDeleing" :disabled="isDeleing" @click="deleteTag">Seguro</b-button>
      
      
    </b-modal>
-->

<deleteModal></deleteModal>
	
</base-layout>

</template>

<script>
	const Swal = require('sweetalert2');
import deleteModal from '../components/deleteModal.vue'
import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';
import { mapGetters } from 'vuex'
export default{
	components: {
		Breadcrumbs,
		deleteModal
		
	},



	data(){
		return {
			data : {
				fullName: '',
				email: '',
				paswword: '',
				role_id: null,
			},
			addModal : false,
			editModal : false,
			isAdding : false,
			users : [],
			roles : [],
			editData : {
				fullName: '',
				email: '',
				userType: '',
				role_id:''
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
		async addAdmin(){
			if (this.data.fullName.trim()=='') return this.flashMessage.success({
						message: 'Full name is required',
						time: 500000
					});
			if (this.data.email.trim()=='') return this.flashMessage.success({
						message: 'Email is required',
						time: 500000
					});
			if (this.data.password.trim()=='') return this.flashMessage.success({
						message: 'Password is required',
						time: 500000
					});
			if (!this.data.role_id) return this.flashMessage.success({
				message: 'ROle is required',
				time: 500000
					});

			
			const res = await this.callApi('post', 'app/create_usertype', this.data)
			Swal.fire('Any fool can use a computer','de','success');
			
			if (res.status==201) {
				this.users.unshift(res.data)
				
				this.flashMessage.success({
						message: 'Categoria creada',
						time: 5000
					})
				this.addModal = false
				this.data.fullName = ''
				this.data.email = ''
				this.data.password = ''
				this.data.userType = ''

			} else {
				if (res.status==422) {
					for(let i in res.data.errors){
						Swal.fire({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: res.data.errors[i][0],
					  showConfirmButton: false,
					  timer: 5000
					});

						//position: fixed

						//this.e(res.data.errors[i][0])
					}
					
				} else {
					this.flashMessage.error({
						message: 'Some error occurred, please refresh',
						time: 5000
					});
				}
			}
		},

		async editAdmin(){
			
			if (this.editData.fullName.trim()=='') return this.flashMessage.success({
						message: 'Full name is required',
						time: 500000
					});
			if (this.editData.email.trim()=='') return this.flashMessage.success({
						message: 'Email is required',
						time: 500000
					});
			
			if (!this.editData.role_id) return this.flashMessage.success({
				message: 'User type is required',
				time: 500000
					});

			const res = await this.callApi('post', 'app/edit_users', this.editData)
			Swal.fire('Datos actualizados','Correctamente','success');
			
			if (res.status==200) {
				this.users[this.index] = this.editData
				this.flashMessage.success({
						message: 'Usuario modificada',
						time: 5000
					})
				this.editModal = false
				
			} else {
				if (res.status==422) {

					for(let i in res.data.errors){
						Swal.fire({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: res.data.errors[i][0],
					  showConfirmButton: false,
					  timer: 5000
					});

						//position: fixed

						//this.e(res.data.errors[i][0])
					}
				} else {
					this.flashMessage.error({
						message: 'Some error occurred, please refresh',
						time: 5000
					});
				}
			}
		},
		showEditModal(user, index){
			let obj ={
				id : user.id,
				fullName : user.fullName,
				email : user.email,
				//password : user.password,
				userType : user.userType,
			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},


		async deleteTag(){
			console.log('estoy dentro de deletetag')
			this.isDeleing = true
			//if(!confirm('Esta seguro de eliminar este tag?')) return
				//tag.isDeleting = true
				//this.$set(tag, 'isDeleting', true)

				const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
				if (res.status===200) {
					this.tags.splice(this.deletingIndex, 1)
					Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					});
					$.notify({
			// options
			icon: 'flaticon-alarm-1',
			message: 'Hello World',

		},{
			// settings
			type: 'danger',

		});
					
				} else{
					this.flashMessage.error({
						message: 'Ocurrio algun error',
						time: 5000
					});
				}
					
			this.isDeleing = false
			this.showDeleteModal = false
		},

		/*async deleteTag(){
			this.isDeleing = true
			const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			if(res.status==200){
				this.tags.splice(this.deletingIndex, 1)
				Swal.fire({
					  position: 'top-end',
					  icon: 'success',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					});

			}else {
				Swal.fire({
					  position: 'top-end',
					  icon: 'error',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					});
			}
			this.isDeleing = false
			this.showDeleteModal = false
		},*/

		showdeletingModal(tag, i){
			const deleteModalObj = {
				showDeleteModal : true,
				deleteUrl : 'app/delete_tags',
				data : tag,
				deletingIndex: i,
				isDeleted: false,

			}
			this.$store.commit('setDeletingModalObj', deleteModalObj)
			console.log('delete method called')
			//this.deleteItem = tag
			//this.deletingIndex = i
			//this.showDeleteModal = true

			//console.log('delete method caled')
		},
		

		popToast(){

			$.notify({
			// options
			icon: 'flaticon-alarm-1',
			message: 'Hello World',

		},{
			// settings
			type: 'danger',

		});


	}
	},


	async created(){
	try	{

		const [res, resRole] = await Promise.all([
				this.callApi('get', 'app/get_users'),
				this.callApi('get', 'app/get_roles')
			])

		//const res = await this.callApi('get', 'app/get_users');
			this.users = res.data
			this.roles = resRole.data

		} catch {
			this.flashMessage.error({
						message: 'Some error occurred, please refresh',
						time: 5000
					});
		}
		
		
	},
	computed : {
		...mapGetters(['getDeleteModalObj'])
	},
	watch : {
		getDeleteModalObj(obj){
			console.log("dentro de getdeleted")
			if(obj.isDeleted) {
				console.log("dentro de if")
				this.tags.splice(obj.deletingIndex,1)
				
			}
		},
	},

}
</script>
