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
			
			  
  			

  			<editor 
  			 ref="editor"
                                autofocus
                                holder-id="codex-editor"
                                save-button-id="save-button"
                                :init-data="initData"
                                @save="onSave"
								:config="config"
  			/>


			 
			  <Button @click="save" :loading="isCreating" :disabled="isCreating">{{isCreating ? 'Please wait...' : 'Create blog'}}</Button>
			

		</div>

	</div>

	






	
</base-layout>

</template>

<script>

	const Swal = require('sweetalert2');

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';

export default{
	components: {
		Breadcrumbs,
		
		
	},



	data(){
		return {
			config: {
				autofocus: true,
        

		        
		      },
		     initData: null,

			data : {
				
			},
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

		onSave(response){
			console.log('response on save',response)
		},

		async save(){
			//const res = await this.$refs.editor.save()
			//console.log('res is this:', res)
			console.log(this.$refs.editor.save());
		},

		onInitialized (editor) {
	      console.log(editor)
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


	},
	},


	
	

}
</script>
