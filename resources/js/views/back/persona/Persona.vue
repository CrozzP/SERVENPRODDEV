<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Personas
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Personas Solicitantes</a></li>
       <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li><a href="#">Serven</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
      <li><a href="#">Personas</a></li>
      
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Persona
			</span>
		
		<div class="form-inline my-2 my-lg-0 ml-auto" >


			<b-form-select v-model="searchData.tipoSearch" :options="options"></b-form-select>
			<b-form-input id="search"  v-model="searchData.search" type="text" placeholder="Search" aria-label="Search" v-on:keyup.enter="getResults">
            </b-form-input>
			
			
			<button class="btn btn-outline-primary my-2 my-sm-0" @click="getResults"><span class="fas fa-search"></span> Buscars</button>
		</div>

			<b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
										    
			    <b-dropdown-item href="#" v-if="isReadPermitted" @click="addModal=true" ><button class="btn btn-success btn-sm"  ><span class="far fa-plus-square"></span></button> Nuevo
			    </b-dropdown-item>

			   
			  </b-dropdown>
		 
		</div>
	</div>
	<div class="row">
		<div class="col-md-12  ml-auto mr-auto" v-if="mostrar">
			<div class="card border-success">
				<div class="card-body">
					<div class="row justify-content-md-center">
						<div class="table-responsive">

						<table class="table table-hover">
								
								<thead>
									<tr>
										<td class="bg-primary text-white text-center">#</td>
										<td class="bg-primary text-white text-center">DNI</td>
										<td class="bg-primary text-white text-center">NOMBRES</td>
										<td class="bg-primary text-white text-center">APELLIDOS</td>
									
										<td class="bg-primary text-white text-center">FECHA DE CREACION</td>
										<td class="bg-primary text-white text-center">ACCIONES</td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(persona, i) in personas.data" :key="i" v-if="personas.data.length">
										<td>{{persona.id}}</td>

										<td  @click="personaExtraordinario(persona, i)" >

											<b-link href="#" style="color:#3490dc;">{{persona.dni}}</b-link>

										</td>
										
										<td>{{persona.nombre}}</td>
										<td>{{persona.apellPat}} {{persona.apellMat}}</td>
										
										
										<td>{{persona.created_at}}</td>
										<td>
											<button class="btn btn-primary btn-sm" @click="showEditModal(persona, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(persona, i)" :loading="persona.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>

							<div class="card mb-3">

								
							<advanced-laravel-vue-paginate :data="personas" @paginateTo="getResultsGeneral"></advanced-laravel-vue-paginate>


							

		
							</div>

					</div>

				</div>
			</div>
		</div>

		<div class="col-md-12  ml-auto mr-auto" v-if="mostrarBusqueda">
			<div class="card border-success">
				<div class="card-body">
					<div class="row justify-content-md-center">
						<div class="table-responsive">

						<table class="table table-hover">
								
								<thead>
									<tr>
										<td class="bg-primary text-white text-center">#</td>
										<td class="bg-primary text-white text-center">DNI</td>
										<td class="bg-primary text-white text-center">NOMBRES</td>
										<td class="bg-primary text-white text-center">APELLIDOS</td>
									
										<td class="bg-primary text-white text-center">FECHA CREACION</td>
										<td class="bg-primary text-white text-center">ACCIONES</td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(buscarPersona, i) in buscarPersonas.data" :key="i" v-if="buscarPersonas.data.length">
										<td>{{buscarPersona.id}}</td>
										<td  @click="personaExtraordinario(buscarPersona, i)" >

											<b-link href="#" style="color:#3490dc;">{{buscarPersona.dni}}</b-link>

										</td>
										
										<td>{{buscarPersona.nombre}}</td>
										<td>{{buscarPersona.apellPat}} {{buscarPersona.apellMat}}</td>
										
										
										<td>{{buscarPersona.created_at}}</td>
										<td>
											<button class="btn btn-primary btn-sm" @click="showEditModal(buscarPersona, i)" v-if="isUpdatePermitted"><span class="fa fa-edit"></span></button>
											<button class="btn btn-danger btn-sm" @click="showdeletingModal(buscarPersona, i)" :loading="buscarPersona.isDeleting" v-if="isDeletePermitted"><span class="fa fa-trash"></span>Delete</button>
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>

							<div class="card mb-3">


							<advanced-laravel-vue-paginate :data="buscarPersonas" @paginateTo="getResults"></advanced-laravel-vue-paginate>


							

		
							</div>

					</div>

				</div>
			</div>
		</div>

	</div>

	


	<b-modal  hide-footer size="lg" v-model="addModal" title="Persona nueva" :mask-closable="false" :closable="false">
	
      <div class="d-block ">
        <form v-on:submit.prevent="addPersona">

        	<b-container class="bv-example-row">
			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>

               <b-form-group id="input-group-1" label="Tipo Documento:" label-for="id">
                  <b-form-select v-model="data.tipoDocumento"  name="tipoDocumento"  >
                     <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                     <b-form-select-option :value="tipoDocumento.id" v-for="(tipoDocumento, i) in tipoDocumentos" :key="i" v-if="tipoDocumentos.length">{{tipoDocumento.nombre}}</b-form-select-option>
                  </b-form-select>
               </b-form-group>

			    	<b-form-group id="input-group-1" label="Dni :" label-for="dni" >
			        	<b-form-input id="dni" v-model="data.dni" type="text" placeholder="Ingresar el dni" >
			        	</b-form-input>
			     	</b-form-group>
			     			     	 
			    </b-col>
			    <b-col>

               <b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat" >
                    <b-form-input id="apellPat" v-model="data.apellPat" type="text" placeholder="Ingresar el Apellido Paterno" >
                    </b-form-input>
                 </b-form-group>
			    	
				     <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat" >
				        <b-form-input id="apellMat" v-model="data.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
				        </b-form-input>
				     </b-form-group>
			    </b-col>
			  </b-row>

			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>

                 <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre">
                    <b-form-input id="nombre" v-model="data.nombre" type="text" placeholder="Ingresar los nombres" >
                    </b-form-input>
                 </b-form-group>
			    	<b-form-group label="Sexo">
				      <b-form-radio v-model="data.sexo" name="some-radios" value="0">femenino</b-form-radio>
				      <b-form-radio v-model="data.sexo" name="some-radios" value="1">Masculino</b-form-radio>
				    </b-form-group>
			     			     	 
			    </b-col>
			    <b-col>

                <b-form-group id="input-group-1" label="Fecha de Nacimiento :" label-for="fechaNacimiento" >
                    <b-form-input id="fechaNacimiento" v-model="data.fechaNacimiento" type="date" placeholder="Ingresar la fecha de nacimiento" >
                    </b-form-input>
                 </b-form-group>
			    	<b-form-group id="input-group-1" label="Direccion :" label-for="direccion" >
				        <b-form-input id="direccion" v-model="data.direccion" type="text" placeholder="Ingresar la direccion" >
				        </b-form-input>
				     </b-form-group>
				     
			    </b-col>
			  </b-row>

			</b-container>

        	<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>


                 <b-form-group id="input-group-1" label="Telefono :" label-for="telefono" >
                    <b-form-input id="telefono" v-model="data.telefono" type="text" placeholder="Ingresar el telefono" >
                    </b-form-input>
                 </b-form-group>
            </b-col>
            <b-col>

			     <b-form-group id="input-group-1" label="Email :" label-for="email" >
			        <b-form-input id="email" v-model="data.email" type="email" placeholder="Ingresar el email" >
			        </b-form-input>
			     </b-form-group>

				</b-col>
			  </b-row>



			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Crear persona'}}</button>
			</div>
        	</form>
        
      </div>
	</b-modal>


	<b-modal  hide-footer size="lg" v-model="editModal" title="Editar Persona Solicitante" :mask-closable="false" :closable="false">
	
      <div class="d-block ">
        <form v-on:submit.prevent="editPersona(editData)">

        	<b-container class="bv-example-row">
			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>
               <b-form-group id="input-group-1" label="Tipo Documento:" label-for="id">
                  <b-form-select v-model="editData.tipoDocumento"  name="tipoDocumento" disabled >
                     <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                     <b-form-select-option :value="tipoDocumento.id" v-for="(tipoDocumento, i) in tipoDocumentos" :key="i" v-if="tipoDocumentos.length">{{tipoDocumento.nombre}}</b-form-select-option>
                  </b-form-select>
               </b-form-group>


			    	<b-form-group id="input-group-1" label="Dni :" label-for="dni" >
			        	<b-form-input id="dni" v-model="editData.dni" type="text" placeholder="Ingresar el dni" >
			        	</b-form-input>
			     	</b-form-group>
			     			     	 
			    </b-col>
			    <b-col>

               <b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat" >
                    <b-form-input id="apellPat" v-model="editData.apellPat" type="text" placeholder="Ingresar el Apellido Paterno" >
                    </b-form-input>
                 </b-form-group>
			    	
				     <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat" >
				        <b-form-input id="apellMat" v-model="editData.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
				        </b-form-input>
				     </b-form-group>
			    </b-col>
			  </b-row>

			  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			    <b-col>

                 <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre">
                    <b-form-input id="nombre" v-model="editData.nombre" type="text" placeholder="Ingresar los nombres" >
                    </b-form-input>
                 </b-form-group>
			    	<b-form-group label="Sexo">
				      <b-form-radio v-model="editData.sexo" name="some-radios" value="0">femenino</b-form-radio>
				      <b-form-radio v-model="editData.sexo" name="some-radios" value="1">Masculino</b-form-radio>
				    </b-form-group>
				    
			     			     	 
			    </b-col>
			    <b-col>
			    	<b-form-group id="input-group-1" label="Direccion :" label-for="direccion" >
				        <b-form-input id="direccion" v-model="editData.direccion" type="text" placeholder="Ingresar la direccion" >
				        </b-form-input>
				     </b-form-group>

				     <b-form-group id="input-group-1" label="Telefono :" label-for="telefono" >
				        <b-form-input id="telefono" v-model="editData.telefono" type="text" placeholder="Ingresar el telefono" >
				        </b-form-input>
				     </b-form-group>
				     
			    </b-col>
			  </b-row>

			</b-container>

        	

			 


			
			<br>
			<div class="text-ringth">
				<button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
				
				<button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Editar persona'}}</button>

				

			</div>
        	</form>
        
      </div>
	</b-modal>


	<b-modal  hide-footer v-model="showModalPersonaExtraordinario" title="Datos de la persona solicitante" :mask-closable="false" :closable="false" size="xl">

	<b-card
				    
    img-top
    tag="article"
    style="max-width: auto;"
    class="mb-2"
    bg-variant="primary" 
    text-variant="white" 
  >
    <b-card-text>
      <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="2" >
		<b-col>
			<p>
			<h5>
				
			DNI: 
			</h5>	
			<span>{{datosPersonaExtraordinario.dni}}</span>
			</p>
		</b-col>
		<b-col>
			<p>
				<h5>
					
			APELLIDOS Y NOMBRES: 
				</h5>

			<span>{{datosPersonaExtraordinario.apellPat}} {{datosPersonaExtraordinario.apellMat}} {{datosPersonaExtraordinario.nombre}}</span>
			</p>
		</b-col>
	</b-row>

	<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="2">
		<b-col>
			<p>
				<h5>
					
			CELULAR: 
				</h5>
			<span  class="text-uppercase">{{datosPersonaExtraordinario.telefonop}} </span>
				
			</p>
		</b-col>
		<b-col>
			<p>
				<h5>
					
			 DIRECCION:
				</h5>
			<span  class="text-uppercase">
				
			{{datosPersonaExtraordinario.direccion}}
			</span> 
			</p>
		</b-col>
	</b-row>
    	

    </b-card-text>

    
  </b-card>

  <b-card 
  border-variant="primary"
    
        header-bg-variant="primary"
        header-text-variant="white"
        align="center"

  v-for="(buscarPE, i) in buscarPersonaExtraordinario" :key="i" v-if="buscarPersonaExtraordinario.length">

  	<template #header>
        	<b-row cols="1" cols-sm="1" cols-md="3" cols-lg="3"  >

		<b-col>
			<span  >

							
			 Codigo del Registro:
			
			{{buscarPE.extraordinario.id}}

			</span> 
		</b-col>

		<b-col>
			<span  >

							
			 Serie Suministro:
			
			{{buscarPE.extraordinario.suministro_id}}
			</span> 
		</b-col>

		<b-col>

			<span  >

							
			 Tipo:
			

			<span v-if="buscarPE.extraordinario.obs_tipo_extraordinario.tipo_extraordinario.id == 1" >
				<b-button pill variant="outline-light" size="sm">{{buscarPE.extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt}}</b-button>
			</span>
			<span v-else-if="buscarPE.extraordinario.obs_tipo_extraordinario.tipo_extraordinario.id > 1" >
				
				<b-button pill variant="light" size="sm">{{buscarPE.extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt}}</b-button>

			</span>
			</span> 

		</b-col>

	</b-row>
    </template>

	




	<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1"  >

		<table class="table" >

			  <thead>
			    <tr>
			      <th scope="col">Tipo Registro</th>
			      <th scope="col">Estado Registro</th>
			      <th scope="col">Descripcion del registro</th>
			      <th scope="col">Observacion</th>
			      <th scope="col">Fecha y Hora</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			     

					<td>
						<b-button pill variant="success" size="sm" v-if="buscarPE.extraordinario.estado_extraordinario.tipo == 1">Normal</b-button>
						<b-button pill variant="warning" size="sm"  v-else-if="buscarPE.extraordinario.estado_extraordinario.tipo > 1">Reiterativo</b-button>

					</td>

					<td>
						<b-button pill variant="danger" size="sm" v-if="buscarPE.extraordinario.estado_extraordinario.estado == 1">Sin atender</b-button>
						<b-button pill variant="success" size="sm" v-else-if="buscarPE.extraordinario.estado_extraordinario.estado > 1">Atendido</b-button>
						
					</td>


			      <td>{{buscarPE.extraordinario.obs_tipo_extraordinario.descripcion}}</td>
			      <td>{{buscarPE.extraordinario.estado_extraordinario.referencia}}</td>

			      <td>{{buscarPE.extraordinario.estado_extraordinario.fechaRegistro}}</td>
			      
			    </tr>
			    
			  </tbody>
			</table>

	</b-row>	
  </b-card>

	<div class="text-ringth">
		<button type="button" class="btn btn-default" v-on:click="showModalPersonaExtraordinario=false" >Cancelar</button>
		<button class="btn btn-primary"  v-on:click="showModalPersonaExtraordinario=false" ><span class="fa fa-check"></span>Aceptar</button>
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
				
				dni : '',
				nombre : '',
				apellPat : '',
				apellMat : '',
				sexo : '',
				fechaNacimiento : '',
				direccion : '',
				telefono : '',
				email : '',
            tipoDocumento : '',


			},
			mostrar: true,
			mostrarBusqueda: false,
			showModalPersonaExtraordinario: false,

			searchData:{

			},
			options: [
	          { value: null, text: 'Please select an option' },
	          { value: 'Documento', text: 'DNI' },
	          { value: 'Nombres', text: 'Apellidos y Nombres' }
	          
	        ],


		    buscarPersona:{},
      		buscarPersonas:{},
      		buscarPersonaR:{},

			
			provincia: {
				id: 0,
				nameProvincia: '',

			},
			distrito: {
				id: 0,
				nameDistrito: '',

			},
			addModal : false,
			isAdding : false,
			editModal : false,
			showDeleteModal: false,
			personas: [],
         tipoDocumentos: [],
			editData : {
				id : '',
				dni : '',
				nombre : '',
				apellPat : '',
				apellMat : '',
				sexo : '',
				fechaNacimiento : '',
				direccion : '',
				telefono : '',
				email : '',
            tipoDocumento_id : '',
				
				
			},


			buscarPersonaExtraordinario: [],
			datosPersonaExtraordinario : {

			},

			index : -1,
			
			isDeleing: false,
			deleteItem: {},
			deletingIndex: -1,

			
		}
	},


	methods : {
		
		async addPersona(){
         if (this.data.tipoDocumento =='') return this.$swal('Tipo Documento','Es obligatorio','warning')
			if (this.data.dni.trim()=='') return this.$swal('DNI','Necesario','warning')
			if (this.data.nombre.trim()=='') return this.$swal('Nombres','Necesarios','warning')
			if (this.data.apellPat.trim()=='') return this.$swal('Apellido Paterno','Necesario','warning')
			if (this.data.apellMat.trim()=='') return this.$swal('Apellido Materno','Necesario','warning')
			if (this.data.sexo.trim()=='') return this.$swal('Seleccione sexo','Necesario','warning')
			if (this.data.direccion.trim()=='') return this.$swal('Direccion','Necesario','warning')
			if (this.data.telefono.trim()=='') return this.$swal('Telefono','Necesario','warning')
			if (this.data.email.trim()=='') return this.$swal('Email','Necesario','warning')


         let obj ={
            
            personaDni :this.data.dni,
            personaNombre : this.data.nombre,
            personaApellPat : this.data.apellPat,
            personaApellMat : this.data.apellMat,
            email : this.data.email,
            personaDireccion : this.data.direccion,
            personaTelefono : this.data.telefono,
            personaSexo : this.data.sexo,

            tipoDocumento : this.data.tipoDocumento,
            
         }

         this.datosPersona = obj

			
			//const res = await this.callApi('post', 'app/persona', this.data)
         const res = await this.callApi('post', 'app/persona', this.datosPersona)
			//const res = await this.callApi('post', 'app/persona', [this.data, this.distrito])
			
			
			if (res.status==201) {
				this.personas.unshift(res.data)

				
				this.$swal('Persona creado','Correctamente','success')
				
				
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
				} else {
					this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
				}
			}
		},


      showEditModal(persona, index){
         let obj ={
            id : persona.id,
            dni : persona.dni,
            nombre : persona.nombre,
            apellPat : persona.apellPat,
            apellMat : persona.apellMat,
            email : persona.email,
            direccion : persona.direccion,
            telefono : persona.telefono,
            sexo : persona.sexo,
            index : index,
            tipoDocumento : persona.tipoDocumento_id,

         }
         this.editData = obj
         this.editModal = true
         this.index = index
         
      },


		async editPersona(editData){
         console.log('index_____',editData)
			
			if (this.editData.tipoDocumento > 0) return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'Seleccione el tipo de documento',
					  showConfirmButton: false,
					  timer: 5000
					});
         
         if (this.editData.nombre.trim()=='') return this.$swal({
                     toast: true,
                 position: 'top-end',
                 icon: 'error',
                 title: 'Nombre del usuario requerido',
                 showConfirmButton: false,
                 timer: 5000
               });
			if (this.editData.apellPat.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'apellPat completos son requeridos',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.apellMat.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'apellMat requeridar',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.direccion.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'direccion requeridar',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.telefono==null) return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'telefono requeridar',
					  showConfirmButton: false,
					  timer: 5000
					});
			if (this.editData.sexo.trim()=='') return this.$swal({
							toast: true,
					  position: 'top-end',
					  icon: 'error',
					  title: 'sexo requeridar',
					  showConfirmButton: false,
					  timer: 5000
					});
            this.editData.vistaEditPersona = 1
            this.editData.telefonop = this.editData.telefono
			

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/persona/${editData.id}`, this.editData)
			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
            console.log('console__this::', this.buscarPersonas.data[editData.index])
            console.log('console__', editData.index)
            console.log('console__res___', res.data)
				this.personas.data[editData.index] = res.data
            this.buscarPersonas.data[editData.index] = res.data
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






		async deletePersona(deleteItem, index){
			this.isDeleing = true
			//const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			
			const res = await this.callApi('delete', `app/persona/${deleteItem.id}`, this.deleteItem)
			if(res.status==200){
				this.personas.splice(index, 1)
				

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


		showdeletingModal(persona, i){
			
			
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
		          	this.deletePersona(persona, i)
		            this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},



		

        getProvincia: function() {
        	
            axios.get('/back/app/getProvincia',{
             params: {
               departamento_id: this.data.departamento_id
             }
          }).then(function(response){
                this.provincias = response.data;
            }.bind(this));

        },

        getDistrito: function() {
        	
            axios.get('/back/app/getDistrito',{
             params: {
               provincia_id: this.data.provincia_id
             }
          }).then(function(response){
                this.distritos = response.data;
            }.bind(this));

        },

        editProvincia: function() {
        	
            axios.get('/back/app/getProvincia',{
             params: {
               departamento_id: this.editData.departamento_id
             }
          }).then(function(response){
                this.provincias = response.data;
            }.bind(this));

        },

        editDistrito: function() {
        	
            axios.get('/back/app/getDistrito',{
             params: {
               provincia_id: this.editData.provincia_id
             }
          }).then(function(response){
                this.distritos = response.data;
            }.bind(this));

        },

        getResults(page = 1) {
            axios.get('app/personaBuscar?page=' + page,{
	             params: {
	             	tipoSearch: this.searchData.tipoSearch,
	               	search: this.searchData.search

	             }
	          })
                .then(response => {
                    this.buscarPersonas = response.data;
                    this.buscarPersonaR = response.data;
                    this.mostrarBusqueda = true
                    this.mostrar = false
                   
                    console.log(response.data)
                });
        },

        getResultsGeneral(page = 1) {
            axios.get('app/persona?page=' + page,{
	             params: {
	             	

	             }
	          })
                .then(response => {
                    //this.buscarExtraordinarios = response.data;
                    //this.buscarExtraordinarioR = response.data;
                    //this.mostrarBusqueda = true
                    //this.mostrar = false
                    this.personas= response.data
                   
                    console.log(response.data)
                });
        },



		personaExtraordinario(persona, index){

			let obj ={
				
				id : persona.id,
				dni : persona.dni,
				nombre : persona.nombre,
				apellPat : persona.apellPat,
				apellMat : persona.apellMat,
				email : persona.email,
				direccion : persona.direccion,
				telefono : persona.telefono,
				sexo : persona.sexo,
				
				

			}


			this.datosPersonaExtraordinario = obj


			//axios.get(`/back/app/personaExtraordinario`, {
			//const res = await this.callApi('delete', `app/extraordinario/${deleteItem.id}`, this.deleteItem)
			axios.get(`/back/app/buscarPersonaExtraordinario/${this.datosPersonaExtraordinario.id}`,{
             params: {
               persona_id: this.datosPersonaExtraordinario.id

             }
          }).then(function(response){
                //this.obsTipoExtraordinarios = response.data;
               // console.log('es el log del mail',response.data)
                //window.open('/back/app/generate-pdf');

                 if (response.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
					
					//this.$swal('Excelent !','El correo se envio satisfactoriamente','success')

			
			this.buscarPersonaExtraordinario= response.data[0].persona_extraordinario
			//this.buscarPersonaExtraordinario= response.data.persona_extraordinario
			//this.buscarPersonaExtraordinario= response.data
			console.log('datos buscados personas',this.buscarPersonaExtraordinario )
					
					
				} else {
					if (response.status==422) {
						for(let i in response.data.errors){
							this.$swal({
								toast: true,
						  position: 'top-end',
						  icon: 'error',
						  title: response.data.errors[i][0],
						  showConfirmButton: false,
						  timer: 5000
						});
						}
					} else {
						this.$swal('Algo salio mal','Verifique los correos','error')
					}
				}

            }.bind(this));


			this.showModalPersonaExtraordinario = true
			this.index = index
			console.log('datos para persona Extraordinario ', this.datosPersonaExtraordinario)

		},






	},


		

		async created(){
			this.getResultsGeneral();
			try	{
				const [resTiDoc] = await Promise.all([
					//this.callApi('get', 'app/persona')
               this.callApi('get', 'app/tipodocumento')
					
				])
			
				//this.personas = res.data

               this.tipoDocumentos = resTiDoc.data

				//this.departamentos = resDep.data

				//console.log('esto esd:',this.departamentos)
				//console.log('esto es:',this.personas)
				//console.log('esto es:',this.departamentos)

			} catch {
				this.$swal('Any fool can use a computer','de','error')
			}

			

			
			
		},


	




}




  </script>