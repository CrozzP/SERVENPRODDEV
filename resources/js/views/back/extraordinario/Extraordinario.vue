<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Extraordinario
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Servicio Exraordinario</a></li>
       <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li><a href="#">Serven</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Extraordinario</li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Extraordinario
			</span>
		

		<div class="form-inline my-2 my-lg-0 ml-auto" >


			<b-form-select v-model="searchData.tipoSearch" :options="options"></b-form-select>
			<b-form-input id="search"  v-model="searchData.search" type="text" placeholder="Search" aria-label="Search" v-on:keyup.enter="getResults">
            </b-form-input>
			
			
			<button class="btn btn-outline-primary m-2" @click="getResults"><span class="fas fa-search"></span> Buscars</button>
		</div>

			

         <b-dropdown  id="dropdown-dropleft" dropleft text="Opciones"  class="m-2"  variant="outline-primary">

                <b-dropdown-item href="#" @click="opcionesModal=true" v-if="isWritePermitted" >
                  <span class="fas fa-chart-bar"></span> Reportes
                </b-dropdown-item>

                <b-dropdown-item href="#" @click="cargarAtencionModal=true" v-if="isWritePermitted" >
                  <span class="fa fa-plus"></span> Cargar Atencion
                </b-dropdown-item>

                <b-dropdown-item href="#" @click="exportarRegistroAtencionModal=true" v-if="isWritePermitted" >
                  <span class="fas fa-file-download"></span> Exportar Registro
                </b-dropdown-item>

      
        </b-dropdown>

		</div>
	</div>
		<div class="row">

			<div class="col-md-12  ml-auto mr-auto" v-if="mostrar">
				<div class="card border-primary">
					<div class="card-body">
						<div class="row justify-content-md-center">
							<div class="table-responsive-xl">
								<b-overlay :show="cargaremail" rounded="lg" variant="secondary">
								      <template #overlay>
								        <div class="d-flex align-items-center">
								        	
								          <b-button variant="outline-primary" disabled>
												    <b-spinner small type="grow" variant="primary"></b-spinner>
											          <b-spinner type="grow" variant="primary"></b-spinner>
											          <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner" type="grow" variant="primary"></b-spinner>
											          <b-spinner type="grow" variant="primary"></b-spinner>
											          <b-spinner small type="grow" variant="primary"></b-spinner>
											          <br>
											          <h3>Enviando correo...</h3>
												    
												  </b-button>

								          <!-- We add an SR only text for screen readers -->
								          
								        </div>
								      </template>
							<table class="table table-hover tablaSuministro">
								
								
								<thead>
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
									<tr v-for="(extraordinario, i) in extraordinarios.data" :key="i" v-if="extraordinarios.data.length">
										<td>{{extraordinario.id}}</td>
										
										<td @click="personaExtraordinario(extraordinario, i)" >

											<b-link href="#" style="color:#3490dc;">{{extraordinario.persona_extraordinario.persona.dni}}</b-link>

										</td>

										<td>{{extraordinario.suministro_id}}</td>
										<td>{{extraordinario.suministro.NombreSuministro}}</td>
										
										<td v-if="extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id == 1" >
											
											<strong class="text-info">Reconexion<b-badge variant="primary" v-if="extraordinario.estado_extraordinario.tipo == 1">Nor</b-badge>
												<b-badge variant="danger" v-else-if="extraordinario.estado_extraordinario.tipo > 1" >Rei</b-badge>
											</strong>

										</td>
										<td v-else-if="extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id == 2" >
											
										
											<strong class="text-secondary">Reparacion<b-badge variant="primary" v-if="extraordinario.estado_extraordinario.tipo == 1">Nor</b-badge>
											<b-badge variant="danger" v-else-if="extraordinario.estado_extraordinario.tipo > 1" >Rei</b-badge>
											</strong>
											

										</td>

										
										<td>{{extraordinario.estado_extraordinario.fechaRegistro}}</td>
										
										
										
										<td>
											<b-dropdown  id="dropdown-dropleft" dropleft text="Acciones"  class="m-2"  :variant="extraordinario.estado_extraordinario.estado == '2' ? 'outline-secondary' :  extraordinario.estado_extraordinario.estado == '3' ? 'outline-warning': extraordinario.estado_extraordinario.estado == '4' ? 'outline-primary': extraordinario.estado_extraordinario.estado == '5' ? 'outline-success': 'outline-danger'">

												    <b-dropdown-item href="#" v-if="isReadPermitted" @click="showExtraordinarioModal(extraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-eye"></span></button> Ver
												    </b-dropdown-item>

												    <b-dropdown-item href="#" v-if="isUpdatePermitted && extraordinario.estado_extraordinario.estado < '5'" @click="editExtraordinarioModal(extraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-edit"></span></button> Editar
												    </b-dropdown-item>

                                        <b-dropdown-item href="#" v-if="isWritePermitted" @click="reportePDF(extraordinario, i)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-file-pdf"></span></button> PDF
                                       </b-dropdown-item>

                                        <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado == '5'" @click="reportePdfAtencionB(extraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fas fa-file-pdf"></span></button> Atencion-PDF
                                        </b-dropdown-item>

                                        <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado == '5'" @click="detalleAtencion(extraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fas fa-check"></span></button> Detalle atencion
                                        </b-dropdown-item>

												    <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado < '5'" @click="getMailExtraordinario(extraordinario, i)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-paper-plane"></span></button> Enviar registro Service
												    </b-dropdown-item>

                                        <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado < '5'" @click="showCorreoModal(extraordinario, i)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-rocket"></span></button> Enviar reporte Solicitante
                                        </b-dropdown-item>
												    
												    <b-dropdown-item href="#" v-if="isDeletePermitted && extraordinario.estado_extraordinario.estado < '5'" @click="showdeletingModal(extraordinario, i)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-trash"></span></button> Eliminar
												    </b-dropdown-item>
												    
												    <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado < '5' " @click="reiterativoExtraordinario(extraordinario, i)" ><button class="btn btn-warning btn-sm"  ><span class="fas fa-angry fas-xl "></span></button> Reiterativo
												    </b-dropdown-item>
										
										  </b-dropdown>


										</td>
										
										
									</tr>
								</tbody>
							</table>
							</b-overlay>
						</div>

								
							<advanced-laravel-vue-paginate :data="extraordinarios" @paginateTo="getResultsGeneral"></advanced-laravel-vue-paginate>
                     


						</div>

					</div>
				</div>
			</div>

			<div class="col-md-12  ml-auto mr-auto" v-if="mostrarBusqueda">
				<div class="card border-primary">
					<div class="card-body">
						<div class="row justify-content-md-center" >
							<div class="table-responsive-xl">
								<b-overlay :show="cargaremail" rounded="lg">
											      <template #overlay>
											        <div class="d-flex align-items-center">
											        	
											 

											          <b-button variant="outline-primary" disabled>
															    <b-spinner small type="grow" variant="primary"></b-spinner>
														          <b-spinner type="grow" variant="primary"></b-spinner>
														          <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner" type="grow" variant="primary"></b-spinner>
														          <b-spinner type="grow" variant="primary"></b-spinner>
														          <b-spinner small type="grow" variant="primary"></b-spinner>
														          <br>
														          <h3>Envian correo...</h3>
															    
															  </b-button>

											          <!-- We add an SR only text for screen readers -->
											          
											        </div>
											      </template>

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
											<b-dropdown id="dropdown-dropleft" dropleft text="Acciones" class="m-2" :variant="buscarExtraordinario.estado_extraordinario.estado == '2' ? 'outline-secondary' :  buscarExtraordinario.estado_extraordinario.estado == '3' ? 'outline-warning': buscarExtraordinario.estado_extraordinario.estado == '4' ? 'outline-primary': buscarExtraordinario.estado_extraordinario.estado == '5' ? 'outline-success': 'outline-danger'">

										    
                                  <b-dropdown-item href="#" v-if="isReadPermitted" @click="showExtraordinarioModal(buscarExtraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-eye"></span></button> Ver
                                  </b-dropdown-item>

										    
                                  <b-dropdown-item href="#" v-if="isUpdatePermitted && buscarExtraordinario.estado_extraordinario.estado < '5'" @click="editExtraordinarioModal(buscarExtraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-edit"></span></button> Editar
                                  </b-dropdown-item>


										    <b-dropdown-item href="#" v-if="isWritePermitted" @click="reportePDF(buscarExtraordinario, i)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-file-pdf"></span></button> PDF
										    </b-dropdown-item>

										    

                                  <b-dropdown-item href="#" v-if="isWritePermitted && buscarExtraordinario.estado_extraordinario.estado < '5'" @click="getMailExtraordinario(buscarExtraordinario, i)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-paper-plane"></span></button> Enviar registro Service
                                  </b-dropdown-item>
										    
										    

                                  <b-dropdown-item href="#" v-if="isDeletePermitted && buscarExtraordinario.estado_extraordinario.estado < '5'" @click="showdeletingModal(buscarExtraordinario, i)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-trash"></span></button> Eliminar
                                  </b-dropdown-item>


										    
                                  <b-dropdown-item href="#" v-if="isWritePermitted && buscarExtraordinario.estado_extraordinario.estado < '5' " @click="reiterativoExtraordinario(buscarExtraordinario, i)" ><button class="btn btn-warning btn-sm"  ><span class="fas fa-angry fas-xl "></span></button> Reiterativo
                                  </b-dropdown-item>

                                   

                                  <b-dropdown-item href="#" v-if="isWritePermitted && buscarExtraordinario.estado_extraordinario.estado == '5'" @click="reportePdfAtencionB(buscarExtraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fas fa-file-pdf"></span></button> Atencion-PDF
                                  </b-dropdown-item>

                                  <b-dropdown-item href="#" v-if="isWritePermitted && buscarExtraordinario.estado_extraordinario.estado == '5'" @click="detalleAtencion(buscarExtraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fas fa-check"></span></button> Detalle atencion
                                  </b-dropdown-item>

                                  

                                  <b-dropdown-item href="#" v-if="isWritePermitted && buscarExtraordinario.estado_extraordinario.estado < '5'" @click="showCorreoModal(buscarExtraordinario, i)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-rocket"></span></button> Enviar reporte Solicitante
                                  </b-dropdown-item>
                                  
                                                                    
                                  
										
										  </b-dropdown>

										</td>
										
										
									</tr>
								</tbody>
							</table>
							</b-overlay>
						</div>
						

								
							<advanced-laravel-vue-paginate :data="buscarExtraordinarios" @paginateTo="getResults"></advanced-laravel-vue-paginate>


							



						</div>

					</div>
				</div>
			</div>
		</div>


<b-modal  hide-footer v-model="showModal"  :mask-closable="false" :closable="false" size="xl">
	
	 <template #modal-title>
	 	<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
	 		<b-col>
	 			<h4>Informacion del registro</h4>
            <p>Reporte 
             <b-button pill  variant="outline-danger" v-if="isWritePermitted" @click="reportePDF(showData)" ><span class="fas fa-file-pdf"></span> PDF</b-button>
            </p>
	 		</b-col>
	 		<b-col >
	 			 Usuario del registro <code>{{showData.usuarioCorreo}}</code>
	 		</b-col>
	 	</b-row> 
    </template>
   
		<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="2">
			<b-col>
				<b-card
				
				    
                 :border-varian="showData.estado == '2' ? 'secondary' :  showData.estado == '3' ? 'warning': showData.estado == '4' ? 'primary': showData.estado == '5' ? 'success': 'danger'"
			        header="Datos del Suministro"
                 :header-bg-variant="showData.estado == '2' ? 'secondary' :  showData.estado == '3' ? 'warning': showData.estado == '4' ? 'primary': showData.estado == '5' ? 'success': 'danger'"
			        header-text-variant="white"
			        align="center"
				  >
				  	
				    <b-card-text>

				      <div>
				      	<b-table-simple small caption-top stacked class="tablaInforme">
    
						    <b-tbody>
						      <b-tr>
						        <b-th stacked-heading="Codigo del suministro"  >{{showData.CodigoSuministro}}</b-th>
						        <b-td stacked-heading="Codigo de Ruta">{{showData.CodigoRutaSuministro}}</b-td>
						        <b-td stacked-heading="Nombre del Suministro">{{showData.NombreSuministro}}</b-td>
						        <b-td stacked-heading="Documento">{{showData.Documento}}</b-td>
						        <b-td stacked-heading="Direccion del Predio">{{showData.DireccionPredio}}</b-td>
						        <b-td stacked-heading="Nombre Zona">{{showData.NombreZonaAdministrativa}}</b-td>
						        <b-td stacked-heading="Distrito">{{showData.NombreDistrito}}</b-td>
						        <b-td stacked-heading="Tarifa || Serie Medidor">{{showData.Tarifa}} || {{showData.SerieMedidor}}</b-td>
						      </b-tr>
						      
						    </b-tbody>
						    
						  </b-table-simple>

				      </div>

				    </b-card-text>
 
				  </b-card>
				</b-col>
			<b-col>
				<b-card
				    :border-variant="showData.estado == '2' ? 'secondary' :  showData.estado == '3' ? 'warning': showData.estado == '4' ? 'primary': showData.estado == '5' ? 'success': 'danger'"
			        header="Datos del Solicitante"
			        :header-bg-variant="showData.estado == '2' ? 'secondary' :  showData.estado == '3' ? 'warning': showData.estado == '4' ? 'primary': showData.estado == '5' ? 'success': 'danger'"
			        header-text-variant="white"
			        align="center"
				  >
				    <b-card-text>

				    <div>
				      	<b-table-simple small caption-top stacked class="tablaInforme">
    
						    <b-tbody>
						      <b-tr>
						        <b-th stacked-heading="DNI del solicitante"  >{{showData.dni}}</b-th>
						        <b-td stacked-heading="Apellido paterno">{{showData.apellPat}}</b-td>
						        <b-td stacked-heading="Apellido materno">{{showData.apellMat}}</b-td>
						        <b-td stacked-heading="Nombres">{{showData.nombre}}</b-td>
						        <b-td stacked-heading="Telefono">{{showData.telefonop}}</b-td>
						        <b-td stacked-heading="Sexo">
						        	<div v-if="showData.sexo == 1">
										MASCULINO
								    </div>
								    <div v-if="showData.sexo == 2">
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
               <b-alert show variant="primary">
                  <h7>Sede SERVICE seleccionada:</h7>
                  
                  <h7  v-for="(datasede, i) in dataSedes" :key="i" v-if="(dataSedes.length) && (datasede.id == showData.sede_id)" > <strong>{{datasede.nombre}}</strong></h7>
                

               </b-alert>
            </div>
			</b-col>

		</b-row>

		<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
			<b-col>
            <b-card
              :border-variant="showData.estado == '2' ? 'secondary' :  showData.estado == '3' ? 'warning': showData.estado == '4' ? 'primary': showData.estado == '5' ? 'success': 'danger'"
              header="Datos del Caso"
              :header-bg-variant="showData.estado == '2' ? 'secondary' :  showData.estado == '3' ? 'warning': showData.estado == '4' ? 'primary': showData.estado == '5' ? 'success': 'danger'"
              header-text-variant="white"
              align="center"
            >

              <b-card-text class="text-uppercase">
      				      <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="4">
      						<b-col>
      							<h6>Tipo :</h6>
      							<span>{{showData.nombreTipoExt}}</span>
      						</b-col>
      						<b-col>
      							<h6>Descripcion:</h6>
      							<span>{{showData.nombreObsTipoExt}}</span>
      						</b-col>
      						<b-col>
      							<h6>Observacion :</h6>
      							<span>{{showData.referencia}}</span>
      						</b-col>
      						<b-col>
      							<h6>Estado :</h6>
      							
      							<div v-if="showData.tipo == 1">
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
	
<b-modal  hide-footer v-model="editModal" title="Editar extraordinario" :mask-closable="false" :closable="false" size="xl">

	<div class="d-block ">
    	<div class="row mt--1">
	        <div class="col-md-12">
	            <b-card no-body >
	                    
	                	<b-tabs
	                        v-model="tabIndex"
	                        active-nav-item-class="font-weight-bold text-uppercase text-success"
	                        active-tab-class="font-weight-bold text-success"
	                        content-class="mt-3"
	                        nav-wrapper-class="w-30"

	                        vertical
	                      >

	                    <b-tab title="Datos del Suministro" active>
                        	<div class="d-block ">
					        	

					        	<form v-on:submit.prevent="editExtraordinario(editData)">
					        		

                                    <b-container class="bv-example-row">

                                            <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                              <b-col>
                                                <b-form-group id="input-group-1" label="CodigoSuministro :" label-for="CodigoSuministro" >
                                                      <b-form-input id="CodigoSuministro" v-model="editData.CodigoSuministro" type="text" placeholder="Ingresar el CodigoSuministro" disabled>
                                                      </b-form-input>
                                                </b-form-group>
                                                <b-form-group  id="input-group-1" label="CodigoRutaSuministro :" label-for="CodigoRutaSuministro" >
                                                        <b-form-input id="CodigoRutaSuministro" v-model="editData.CodigoRutaSuministro" type="text" placeholder="Ingresar CodigoRutaSuministroPaterno" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                                   
                                              </b-col>
                                              <b-col>
                                                	<b-form-group  id="input-group-1" label="Documento :" label-for="Documento">
                                                        <b-form-input id="Documento" v-model="editData.Documento" type="text" placeholder="Ingresar los Documento" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     <b-form-group id="input-group-1" label="Direccion :" label-for="direccion" >
                                                        <b-form-input id="direccion" v-model="editData.DireccionPredio" type="text" placeholder="Ingresar la direccion" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     
                                              </b-col>
                                            </b-row>

                                            <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                              <b-col>
                                                
                                              		<b-form-group  id="input-group-1" label="Nombre del Titular :" label-for="NombreSuministro" >
                                                        <b-form-input id="NombreSuministro" v-model="editData.NombreSuministro" type="text" placeholder="Ingresar el NombreSuministro" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                    <b-form-group id="input-group-1" label="Latitud :" label-for="Latitud" >
	                                                  <b-form-input id="Latitud" v-model="editData.Latitud" type="text" placeholder="Ingresar el Latitud" disabled>
	                                                  </b-form-input>
	                                               </b-form-group>
                                                        
                                                                   
                                              </b-col>
                                              <b-col>
                                                
                                              		<b-form-group  id="input-group-1" label="Telefono :" label-for="telefono" >
                                                        <b-form-input id="telefono" v-model="editData.Telefono" type="text" placeholder="Sin telefono" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     <b-form-group id="input-group-1" label="Longitud :" label-for="Longitud" >
                                                        <b-form-input id="Longitud" v-model="editData.Longitud" type="text" placeholder="Ingresar el Longitud" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     
                                              </b-col>
                                            </b-row>

                                    </b-container>

                                    

                                    <b-row cols="1" cols-sm="1" cols-md="3" cols-lg="3">
                                      <b-col>

                                              <b-form-group  id="input-group-1" label="Departamento :" label-for="departamento" >
                                                        <b-form-input id="departamento" v-model="editData.NombreDepartamento" type="text" placeholder="Ingresar el NombreDepartamento" disabled>
                                                        </b-form-input>
                                                     </b-form-group>

                                        </b-col>
                                        <b-col>

                                             

                                              <b-form-group  id="input-group-1" label="NombreProvincia :" label-for="NombreProvincia" >
                                                        <b-form-input id="NombreProvincia" v-model="editData.NombreProvincia" type="text" placeholder="Ingresar el NombreProvincia" disabled>
                                                        </b-form-input>
                                                     </b-form-group>


                                        </b-col>
                                       

                                         <b-col>
                                                
                                                     <b-form-group  id="input-group-1" label="NombreDistrito :" label-for="NombreDistrito" >
                                                        <b-form-input id="NombreDistrito" v-model="editData.NombreDistrito" type="text" placeholder="Ingresar el ANombreDistrito" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     
                                              </b-col>

                                    </b-row>

                                      <br>
                                                  
                                </form>
					        
					      	</div>   
                                           
                                        
                        </b-tab>


                        <b-tab title="Datos Personales">

                              <b-col>
                                 <b-form-checkbox v-model="editData.vistaEditPersona" value="1" unchecked-value="0" name="check-button" switch  v-on:change="vistaEditPersona(editData.vistaEditPersona)">
                                 <b> Verificar registros</b>
                                 </b-form-checkbox>

                              </b-col>
                           <div class="d-block " v-if="editarPersona">

						        <form v-on:submit.prevent="editPersona">
						        	
						        	<b-container class="bv-example-row" >
						        		
									  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
									    <b-col>
									    	<b-form-group id="input-group-1" label="Dni :" label-for="dni" >
									        	<b-form-input id="dni" v-model="editData.dni" type="text" placeholder="Ingresar el dni" maxlength="8" disabled >
									        	</b-form-input>
									     	</b-form-group>

									     	

									     	<b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat"   >
										        <b-form-input id="apellPat" v-model="editData.apellPat" type="text" placeholder="Ingresar el Apellido Paterno"  >
										        </b-form-input>
										     </b-form-group>
									     			     	 
									    </b-col>
									    <b-col>
									    	
										     <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat"  >
										        <b-form-input id="apellMat" v-model="editData.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
										        </b-form-input>
										     </b-form-group>
										     <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre"  >
										        <b-form-input id="nombre" v-model="editData.nombre" type="text" placeholder="Ingresar los nombres" >
										        </b-form-input>
										     </b-form-group>
									    </b-col>
									  </b-row>

									  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2"  >
									    
									    
									  </b-row>

									</b-container>

						        	<b-container class="bv-example-row">

									  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
									  	<b-col>
									    <b-form-group id="input-group-1" label="Telefono :" label-for="telefonop" >
										        <b-form-input id="telefonop" v-model="editData.telefonop" type="text" placeholder="Ingresar el telefono" >
										        </b-form-input>
										     </b-form-group>
										 </b-col>
											<b-col >
										    	<b-form-group label="Sexo">
											      <b-form-radio v-model="editData.sexo" name="some-radios" value="0">femenino</b-form-radio>
											      <b-form-radio v-model="editData.sexo" name="some-radios" value="1">Masculino</b-form-radio>
											    </b-form-group>
											    
										     			     	 
										    </b-col>
										
										
									  </b-row>
									  </b-container>

						        	</form>
						        
						      </div>    
                                           
                                        
                        </b-tab>


                    	<b-tab title="Registrar Caso">
	                        <div class="d-block ">
						        <form v-on:submit.prevent="editExtraordinario">
						        	<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
									    <b-col>
									    	<b-form-group id="input-group-1" label="Referencia Tipo Registro :" label-for="referencia" >
										        <b-form-input id="referencia" v-model="editData.nombreTipoExt" type="text" placeholder="Ingresar el referencia" disabled>
										        </b-form-input>
										     </b-form-group>
									    </b-col>

									    <b-col>
									    	<b-form-group id="input-group-1" label="Referencia Descripcion Registro :" label-for="referencia" >
										        <b-form-input id="referencia" v-model="editData.nombreObsTipoExt" type="text" placeholder="Ingresar el referencia" disabled>
										        </b-form-input>
										     </b-form-group>
									    </b-col>
									</b-row>

									<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
									    <b-col>

									    	<b-form-group id="input-group-1" label="Seleccionar el Tipo Registro:" label-for="id">
										        <b-form-select v-model="editData.tipoExtraordinario_id"  class="mb-3" name="tipoExtraordinario" @change='getObsTipoExtraordinario()' >
											      
											        <b-form-select-option :value="null" disabled>-- Seleccione una opcion--</b-form-select-option>
											      
											      <b-form-select-option :value="tipoExtraordinario.id" v-for="(tipoExtraordinario, i) in tipoExtraordinarios" :key="i" v-if="tipoExtraordinarios.length">{{tipoExtraordinario.nombreTipoExt}}</b-form-select-option>
											      
											    </b-form-select>
										      </b-form-group>



										</b-col>
										<b-col>

											<b-form-group id="input-group-1" label="Seleccionar Descripcion Registro:" label-for="obsTipoExtraordinario_id">
										        <b-form-select v-model="editData.obsTipoExtraordinario_id" class="mb-3" name="obsTipoExtraordinario"  >
											      
											        <b-form-select-option :value="null" disabled>-- Seleccione una opcion --</b-form-select-option>
											      
											     
											      
											        <b-form-select-option :value="obsTipoExtraordinario.id"  v-for="(obsTipoExtraordinario, i) in obsTipoExtraordinarios" :key="i" v-if="obsTipoExtraordinarios.length">{{obsTipoExtraordinario.nombreObsTipoExt}}</b-form-select-option>
											    </b-form-select>


										      </b-form-group>


										</b-col>
									</b-row>


									<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
									    <b-col>

									    	

										</b-col>
										<b-col>

											

										</b-col>
									</b-row>
									<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
									    <b-col>
									    	 <b-form-group id="input-group-1" label="Observacion :" label-for="referencia" >
											       
                                          <b-form-textarea
                                             id="referencia"
                                             v-model="editData.referencia" 
                                             placeholder="Ingresar el referencia..."
                                             rows="3"
                                           ></b-form-textarea>
											     </b-form-group>

									    </b-col>
                               <b-col>
                                 <b-alert show variant="primary">
                                   <b-form-group id="input-group-1" label="Seleccionar provincia - SERVICE:" label-for="IdProvincia">
                                  
                                       <b-form-select v-model="editData.sede_id" class="mb-3" name="sede_id" >
                                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option >
                                          <b-form-select-option :value="datasede.id" v-for="(datasede, i) in dataSedes" :key="i" v-if="dataSedes.length">{{datasede.nombre}}</b-form-select-option>
                                       </b-form-select>

                                    </b-form-group>
                                 </b-alert>

                              </b-col>
									</b-row>

								<br>
									<div class="text-ringth">
									  <button type="button" class="btn btn-default" v-on:click="editModal=false">Cancelar</button>
									  <button class="btn btn-primary" ><span class="fa fa-check"></span>Editar</button>
									</div>
						      </form>
						   </div>
                  </b-tab> 
               </b-tabs>
            </b-card>                                      
         </div>
      </div>
  	</div>
</b-modal>

<b-modal  hide-footer v-model="opcionesModal" title="Filtro de reportes" :mask-closable="false" :closable="false" size="lg" header-bg-variant="success">
	

	<b-overlay :show="cargar" rounded="lg"  variant="light" opacity="0.8">
	      <template #overlay>
	        <div class="text-center">
             <b-icon icon="stopwatch" font-scale="3" animation="cylon"></b-icon>
                      
             </div>
              <div class="d-flex align-items-center">
                    
                 <strong>Espere a que el correo sea enviado...</strong>
             
              </div>
	      </template>

	<form v-on:submit.prevent="filtroExtraordinario()">

		<b-overlay :show="cargarexcel" rounded="lg" variant="light" opacity="0.8"> 
	      <template #overlay>
         	 <div class="text-center">
	          <b-icon icon="stopwatch" font-scale="3" animation="cylon"></b-icon>
				          
             </div>
	           <div class="d-flex align-items-center">
				        
				     <strong>Espere a que el archivo se descargue...</strong>
	          
	           </div>
	      </template>
	  

        <b-container class="bv-example-row">
        	
            
            <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
              <b-col>

              	<b>Seleccionar sedes:</b><br>
              	

        
        <b-form-checkbox-group
          id="sede"
          v-model="sede"
          :options="sedes"
          
          name="sede"
          class="ml-4"
          aria-label="Individual sedes"
					switches
          stacked

        ></b-form-checkbox-group>

        

							</b-col>


							<b-col>


                <b-form-group id="input-group-1" label="Seleccionar Tipo Registro:" label-for="tipoExtraordinario">
								  <b-form-select v-model="filtroData.tipoExtraordinario_id" :options="filexcel"></b-form-select>
							  </b-form-group>

                <b-form-group  id="input-group-1" label="Fecha Inicio :" label-for="fechaInicio" >
                    <b-form-input id="fechaInicio" v-model="filtroData.FechaInicio" type="date" placeholder="Ingresar fene Inicial" >
                    </b-form-input>
                </b-form-group> 

                <b-form-group  id="input-group-1" label="Fecha Final :" label-for="FechaFinal" >
                    <b-form-input id="FechaFinal" v-model="filtroData.FechaFinal" type="date" placeholder="Ingresar fecha Final" >
                    </b-form-input>
                </b-form-group> 

              </b-col>
            </b-row>
              <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
                 <b-col>

                 	<button class="btn btn-primary btn-block"><span class="far fa-envelope"> </span> Enviar Mail</button>

                 	
                 	<b-button block variant="success" @click="filtroExcelExtraordinario()"><span class="far fa-file-excel"></span> Exportar en Excel</b-button>
                 	<b-button block variant="danger" v-on:click="opcionesModal=false">Cancelar</b-button>
                 			
   			

                 </b-col>

             </b-row>
      </b-container>

      

      </b-overlay>

  </form>
  
</b-overlay>
</b-modal>

<b-modal  hide-footer v-model="showModalReiterativo" title="Datos para el Reiterativo " :mask-closable="false" :closable="false" size="lg">

	<b-card
				    
    img-top
    tag="article"
    style="max-width: auto;"
    class="mb-2"
  >
    <b-card-text>

      <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="2" >
		<b-col>
			<p>
			<h5>
				
			Codigo del suministro: 
			</h5>	
			<span>{{reiterativo.CodigoSuministro}}</span>
			</p>
		</b-col>
		<b-col>
			<p>
				<h5>
					
			Nombres Titular: 
				</h5>

			<span>{{reiterativo.NombreSuministro}}</span>
			</p>
		</b-col>
	</b-row>

	<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="2">
		<b-col>
			<p>
				<h5>
					
			Tipo de Registro: 
				</h5>
			<span  class="text-uppercase">{{reiterativo.nombreTipoExt}}</span>
				
			</p>
		</b-col>
		<b-col>
			<p>
				<h5>
					
			 Descripcion del Registro:
				</h5>
			<span  class="text-uppercase">
				
			{{reiterativo.nombreObsTipoExt}}
			</span> 
			</p>
		</b-col>
	</b-row>
    	

    </b-card-text>

    
  </b-card>

  <b-card>
  	<b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
	    <b-col>
	    	 <b-form-group id="input-group-1" label="Motivo del Reiterativo :" label-for="referencia" >
			        <b-form-input id="referencia" v-model="regReiterativo.referencia" type="text" placeholder="Ingresar observacion" >
			        </b-form-input>


			     </b-form-group>

	    </b-col>
	</b-row>	
  </b-card>

<div class="text-ringth">
	<button type="button" class="btn btn-default" v-on:click="showModalReiterativo=false" >Cancelar</button>
	<button class="btn btn-primary" v-on:click="storeEstadoExtraordinario()"  ><span class="fa fa-check"></span>Registrar</button>
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


<b-modal  hide-footer v-model="showDetalleAtencionModal" title="Detalle de la atencion" :mask-closable="false" :closable="false" size="xl">
   <div class="row">
      <div class="col-md-12">
         <div class="card card-dark bg-primary-gradient">
            <div class="card-body bubble-shadow">
               <h3>{{datoDetalleAtencion.id}}</h3>
               
               <div class="pull-right">
                  <h5 class="fw-bold op-8">Tipo Registro Atencion:</h5>
                  <div v-if="datoDetalleAtencionEE.atencion_excel == 1">
                     <h5 class="pull-right fw-bold">Excel</h5>
                  </div>
                  <div v-if="datoDetalleAtencionEE.atencion_appweb == 1">
                     <h5 class="pull-right fw-bold">AppWeb</h5>
                  </div>
                  
               </div>
               <h6 >Direccion: <p class="op-8">{{datoDetalleAtencionS.DireccionPredio}}</p></h6>
               <h6 >Nombres: <p class="op-8">{{datoDetalleAtencionS.NombreSuministro}}</p></h6>
               <div class="pull-right">
                  <h4 class="fw-bold op-8">{{datoDetalleAtencionOTETE.nombreTipoExt}}</h4>
                  <h4 class="pull-right fw-bold">{{datoDetalleAtencionS.CodigoSuministro}}</h4>
               </div>
               <h6 >Descripcion: <p class="op-8">{{datoDetalleAtencionOTE.descripcion}}</p></h6>

            </div>
         </div>
      </div>

      <div class="col-md-12  ml-auto mr-auto">
         <div class="card">
            <div class="card-body">
              
               <div>


                  <b-tabs
                   active-nav-item-class="font-weight-bold text-uppercase text-danger"
                   active-tab-class="font-weight-bold text-success"
                   content-class="mt-3"
                   fill
                  >
                     <b-tab title="Fotografias" active>
                     
                        <b-row>
                           <b-col   md="9">
                              <b-row>
                                 <b-col cols="6" md="3">

                                      <b-tooltip target="imgMax-1" triggers="hover">
                                        <b-button-group size="sm">
                                          <b-button variant="outline-light"  v-on:click="downloadImg(`/storage/atencion/medidor/${datoDetalleADR.medidor}`, 'Medidor')"><span class="fas fa-cloud-download-alt"></span></b-button>
                                          <b-button variant="outline-light" v-on:click="maximizarImagen(1)"><span class="fas fa-expand-arrows-alt"></span></b-button>
                                        </b-button-group>
  
                                      </b-tooltip>

                                    <b-img id="imgMax-1" thumbnail rounded fluid :src="`/storage/atencion/medidor/${datoDetalleADR.medidor}`" ref="newDescuentoImageDisplay1" alt="Image 1"  v-if="datoDetalleADR.medidor != null">
                                    
                                    </b-img>
                                    <div class="card card-dark bg-primary-gradient"  v-if="datoDetalleADR.medidor == null">
                                       <div class="card-body bubble-shadow" align="center">
                                          <h6>Sin imagen</h6>
                                       </div>
                                    </div>
                                    
                                    
                                    <b-form-group id="input-group-1" label="Medidor :" label-for="image">

                                    </b-form-group>
                                 </b-col>
                                 <b-col cols="6" md="3">

                                      <b-tooltip target="imgMax-2" triggers="hover">
                                        <b-button-group size="sm">
                                          <b-button variant="outline-light"  v-on:click="downloadImg(`/storage/atencion/preReparaciones/${datoDetalleADR.archivoPre1}`, 'Pre-Atencion')"><span class="fas fa-cloud-download-alt"></span></b-button>
                                          <b-button variant="outline-light" v-on:click="maximizarImagen(2)"><span class="fas fa-expand-arrows-alt"></span></b-button>
                                        </b-button-group>
  
                                      </b-tooltip>
                                    <b-img  id="imgMax-2" thumbnail rounded fluid :src="`/storage/atencion/preReparaciones/${datoDetalleADR.archivoPre1}`" ref="newDescuentoImageDisplay1" alt="Image 1"  v-if="datoDetalleADR.archivoPre1 != null">
                                    </b-img>

                                    <div class="card card-dark bg-primary-gradient"  v-if="datoDetalleADR.archivoPre1 == null">
                                       <div class="card-body bubble-shadow" align="center">
                                          <h6>Sin imagen</h6>
                                       </div>
                                    </div>

                                    
                                    <b-form-group id="input-group-1" label="Pre-Atencion :" label-for="image">
                                      
                                    </b-form-group>
                                 </b-col>
                                 <b-col cols="6" md="3">

                                      <b-tooltip target="imgMax-3" triggers="hover">
                                        <b-button-group size="sm">
                                          <b-button variant="outline-light" v-on:click="downloadImg(`/storage/atencion/usuarios/${datoDetalleADR.usuarioImagen}`, 'Usuario/Fachada')"><span class="fas fa-cloud-download-alt"></span></b-button>
                                          <b-button variant="outline-light" v-on:click="maximizarImagen(3)"><span class="fas fa-expand-arrows-alt"></span></b-button>
                                        </b-button-group>
  
                                      </b-tooltip>
                                    <b-img  id="imgMax-3" thumbnail rounded fluid :src="`/storage/atencion/usuarios/${datoDetalleADR.usuarioImagen}`" ref="newDescuentoImageDisplay1" alt="Image 1" v-if="datoDetalleADR.usuarioImagen != null">
                                    </b-img>

                                    <div class="card card-dark bg-primary-gradient"  v-if="datoDetalleADR.usuarioImagen == null">
                                       <div class="card-body bubble-shadow" align="center">
                                          <h6>Sin imagen</h6>
                                       </div>
                                    </div>
                                    
                                    <b-form-group id="input-group-1" label="Usuario/Fachada :" label-for="image">
                                      
                                    </b-form-group>
                                 </b-col>
                                 <b-col cols="6" md="3">

                                      <b-tooltip target="imgMax-4" triggers="hover">
                                        <b-button-group size="sm">
                                          <b-button variant="outline-light" v-on:click="downloadImg(`/storage/atencion/reparaciones/${datoDetalleADR.archivoPost1}`, 'Post-Atencion')"><span class="fas fa-cloud-download-alt"></span></b-button>
                                          <b-button variant="outline-light" v-on:click="maximizarImagen(4)"><span class="fas fa-expand-arrows-alt"></span></b-button>
                                        </b-button-group>
  
                                      </b-tooltip>
                                    <b-img  id="imgMax-4" thumbnail rounded fluid :src="`/storage/atencion/reparaciones/${datoDetalleADR.archivoPost1}`" ref="newDescuentoImageDisplay1" alt="Image 1" v-if="datoDetalleADR.archivoPost1 != null">
                                    </b-img>

                                    <div class="card card-dark bg-primary-gradient"  v-if="datoDetalleADR.archivoPost1 == null">
                                       <div class="card-body bubble-shadow" align="center">
                                          <h6>Sin imagen</h6>
                                       </div>
                                    </div>
                                    
                                    <b-form-group id="input-group-1" label="Post-Atencion :" label-for="image">
                                      
                                    </b-form-group>
                                 </b-col>

                              </b-row>
                           </b-col>
                           <b-col   md="3">
                              <b-row>
                                 <b-col cols="6" md="5">
                                    <b-form-group id="input-group-1" label="Firma Tecnico :" label-for="image">

                                    </b-form-group>
                                 </b-col>
                                 <b-col cols="6" md="7">

                                      <b-tooltip target="imgMax-5" triggers="hover">
                                        <b-button-group size="sm">
                                          <b-button variant="outline-light"><span class="fas fa-cloud-download-alt"></span></b-button>
                                          <b-button variant="outline-light" v-on:click="maximizarImagen(5)"><span class="fas fa-expand-arrows-alt"></span></b-button>
                                        </b-button-group>
  
                                      </b-tooltip>
                                    <b-img  id="imgMax-5" thumbnail rounded fluid :src="`/storage/atencion/firmas/tecnicos/${datoDetalleADR.firmaTecnico}`" ref="newDescuentoImageDisplay1" alt="Image 1" v-if="datoDetalleADR.firmaTecnico != null">
                                    </b-img>

                                    <div class="card card-dark bg-primary-gradient"  v-if="datoDetalleADR.firmaTecnico == null">
                                       <div class="card-body bubble-shadow" align="center">
                                          <h6>Sin imagen</h6>
                                       </div>
                                    </div>
                                   

                                 </b-col>
                              </b-row>
                              <b-row>
                                 <b-col cols="6" md="5">
                                    <b-form-group id="input-group-1" label="Firma Usuario :" label-for="image">

                                    </b-form-group>
                                 </b-col>
                                 <b-col cols="6" md="7">

                                      <b-tooltip target="imgMax-6" triggers="hover">
                                        <b-button-group size="sm">
                                          <b-button variant="outline-light"><span class="fas fa-cloud-download-alt"></span></b-button>
                                          <b-button variant="outline-light" v-on:click="maximizarImagen(6)"><span class="fas fa-expand-arrows-alt"></span></b-button>
                                        </b-button-group>
  
                                      </b-tooltip>
                                    <b-img  id="imgMax-6" thumbnail rounded fluid :src="`/storage/atencion/firmas/usuarios/${datoDetalleADR.firmaUsuario}`" ref="newDescuentoImageDisplay1" alt="Image 1" v-if="datoDetalleADR.firmaUsuario != null">
                                    </b-img>

                                    <div class="card card-dark bg-primary-gradient"  v-if="datoDetalleADR.firmaUsuario == null">
                                       <div class="card-body bubble-shadow" align="center">
                                          <h6>Sin imagen</h6>
                                       </div>
                                    </div>
                                   
                                 </b-col>
                              </b-row>
                           </b-col>

                        </b-row>

                     </b-tab>
                     <b-tab title="Detalles">


                              

                        
                        <b-row cols="2" cols-sm="1" cols-md="1" cols-lg="2">
                           
                           <b-col >
                              <b-card
                                border-varian="primary"
                                header="Mas informacion"
                                header-bg-variant="primary"
                                header-text-variant="white"
                                align="center"
                              >
                              
                                  <b-card-text>

                                    <div>
                                       <b-table-simple small caption-top stacked class="tablaInforme">
                      
                                        <b-tbody>
                                          <b-tr>
                                            <b-th stacked-heading="Fecha de Registro :"  >{{datoDetalleAtencionEE.fechaRegistro}}</b-th>
                                            <b-td stacked-heading="Fecha de Asignacion :">{{datoDetalleAtencionEE.fechaDerivado}}</b-td>
                                            <b-td stacked-heading="Fecha de Aceptado por tecnico :">{{datoDetalleAtencionEE.fechaAceptadoT}}</b-td>
                                            <b-td stacked-heading="Fecha de Atencion :">{{datoDetalleAtencionEE.fechaAtencion}}</b-td>
                                            <b-td stacked-heading="Descripcion de la atencion :">{{datoDetalleDR.observacion}}</b-td>
                                          </b-tr>
                                          
                                        </b-tbody>
                                        
                                      </b-table-simple>

                                    </div>

                                 </b-card-text>
                
                              </b-card>

                           </b-col>

                           <b-col>

                              <b-card
            
                
                                border-varian="primary"
                                header="Datos del solicitante"
                                header-bg-variant="primary"
                                header-text-variant="white"
                                align="center"
                             >
                              
                               <b-card-text>

                                 <div>
                                    <b-table-simple small caption-top stacked class="tablaInforme">
                   
                                     <b-tbody>
                                       <b-tr>
                                         
                                         <b-td stacked-heading="Apellidos y Nombres :">{{datoDetalleAtencionPEP.nombres}}</b-td>
                                         <b-td stacked-heading="DNI :">{{datoDetalleAtencionPEP.dni}}</b-td>
                                         <b-td stacked-heading="Celular :">{{datoDetalleAtencionPEP.telefono}}</b-td>
                                         <b-td stacked-heading="Parentesto :">{{datoDetalleAtencionPER.nombre}}</b-td>
                                       </b-tr>
                                       
                                     </b-tbody>
                                     
                                   </b-table-simple>

                                 </div>

                               </b-card-text>
                
                             </b-card>
                             
                           <b-button pill  variant="outline-success" :href="`https://maps.google.com/?q=${datoDetalleADR.latitudAtencion},${datoDetalleADR.longitudAtencion}&z=18`" target="_blank"><span class="fas fa-map-marker-alt"></span> Ubicacion Atencion</b-button>
                           <b-button pill  variant="outline-success" :href="`https://maps.google.com/?q=${datoDetalleADR.latitudAtencion},${datoDetalleADR.longitudAtencion}&z=18&t=k`" target="_blank"><span class="fas fa-map-marker-alt"></span> Ubicacion Atencion</b-button>
                           <b-button pill  variant="outline-danger" @click="reportePdfAtencionB(datoDetalleAtencion)"><span class="fas fa-file-pdf"></span> Reporte PDF</b-button>

                           </b-col>
                        </b-row>

                        
                      </b-tab>
                     <b-tab title="Second">

                        <br>

                           <!--button class="btn btn-primary" v-on:click="addUser"><span class="fa fa-check"></span>: Add role</button-->
                        <button class="btn btn-primary"  ><span class="fa fa-check"></span>: subir imagen</button>
                      </b-tab>
                    </b-tabs>

               </div>


            </div>
         </div>
      </div>
   </div>


</b-modal>


<b-modal hide-footer v-model="maximizarImagenModal" id="modal-center"  size="lg" :mask-closable="false" :closable="false" centered>
   <template #modal-title>
       {{maxI.tituloImagen}}
    </template>
    <div class="d-block text-center">
   <b-img v-bind="mainProps" id="tooltip-target-1" thumbnail rounded fluid :src="maxI.urlImagen" alt="Image 1" >
   </b-img>
    </div>
                             
</b-modal>

<b-modal hide-footer v-model="correoModal" id="modal-center"title="Enviar Reporte"   :mask-closable="false" :closable="false" centered>

   <b-overlay :show="cargaremailReporte" rounded="lg" variant="secondary">
      <template #overlay>
        <div class="d-flex align-items-center">
         
          <b-button variant="outline-primary" disabled>
                <b-spinner small type="grow" variant="primary"></b-spinner>
                   <b-spinner type="grow" variant="primary"></b-spinner>
                   <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner" type="grow" variant="primary"></b-spinner>
                   <b-spinner type="grow" variant="primary"></b-spinner>
                   <b-spinner small type="grow" variant="primary"></b-spinner>
                   <br>
                   <h3>Enviando correo...</h3>
                
              </b-button>

          <!-- We add an SR only text for screen readers -->
          
        </div>
      </template>

      <b-form-group
           id="input-group-1"
           label="Correo del solicitante"
           label-for="input-1"
           description="Se enviara el reporte de registro al correo consignado."
         >
           <b-form-input
             id="input-1"
             v-model="dataEmail.email"
             type="email"
             placeholder="email"
             required
           ></b-form-input>
         </b-form-group> 
      </b-overlay>

<button class="btn btn-primary" v-on:click="getMailReporteExtraordinario()"><span class="fa fa-check"></span>Enviar Correo</button>
                             
</b-modal>


<b-modal  hide-footer v-model="cargarAtencionModal"  :mask-closable="false" :closable="false"  title="Cargar Archivos" >

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


<b-modal  hide-footer v-model="exportarRegistroAtencionModal" title="Filtro de registros para atencion" :mask-closable="false" :closable="false" size="lg" header-bg-variant="primary" >

   

   <b-overlay :show="cargar" rounded="lg"  variant="light" opacity="0.8">
         <template #overlay>
           <div class="text-center">
             <b-icon icon="stopwatch" font-scale="3" animation="cylon"></b-icon>
                      
             </div>
              <div class="d-flex align-items-center">
                    
                 <strong>Espere a que el correo sea enviado...</strong>
             
              </div>
         </template>

   <form v-on:submit.prevent="filtroExtraordinarioMail()">

      <b-overlay :show="cargarexcel" rounded="lg" variant="light" opacity="0.8"> 
         <template #overlay>
             <div class="text-center">
             <b-icon icon="stopwatch" font-scale="3" animation="cylon"></b-icon>
                      
             </div>
              <div class="d-flex align-items-center">
                    
                 <strong>Espere a que el archivo se descargue...</strong>
             
              </div>
         </template>
     

        <b-container class="bv-example-row">
         
            
            <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
              <b-col>

               <b>Seleccionar sedes:</b><br>
               

        
        <b-form-checkbox-group
          id="sede"
          v-model="sede"
          :options="sedes"
          
          name="sede"
          class="ml-4"
          aria-label="Individual sedes"
               switches
          stacked

        ></b-form-checkbox-group>

        

                     </b-col>


                     <b-col>


                <b-form-group id="input-group-1" label="Seleccionar Tipo Registro:" label-for="tipoExtraordinario">
                          <b-form-select v-model="filtroData.tipoExtraordinario_id" :options="filexcel"></b-form-select>
                       </b-form-group>

                <b-form-group  id="input-group-1" label="Fecha Inicio :" label-for="fechaInicio" >
                    <b-form-input id="fechaInicio" v-model="filtroData.FechaInicio" type="date" placeholder="Ingresar fene Inicial" >
                    </b-form-input>
                </b-form-group> 

                <b-form-group  id="input-group-1" label="Fecha Final :" label-for="FechaFinal" >
                    <b-form-input id="FechaFinal" v-model="filtroData.FechaFinal" type="date" placeholder="Ingresar fecha Final" >
                    </b-form-input>
                </b-form-group> 

              </b-col>
            </b-row>
              <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
                 <b-col>

                  <button class="btn btn-primary btn-block"><span class="far fa-envelope"> </span> Enviar Mail</button>

                  
                  <b-button block variant="success" @click="filtroExcelRegistroAtencion()"><span class="far fa-file-excel"></span> Exportar excel - Registros Atencion</b-button>
                  <b-button block variant="danger" v-on:click="opcionesModal=false">Cancelar</b-button>
                        
            

                 </b-col>

             </b-row>
      </b-container>

      

      </b-overlay>

  </form>
  
</b-overlay>
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

         imagenCss: { blank: true, blankColor: '#3b91f3', width: 175, height: 225, class: 'm1' },
         imagenCssFirma: { blank: true, blankColor: '#3b91f3', width: 120, height: 60, class: 'm1' },

			items: [
          { age: 40, first_name: 'Dickerson', last_name: 'Macdonald' },
          { age: 21, first_name: 'Larsen', last_name: 'Shaw' },
          { age: 89, first_name: 'Geneva', last_name: 'Wilson' },
          { age: 38, first_name: 'Jami', last_name: 'Carney' }
        ],

			cargar: false,
			cargarexcel: false,
			cargaremail: false,
         cargaremailReporte: false,

			options: ['Apple', 'Orange', 'Banana', 'Lime', 'Chocolate', 'Strawberry'],
        value: [],


			mostrar: true,
			mostrarBusqueda: false, 
			editModal: false,
			showModal: false,
			showModalReiterativo: false,
         showDetalleAtencionModal: false,
			showModalPersonaExtraordinario: false,
         correoModal: false,
         cargarAtencionModal: false,
         exportarRegistroAtencionModal: false,

			opcionesModal: false,
         maximizarImagenModal: false,
         editarPersona: false,
			tabIndex: 1,
			index : -1,

			extraordinarios: [],
			//personaExtraordinario: [],
			tipoExtraordinarios: [],
        	obsTipoExtraordinarios: [],

        	options: [
	          { value: null, text: 'Seleccione una opcion' },
	          { value: 'Documento', text: 'DNI' },
	          { value: 'CodigoSuministro', text: 'Suministro' },
	          { value: 'CodigoRutaSuministro', text: 'Ruta' },
	          { value: 'Nombres', text: 'Apellidos y Nombres' }
	          
	        ],

	        filexcel: [
	         
	          { value: '3', text: 'Todo' },
	          { value: '1', text: 'Reconexion' },
	          { value: '2', text: 'Reparacion' }
	          
	        ],

	        sedes: [],
	        
	        sede:[],
           dataSedes:[],
           datoDetalleAtencion:[],
           datoDetalleAtencionEE:[],
           datoDetalleAtencionOTE:[],
           datoDetalleAtencionOTETE:[],	   
           datoDetalleAtencionPEP:[],      
           datoDetalleAtencionPER:[],      
           datoDetalleAtencionS:[],      
           datoDetalleADR:[],      
           datoDetalleDR:[],      


        	searchData:{
		      	tipoSearch: null,

		      },
        	regReiterativo:{
		      	

		      },

		    buscarExtraordinario:{},
      		buscarExtraordinarios:{},
      		buscarExtraordinarioR:{},
            maxI:{},
            dataEmail:{},
            dataExtgraordinario:{},
            dataCarga:{},
            fff:{

            estado_extraordinario: {id:'',},
            },

      		//buscarExtraordinarios:[],

			editData : {
				id:'',

			},
			filtroData : {
				tipoExtraordinario_id:'',
				FechaFinal:'',
				FechaInicio:'',

			},
			showData : {

			},
			reiterativo : {

			},
			tipoExtraordinario : {
				
				
				
				
			},
			deleteItem: {},
			buscarPersonaExtraordinario: [],
			datosPersonaExtraordinario : {

			},

			
			
		}
	},


	methods : {
		

		async editExtraordinario(editData){
			console.log("dentro del edit",this.editData)
			

			const formData = new FormData();
                  //formData.append('photo', this.photo);
                  
                  
                
                /*formData.append('CodigoSuministro', this.extraordinario.suministro.CodigoSuministro)
				formData.append('CodigoRutaSuministro', this.extraordinario.suministro.CodigoRutaSuministro)
				formData.append('NombreSuministro', this.extraordinario.suministro.NombreSuministro)
				formData.append('Doumento', this.extraordinario.suministro.Doumento)
				formData.append('Telefono', this.extraordinario.suministro.Telefono)
				formData.append('DireccionPredio', this.extraordinario.suministro.DireccionPredio)
				formData.append('Longitud', this.extraordinario.suministro.Longitud)
				formData.append('Latitud', this.extraordinario.suministro.Latitud)
				formData.append('SerieMedidor', this.extraordinario.suministro.SerieMedidor)
				formData.append('MarcaMedidor', this.extraordinario.suministro.MarcaMedidor)
				formData.append('Tarifa', this.extraordinario.suministro.Tarifa)
				formData.append('NombreZonaAdministrativa', this.extraordinario.suministro.NombreZonaAdministrativa)
				formData.append('NombreDepartamento', this.extraordinario.suministro.NombreDepartamento)
				formData.append('NombreProvincia', this.extraordinario.suministro.NombreProvincia)
				formData.append('NombreDistrito', this.extraordinario.suministro.NombreDistrito)

				formData.append('dni', this.extraordinario.persona_extraordinario.persona.dni)
				formData.append('apellPat', this.extraordinario.persona_extraordinario.persona.apellPat)
				formData.append('apellMat', this.extraordinario.persona_extraordinario.persona.apellMat)
				formData.append('nombre', this.extraordinario.persona_extraordinario.persona.nombre)
				formData.append('telefonop', this.extraordinario.persona_extraordinario.persona.telefono)
				formData.append('sexo', this.extraordinario.persona_extraordinario.persona.sexo)

				formData.append('nombreObsTipoExt', this.extraordinario.obs_tipo_extraordinario.nombreObsTipoExt)
				formData.append('nombreTipoExt', this.extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt)
				
				formData.append('referencia', this.extraordinario.referencia)


				formData.append('tipoExtraordinario_id', this.extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id)
				formData.append('obsTipoExtraordinario_id', this.extraordinario.obsTipoExtraordinario_id)

*/console.log("dentro del formData",formData)
               
        	const formPers = new FormData();
/*
                formPers.append('tipoExtraordinario_id', this.extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id)
				formPers.append('obsTipoExtraordinario_id', this.extraordinario.obsTipoExtraordinario_id)
*/


			const [ resp, res] = await Promise.all([
				this.callApi('put', `app/persona/${this.editData.persona_id}`, this.editData),
            //this.callApi('put', `app/persona/${editData.persona_id}`, this.editData),
				//this.callApi('put', `app/extraordinario/${editData.id}`,this.editData)
            this.callApi('put', `app/extraordinario/${this.editData.id}`,this.editData)
			])
			//const res = await this.callApi('put', `app/extraordinario/${editData.id}`, this.editData)
			/*
																this.extraordinario.persona_extraordinario.persona_id
			*/
			//const res = await this.callApi('put', `app/persona/${extraordinario.persona_extraordinario.persona_id}`, this.editData)
			//const res = await this.callApi('put', `app/persona/${extraordinario.persona_extraordinario.persona_id}`, this.formPers)
			/*const [ res, resp] = await Promise.all([
				this.callApi('put', `app/persona/${this.extraordinario.persona_extraordinario.persona_id}`, formPers),
				this.callApi('put', `app/extraordinario/${this.extraordinario.id}`,formData)
			])*/



			if (res.status==200 && resp.status==200 ) {
				//this.extraordinarios.unshift(resp.data)
				//this.$swal('Hello Vue world!!!');
				this.$swal('Registro actualizado','Correctamente','success');
				//Swal.fire('Any fool can use a computer','de','success');
				/*this.flashMessage.success({
						message: 'Categoria creada',
						time: 5000
					})*/
				this.editModal = false
				//this.data.roleName = ''
				//this.data.description = ''

			} else if (resp.status==233 && res.status==200 ) {
            //this.extraordinarios.unshift(resp.data)
            //this.$swal('Hello Vue world!!!');
            //Swal.fire('Any fool can use a computer','de','success');
            
            this.$swal('Registro actualizado','Correctamente','success');
            this.editModal = false
            //this.data.roleName = ''
            //this.data.description = ''

         } else {
				if (res.status==422 || resp.status==422) {
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
					for(let i in resp.data.errors){
						this.$swal({
							toast: true,
						  position: 'top-end',
						  icon: 'error',
						  title: resp.data.errors[i][0],
						  showConfirmButton: false,
						  timer: 5000
						});
					}
				} else {
					this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
				}
			}
		},
		

		editExtraordinarioModal(extraordinario, index){
			
			let obj ={
				
				id : extraordinario.id,
				persona_id : extraordinario.persona_extraordinario.persona_id,

				CodigoSuministro : extraordinario.suministro.CodigoSuministro,
				CodigoRutaSuministro : extraordinario.suministro.CodigoRutaSuministro,
				NombreSuministro : extraordinario.suministro.NombreSuministro,
				Documento : extraordinario.suministro.Documento,
				Telefono : extraordinario.suministro.Telefono,
				DireccionPredio : extraordinario.suministro.DireccionPredio,
				Longitud : extraordinario.suministro.Longitud,
				Latitud : extraordinario.suministro.Latitud,
				SerieMedidor : extraordinario.suministro.SerieMedidor,
				MarcaMedidor : extraordinario.suministro.MarcaMedidor,
				Tarifa : extraordinario.suministro.Tarifa,
				NombreZonaAdministrativa : extraordinario.suministro.NombreZonaAdministrativa,
				NombreDepartamento : extraordinario.suministro.NombreDepartamento,
				NombreProvincia : extraordinario.suministro.NombreProvincia,
				NombreDistrito : extraordinario.suministro.NombreDistrito,

				dni : extraordinario.persona_extraordinario.persona.dni,
				apellPat : extraordinario.persona_extraordinario.persona.apellPat,
				apellMat : extraordinario.persona_extraordinario.persona.apellMat,
				nombre : extraordinario.persona_extraordinario.persona.nombre,
				telefonop : extraordinario.persona_extraordinario.persona.telefono,
				sexo : extraordinario.persona_extraordinario.persona.sexo,

				nombreObsTipoExt : extraordinario.obs_tipo_extraordinario.nombreObsTipoExt,
				nombreTipoExt : extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt,
				


				tipoExtraordinario_id : extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id,
				obsTipoExtraordinario_id : extraordinario.obsTipoExtraordinario_id,

            sede_id: extraordinario.estado_extraordinario.sede_id,
				referencia : extraordinario.estado_extraordinario.referencia,
            estadoExtraordinario_id : extraordinario.estado_extraordinario.id,
            estado : extraordinario.estado_extraordinario.estado,

            vistaEditPersona: 0,
				

			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},


		showExtraordinarioModal(extraordinario, index){
			
			let obj ={
				
				CodigoSuministro : extraordinario.suministro.CodigoSuministro,
				CodigoRutaSuministro : extraordinario.suministro.CodigoRutaSuministro,
				NombreSuministro : extraordinario.suministro.NombreSuministro,
				Documento : extraordinario.suministro.Documento,
				Telefono : extraordinario.suministro.Telefono,
				DireccionPredio : extraordinario.suministro.DireccionPredio,
				Longitud : extraordinario.suministro.Longitud,
				Latitud : extraordinario.suministro.Latitud,
				SerieMedidor : extraordinario.suministro.SerieMedidor,
				MarcaMedidor : extraordinario.suministro.MarcaMedidor,
				Tarifa : extraordinario.suministro.NombreTipoSistema,
				NombreZonaAdministrativa : extraordinario.suministro.NombreZonaAdministrativa,
				NombreDepartamento : extraordinario.suministro.NombreDepartamento,
				NombreProvincia : extraordinario.suministro.NombreProvincia,
				NombreDistrito : extraordinario.suministro.NombreDistrito,

				dni : extraordinario.persona_extraordinario.persona.dni,
				apellPat : extraordinario.persona_extraordinario.persona.apellPat,
				apellMat : extraordinario.persona_extraordinario.persona.apellMat,
				nombre : extraordinario.persona_extraordinario.persona.nombre,
				telefonop : extraordinario.persona_extraordinario.persona.telefono,
				sexo : extraordinario.persona_extraordinario.persona.sexo,

				nombreObsTipoExt : extraordinario.obs_tipo_extraordinario.nombreObsTipoExt,
				nombreTipoExt : extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt,
				referencia : extraordinario.estado_extraordinario.referencia,
				tipo : extraordinario.estado_extraordinario.tipo,
				usuarioNombre : extraordinario.usuario.name,
				usuarioNombres : extraordinario.usuario.fullName,
				usuarioCorreo : extraordinario.usuario.email,

            sede_id: extraordinario.estado_extraordinario.sede_id,
            referencia : extraordinario.estado_extraordinario.referencia,
            estado : extraordinario.estado_extraordinario.estado,

            id : extraordinario.id,

				
				

			}
			this.showData = obj
			this.showModal = true
			this.index = index
		},

		reiterativoExtraordinario(extraordinario, index){

			let obj ={
				
				CodigoSuministro : extraordinario.suministro.CodigoSuministro,
				CodigoRutaSuministro : extraordinario.suministro.CodigoRutaSuministro,
				NombreSuministro : extraordinario.suministro.NombreSuministro,
				Documento : extraordinario.suministro.Documento,
				Telefono : extraordinario.suministro.Telefono,
				DireccionPredio : extraordinario.suministro.DireccionPredio,
				Longitud : extraordinario.suministro.Longitud,
				Latitud : extraordinario.suministro.Latitud,
				SerieMedidor : extraordinario.suministro.SerieMedidor,
				MarcaMedidor : extraordinario.suministro.MarcaMedidor,
				Tarifa : extraordinario.suministro.Tarifa,
				NombreZonaAdministrativa : extraordinario.suministro.NombreZonaAdministrativa,
				NombreDepartamento : extraordinario.suministro.NombreDepartamento,
				NombreProvincia : extraordinario.suministro.NombreProvincia,
				NombreDistrito : extraordinario.suministro.NombreDistrito,
				IdProvincia : extraordinario.suministro.IdProvincia,

				dni : extraordinario.persona_extraordinario.persona.dni,
				apellPat : extraordinario.persona_extraordinario.persona.apellPat,
				apellMat : extraordinario.persona_extraordinario.persona.apellMat,
				nombre : extraordinario.persona_extraordinario.persona.nombre,
				telefonop : extraordinario.persona_extraordinario.persona.telefono,
				sexo : extraordinario.persona_extraordinario.persona.sexo,

				nombreObsTipoExt : extraordinario.obs_tipo_extraordinario.nombreObsTipoExt,
				nombreTipoExt : extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt,
				referencia : extraordinario.estado_extraordinario.referencia,
				tipo : extraordinario.estado_extraordinario.tipo,
				estado : extraordinario.estado_extraordinario.estado,

				extraordinario_id : extraordinario.id,
				id : extraordinario.estado_extraordinario.id,
            sede_id: extraordinario.estado_extraordinario.sede_id,
            referencia : extraordinario.estado_extraordinario.referencia,
            estado : extraordinario.estado_extraordinario.estado,
				
			}
			this.reiterativo = obj
			this.showModalReiterativo = true
			this.index = index
			console.log('datos para reiterativo: ', this.reiterativo)

		},

		async storeEstadoExtraordinario(reiterativo){

			const formData = new FormData();
                  //formData.append('photo', this.photo);
                  
                  formData.append('referenciaReiterativo', this.regReiterativo.referencia);
                  formData.append('extraordinario_id', this.reiterativo.extraordinario_id);
                  formData.append('estado', this.reiterativo.estado);
                  formData.append('tipo', this.reiterativo.tipo);
                  formData.append('idProvincia', this.reiterativo.IdProvincia);
                  formData.append('id', this.reiterativo.id);
                  
			const res = await this.callApi('post', `app/storeEstadoExtraordinario`, formData)

			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==201) {
            console.log('datos de respuesta :_______',res.data)
				//this.roles[this.index].roleName = this.editData.roleName
				this.extraordinarios[this.index] = this.formData
				this.buscarExtraordinarios[this.index] = this.formData


            let obj ={
            
               id : res.data.extraordinario_id,
               estado_extraordinario : {tipo : res.data.tipo,},
               //estado_extraordinario.tipo : res.data.tipo,
            }
            this.reiterativos = obj



            this.getMailExtraordinario(this.reiterativos)

				this.$swal('Excelent !','Reiterativo se registró correctamente','success')

				window.location.href = "/back/extraordinario"
				this.showModalReiterativo = false

				//this.$router.Push('/back/extraordinario') 
				
				//window.open(`/back/extraordinario`);
				//this.$router.replace('/back/extraordinario')
				
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
				} if (res.status==400) {
					
						this.$swal({
							toast: true,
							  position: 'top-end',
							  icon: 'error',
							  title: res.data.message,
							  showConfirmButton: false,
							  timer: 5000
							});
					
				} else {
					this.$swal('Ocurrio algun error','Intentelo nuevamente','error')
				}
			}
		},


		getObsTipoExtraordinario: function() {
        	
            axios.get('/back/app/getObsTipoExtraordinario',{
             params: {
               tipoExtraordinario_id: this.editData.tipoExtraordinario_id

             }
          }).then(function(response){
                this.obsTipoExtraordinarios = response.data;
            }.bind(this));

        },

		reportePDF(extraordinario, index){

				

			console.log('dentro de reportePDF',extraordinario.id)
			//window.open(`/back/app/generate-pdf/${extraordinario.id}`);
			
			//redirect: '/back/app/generate-pdf'

			//window.location.href = '/back/app/generate-pdf'
			//window.location.href = `/back/app/generate-pdf/${this.editData.tipoExtraordinario_id}`
			
			window.location.href = `/back/app/generate-pdf/${extraordinario.id}`
			//window.open(`/back/app/generate-pdf/${extraordinario.id}`, '_blank');
        	
            /*axios.get(`/back/app/generate-pdf/${extraordinario.id}`,{
             params: {
               tipoExtraordinario_id: extraordinario.id

             }
          }).then(function(response){
                this.obsTipoExtraordinarios = response.data;
                //window.open('/back/app/generate-pdf');
            }.bind(this));*/

        },

        getMailExtraordinario(extraordinario, index){

				

			//console.log('dentro de getMailExtraordinario',extraordinario.id)
			//window.open(`/back/app/getMailExtraordinario/${extraordinario.id}`);
			
			//redirect: '/back/app/generate-pdf'
			//window.location.href = '/back/app/generate-pdf'
			//window.location.href = `/back/app/generate-pdf/${this.editData.tipoExtraordinario_id}`
			
			///window.location.href = `/back/app/generate-pdf/${extraordinario.id}`
			//window.open(`/back/app/generate-pdf/${extraordinario.id}`, '_blank');
        	this.cargaremail =true
            axios.get(`/back/app/getMailExtraordinario`,{
             params: {
               tipoExtraordinario_id: extraordinario.id,
               estadoReiterativo: extraordinario.estado_extraordinario.tipo,


             }
          }).then(function(response){
                //this.obsTipoExtraordinarios = response.data;
               // console.log('es el log del mail',response.data)
                //window.open('/back/app/generate-pdf');

                 if (response.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
					this.cargaremail =false
					this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
					
					
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
						this.cargaremail =false
						this.$swal('Algo salio mal','Verifique los correos','error')
					}
				}

            }.bind(this));

        },


        showCorreoModal(extraordinario, index){

           this.correoModal = true

           this.dataExtgraordinario = extraordinario

        },

        getMailReporteExtraordinario(){

         
         if (this.dataEmail.email == 0) return this.$swal('El correo es obligatorio','Asignar correo para continuar','warning')
         //console.log('para enviar correos',this.dataExtgraordinario)
         this.cargaremailReporte =true
            axios.get(`/back/app/getMailReporteExtraordinario`,{
             params: {
               extraordinario_id: this.dataExtgraordinario.id,
               estadoReiterativo: this.dataExtgraordinario.estado_extraordinario.tipo,
               email: this.dataEmail.email,


             }
          }).then(function(response){
                //this.obsTipoExtraordinarios = response.data;
               // console.log('es el log del mail',response.data)
                //window.open('/back/app/generate-pdf');

                 if (response.status==200) {
            //this.roles[this.index].roleName = this.editData.roleName
               this.cargaremailReporte =false
                this.correoModal = false
               this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
               
               
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
                  this.cargaremailReporte =false
                  this.$swal('Algo salio mal','Verifique los correos','error')
               }
            }

            }.bind(this));

        },

        filtroExtraordinario(){
         //console.log('-----------', this.filtroData)
         
            if (this.sede.length == 0) return this.$swal('La Sede es obligatorio','Seleccione una sede como minimo','warning')
            if (this.filtroData.tipoExtraordinario_id.length == 0) return this.$swal('Tipo Registro es','Obligatorio','warning')
            if (this.filtroData.FechaInicio.length == 0) return this.$swal('La fecha de Inicio es','Obligatorio','warning')
            if (this.filtroData.FechaFinal.length == 0) return this.$swal('La fecha Final es','Obligatorio','warning')
            if (this.filtroData.FechaFinal < this.filtroData.FechaInicio) return this.$swal('Error en Fecha Final','La fecha Final no puede ser inferior a la fecha de inicio','warning')
               this.cargar = true
				

			//console.log('dentro de filtroExtraordinario')
			//window.open(`/back/app/getMailExtraordinario/${extraordinario.id}`);
			
			//redirect: '/back/app/generate-pdf'
			//window.location.href = '/back/app/generate-pdf'
			//window.location.href = `/back/app/generate-pdf/${this.editData.tipoExtraordinario_id}`
			
			///window.location.href = `/back/app/generate-pdf/${extraordinario.id}`
			//window.open(`/back/app/generate-pdf/${extraordinario.id}`, '_blank');
        	//this.cargar =true

            axios.get(`/back/app/getMailExtraordinarioFiltro`,{
             params: {
               tipoExtraordinario_id: this.filtroData.tipoExtraordinario_id,
               FechaFinal: this.filtroData.FechaFinal,
               FechaInicio: this.filtroData.FechaInicio,
               sedes: this.sede

             }
          }).then(function(response){
            //console.log('el status es:_____',response.status)
                //this.obsTipoExtraordinarios = response.data;
               // console.log('es el log del mail',response.data)
                //window.open('/back/app/generate-pdf');
              //  console.lo('Datos de la consulta', response.data)

                if (response.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
					this.cargar =false
					this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
					
					
   				} else if (response.status==422) {
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
                     this.cargar = false
                     
                  }else{
   					 
                     this.cargar = false
   						this.$swal('Algo salio mal','Verifique los correos','error')
   					
   				}
   				
               }.bind(this));

        },


        filtroExtraordinarioMail(){
         //console.log('-----------', this.filtroData)
         
            //if (this.sede.length == 0) return this.$swal('La Sede es obligatorio','Seleccione una sede como minimo','warning')
            //if (this.filtroData.tipoExtraordinario_id.length == 0) return this.$swal('Tipo Registro es','Obligatorio','warning')
            //if (this.filtroData.FechaInicio.length == 0) return this.$swal('La fecha de Inicio es','Obligatorio','warning')
            //if (this.filtroData.FechaFinal.length == 0) return this.$swal('La fecha Final es','Obligatorio','warning')
            //if (this.filtroData.FechaFinal < this.filtroData.FechaInicio) return this.$swal('Error en Fecha Final','La fecha Final no puede ser inferior a la fecha de inicio','warning')
               this.cargar = true
            

         //console.log('dentro de filtroExtraordinario')
         //window.open(`/back/app/getMailExtraordinario/${extraordinario.id}`);
         
         //redirect: '/back/app/generate-pdf'
         //window.location.href = '/back/app/generate-pdf'
         //window.location.href = `/back/app/generate-pdf/${this.editData.tipoExtraordinario_id}`
         
         ///window.location.href = `/back/app/generate-pdf/${extraordinario.id}`
         //window.open(`/back/app/generate-pdf/${extraordinario.id}`, '_blank');
         //this.cargar =true

            axios.get(`/back/app/getMailRegistroExtraordinarioFiltro`,{
             params: {
               tipoExtraordinario_id: this.filtroData.tipoExtraordinario_id,
               FechaFinal: this.filtroData.FechaFinal,
               FechaInicio: this.filtroData.FechaInicio,
               sedes: this.sede

             }
          }).then(function(response){
            //console.log('el status es:_____',response.status)
                //this.obsTipoExtraordinarios = response.data;
               // console.log('es el log del mail',response.data)
                //window.open('/back/app/generate-pdf');
              //  console.lo('Datos de la consulta', response.data)

                if (response.status==200) {
            //this.roles[this.index].roleName = this.editData.roleName
               this.cargar =false
               this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
               
               
               } else if (response.status==422) {
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
                     this.cargar = false
                     
                  }else{
                   
                     this.cargar = false
                     this.$swal('Algo salio mal','Verifique los correos','error')
                  
               }
               
               }.bind(this));

        },

   

		filtroExcelExtraordinario(){
            if (this.sede.length == 0) return this.$swal('La Sede es obligatorio','Seleccione una sede como minimo','warning')
            if (this.filtroData.tipoExtraordinario_id.length == 0) return this.$swal('Tipo Registro es','Obligatorio','warning')
            if (this.filtroData.FechaInicio.length == 0) return this.$swal('La fecha de Inicio es','Obligatorio','warning')
            if (this.filtroData.FechaFinal.length == 0) return this.$swal('La fecha Final es','Obligatorio','warning')
            if (this.filtroData.FechaFinal < this.filtroData.FechaInicio) return this.$swal('Error en Fecha Final','La fecha Final no puede ser inferior a la fecha de inicio','warning')


			this.cargarexcel =true
	        axios.get(`/back/app/getExcelExtraordinario`, {
			    responseType: 'arraybuffer',
			    params: {
			        tipoExtraordinario_id: this.filtroData.tipoExtraordinario_id,
	               FechaFinal: this.filtroData.FechaFinal,
	               FechaInicio: this.filtroData.FechaInicio,
	               sedes: this.sede
			    }
			}).then(response => {
			    //RESPUESTA
			    if (response.status==200) {

			    	console.log('exceltiempo de la ejecucion',response.request.timeout)
			    let blob = new Blob([response.data], { type: 'application/vnd.ms-excel' });
			    let link = document.createElement('a');
			    link.href = window.URL.createObjectURL(blob);
			    link.download = 'Reporte.xlsx';
			    link.click();

					this.$swal('Excelent !','El archivo se descargo satisfactoriamente','success')
			        this.cargarexcel =false

			    } else {
               this.cargarexcel = false
						this.$swal('Algo salio mal','Verifique los correos','error')
					}

			    
			})
		},

   

      filtroExcelRegistroAtencion(){
            //if (this.sede.length == 0) return this.$swal('La Sede es obligatorio','Seleccione una sede como minimo','warning')
            //if (this.filtroData.tipoExtraordinario_id.length == 0) return this.$swal('Tipo Registro es','Obligatorio','warning')
            //if (this.filtroData.FechaInicio.length == 0) return this.$swal('La fecha de Inicio es','Obligatorio','warning')
            //if (this.filtroData.FechaFinal.length == 0) return this.$swal('La fecha Final es','Obligatorio','warning')
            //if (this.filtroData.FechaFinal < this.filtroData.FechaInicio) return this.$swal('Error en Fecha Final','La fecha Final no puede ser inferior a la fecha de inicio','warning')


         this.cargarexcel =true
           axios.get(`/back/app/getExcelRegistroAtencion`, {
             responseType: 'arraybuffer',
             params: {
                 tipoExtraordinario_id: this.filtroData.tipoExtraordinario_id,
                  FechaFinal: this.filtroData.FechaFinal,
                  FechaInicio: this.filtroData.FechaInicio,
                  sedes: this.sede
             }
         }).then(response => {
             //RESPUESTA
             if (response.status==200) {

               console.log('exceltiempo de la ejecucion',response.request.timeout)
             let blob = new Blob([response.data], { type: 'application/vnd.ms-excel' });
             let link = document.createElement('a');
             link.href = window.URL.createObjectURL(blob);
             link.download = 'Reporte.xlsx';
             link.click();

               this.$swal('Excelent !','El archivo se descargo satisfactoriamente','success')
                 this.cargarexcel =false

             } else {
               this.cargarexcel = false
                  this.$swal('Algo salio mal','Verifique los correos','error')
               }

             
         })
      },

      //getauron(page = 1) {
      getauron(watchFiltros) {
         console.log('listo para buscar:_____',watchFiltros )
         this.page='1'
            axios.get('app/extraordinarioBuscar?page=' + this.page,{
                params: {
                  tipoSearch: watchFiltros.tipoSearch,
                     search: watchFiltros.search

                }
             })
                .then(response => {
                    this.buscarExtraordinarios = response.data;
                    this.buscarExtraordinarioR = response.data;
                    this.mostrarBusqueda = true
                    this.mostrar = false
                   
                    console.log(response.data)
                });

               // console.log('ddddddd AURON::::::::::::::::::::::::::d',watchFiltros)
        },

		getResults(page = 1) {
            axios.get('app/extraordinarioBuscar?page=' + page,{
	             params: {
	             	tipoSearch: this.searchData.tipoSearch,
	               	search: this.searchData.search

	             }
	          })
                .then(response => {
                    this.buscarExtraordinarios = response.data
                    this.buscarExtraordinarioR = response.data
                    this.mostrarBusqueda = true
                    this.mostrar = false

                   
                    console.log(response.data)
                });
        },

		getResultsGeneral(page = 1) {
            axios.get('app/extraordinario?page=' + page,{
	             params: {
	             	

	             }
	          })
                .then(response => {
                    //this.buscarExtraordinarios = response.data;
                    //this.buscarExtraordinarioR = response.data;
                    //this.mostrarBusqueda = true
                    //this.mostrar = false
                    console.log('datos buscados',response.data )
                    this.extraordinarios= response.data
                   
                    console.log(response.data)
                });
        },

        async deleteExtraordinario(deleteItem, index){
			this.isDeleing = true
			//const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
			
			const res = await this.callApi('delete', `app/extraordinario/${deleteItem.id}`, this.deleteItem)
			if(res.status==200){
				//this.users.splice(index, 1)
				this.extraordinarios.splice(index, 1)
				this.buscarExtraordinarios.splice(index, 1)
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

		showdeletingModal(extraordinario, i){

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
		          	this.deleteExtraordinario(extraordinario, i)
		            this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
		          } else {
		            this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
		          }
		        })
		},


		personaExtraordinario(extraordinario, index){

			let obj ={
				
				CodigoSuministro : extraordinario.suministro.CodigoSuministro,
				CodigoRutaSuministro : extraordinario.suministro.CodigoRutaSuministro,
				NombreSuministro : extraordinario.suministro.NombreSuministro,
				Documento : extraordinario.suministro.Documento,
				Telefono : extraordinario.suministro.Telefono,
				DireccionPredio : extraordinario.suministro.DireccionPredio,
				Longitud : extraordinario.suministro.Longitud,
				Latitud : extraordinario.suministro.Latitud,
				SerieMedidor : extraordinario.suministro.SerieMedidor,
				MarcaMedidor : extraordinario.suministro.MarcaMedidor,
				Tarifa : extraordinario.suministro.Tarifa,
				NombreZonaAdministrativa : extraordinario.suministro.NombreZonaAdministrativa,
				NombreDepartamento : extraordinario.suministro.NombreDepartamento,
				NombreProvincia : extraordinario.suministro.NombreProvincia,
				NombreDistrito : extraordinario.suministro.NombreDistrito,

				dni : extraordinario.persona_extraordinario.persona.dni,
				persona_id : extraordinario.persona_extraordinario.persona_id,
				apellPat : extraordinario.persona_extraordinario.persona.apellPat,
				apellMat : extraordinario.persona_extraordinario.persona.apellMat,
				nombre : extraordinario.persona_extraordinario.persona.nombre,
				telefonop : extraordinario.persona_extraordinario.persona.telefono,
				sexo : extraordinario.persona_extraordinario.persona.sexo,
				direccion : extraordinario.persona_extraordinario.persona.direccion,

				nombreObsTipoExt : extraordinario.obs_tipo_extraordinario.nombreObsTipoExt,
				nombreTipoExt : extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt,
				referencia : extraordinario.estado_extraordinario.referencia,
				tipo : extraordinario.estado_extraordinario.tipo,
				estado : extraordinario.estado_extraordinario.estado,

				extraordinario_id : extraordinario.id,
				
				

			}


			this.datosPersonaExtraordinario = obj


			//axios.get(`/back/app/personaExtraordinario`, {
			//const res = await this.callApi('delete', `app/extraordinario/${deleteItem.id}`, this.deleteItem)
			axios.get(`/back/app/buscarPersonaExtraordinario/${this.datosPersonaExtraordinario.persona_id}`,{
             params: {
               persona_id: this.datosPersonaExtraordinario.persona_id

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

      vistaEditPersona(vistaEditPerson){
         if (vistaEditPerson == 1) {

            this.editarPersona=true;
         }else{

            this.editarPersona=false;
         }
      },



      async reportePdfAtencionB(enviar ,index){


         //const formData = new FormData();
         //formData.append('estado_extraordinario', this.regReiterativo.referencia);

         console.log('datos a enviar : ',enviar.id);
         this.fff.estado_extraordinario['id'] = enviar.id
         console.log('77777___',this.fff)

            axios({
              method: 'post',
              url: 'app/reportePdfAtencionB',
              responseType: 'arraybuffer',
              data: enviar,
              //data: this.fff,
             
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



      async detalleAtencion(extraordinario ,index){
         this.datoDetalleAtencion = extraordinario

         this.datoDetalleAtencionEE = extraordinario.estado_extraordinario
         this.datoDetalleAtencionOTE = extraordinario.obs_tipo_extraordinario
         this.datoDetalleAtencionOTETE = extraordinario.obs_tipo_extraordinario.tipo_extraordinario
         this.datoDetalleAtencionPEP = extraordinario.persona_extraordinario.persona
         this.datoDetalleAtencionPER = extraordinario.persona_extraordinario.relacion
         this.datoDetalleAtencionS = extraordinario.suministro

         const formData = new FormData();
            //formData.append('photo', this.photo);
         formData.append('id', this.datoDetalleAtencionEE.id);


         const res = await this.callApi('post', `app/detalleAtencion`, formData)
         if (res.status == 200) {
            this.datoDetalleADR =res.data
            this.datoDetalleDR =res.data.derivar_registro

            this.showDetalleAtencionModal =true

         }else {
                  this.$swal('Algo salio mal','Contactarse con soporte','error')
               
            }


         
     },
     maximizarImagen(numeral){
         console.log('dentro de la carga___:', numeral)

         if (numeral == 1) {
            this.maxI.urlImagen = `/storage/atencion/medidor/${this.datoDetalleADR.medidor}`
            this.maxI.tituloImagen = "Imagen del Medidor"

         }else if(numeral == 2){
            this.maxI.urlImagen = `/storage/atencion/preReparaciones/${this.datoDetalleADR.archivoPre1}`
            this.maxI.tituloImagen = "Imagen de la Pre-Atencion"

         }else if(numeral == 3){
            this.maxI.urlImagen = `/storage/atencion/usuarios/${this.datoDetalleADR.usuarioImagen}`
            this.maxI.tituloImagen = "Imagen Usuario/Fachada"

         }else if(numeral == 4){
            this.maxI.urlImagen = `/storage/atencion/reparaciones/${this.datoDetalleADR.archivoPost1}`
            this.maxI.tituloImagen = "Imagen de la Post-Atencion"

         }else if(numeral == 5){
            this.maxI.urlImagen = `/storage/atencion/firmas/tecnicos/${this.datoDetalleADR.firmaTecnico}`
            this.maxI.tituloImagen = "Imagen Firma del Tecnico"

         }else if(numeral == 6){
            this.maxI.urlImagen = `/storage/atencion/firmas/usuarios/${this.datoDetalleADR.firmaUsuario}`
            this.maxI.tituloImagen = "Imagen Firma del Usuario"

         }else{
            this.maxI.urlImagen = `/storage/atencion/medidor/${this.datoDetalleADR.medidor}`
            this.maxI.tituloImagen = "Imagen Firma del Usuario"

         }
         

         this.maximizarImagenModal=true

      },


    downloadImg(url, desc) { 
    

      var hoy = new Date();
      var fecha = hoy.getDate() + '-' + ( hoy.getMonth() + 1 ) + '-' + hoy.getFullYear();
      var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
      var fechaYHora = fecha + '_' + hora;
      

      const xhr = new XMLHttpRequest(); 
      xhr.responseType = "blob"; 
      xhr.onload = () => { 
         var urlCreator = window.URL || window.webkitURL; 
         var imageUrl = urlCreator.createObjectURL(xhr.response); 
         const link = document.createElement("a"); 
         link.href = imageUrl; 
         link.setAttribute("download", desc+"-"+this.datoDetalleAtencion.id+"-"+this.datoDetalleAtencion.suministro_id+fechaYHora); 
         link.setAttribute("target", "new"); 
         document.body.appendChild(link); 
         link.click(); }; 
         xhr.open("GET", url); 
         xhr.send(); 
      },



        async subirArchivoExcel(eviar){

         const formData = new FormData();
                  //formData.append('photo', this.photo);

                   

                  formData.append('archivoPost1', this.dataCarga.excel);

         //const res = await this.callApi('post', `/repositorio/app/import-insert-update`, formData)
         //const res = await this.callApi('post', `/repositorio/app/cargarArchivoExcel`, formData)
         const res = await this.callApi('post', `app/cargarArchivoExcel`, formData)
         console.log('respuesta::::::-------',res)
         if (res.status==200) {

            this.cargarAtencionModal = false
            this.$swal('Caso registrado','Correctamente','success')
            //window.reload()
            window.location.reload()

            //this.dataCarga.excel= ''
            //this.$router.push({ path: '/back/extraordinario' })

         }else{
            this.$swal('Algo salio mal','Verificar los datos consinados','error')
            this.cargarAtencionModal = false

         }


        },






	},
	selected(newValue, oldValue) {
        // Handle changes in individual flavour checkboxes
        if (newValue.length === 0) {
          this.indeterminate = false
          this.allSelected = false
        } else if (newValue.length === this.flavours.length) {
          this.indeterminate = false
          this.allSelected = true
        } else {
          this.indeterminate = true
          this.allSelected = false
        }
      },





watch:{

       //  console.log('prueba______________:');
  /* "$route.query":{
      immediate: true,
      handler(page){
         console.log('prueba______________:', page)
         this.watchFiltro=page
         console.log('prueba______________+++++:', this.watchFiltro)
         if (!this.watchFiltro.page == "") {
         console.log('dentro del if')
           
            this.getauron(this.watchFiltro);

         }

      }
   }*/
         
   "$route.params":{
      immediate: true,
      handler(page){
         console.log('prueba______________:', page)
         this.watchFiltro=page
         console.log('prueba______________+++++:', this.watchFiltro)
         if (!this.watchFiltro.search == "") {
         console.log('dentro del if')
           
            this.getauron(this.watchFiltro);

         }else{
            this.getResultsGeneral();
         }

      }
   }
},



	async created(){
	try	{
		//console.log(this.isWritePermitted)
		//console.log('esto es el permiso')
		//this.getResultsGeneral();



		const [  resTipoExtraordinario, resSede, resDataSedes] = await Promise.all([
				//this.callApi('get', 'app/extraordinario'),
				this.callApi('get', 'app/getTipoExtraordinario'),
				this.callApi('get', 'app/getSedes'),
            this.callApi('get', 'app/getDataSedes'),
			])
		
			//this.getResultsGeneral();
			//this.extraordinarios = res.data
			this.tipoExtraordinarios = resTipoExtraordinario.data,
			this.sedes = resSede.data,
         this.dataSedes = resDataSedes.data,
			
			

			//this.tipoExtraordinarios = resTipoExtraordinario.data
			console.log('los datos del suministro son',this.extraordinarios)
			//console.log('los datos del suministro son',this.personaExtraordinario)
			
			//console.log('los datos del suministro son',this.tipoExtraordinarios)

			//console.log('es el usuario',this.users)
			//console.log('es el usuario logueado ',this.userLogged['permissions'])

		} catch {
			this.$swal('Any fool can use a computer','de','error')
		}
		
		
	},

}

  </script>