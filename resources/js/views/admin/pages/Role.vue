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
					Administrar Roles
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
										<td>Role Name</td>
										<td>Created_At</td>
										<td>Action</td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(role, i) in roles" :key="i" v-if="roles.length">
										<td>{{role.id}}</td>
										<td>{{role.roleName}}</td>
										
										<td>{{role.created_at}}</td>
										<td>
											<button class="btn btn-primary btn-sm" @click="showEditModal(role, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(role, i)" :loading="role.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>
											
										</td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>
	

	<b-modal  hide-footer v-model="addModal" title="Add role" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="addRole">
        	<div class="form-group">
			    <label for="roleName">Enter Name</label>
			    <input type="text" v-model="data.roleName" class="form-control" id="roleName" >
			</div>

			<div class="form-group">
			    <label for="description">ingresar descripcion</label>
			    <input type="text" v-model="data.description" class="form-control" id="description" >
			</div>

			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add role'}}</button>
			</div>
        	</form>
        
      </div>
	</b-modal>

	<b-modal  hide-footer v-model="editModal" title="Editar role" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="editRole(editData)">
        	<div class="form-group">
			    <label for="roleName">Enter Name</label>
			    <input type="text" v-model="editData.roleName" class="form-control" id="roleName" >
			</div>

			<div class="form-group">
			    <label for="description">ingresar descripcion</label>
			    <input type="text" v-model="editData.description" class="form-control" id="description" >
			</div>

			
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
				roleName: '',
				description: '',
			},
			addModal : false,
			editModal : false,
			isAdding : false,
			roles : [],
			editData : {
				roleName: '',
				description: '',
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
		async addRole(){
			if (this.data.roleName.trim()=='') return this.$swal('Nombre del rol','Requerido','warning')
			if (this.data.description.trim()=='') return this.$swal('Descripcion','Requerido','warning')

			
			const res = await this.callApi('post', 'app/role', this.data)
			
			
			if (res.status==201) {
				this.roles.unshift(res.data)
				//this.$swal('Hello Vue world!!!');
				this.$swal('Role creado','Correctamente','success');
				//Swal.fire('Any fool can use a computer','de','success');
				/*this.flashMessage.success({
						message: 'Categoria creada',
						time: 5000
					})*/
				this.addModal = false
				this.data.roleName = ''
				this.data.description = ''

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

		async editRole(editData){
			
			if (this.editData.roleName.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Nombre del rol requerido',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.description.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Descripcion requeridar',
					  showConfirmButton: false,
					  timer: 5000
					});

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/role/${editData.id}`, this.editData)
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.roles[this.index] = this.editData
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
		showEditModal(role, index){
			let obj ={
				id : role.id,
				roleName : role.roleName,
				description : role.description,

			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},

		async deleteRole(deleteItem, index){
			this.isDeleing = true
			//const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			const res = await this.callApi('delete', `app/role/${deleteItem.id}`, this.deleteItem)
			if(res.status==200){
				this.roles.splice(index, 1)
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

		showdeletingModal(role, i){
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
		          	this.deleteRole(role, i)
		            this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},




	},


		

		


	async created(){
	try	{
		console.log(this.isWritePermitted)
		const res = await this.callApi('get', 'app/role');
			this.roles = res.data
		} catch {
			this.$swal('Any fool can use a computer','de','error')
		}
		
		
	},



}




  </script>