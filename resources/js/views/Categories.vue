<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Categorias
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario Crozz2</li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Categorias
			</span>
		<button class="btn btn-primary btn-sm ml-auto" v-on:click="showNewCategoryModal"><span class="fa fa-plus"></span> Nuevo</button>
		</div>
		<div class="card-body">
			<table class="table">
				
				<thead>
					<tr>
						<td>#</td>
						<td>Name</td>
						<td>Image</td>
						<td>Action</td>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(category, index) in categories" :key="index">
						<td>{{index+1}}</td>
						<td>{{category.name}}</td>
						
						<td>
							<img :src="`${$store.state.serverPath}/storage/${category.image}`" :alt="`{category.name}`" class="table-img" />
						</td>
						<td>
							<button class="btn btn-primary btn-sm" v-on:click="editCategory(category)"><span class="fa fa-edit"></span></button>
							<button class="btn btn-danger btn-sm" v-on:click="deleteCategory(category)" ><span class="fa fa-trash"></span></button>
						</td>
					</tr>
				</tbody>
			</table>

			<div class="text-center" v-show="moreExists" >
				<button type="button" class="btn btn-primary btn.sm" v-on:click="loadMore" > <span class="fa fa-arrow-down">Mas...</span> </button>
			</div>

		</div>

	</div>

	<b-modal ref="newCategoryModal" hide-footer title="Nueva Categoria">
      <div class="d-block ">
        <form v-on:submit.prevent="CreateCategory">
        	<div class="form-group">
			    <label for="name">Enter Name</label>
			    <input type="text" v-model="categoryData.name" class="form-control" id="name" >
			    <div class="invalid-feebdack" v-if="errors.name">{{ errors.name[0] }}</div>
			</div>
			<div class="form-group">
			    <label for="image">Cambiar la imagen</label>
			    <div v-if="categoryData.image.name">
			    	<img src="" ref="newCategoryImageDisplay" class="w-150px" />
			    </div>
			    <input type="file" v-on:change="attachImage" ref="newCategoryImage" class="form-control" id="image" aria-describedby="emailHelp">
			    <div class="invalid-feebdack" v-if="errors.image">{{ errors.image[0] }}</div>
			</div>
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="hideNewCategoryModal">Cancelar</button>
				<button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Guardar</button>
			</div>
        	
        </form>
      </div>
      
    </b-modal>
    <b-modal ref="editCategoryModal" hide-footer title="Actualizar Categoria">
      <div class="d-block ">
        <form v-on:submit.prevent="updateCategory">
        	<div class="form-group">
			    <label for="name">Enter Name</label>
			    <input type="text" v-model="editCategoryData.name" class="form-control" id="name" >
			    <div class="invalid-feebdack" v-if="errors.name">{{ errors.name[0] }}</div>
			</div>
			<div class="form-group">
			    <label for="image">Cambiar la imagen</label>
			    <div>
			    	<img :src="`${$store.state.serverPath}/storage/${editCategoryData.image}`" ref="editCategoryImageDisplay" class="w-150px" />
			    </div>
			    <input type="file" v-on:change="editAttachImage" ref="editCategoryImage" class="form-control" id="image" aria-describedby="emailHelp">
			    <div class="invalid-feebdack" v-if="errors.image">{{ errors.image[0] }}</div>
			</div>
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="hideEditCategoryModal">Cancelar</button>
				<button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Actualizar</button>
			</div>
        	
        </form>
      </div>
      
    </b-modal>

</base-layout>

</template>

