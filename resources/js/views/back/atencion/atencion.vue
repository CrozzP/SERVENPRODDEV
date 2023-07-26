<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Atencion
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Usuarios del sistema</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario</li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Atencion
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
										<td>TipoAtencion de Atencion</td>
										<td>DNI</td>
										<td>Fecha de Registro</td>
										<td>Observacion</td>
										<td>Usuario</td>
										
										
										
										<td>Acciones</td>
									</tr>
								</thead>
								<tbody>
									 
									<tr v-for="(atencion, i) in atenciones" :key="i" v-if="atenciones.length">
										<td>{{atencion.id}}</td>
										<td>{{atencion.tipoAtencion_id}}</td>
										<td>{{atencion.dni}}</td>
										<td>{{atencion.fechaRegistro}}</td>
										<td>{{atencion.observacion}}</td>
										<td>{{atencion.user_id}}</td>
										
										
										
										
										<td>
											<button class="btn btn-primary btn-sm" @click="showEditModal(atencion, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(atencion, i)" :loading="atencion.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>
											
										</td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>

		
	

<b-modal  hide-footer v-model="addModal" title="Registrar Atencion" size="lg"  >
	<div class="d-block " >
		<b-overlay :show="cargar" rounded="lg" 
		
      
      >
      <template #overlay>
        <div class="d-flex align-items-center">
          <b-spinner small type="grow" variant="info"></b-spinner>
          <b-spinner type="grow" variant="primary"></b-spinner>
          <b-spinner small type="grow" variant="info"></b-spinner>
          <!-- We add an SR only text for screen readers -->
          <span class="sr-only">Please wait...</span>
        </div>
      </template>
	        <form v-on:submit.prevent="addAtencion(regData)">
	        	<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
				    <b-col>

				    	
					     <b-form-group id="input-group-1" label="Seleccionar tipo de Atencion:" label-for="tipoAtencion_id">
					        <b-form-select v-model="regData.tipoAtencion_id" class="mb-3" name="atencion"  >
						      
						        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
						      
						     
						      
						        <b-form-select-option :value="tipoAtencion.id" v-for="(tipoAtencion, i) in tipoAtenciones" :key="i" v-if="tipoAtenciones.length">{{tipoAtencion.nombre}}</b-form-select-option>
						    </b-form-select>


					      </b-form-group>	

					</b-col>
					<b-col>

						<b-form-group id="input-group-1" label="DNI :" label-for="dni" >
					        <b-form-input id="dni" v-model="regData.dni" type="text" placeholder="Ingresar el dni" >
					        </b-form-input>
					     </b-form-group>


					</b-col>
				</b-row>
				<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
				    <b-col>
				    	 <b-form-group id="input-group-1" label="Observacion :" label-for="observacion" >
						        <b-form-input id="observacion" v-model="regData.observacion" type="text" placeholder="Ingresar el observacion" >
						        </b-form-input>
						     </b-form-group>

				    </b-col>
				</b-row>

					<br>
					<div class="text-ringth">
						
						<button type="button" class="btn btn-default" v-on:click="regModal=false">Cancelar</button>
						
						<button class="btn btn-primary"  ><span class="fa fa-check"></span>Registrar</button>



					</div>
	        </form>
        </b-overlay>
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
				
			},

			cargar: false,

			addModal: false,
			regData: {},
			atencion: {},

			atenciones:[],
			tipoAtenciones:[],


			
		}
	},


	methods : {
		

		async addAtencion(){
		/*
			if (this.data.dni.trim()=='') return this.$swal('DNI','Necesario','warning')
			if (this.data.nombre.trim()=='') return this.$swal('Nombres','Necesarios','warning')
			if (this.data.apellPat.trim()=='') return this.$swal('Apellido Paterno','Necesario','warning')
			if (this.data.apellMat.trim()=='') return this.$swal('Apellido Materno','Necesario','warning')
			if (this.data.sexo.trim()=='') return this.$swal('Seleccione sexo','Necesario','warning')
			if (this.data.fechaNacimiento.trim()=='') return this.$swal('Fecha de Nacimiento','Necesario','warning')
			if (this.data.direccion.trim()=='') return this.$swal('Direccion','Necesario','warning')
			if (this.data.telefono.trim()=='') return this.$swal('Telefono','Necesario','warning')
			if (this.data.email.trim()=='') return this.$swal('Email','Necesario','warning')
*/
			this.cargar= true
			const res = await this.callApi('post', 'app/atencion', this.regData)
			//const res = await this.callApi('post', 'app/persona', [this.data, this.distrito])
			
			
			if (res.status==201) {
				this.atenciones.unshift(res.data)

				
				this.$swal('Atencion registrado','Correctamente','success')
				
				this.cargar= false
				this.addModal = false
				

			} else {
				if (res.status===422) {
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
				} else {//this.cargar= false
					this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
				}
			}
		},
		




	},

	async created(){
			try	{
				const [res, resa] = await Promise.all([
					this.callApi('get', 'app/atencion'),
					this.callApi('get', 'app/tipoatencion')
				])
			
				this.atenciones = res.data
				this.tipoAtenciones = resa.data

				//console.log('esto esd:',this.departamentos)
				//console.log('esto es:',this.personas)
				//console.log('esto es:',this.departamentos)

			} catch {
				this.$swal('Algo salio mal','Reintente','error')
			}

			

			
			
		},


		

		


	




}




  </script>