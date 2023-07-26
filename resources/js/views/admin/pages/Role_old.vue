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
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true"><span class="fa fa-plus"></span> Nuevo</button>
		 <b-button @click="popToast">Show Toast with custom content</b-button>
		</div>
		<div class="card-body">
			<table class="table">
				
				<thead>
					<tr>
						<td>ID</td>
						<td>Role Type</td>
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
							<button class="btn btn-primary btn-sm" @click="showEditModal(role, i)"><span class="fa fa-edit"></span></button>
							<button class="btn btn-danger btn-sm" @click="showdeletingModal(role, i)" :loading="role.isDeleting"><span class="fa fa-trash"></span>Delete</button>
							
						</td>
					</tr>
				</tbody>
			</table>

			

		</div>

	</div>

	<b-modal  hide-footer v-model="addModal" title="Add Role" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="addRole">
        	<b-form-group 
			 	id="input-group-1" 
			 	label="Full Name:" 
			 	label-for="roleName">
		        <b-form-input
		          id="roleName"
		          v-model="data.roleName"
		          
		          placeholder="Role name"
		        ></b-form-input>
		     </b-form-group>

        	
			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add rol'}}</button>
			</div>
        	</form>
        
      </div>
	</b-modal>

	<b-modal hide-footer v-model="editModal" title="Editar Roles" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="editRole">
        	<div class="form-group">
			    <label for="roleName">Role Name</label>
			    <input type="text" v-model="editData.roleName" class="form-control" id="roleName" >
			</div>
			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="editModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Editing..' : 'Edit tag'}}</button>
				
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
				roleName: ''
			},
			addModal : false,
			editModal : false,
			isAdding : false,
			roles : [],
			editData : {
				roleName: ''
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
	try	{

		const res = await this.callApi('get', 'app/get_roles');
			this.roles = res.data
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
