<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Permisos
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
					Administrar Permisos
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
		 
		</div>
	</div>
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<table class="table table-hover">
								
								<thead>
									<tr>
										<td>ID</td>
										<td>Perssion Name</td>
										<td>Description</td>
										<td>Rol</td>
										<td>Created_At</td>
										<td>Action</td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(permission, i) in permissions" :key="i" v-if="permissions.length">
									
										<td>{{permission.id}}</td>
										<td>{{permission.permissionName}}</td>
										<td>{{permission.description}}</td>
										<td v-for="(role, i) in roles" :key="i" v-if="role.id==permission.role_id">{{role.roleName}}</td>
										<td>{{permission.created_at}}</td>
										
										
											<button class="btn btn-primary btn-sm" @click="showEditModal(permission, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(permission, i)" :loading="permission.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>
											
										</td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>
	

	<b-modal  hide-footer v-model="addModal" title="Add permission" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="addPermission">
        	<b-form-group 
			 	id="input-group-1" 
			 	label="Nombre del Permiso:" 
			 	label-for="permissionName">
		        <b-form-input
		          id="permissionName"
		          v-model="data.permissionName"
		          
		          placeholder="Enter name"
		        ></b-form-input>
		     </b-form-group>

        	<b-form-group 
			 	id="input-group-1" 
			 	label="Descripcion del permiso:" 
			 	label-for="description">
		        <b-form-input
		          id="description"
		          v-model="data.description"
		          
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
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add permission'}}</button>
			</div>
        	</form>
        
      </div>
	</b-modal>

	<b-modal  hide-footer v-model="editModal" title="Editar permission" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="editPermission(editData)">
        	<b-form-group 
			 	id="input-group-1" 
			 	label="Nombre del Permiso:" 
			 	label-for="permissionName">
		        <b-form-input
		          id="permissionName"
		          v-model="editData.permissionName"
		          
		          placeholder="Enter name"
		        ></b-form-input>
		     </b-form-group>
			<b-form-group 
			 	id="input-group-1" 
			 	label="Descripcion del permiso:" 
			 	label-for="description">
		        <b-form-input
		          id="description"
		          v-model="editData.description"
		          
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
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Editing..' : 'Edit tag'}}</button>
				
			</div>
        	</form>
        
      </div>
	</b-modal>





	
</base-layout>

</template>

<script>

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';

export default{
	components: {
		Breadcrumbs,
		
		
	},



	data(){
		return {
			data : {
				permissionName: '',
				description: '',
				role_id: null,

			},
			addModal : false,
			editModal : false,
			isAdding : false,
			permissions : [],
			roles : [],
			editData : {
				permissionName: '',
				description: '',
				role_id: '',
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
		async addPermission(){
			if (this.data.permissionName.trim()=='') return this.$swal('Nombre del rol','Requerido','warning')
			if (this.data.description.trim()=='') return this.$swal('Descripcion','Requerido','warning')
			if (!this.data.role_id) return this.$swal('Rol es','Requerido','warning')
			
			const res = await this.callApi('post', 'app/permission', this.data)
			
			
			if (res.status==201) {
				this.permissions.unshift(res.data)
				
				this.$swal('permission creado','Correctamente','success');
				
				this.addModal = false
				this.data.permissionName = ''
				this.data.description = ''
				this.data.role_id = ''

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
					this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
				}
			}
		},

		async editPermission(editData){
			
			if (this.editData.permissionName.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Nombre del rol requerido',
					  showConfirmButton: false,
					  timer: 5000
					})
			if (this.editData.description.trim()=='') return this.$swal({
							
					  position: 'top-end',
					  icon: 'error',
					  title: 'Descripcion requerida',
					  showConfirmButton: false,
					  timer: 5000
					})
			if (!this.editData.role_id) return this.$swal({
						toast: true,
				  position: 'top-end',
				  icon: 'error',
				  title: 'Rol requerida',
				  showConfirmButton: false,
				  timer: 5000
				})

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/permission/${editData.id}`, this.editData)
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.permissions[this.index] = this.editData
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
		showEditModal(permission, index){
			let obj ={
				id : permission.id,
				permissionName : permission.permissionName,
				description : permission.description,
				role_id : permission.role_id,

			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},

		async deletePermission(deleteItem, index){
			this.isDeleing = true
			//const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			const res = await this.callApi('delete', `app/permission/${deleteItem.id}`, this.deleteItem)
			if(res.status==200){
				this.permissions.splice(index, 1)
				/*this.$swal({
					  position: 'top-end',
					  icon: 'success',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					});*/

			}else {
				this.$swal({
					  position: 'top-end',
					  icon: 'error',
					  title: 'Your work has been saved',
					  showConfirmButton: false,
					  timer: 1500
					});
			}
			this.isDeleing = false
			//this.showDeleteModal = false
		},

		showdeletingModal(permission, i){
			/*const deleteModalObj = {
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

			*/
			
			this.$swal({
		          title: '¿ Estas seguro ?',
		          text: 'No puedes revertir despues de esta accion',
		          icon: 'warning',
		          
		          showCancelButton: true,
		          confirmButtonColor: '#3085d6',
			  	  cancelButtonColor: '#d33',
		          confirmButtonText: 'Si, Eliminar!',
		          cancelButtonText: 'No, Mantener!',
		          showCloseButton: true,
		          showLoaderOnConfirm: true
		        }).then((result) => {
		          if(result.value) {
		          	this.deletePermission(permission, i)
		            this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},




	},


		

		


	async created(){
	try	{
		const [res, resPermission] = await Promise.all([
				this.callApi('get', 'app/role'),
				this.callApi('get', 'app/permission')
			])
		

			this.roles = res.data
			this.permissions = resPermission.data
		} catch {
			this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
		}
		
		
	},



}




  </script>