<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Roles
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
					Asignar Roles
			</span>
		
		 	
			    <button class="btn btn-primary btn-sm ml-auto" @click="assignRoles" :loading="isSending" :disabled="isSending"><span class="fa fa-plus"></span> Asignar</button>
		      
		</div>
		<b-form-group label="Seleccionar Rol" label-for="role_id">
		        <b-form-select v-model="data.id"  class="mb-3" @change="changeAdmin" >
			      
			        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
			      
			      <b-form-select-option :value="role.id" v-for="(role, i) in roles" :key="i" v-if="roles.length">{{role.roleName}}</b-form-select-option>
			      
			    </b-form-select>
		      </b-form-group>

		<div class="card-body">
			<table class="table">
				
				<thead>
					<tr>
						<td>Resorce Name</td>
						<td>Read</td>
						<td>Write</td>
						<td>Update</td>
						<td>Delete</td>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(role, i) in resources" :key="i">
						<td>{{role.resourceName}}</td>
						<td><b-form-checkbox switch  v-model="role.read"></b-form-checkbox></td>
						<td><b-form-checkbox switch  v-model="role.write"></b-form-checkbox></td>
						<td><b-form-checkbox switch  v-model="role.update"></b-form-checkbox></td>
						<td><b-form-checkbox switch  v-model="role.delete"></b-form-checkbox></td>
						
						
					</tr>
				</tbody>
			</table>

			

		</div>

	</div>







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
				roleName: '',
				id: null,
				permission: '',
			},
			isSending: false,
			
			roles : [],

			resources: [
				{resourceName: 'Home', read: false, write: false, update: false, delete: false, name: '/'},
				{resourceName: 'Tags', read: false, write: false, update: false, delete: false, name: 'tags'},
				{resourceName: 'Category', read: false, write: false, update: false, delete: false, name: 'category'},
				{resourceName: 'Create Blogs', read: false, write: false, update: false, delete: false, name: 'createBlog'},
				{resourceName: 'Admin Users', read: false, write: false, update: false, delete: false, name: 'adminusers'},
				{resourceName: 'Role', read: false, write: false, update: false, delete: false, name: 'role'},
				{resourceName: 'Assign Role', read: false, write: false, update: false, delete: false, name: 'assignrole'},
				
			],

			defaultResourcesPermission: [
				{resourceName: 'Home', read: false, write: false, update: false, delete: false, name: '/'},
				{resourceName: 'Tags', read: false, write: false, update: false, delete: false, name: 'Tags'},
				{resourceName: 'Category', read: false, write: false, update: false, delete: false, name: 'category'},
				{resourceName: 'Create Blogs', read: false, write: false, update: false, delete: false, name: 'createBlog'},
				{resourceName: 'Admin Users', read: false, write: false, update: false, delete: false, name: 'adminusers'},
				{resourceName: 'Role', read: false, write: false, update: false, delete: false, name: 'role'},
				{resourceName: 'Assign Role', read: false, write: false, update: false, delete: false, name: 'assignrole'},
				
			],



			editData : {
				roleName: ''
			},

			
		}
	},


	methods : {
		async assignRoles(){
			let data = JSON.stringify(this.resources)
			const res = await this.callApi('post', 'app/assign_roles', {'permission' : data, id: this.data.id})
			if (res.status==200) {
				
				Swal.fire('Roles asignados','Correctamente','success')
				let index = this.roles.findIndex(role => role.id == this. data.id)
				this.roles[index].permission = data
			} else {
				Swal.fire('Ocurrio algun error','!Problema¡','success')
			
			}
		},

		changeAdmin(){
			let index = this.roles.findIndex(role => role.id == this. data.id)
			let permission = this.roles[index].permission
			//console.log(permission)
			if (!permission) {
				this.resources = this.defaultResourcesPermission
			} else {
				this.resources = JSON.parse(permission)
			}
		},


		async addRole(){
			if (this.data.roleName.trim()=='') return this.flashMessage.success({
						message: 'Nombre del rol requerido',
						time: 500000
					});

			
			const res = await this.callApi('post', 'app/create_role', this.data)
			Swal.fire('Rol creado','Correctamente','success');
			
			if (res.status==201) {
				this.roles.unshift(res.data)
				
				this.flashMessage.success({
						message: 'Categoria creada',
						time: 5000
					})
				this.addModal = false
				this.data.roleName = ''

			} else {
				if (res.status==422) {
					if (res.data.errors.roleName) {
						this.flashMessage.error({
						message: res.data.errors.roleName[0],
						time: 5000
					});
					}
				} else {
					this.flashMessage.error({
						message: 'Some error occurred, please refresh',
						time: 5000
					});
				}
			}
		},

		async editRole(){
			
			if (this.editData.roleName.trim()=='') return this.flashMessage.success({
						message: 'NOmbre del rol requerido',
						time: 500000
					});

			const res = await this.callApi('post', 'app/edit_roles', this.editData)
			if (res.status==200) {
				this.roles[this.index].roleName = this.editData.roleName
				this.flashMessage.success({
						message: 'Categoria modificada',
						time: 5000
					})
				this.editModal = false
				
			} else {
				if (res.status==422) {
					if (res.data.errors.roleName) {
						this.flashMessage.error({
						message: res.data.errors.roleName[0],
						time: 5000
					});
					}
				} else {
					this.flashMessage.error({
						message: 'Some error occurred, please refresh',
						time: 5000
					});
				}
			}
		},
		showEditModal(role, index){
			let obj ={
				id : role.id,
				roleName : role.roleName
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
	

		const res = await this.callApi('get', 'app/get_roles')
		if (res.status == 200) {
			this.roles = res.data;

			if (res.data.length) {
				this.data.id = res.data[0].id
				if (res.data[0].permission) {
					this.resources = JSON.parse(res.data[0].permission)
				}

			}

		} else {
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
