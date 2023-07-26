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
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true"><span class="fa fa-plus"></span> Nuevo</button>
		 <b-button @click="popToast">Show Toast with custom content</b-button>
		</div>
		<div class="card-body">
			<table class="table">
				
				<thead>
					<tr>
						<td>ID</td>
						<td>Icon image</td>
						<td>Category name</td>
						<td>Created_at</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(category, i) in categoryLists" :key="i" v-if="categoryLists.length">
						<td>{{category.id}}</td>
						<td class="table_image">
							

    
							<img :src="`/storage/${category.image}`"  :alt="`{category.name}`" class="table-img" />
						
						</td>
						<td>{{category.name}}</td>
						<td>{{category.created_at}}</td>
						<td>
							<button class="btn btn-primary btn-sm" @click="showEditModal(category, i)"><span class="fa fa-edit"></span></button>
							<button class="btn btn-danger btn-sm" @click="showDeletingModal(category, i)" :loading="category.isDeleting"><span class="fa fa-trash"></span>Delete</button>
							
						</td>
					</tr>
				</tbody>
			</table>

			

		</div>

	</div>

	<b-modal  hide-footer v-model="addModal" title="Add tag" :mask-closable="false" :closable="false">
      <div class="d-block ">
        <form v-on:submit.prevent="addCategory" >
        	
		    <div class="mt-3">Selected data.image: {{ data.image ? data.image.name : '' }}</div>
		    <br>

		    <div class="form-group">
			    <label for="image">Cambiar la imagen</label>
			    <div v-if="data.image.name">
			    	<b-img v-bind="mainProps" thumbnail fluid  src="" ref="newCategoryImageDisplay" class="w-150px" rounded ></b-img>
			    	
			    </div>
			    <input type="file" v-on:change="attachImage" ref="newCategoryImage" class="form-control" id="image" aria-describedby="emailHelp"

		      :headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
			    >
			    
			</div>


		    
        	<div class="form-group">
			    <label for="name">Enter Name</label>
			    <input type="text" v-model="data.name" class="form-control" id="name" >
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
        <form v-on:submit.prevent="editCategory">
        	<div class="form-group">
			    <label for="name">Enter Name</label>
			    <input type="text" v-model="editData.name" class="form-control" id="name" >
			</div>
			<br>

			<b-form-file v-show="isimageNew"
		      v-model="file"
		      :state="Boolean(file)"
		      placeholder="Choose a file or drop it here..."
		      drop-placeholder="Drop file here..."
		      :deaders="{'x-csrf-token' : token}"
		      action= "/app/upload"
		      accept="image/jpeg, image/png, image/gif"
		    ></b-form-file>
		    <div class="mt-3">Selected file: {{ file ? file.name : '' }}</div>
		    <br>

		    <div class="demo-upload-list" v-if="editData.image">
		    	<img :src="`${editData.image}`">
		    	<div class="demo-upload-list-cover">
		    		<Icon type="ios-trash-outline" @click="deleteImage(false)"></Icon>
		    	</div>
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
	<Modal v-model="showDeleteModal" width="360">
		<p slot="header" style="color:#f60;text-align: :center">
			<Icon type="ios-information-circle"></Icon>
			<span>Delete confirmation</span>
		</p>
		<div style="text-align: center;">
			<p>Esta seguro de eliminar?</p>
		</div>
		<div slot="footer">
			<Button type="error" size="large" long :loading="isDeleing" :disabled="isDeleing" @click="deleteTag"></Button>
			
		</div>
		
	</Modal>
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
				image: '',
				name: ''
			},
			addModal : false,
			editModal : false,
			isAdding : false,
			categoryLists : [],
			editData : {
				image: '',
				name: ''
			},
			index : -1,
			showDeleteModal: false,
			isDeleting : false,
			deleteItem: {},
			deletingIndex: -1,
			token: '',
			isimageNew: false,
			isEditingItem: false,
			websiteSettings: [],

			file: null,
		}
	},


	methods : {
		async addCategory(){
			if (this.data.name.trim()=='') return this.flashMessage.error({
						message: 'Categoria eliminada',
						time: 500000
					});
			if (this.data.image.name.trim()=='') return this.flashMessage.error({
						message: 'Categoria eliminada',
						time: 500000
					});
			let formData = new FormData();
				formData.append('name', this.data.name);
				formData.append('image', this.data.image);
			const res = await this.callApi('post', 'app/create_category', formData)
			//const response = await categoryService.addCategory(formData);
			///const response = await categoryService.addCategory(formData);
					//this.categoryLists.unshift(response.data);
			Swal.fire('Any fool can use a computer','de','success');
			//httpFile().post('/categories',data)
			if (res.status===201) {
				//console.log('dentro de 201')

				this.categoryLists.unshift(res.data)
				
				this.flashMessage.success({
						message: 'Categoria creada',
						time: 5000
					})
				this.addModal = false
				this.data.name = ''

			} else {
				if (res.status==422) {
					if (res.data.error.name) {
						this.flashMessage.error({
						message: res.data.errors.name[0],
						time: 5000
					});
					}
					if (res.data.error.image) {
						this.flashMessage.error({
						message: res.data.errors.image[0],
						time: 5000
					});
					}
				} else {
					this.flashMessage.success({
						message: 'Some error occurred, please refresh',
						time: 5000
					});
				}
			}
		},
		attachImage(){
				this.data.image = this.$refs.newCategoryImage.files[0];
				let reader = new FileReader();
				reader.addEventListener('load', function(){
					this.$refs.newCategoryImageDisplay.src = reader.result;
				}.bind(this), false);
				reader.readAsDataURL(this.data.image);
			},




		async editCategory(){
			if (this.editData.name.trim()=='') return this.flashMessage.success({
						message: 'Categoria es requerido',
						time: 500000
					});
			if (this.editData.image.trim()=='') return this.flashMessage.success({
						message: 'La imagen es requerido',
						time: 500000
					});

			const res = await this.callApi('post', 'app/edit_cataegory', this.editData)
			if (res.status==200) {
				this.categoryLists[this.index].name = this.editData.name
				this.flashMessage.success({
						message: 'Categoria modificada',
						time: 5000
					})
				this.editModal = false
				
			} else {
				if (res.status==422) {
					if (res.data.errors.name) {
						this.flashMessage.error({
						message: res.data.errors.name[0],
						time: 5000
					});
					}
					if (res.data.errors.image) {
						this.flashMessage.error({
						message: res.data.errors.image[0],
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
		showEditModal(category, index){
			let obj ={
				id : category.id,
				name : category.name
			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},


	/*	async deleteTag(){
			this.isDeleing = true
			const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
				if (res.status==200) {
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
					

		},*/

		showDeletingModal(category, i){
			const deleteModalObj = {
				showDeleteModal : true,
				deleteUrl : 'app/delete_category',
				data : category,
				deletingIndex: i,
				isDeleted: false,

			}
			this.$store.commit('setDeletingModalObj', deleteModalObj)
			

			//this.deleteItem = tag
			//this.deletingIndex = i
			//this.showDeleteModal = true
		},

		handleSuccess (res, file){
			re = `/upload/${res}`
			if(this.isEditingItem){
				return this.editData.image = res
			}
			this.data.image = res
		},

		handleError (res, file){

		},

		handleFormatError (file){

		},

		handleMaxSize (file){

		},

		async dleteImage(isAdd=true){
			let image
			if(!isAdd){
				this.isimageNew=true
				image = this.editData.image
				this.editData.image = ''
				this.$refs.uploads.clearFiles()
			} else {
				image = this.data.image
				this.data.image = ''
				this.$refs.uploads.clearFiles()
			}

			const res = await this.callApi('post', 'app/delete_image', {imageName: image})
			if(res.status!=200){
				this.data.image = image
				this.flashMessage.error({
						message: 'Some error occurred, please refresh',
						time: 5000
					});

			}
		},

		closeEditModal(){
			this.isEditingItem = false
			this.editModal = false
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
		this.token = window.Laravel.csrfToken
		const res = await this.callApi('get', 'app/get_category');
			this.categoryLists = res.data
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
				this.categoryLists.splice(obj.deletingIndex,1)
				
				
			}
		},
	},

}
</script>
