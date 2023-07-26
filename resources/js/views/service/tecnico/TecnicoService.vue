<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Tecnico
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Casos Asigados</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Tecnico Crozz</li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Registros
			</span>
		<button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
      <button class="btn btn-primary btn-sm ml-auto" @click="cargarAtencionModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Cargar Archivo</button>
		 
		</div>
	</div>
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">

							<div class="col-md-12  ml-auto mr-auto" v-if="mostrar">
								<div class="card border-primary">
									<div class="card-body">
										<div class="row justify-content-md-center">
											<div class="table-responsive-xl">
												
											<table class="table table-hover tablaSuministro" v-if="isReadPermitted" >
												
												<thead>
													<tr>
														<td class="bg-primary text-white text-center">#</td>
														<td class="bg-primary text-white text-center">SUMINISTRO</td>
														<td class="bg-primary text-white text-center">TITULAR SUMINISTRO</td>
														<td class="bg-primary text-white text-center">TIPO REGISTRO </td>
														<td class="bg-primary text-white text-center">FECHA REGISTRO</td>
														<td class="bg-primary text-white text-center">DIRECCION</td>
														<td class="bg-primary text-white text-center">ACCIONES</td>
													</tr>
												</thead>
												<tbody>
													
													<tr v-for="(extraordinario, i) in tecnicoRegistros.data" :key="i" v-if="tecnicoRegistros.data.length" :class="extraordinario.estado_extraordinario.estado == '4' ? 'table-primary' : extraordinario.estado_extraordinario.estado == '5' ? 'table-success': ' '" >
														<td>{{extraordinario.estado_extraordinario.id}}</td>
														<td>{{extraordinario.estado_extraordinario.extraordinario.suministro_id}}</td>
														<td>{{extraordinario.estado_extraordinario.extraordinario.suministro.NombreSuministro}}</td>
														<td>{{extraordinario.estado_extraordinario.extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt}}</td>
														<td>{{extraordinario.estado_extraordinario.extraordinario.suministro.DireccionPredio}}</td>
														<td>{{extraordinario.estado_extraordinario.fechaRegistro}}</td>
														<td>
															<b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">

															    <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado == '3'" @click="aceptarRegistro(extraordinario.estado_extraordinario, i)" ><button class="btn btn-primary btn-sm"  ><span class="fa fa-eye"></span></button> Aceptar
															    </b-dropdown-item>

															    <b-dropdown-item href="#" v-if="isReadPermitted" @click="showExtraordinario(extraordinario.estado_extraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-eye"></span></button> Ver
															    </b-dropdown-item>

															    <b-dropdown-item href="#" v-if="isUpdatePermitted && extraordinario.estado_extraordinario.estado == '4'" @click="atenderExtraordinario(extraordinario.estado_extraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-edit"></span></button> Atencion PRE 
															    </b-dropdown-item>

															    <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado == '4'" @click="atenderExtraordinarioPost(extraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-edit"></span>  </button> Atencion POST
															    </b-dropdown-item>

															    <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado == '5'" @click="reportePdfAtencion(extraordinario, i)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-file-pdf"></span></button> PDF
															    </b-dropdown-item>

															</b-dropdown>

														</td>
														

														
													</tr>
												</tbody>
											</table>
											
										</div>
											<div class="card mb-3">

												
											<advanced-laravel-vue-paginate :data="extraordinarios" @paginateTo="getResultsGeneral"></advanced-laravel-vue-paginate>


											

						
											</div>


										</div>
										

									</div>
								</div>
							</div>

							<div class="col-md-12  ml-auto mr-auto" v-if="mostrarBusqueda">
								<div class="card border-primary">
									<div class="card-body">
										<div class="row justify-content-md-center" >
											<div class="table-responsive-xl">
												
											<table class="table table-hover tablaSuministro">
												
												<thead >
													<tr>
														<td class="bg-primary text-white text-center">#</td>
														<td class="bg-primary text-white text-center">DNI SOLICITANTE</td>
														<td class="bg-primary text-white text-center">SUMINISTRO</td>
														<td class="bg-primary text-white text-center">TITULAR SUMINISTRO</td>
														<td class="bg-primary text-white text-center">TIPO REGISTRO </td>
														<td class="bg-primary text-white text-center">FECHA REGISTRO</td>
														<td class="bg-primary text-white text-center">ACCIONES</td>
													</tr>
												</thead>
												<tbody>
													<tr v-for="(buscarExtraordinario, i) in buscarExtraordinarios.data" :key="i" v-if="buscarExtraordinarios.data.length">
														<td>{{buscarExtraordinario.id}}</td>
														<td @click="personaExtraordinario(buscarExtraordinario, i)" >

															<b-link href="#" style="color:#3490dc;">{{buscarExtraordinario.persona_extraordinario.persona.dni}}</b-link>

														</td>
														<td>{{buscarExtraordinario.suministro_id}}</td>
														<td>{{buscarExtraordinario.suministro.NombreSuministro}}</td>
														
														
														<td v-if="buscarExtraordinario.obs_tipo_extraordinario.tipoExtraordinario_id == 1" >
															
															<strong class="text-info">Reconexion<b-badge variant="primary" v-if="buscarExtraordinario.estado_extraordinario.tipo == 1">Nor</b-badge>
																<b-badge variant="danger" v-else-if="buscarExtraordinario.estado_extraordinario.tipo > 1" >Rei</b-badge>
															</strong>

														</td>
														<td v-else-if="buscarExtraordinario.obs_tipo_extraordinario.tipoExtraordinario_id == 2" >
															
														
															<strong class="text-secondary">Reparacion<b-badge variant="primary" v-if="buscarExtraordinario.estado_extraordinario.tipo == 1">Nor</b-badge>
															<b-badge variant="danger" v-else-if="buscarExtraordinario.estado_extraordinario.tipo > 1" >Rei</b-badge>
															</strong>
															

														</td>
														
														
														<td>{{buscarExtraordinario.estado_extraordinario.fechaRegistro}}</td>
														
														
														<td>
															<b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">

														    <b-dropdown-item href="#" v-if="isReadPermitted" @click="showExtraordinarioModal(buscarExtraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-eye"></span></button> Ver
														    </b-dropdown-item>

														    <b-dropdown-item href="#" v-if="isUpdatePermitted" @click="editExtraordinarioModal(buscarExtraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-edit"></span></button> Editar
														    </b-dropdown-item>

														    <b-dropdown-item href="#" v-if="isWritePermitted" @click="reportePDF(buscarExtraordinario, i)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-file-pdf"></span></button> PDF
														    </b-dropdown-item>

														    <b-dropdown-item href="#" v-if="isWritePermitted" @click="getMailExtraordinario(buscarExtraordinario, i)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-paper-plane"></span></button> Enviar
														    </b-dropdown-item>
														    
														    <b-dropdown-item href="#" v-if="isDeletePermitted" @click="showdeletingModal(buscarExtraordinario, i)" ><button class="btn btn-danger btn-sm"  ><span class="fa fa-trash"></span></button> Eliminar
														    </b-dropdown-item>

														    <b-dropdown-item href="#" v-if="isWritePermitted" @click="reiterativoExtraordinario(buscarExtraordinario, i)" ><button class="btn btn-warning btn-sm"  ><span class="fa fa-plus"></span></button> Reiterativo
														    </b-dropdown-item>
														
														  </b-dropdown>

														</td>
														
														
													</tr>
												</tbody>
											</table>
											
										</div>
											<div class="card mb-3">

												
											<advanced-laravel-vue-paginate :data="buscarExtraordinarios" @paginateTo="getResults"></advanced-laravel-vue-paginate>


											

						
											</div>


										</div>

									</div>
								</div>
							</div>
							
						</div>

					</div>
				</div>
			</div>
		</div>

		

				



<b-modal  hide-footer v-model="showExtraordinarioModal"  :mask-closable="false" :closable="false" size="xl" title="Asignar Tecnico" >

	 <template #modal-title>
	 	<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
	 		<b-col>
	 			<h4>Datos registrados</h4>
	 		</b-col>
	 		<b-col>
	 			 Usuario del registro <code>{{extraordinarioData.nombreUsuario}}</code>
	 		</b-col>
	 	</b-row>
	 	
     
    </template>

		<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
			<b-col>
				<b-card
				
				    border-variant="primary"
			        header="Datos del Suministro"
			        header-bg-variant="primary"
			        header-text-variant="white"
			        align="center"
				  >
				  	
				    <b-card-text>

				      <div>
				      	<b-table-simple small caption-top stacked class="tablaInforme">
    
						    <b-tbody>
						      <b-tr>
						        <b-th stacked-heading="Codigo del suministro"  >{{extraordinarioData.suministro_id}}</b-th>
						        <b-td stacked-heading="Codigo de Ruta">{{extraordinarioData.codigoRuta}}</b-td>
						        <b-td stacked-heading="Nombre del Suministro">{{extraordinarioData.nombreSuministro}}</b-td>
						        <b-td stacked-heading="Documento">{{extraordinarioData.documento}}</b-td>
						        <b-td stacked-heading="Direccion del Predio">{{extraordinarioData.direccionSuministro}}</b-td>
						        <b-td stacked-heading="Nombre Zona">{{extraordinarioData.zonaSuministro}}</b-td>
						        <b-td stacked-heading="Distrito">{{extraordinarioData.distritoSuministro}}</b-td>
						        <b-td stacked-heading="Tarifa || Serie Medidor">{{extraordinarioData.tarifaSuministro}} || {{extraordinarioData.serieMedidor}}</b-td>
						      </b-tr>
						      
						    </b-tbody>
						    
						  </b-table-simple>

				      </div>

				    </b-card-text>
 
				  </b-card>
				</b-col>
			<b-col>
				<b-card
				    border-variant="primary"
			        header="Datos del Solicitante"
			        header-bg-variant="primary"
			        header-text-variant="white"
			        align="center"
				  >
				    <b-card-text>

				    <div>
				      	<b-table-simple small caption-top stacked class="tablaInforme">
    
						    <b-tbody>
						      <b-tr>
						        <b-th stacked-heading="DNI del solicitante"  >{{extraordinarioData.dniSolicitante}}</b-th>
						        <b-td stacked-heading="Apellido paterno">{{extraordinarioData.apellidoPaternoSolicitante}}</b-td>
						        <b-td stacked-heading="Apellido materno">{{extraordinarioData.apellidoMaternoSolicitante}}</b-td>
						        <b-td stacked-heading="Nombres">{{extraordinarioData.nombreSolicitante}}</b-td>
						        <b-td stacked-heading="Telefono">{{extraordinarioData.telefonoSolicitante}}</b-td>
						        <b-td stacked-heading="Sexo">
						        	<div v-if="extraordinarioData.sexoSolicitante == 1">
										MASCULINO
								    </div>
								    <div v-if="extraordinarioData.sexoSolicitante == 2">
									  FEMENINO
								    </div>
								    <div v-else>
									  -
								    </div>
								  </b-td>
						      </b-tr>
						      
						    </b-tbody>
						    
						  </b-table-simple>

				    </div>

				    </b-card-text>

				    
				  </b-card>
				  <div>
					  <b-button block   variant="outline-primary" size="sm"><span class="fa fa-eye"></span> Atencion</b-button>
					  <b-button block   variant="outline-danger" size="sm"><span class="fa fa-eye"></span> PDF</b-button>
					</div>
			</b-col>

		</b-row>
		<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
			<b-col>
				
				  

      <b-card
        border-variant="success"
        header="Datos del Caso"
        header-bg-variant="primary"
        header-text-variant="white"
        align="center"


      >

        <b-card-text class="text-uppercase">
				      <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="4">
						<b-col>
							<h6>Observacion:</h6>
							<span>{{extraordinarioData.observacionExtraordinario}}</span>
						</b-col>
						<b-col>
							<h6>Tipo :</h6>
							<span>{{extraordinarioData.estadoExtraordinario}}</span>
						</b-col>
						<b-col>
							<h6>Observacion :</h6>
							<span>{{extraordinarioData.referencia}}</span>
						</b-col>
						<b-col>
							<h6>Estado :</h6>
							
							<div v-if="extraordinarioData.tipoExtraordinario == 1">
								<span>NORMAL</span>
							</div>
							<div v-else>
								<span>REITERATIVO</span>
							</div>
						</b-col>
						
					</b-row>

				    </b-card-text>
      </b-card>
			</b-col>

		</b-row>
</b-modal>

	
<b-modal  hide-footer v-model="atenderExtraordinarioModal"  :mask-closable="false" :closable="false" size="xl" title="Asignar Tecnico" >

		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">
						
							<div class="col-md-12">
								<div class="card card-dark bg-primary-gradient">
									<div class="card-body bubble-shadow">
										<h1>188</h1>
										<h5 class="op-8">Total Sales</h5>
										<div class="pull-right">
											<h3 class="fw-bold op-8">25%</h3>
										</div>
									</div>
								</div>
							</div>
							
						</div>

						<b-container class="bv-example-row">
						  <b-row  class="text-center">
						    <b-col>
								  <b-button block variant="outline-primary">Button</b-button>
								</b-col>
						    <b-col>
								  <b-button block variant="outline-primary">Button</b-button>
								</b-col>
						  </b-row>
						</b-container>

						<div>

			
							<form v-on:submit.prevent="subirAtencionExtraordinario">

  <b-tabs
    active-nav-item-class="font-weight-bold text-uppercase text-danger"
    active-tab-class="font-weight-bold text-success"
    content-class="mt-3"
    fill
  >
    <b-tab title="First" active>
    	
	<div class="form-group-row">
								<h3>Cargar imagenes</h3>
								</div>

							

							<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
								<b-col>
								    <b-form-group id="input-group-1" label="Reparacion :" label-for="image">
								<input type="file" v-on:change="attachImage1" ref="newDescuentoImage1" class="form-control" id="data.image1" aria-describedby="emailHelp" 


								:headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
								>

								</b-form-group>

								</b-col>
								<b-col >

								<b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay1" alt="Image 1" ></b-img>



								</b-col>
							</b-row>

							<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
								<b-col>
								    <b-form-group id="input-group-1" label="Medidor :" label-for="image">
								<input type="file" v-on:change="attachImage2" ref="newDescuentoImage2" class="form-control" id="data.image2" aria-describedby="emailHelp" 


								:headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
								>

								</b-form-group>

								</b-col>
								<b-col >

								<b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay2" alt="Image 1" ></b-img>
								

								</b-col>
							</b-row>

							<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
								<b-col>
								    <b-form-group id="input-group-1" label="Usuario :" label-for="image">
								<input type="file" v-on:change="attachImage3" ref="newDescuentoImage3" class="form-control" id="data.image3" aria-describedby="emailHelp" 


								:headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
								>

								</b-form-group>

								</b-col>
								<b-col >

								<b-img v-bind="mainProps" thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay3" alt="Image 1" ></b-img>



								</b-col>
							</b-row>


						    	</b-tab>
						    	<b-tab title="Second">


						
							<div id="pru">
									<vueSignature ref="signature" :sigOption="option" :w="'400px'" :h="'200px'" :disabled="disabled" :defaultUrl="dataUrl"></vueSignature> 

									<button @click="save">Save</button>
									<button @click="clear">Clear</button>
									<button @click="undo">Undo</button>
									<button @click="addWaterMark">addWaterMark</button>
									<button @click="handleDisabled">disabled</button>
								</div>

    	


									<br>


										<!--button class="btn btn-primary" v-on:click="addUser"><span class="fa fa-check"></span>: Add role</button-->
									<button class="btn btn-primary"  ><span class="fa fa-check"></span>: subir imagen</button>
							    </b-tab>
							  </b-tabs>
														
							

							</form>	

			

						</div>


					</div>
				</div>
			</div>
		</div>


</b-modal>



<b-modal  hide-footer v-model="cargarAtencionModal"  :mask-closable="false" :closable="false" size="xl" title="Cargar Archivos" >

   <b-form-group
        id="input-group-1"
        label="Cargar Archivo:"
        label-for="input-1"
        description="Cargar archivo en formato .XLSX o .xls"
      >
      <b-form-file
         v-model="dataCarga.excel"
         placeholder="Choose a file or drop it here..."
         drop-placeholder="Drop file here..."
       ></b-form-file>

   </b-form-group>

   <button class="btn btn-primary" @click="subirArchivoExcel(dataCarga)" ><span class="fa fa-check"></span>Subir archivo</button>

</b-modal>



</base-layout>

</template>

<script>


import * as categoryService from '../../../services/category_service';
import vueSignature from "vue-signature"

export default{
		name: "pru",
	components: {
		
		vueSignature,
		
		
	},
	



	data(){
		return {
			

			data : {
					
					file:'',
					file2:'',
					image:'',
					},
			mainProps: { blank: true, width: 360, height: 1, class: 'm1' },


			mostrar: true,
			showExtraordinarioModal: false,
			atenderExtraordinarioModal: false,
         cargarAtencionModal: false,

			tecnicoRegistros: [],
			extraordinarioData:{},
         dataCarga:{},

			option:{
				penColor:"rgb(0, 0, 0)",
				backgroundColor:"rgb(255,255,255)"
			},
			disabled:false,
			dataUrl:"",

			pruebas:[],
			
		}
	},


	methods : {

		async aceptarExtraordinario(extraordinario ,index){
			

			const res = await this.callApi('put', `app/aceptarExtraordinario/${extraordinario.id}`, extraordinario)
			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				console.log('pruebitas: ',this.tecnicoRegistros.data[index].estado_extraordinario.estado);
				//console.log('pruebitas 222: ',res.data);
				//this.roles[this.index].roleName = this.editData.roleName
				//this.tecnicoRegistros.data[this.index] = this.extraordinario
				this.tecnicoRegistros.data[index].estado_extraordinario.estado = res.data.estado
				//this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
				//this.editModal = false
				
			} else {
				
					this.$swal('Algo salio mal !','Verificar','error')
				
			}

		},


		async aceptarRegistro(extraordinario ,i){
			this.$swal({
		          title: '¿ Estas seguro de Aceptar?',
		          text: 'No puedes revertir despues de esta accion',
		          icon: 'warning',
		          
		          showCancelButton: true,
		          confirmButtonColor: '#3085d6',
			  	  cancelButtonColor: '#d33',
		          confirmButtonText: 'Si, Aceptar!',
		          cancelButtonText: 'Cancelar!',
		          showCloseButton: true,
		          showLoaderOnConfirm: true
		        }).then((result) => {
		          if(result.value) {
		          	this.aceptarExtraordinario(extraordinario, i)
		            this.$swal('Aceptado', 'Usted acepto el registro corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},



		async showExtraordinario(extraordinario ,index){
			console.log('datos extraordinarios', extraordinario)

			let obj ={

				id : extraordinario.id,

				suministro_id : extraordinario.extraordinario.suministro_id,

				codigoRuta : extraordinario.extraordinario.suministro.CodigoRutaSuministro,
				nombreSuministro : extraordinario.extraordinario.suministro.NombreSuministro,
				documento : extraordinario.extraordinario.suministro.Documento,
				direccionSuministro : extraordinario.extraordinario.suministro.DireccionPredio,
				zonaSuministro : extraordinario.extraordinario.suministro.NombreZonaAdministrativa,
				distritoSuministro : extraordinario.extraordinario.suministro.NombreDistrito,
				provinciaSuministro : extraordinario.extraordinario.suministro.NombreProvincia,
				tarifaSuministro : extraordinario.extraordinario.suministro.NombreTarifa,
				serieMedidor : extraordinario.extraordinario.suministro.SerieMedidor,

				dniSolicitante : extraordinario.extraordinario.persona_extraordinario.persona.dni,
				apellidoPaternoSolicitante : extraordinario.extraordinario.persona_extraordinario.persona.apellPat,
				apellidoMaternoSolicitante : extraordinario.extraordinario.persona_extraordinario.persona.apellMat,
				nombreSolicitante : extraordinario.extraordinario.persona_extraordinario.persona.nombre,
				telefonoSolicitante : extraordinario.extraordinario.persona_extraordinario.persona.telefono,
				sexoSolicitante : extraordinario.extraordinario.persona_extraordinario.persona.sexo,
				nombresSolicitante : extraordinario.extraordinario.persona_extraordinario.persona.nombres,

				
				estadoExtraordinario : extraordinario.extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt,
				tipoExtraordinario : extraordinario.extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id,
				observacionExtraordinario : extraordinario.extraordinario.obs_tipo_extraordinario.descripcion,

				referencia : extraordinario.referencia,
				nombreUsuario : extraordinario.extraordinario.usuario.email,




			}
			this.extraordinarioData = obj

			this.showExtraordinarioModal=true
			this.index = index

		},

		
		



		getResultsGeneral(page = 1) {
            axios.get('app/tecnicoRegistro?page=' + page,{
	             params: {
	             	

	             }
	          })
                .then(response => {
                    //this.buscarExtraordinarios = response.data;
                    //this.buscarExtraordinarioR = response.data;
                    //this.mostrarBusqueda = true
                    //this.mostrar = false
                    //console.log('datos buscados',response.data )
                    //this.pruebas= response.data
                    this.tecnicoRegistros= response.data
                    //this.tecnicoRegistros= this.pruebas[0].estado_extraordinario
                   
                   //console.log('1: ',this.pruebas)
                   //console.log('2: ',this.pruebas[1])
                });
        },


        
        async atenderExtraordinario(extraordinario ,index){
		
			//this.$router.push({ name: 'atencionService', params: {extraordinario: extraordinario }})
			this.atenderExtraordinarioModal=true

        },
        
        async subirAtencionExtraordinario(){
		
			//this.$router.push({ name: 'atencionService', params: {extraordinario: extraordinario }})
			 console.log('estas dentro de SUBIR',this.data);
			const formData = new FormData();
                  //formData.append('photo', this.photo);
                  formData.append('file', this.data.file);
                  //formData.append('file', this.data.file);
                 
                  

			const res = await this.callApi('post', 'app/subirAtencionExtraordinario', this.data)
			if (res.status==200) {
				this.$swal('Datos Importados','Correctamente','success')
				//this.data.file = ''

			}else{
				this.$swal('Algo salio mal','Verifique los correos','error')

			}

        },
        
        async atenderExtraordinarioPost(extraordinario ,index){
		
			this.$router.push({ name: 'atencionService', params: {extraordinario: extraordinario }})

        },

        attachImage1(){
	            this.data.image1 = this.$refs.newDescuentoImage1.files[0];
	            let reader = new FileReader();
	            reader.addEventListener('load', function(){
	                  this.$refs.newDescuentoImageDisplay1.src = reader.result;
	            }.bind(this), false);
	            reader.readAsDataURL(this.data.image1);
	    },

        attachImage2(){
	            this.data.image2 = this.$refs.newDescuentoImage2.files[0];
	            let reader = new FileReader();
	            reader.addEventListener('load', function(){
	                  this.$refs.newDescuentoImageDisplay2.src = reader.result;
	            }.bind(this), false);
	            reader.readAsDataURL(this.data.image2);
	    },

        attachImage3(){
	            this.data.image3 = this.$refs.newDescuentoImage3.files[0];
	            let reader = new FileReader();
	            reader.addEventListener('load', function(){
	                  this.$refs.newDescuentoImageDisplay3.src = reader.result;
	            }.bind(this), false);
	            reader.readAsDataURL(this.data.image3);
	    },




	    	/*async filtroPdf(){

					axios({
					  method: 'post',
					  url: 'app/pdftest',
					  responseType: 'arraybuffer',
					  data: this.filtro
					}).then(function(response) {
					  let blob = new Blob([response.data], { type: 'application/pdf'})
					  let link = document.createElement('a')
					  link.href = window.URL.createObjectURL(blob)
						//console.log(filename)
					  //link.download = 'Report.pdf'
					 // link.click()
					   window.open(link.href)


					})

        },*/

	    	async reportePdfAtencion(eviar ,index){

	    		

	    		console.log('datos a enviar : ',eviar);
					axios({
					  method: 'post',
					  url: 'app/reportePdfAtencion',
					  responseType: 'arraybuffer',
					  data: eviar,
					 
					}).then(function(response) {
					  let blob = new Blob([response.data], { type: 'application/pdf'})
					  let link = document.createElement('a')
					  link.href = window.URL.createObjectURL(blob)
						//console.log(filename)
					  //link.download = 'Report.pdf'
					 // link.click()
					   window.open(link.href)


					})

        },

      /* reportePDF(extraordinario, index){
				console.log('dentro de reportePDF',extraordinario.id)
				window.open(`/back/app/generate-pdf/${extraordinario.id}`);

        },*/

        async subirArchivoExcel(eviar){

         const formData = new FormData();
                  //formData.append('photo', this.photo);

                   

                  formData.append('archivoPost1', this.dataCarga.excel);

         //const res = await this.callApi('post', `/repositorio/app/import-insert-update`, formData)
         const res = await this.callApi('post', `/repositorio/app/cargarArchivoExcel`, formData)
         console.log('respuesta::::::-------',res)
         /*if (res.status==201) {
            this.$swal('Caso registrado','Correctamente','success')
            this.data.file2 = ''

         }else{
            this.$swal('Algo salio mal','Verificar los datos consinados','error')

         }*/


        },
		



	},


	async created(){
		try	{
			
			this.getResultsGeneral();

			/*const [  resTipoExtraordinario, resSede, rescol] = await Promise.all([
					//this.callApi('get', 'app/extraordinario'),
					this.callApi('get', '/back/app/getTipoExtraordinario'),
					this.callApi('get', '/back/app/getSedes'),
					this.callApi('get', 'app/empresaColaboradores')
				])
			
				
				this.tipoExtraordinarios = resTipoExtraordinario.data,
				this.sedes = resSede.data,
				this.colaboradores = rescol.data,
				
				
				console.log('los datos del colaboradores son',this.colaboradores)
			*/	

			} catch {
				this.$swal('Any fool can use a computer','de','error')
			}
			
			
		},



		

		


	




}




  </script>