<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Tags
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
					Administrar Tags
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
		 <b-button @click="popToast">Show Toast with custom content</b-button>
		</div>
		<div class="card-body">
			<table class="table">
				
				<thead>
					<tr>
						<td>ID</td>
						<td>Tag Name</td>
						<td>Created_At</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
						<td>{{tag.id}}</td>
						<td>{{tag.tagName}}</td>
						
						<td>{{tag.created_at}}</td>
						<td>
							<button class="btn btn-primary btn-sm" @click="showEditModal(tag, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
							<button class="btn btn-danger btn-sm" @click="showdeletingModal(tag, i)" :loading="tag.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>
							
						</td>
					</tr>
				</tbody>
			</table>

			

		</div>

	</div>

	<b-modal  hide-footer v-model="addModal" title="Add tag" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="addTag">
        	<div class="form-group">
			    <label for="tagName">Enter Name</label>
			    <input type="text" v-model="data.tagName" class="form-control" id="tagName" >
			</div>
			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add tag'}}</button>
			</div>
        	</form>
        
      </div>
	</b-modal>

	<b-modal hide-footer v-model="editModal" title="Editar tag" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="editTag">
        	<div class="form-group">
			    <label for="tagName">Enter Name</label>
			    <input type="text" v-model="editData.tagName" class="form-control" id="tagName" >
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
	//const Swal = require('sweetalert2');
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
				tagName: ''
			},
			addModal : false,
			editModal : false,
			isAdding : false,
			tags : [],
			editData : {
				tagName: ''
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
		async addTag(){
			if (this.data.tagName.trim()=='') return this.flashMessage.success({
						message: 'Categoria eliminada',
						time: 500000
					});

			
			const res = await this.callApi('post', 'app/create_tag', this.data)
			
			
			if (res.status==201) {
				this.tags.unshift(res.data)
				//this.$swal('Hello Vue world!!!');
				this.$swal('Any fool can use a computer','de','success');
				//Swal.fire('Any fool can use a computer','de','success');
				/*this.flashMessage.success({
						message: 'Categoria creada',
						time: 5000
					})*/
				this.addModal = false
				this.data.tagName = ''

			} else {
				if (res.status==422) {
					if (res.data.errors.tagName) {
						this.flashMessage.error({
						message: res.data.errors.tagName[0],
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

		async editTag(){
			
			if (this.editData.tagName.trim()=='') return this.flashMessage.success({
						message: 'Categoria eliminada',
						time: 500000
					});

			const res = await this.callApi('post', 'app/edit_tags', this.editData)
			if (res.status==200) {
				this.tags[this.index].tagName = this.editData.tagName
				this.flashMessage.success({
						message: 'Categoria modificada',
						time: 5000
					})
				this.editModal = false
				
			} else {
				if (res.status==422) {
					if (res.data.errors.tagName) {
						this.flashMessage.error({
						message: res.data.errors.tagName[0],
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
		showEditModal(tag, index){
			let obj ={
				id : tag.id,
				tagName : tag.tagName
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
		console.log(this.isWritePermitted)
		const res = await this.callApi('get', 'app/get_tags');
			this.tags = res.data
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