<script>
	import Breadcrumbs from '../components/layouts/back/includes/Breadcrumbs.vue';
	import * as categoryService from '../services/category_service';
	export default{
		components: {
			Breadcrumbs
			
		},

		name: 'category',
		data() {
			return {
				categories: [],
				categoryData: {
					name: '',
					image: ''
				},
				moreExists: false,
				nextPage: 0,
				editCategoryData: {},

				errors: {}
			}
		},
		
		methods: {
			
			loadCategories: async function(){
				try {
					const response = await categoryService.loadCategories();
					console.log(response);
					this.categories = response.data.data;
					console.log(this.categories);
					if (response.data.current_page < response.data.last_page) {
						this.moreExists = true;
						this.nextPage = response.data.current_page + 1;
					} else {
						this.moreExists = false;
					}

				} catch (error){
					this.flashMessage.error({
						message: 'Some error occurred, please refresh',
						time: 5000
					});
				}
			},
			attachImage(){
				this.categoryData.image = this.$refs.newCategoryImage.files[0];
				let reader = new FileReader();
				reader.addEventListener('load', function(){
					this.$refs.newCategoryImageDisplay.src = reader.result;
				}.bind(this), false);
				reader.readAsDataURL(this.categoryData.image);
			},
			hideNewCategoryModal() {
				this.$refs.newCategoryModal.hide();
			},
			showNewCategoryModal() {
				this.$refs.newCategoryModal.show();
			},
			CreateCategory: async function(){
				let formData = new FormData();
				formData.append('name', this.categoryData.name);
				formData.append('image', this.categoryData.image);

				try{
					const response = await categoryService.createCategory(formData);
					this.categories.unshift(response.data);
					console.log(response);
					this.hideNewCategoryModal();
					this.flashMessage.success({
						message: 'Category stored successfully!',
						time: 5000
					});
					this.categoryData= {
						name: '',
						image: ''
					};
				} catch (error){
					switch (error.response.status){
						case 422:
							this.errors = error.response.data.errors;
							break;
						default:
							this.flashMessage.error({
								message: 'Ocurrio un error, Nuevamente!',
								time: 5000
							});
							breack;
					}

				}
			},
			deleteCategory: async function (category){
				if (!window.confirm(`Estas seguro de eliminar ${category.name}`)) {
					return;
				}
				try {
					await categoryService.deleteCategory(category.id);
  
					this.categories = this.categories.filter(obj => {
						return obj.id != category.id;

					});

					this.flashMessage.success({
						message: 'Categoria eliminada',
						time: 5000
					});

				} catch (error){
					this.flashMessage.error({
						message: error.response.data.message,
						time: 5000
					});
				}
			},
			hideEditCategoryModal(){
				this.$refs.editCategoryModal.hide();
			},
			showEditCategoryModal(){
				this.$refs.editCategoryModal.show();
			},
			editCategory(category){
				this.editCategoryData = {...category};
				this.showEditCategoryModal();
			},
			editAttachImage(){
				this.editCategoryData.image = this.$refs.editCategoryImage.files[0];
				let reader = new FileReader();
				reader.addEventListener('load', function(){
					this.$refs.editCategoryImageDisplay.src = reader.result;
				}.bind(this), false);
				reader.readAsDataURL(this.editCategoryData.image);
			},
			updateCategory: async function(){
				try {
					const formData = new FormData();
					formData.append('name', this.editCategoryData.name);
					formData.append('image', this.editCategoryData.image);
					formData.append('_method','put');

					const response = await categoryService.updateCategory(this.editCategoryData.id, formData);
					this.categories.map(category => {
						if (category.id == response.data.id){
							for (let key in response.data) {
								category[key] = response.data[key];
							}
							
						}
					});

					this.hideEditCategoryModal();
					this.flashMessage.success({
						message: 'Categoria actualizada',
						time: 5000
					});

				} catch (error){
					this.flashMessage.error({
						message: 'error',
						time: 5000
					});
				}
			},
			loadMore: async function(){
				try {
					const response = await categoryService.loadMore(this.nextPage);
					if (response.data.current_page < response.data.last_page) {
						this.moreExists = true;
						this.nextPage = response.data.current_page + 1;
					} else {
						this.moreExists = false;
					}

					response.data.data.forEach(data => {
						this.categories.push(data);
					});
				} catch (error){
					this.flashMessage.error({
						message: 'Error al cargar mas ...',
						time: 5000
					});
				}
			}
		}
	}
</script>
