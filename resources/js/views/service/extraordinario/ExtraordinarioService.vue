<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Registros
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Registros a derivar</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Usuario </li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Administrar Registros
			</span>


		<b-dropdown id="dropdown-dropleft" dropleft text="Masivo" variant="outline-primary" class="m-2 ml-auto mb-3">

			<b-form-group id="input-group-1" label="Seleccionar Tipo:" label-for="id">
	        <b-form-select v-model="prueba.tipoBusqueda"   name="colaboradores" :options="tipoBusquedas">
		      
		    </b-form-select>
	     </b-form-group>


		    <b-dropdown-item href="#" v-if="isWritePermitted" @click="Masivo()" ><button class="btn btn-success btn-sm" ><span class="fa fa-edit"></span> Filtrar</button>   
		    </b-dropdown-item>

		    

		
		  </b-dropdown>
		 
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
											<table class="table table-hover tablaSuministro" v-if="isReadPermitted">
												
												
												<thead>
													<tr>
														<td class="bg-primary text-white text-center">#</td>
														<td class="bg-primary text-white text-center">SUMINISTRO</td>
														<td class="bg-primary text-white text-center">TITULAR SUMINISTRO</td>
														<td class="bg-primary text-white text-center">TIPO REGISTRO </td>
														<td class="bg-primary text-white text-center">FECHA REGISTRO</td>
														<td class="bg-primary text-white text-center">ESTADO REGISTRO</td>
														<td class="bg-primary text-white text-center">ACCIONES</td>
													</tr>
												</thead>
												<tbody>
													
													<tr v-for="(extraordinario, i) in extraordinarios.data" :key="i" v-if="extraordinarios.data.length"  >
														<td>{{extraordinario.id}}</td>
														
														

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

														<td >{{extraordinario.estado_extraordinario.fechaRegistro}} </td>

														<td v-if="extraordinario.estado_extraordinario.estado == '2'" style=" border-radius: 18px 0 !important;background: #6861ce80 !important; text-align: center;"> Registrado</td>
														<td v-else-if="extraordinario.estado_extraordinario.estado == '3'" style=" border-radius: 18px 0 !important;background: #e3342f80 !important; text-align: center;"> Asignado</td>
														<td v-else-if="extraordinario.estado_extraordinario.estado == '4'" style=" border-radius: 18px 0 !important;background: #1572e873 !important; text-align: center;"> Aceptado</td>
														<td v-else-if="extraordinario.estado_extraordinario.estado == '5'" style=" border-radius: 18px 0 !important;background: #38c1729e !important; text-align: center;"> Atendido</td>
														<td v-else-if="extraordinario.estado_extraordinario.estado == '6'" style=" border-radius: 18px 0 !important;background: #ffad4685 !important; text-align: center;"> Calificado</td>
                                          <td v-else-if="extraordinario.estado_extraordinario.estado == '10'" style=" border-radius: 18px 0 !important;background: #000000 !important; text-align: center; color: #ffffff "> Actualizado</td>


														
														<td>
															<b-dropdown id="dropdown-dropleft" dropleft text="Acciones" :variant="extraordinario.estado_extraordinario.estado == '2' ? 'secondary' :  extraordinario.estado_extraordinario.estado == '3' ? 'danger': extraordinario.estado_extraordinario.estado == '4' ? 'primary': extraordinario.estado_extraordinario.estado == '5' ? 'success': 'warning'" class="m-2">

																    <b-dropdown-item href="#" v-if="isReadPermitted" @click="mostrarDetalle(extraordinario, i)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-eye"></span></button> Ver
																    </b-dropdown-item>

																    <b-dropdown-item href="#" v-if="isWritePermitted && extraordinario.estado_extraordinario.estado == '2'" @click="asignarTecnicoDatos(extraordinario, i)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-user-plus"></span></button> Asignar Tecnico
																    </b-dropdown-item>

																     <b-dropdown-item href="#" v-if="isUpdatePermitted && extraordinario.estado_extraordinario.estado == '3'" @click="editAsignarTecnicoDatos(extraordinario, i)" ><button class="btn btn-warning btn-sm"  ><span class="fas fa-people-carry"></span></button> Cambiar Tecnico
																    </b-dropdown-item>
																    

																    <b-dropdown-item href="#" v-if="isWritePermitted" @click="getMailExtraordinario(extraordinario, i)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-paper-plane"></span></button> Enviar
																    </b-dropdown-item>
	
														  </b-dropdown>


														</td>
														
														
													</tr>
												</tbody>
											</table>
											</b-overlay>
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
											</b-overlay>
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


<b-modal  hide-footer v-model="asignoMasivo"  :mask-closable="false" :closable="false" size="xl" title="Asignar Registros Masivamente" >
			
<form v-on:submit.prevent="addMasivo">

			<b-form-group id="input-group-1" label="Seleccionar Tecnico:" label-for="id">
	        <b-form-select v-model="masivo.colaborador"  class="mb-3" name="colaboradores" @change='getObsTipoExtraordinario()' >
		      
		        <b-form-select-option :value="null" disabled>-- Seleccione al Tecnico--</b-form-select-option>
		      
		      	<b-form-select-option :value="colaborador.id" v-for="(colaborador, i) in colaboradores" :key="i" v-if="colaboradores.length">{{colaborador.colaborador.nombre}}</b-form-select-option>
		      
		    </b-form-select>
	     </b-form-group>

<div class="card border-primary">
		<div class="card-body">
				<div class="row justify-content-md-center">
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
								
								
								<thead>
									<tr>
										<td class="bg-primary text-white text-center"><span class="far fa-check-square"></span></td>
										<td class="bg-primary text-white text-center">#</td>
										<td class="bg-primary text-white text-center">SUMINISTRO</td>
										<td class="bg-primary text-white text-center">ZONA</td>
										<td class="bg-primary text-white text-center">DIRECCION</td>
										<td class="bg-primary text-white text-center">TIPO REGISTRO </td>
										<td class="bg-primary text-white text-center">FECHA REGISTRO</td>
									</tr>
								</thead>
								<tbody>
									
									<tr v-for="(extraordinario, i) in extraordinariosMasivo.data" :key="i" v-if="extraordinariosMasivo.data.length"  >
										<td>
												<b-form-checkbox 
									        v-model="estadoExtraordinario"
									        :value="extraordinario.estado_extraordinario.id"
									        class="ml-4"
									      >
									      	
									      </b-form-checkbox>

											
										</td>

										<td>{{extraordinario.id}}</td>
										
										

										<td>{{extraordinario.suministro_id}}</td>
										<td>{{extraordinario.suministro.NombreZonaAdministrativa}}</td>
										<td>{{extraordinario.suministro.DireccionPredio}}</td>
										
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


										<td>{{extraordinario.estado_extraordinario.fechaRegistro}} </td>

										
									
										
										
									</tr>
								</tbody>
							</table>
							</b-overlay>
						</div>
							<div class="card mb-3">

								
							<advanced-laravel-vue-paginate :data="extraordinariosMasivo" @paginateTo="Masivo"></advanced-laravel-vue-paginate>


		
							</div>


						</div>
	</div>
</div>	

   	
 <br>
									
									<div class="text-center mt-3">


										<button type="button" class="btn btn-outline-danger" v-on:click="regModal=false">Cancelar</button>
										
										<button class="btn btn-outline-success" ><span class="fa fa-check"></span>Registrar</button>

                        
									</div>          			
</form>

</b-modal>
	
<b-modal  hide-footer v-model="asignarTecnicoModal"  :mask-closable="false" :closable="false" size="sm" title="Asignar Tecnico" >

		<form v-on:submit.prevent="asignarTectico(extAsignarData)">
			
	     <b-form-group id="input-group-1" label="Seleccionar Tecnico:" label-for="id">
	        <b-form-select v-model="datosAsignarTecnico.colaborador"  class="mb-3" name="colaboradores"  >
		      
		        <b-form-select-option :value="null" disabled>-- Seleccione al Tecnico--</b-form-select-option>
		      
		      	<b-form-select-option :value="colaborador.id" v-for="(colaborador, i) in colaboradores" :key="i" v-if="colaboradores.length">{{colaborador.colaborador.nombre}}</b-form-select-option>
		      
		    </b-form-select>
	     </b-form-group>


		 <br>
											
					<div class="text-center mt-3">


						<button type="button" class="btn btn-outline-danger" v-on:click="asignarTecnicoModal=false">Cancelar</button>
						
						<button class="btn btn-outline-success" v-on:click="asignarTecnico=false"><span class="fa fa-check"></span>Registrar</button>

                
					</div>          			
		</form>
</b-modal>

<b-modal  hide-footer v-model="editAsignarTecnicoModal"  :mask-closable="false" :closable="false" size="sm" title="Asignar Tecnico" >

		<form v-on:submit.prevent="editAsignarTectico(extAsignarData)">
			
	     <b-form-group id="input-group-1" label="Seleccionar Tecnico:" label-for="id">
	        <b-form-select v-model="editDatosAsignarTecnico.colaborador"  class="mb-3" name="colaboradores" >
		      
		        <b-form-select-option :value="null" disabled>-- Seleccione al Tecnico--</b-form-select-option>
		      
		      	<b-form-select-option :value="colaborador.id" v-for="(colaborador, i) in colaboradores" :key="i" v-if="colaboradores.length">{{colaborador.colaborador.nombre}}</b-form-select-option>
		      
		    </b-form-select>
	     </b-form-group>


		 <br>
											
					<div class="text-center mt-3">


						<button type="button" class="btn btn-outline-danger" v-on:click="asignarTecnicoModal=false">Cancelar</button>
						
						<button class="btn btn-outline-success" v-on:click="asignarTecnico=false"><span class="fa fa-check"></span>Registrar</button>

                
					</div>          			
		</form>
</b-modal>


<b-modal  hide-footer v-model="mostrarDetalleModal"  :mask-closable="false" :closable="false" size="xl" title="Asignar Tecnico" >


						
						<b-container class="bv-example-row">
						  <b-row>
						    <b-col><h5>Codigo del Registro: <strong>{{datoExtraordinario.id}}</strong></h5></b-col>
						    <b-col><h6>Tipo Registro: <strong>{{datoExtraordinario.tipo_extraordinario}}</strong></h6></b-col>
						  </b-row>
						</b-container>
					<div class="card card-timeline px-1 border-none">
					    <ul class="bs4-order-tracking">
					        <li  :class="datoExtraordinario.estado >'0' ? 'step active': 'step'">
					            <div >
							        	 <b-iconstack :font-scale="datoExtraordinario.estado > '0' ? '5' : '4'" :animation="datoExtraordinario.estado == '1' ? 'throb' : ' '">
										      <b-icon stacked icon="circle-fill" :variant="datoExtraordinario.estado >= '0' ? 'danger' :  'secondary'"></b-icon>
										      <b-icon stacked icon="file-earmark-medical" scale="0.5" variant="white"  ></b-icon>
										    </b-iconstack>
					            </div>
					            Registro del caso
					            
					        </li>
					        <li  :class="datoExtraordinario.estado >'1' ? 'step active': 'step'">
					            <div >
							        	 <b-iconstack :font-scale="datoExtraordinario.estado > '1' ? '5' : '4'" :animation="datoExtraordinario.estado == '2' ? 'throb' : ' '">
										      <b-icon stacked icon="circle-fill" :variant="datoExtraordinario.estado >= '2' ? 'danger' :  'secondary'"></b-icon>
										      <b-icon stacked icon="envelope" scale="0.5" variant="white"  ></b-icon>
										    </b-iconstack>
					            </div>
					            Registro enviado - Contratista
					            
					        </li>
					        <li  :class="datoExtraordinario.estado >'2' ? 'step active': 'step'">
					            <div >
							        	 <b-iconstack :font-scale="datoExtraordinario.estado > '2' ? '5' : '4'" :animation="datoExtraordinario.estado == '3' ? 'throb' : ' '">
										      <b-icon stacked icon="circle-fill" :variant="datoExtraordinario.estado >= '3' ? 'danger' :  'secondary'"></b-icon>
										      <b-icon stacked icon="person-plus-fill" scale="0.5" variant="white"  >
										      </b-icon>
										    </b-iconstack>
					            </div>
					            Asignado al Tecnico
					            
					        </li>
					        <li  :class="datoExtraordinario.estado >'3' ? 'step active': 'step'">
					            <div >
							        	 <b-iconstack :font-scale="datoExtraordinario.estado > '3' ? '5' : '4'" :animation="datoExtraordinario.estado == '4' ? 'throb' : ' '">
										      <b-icon stacked icon="circle-fill" :variant="datoExtraordinario.estado >= '4' ? 'danger' :  'secondary'"></b-icon>
										      <b-icon stacked icon="person-check-fill" scale="0.5" variant="white"  ></b-icon>
										    </b-iconstack>
					            </div>
					            Aceptado por el Tecnico
					            
					        </li>
					        <li  :class="datoExtraordinario.estado >'4' ? 'step active': 'step'">
					            <div >
							        	 <b-iconstack :font-scale="datoExtraordinario.estado > '4' ? '5' : '4'" :animation="datoExtraordinario.estado == '5' ? 'throb' : ' '">
										      <b-icon stacked icon="circle-fill" :variant="datoExtraordinario.estado >= '5' ? 'danger' :  'secondary'"></b-icon>
										      <b-icon stacked icon="check" scale="0.5" variant="white"  ></b-icon>
										    </b-iconstack>
					            </div>
					            Registro atendido
					            
					        </li>
					        <li  :class="datoExtraordinario.estado >'5' ? 'step active': 'step'">
					            <div >
							        	 <b-iconstack :font-scale="datoExtraordinario.estado > '5' ? '5' : '4'" :animation="datoExtraordinario.estado == '6' ? 'throb' : ' '">
										      <b-icon stacked icon="circle-fill" :variant="datoExtraordinario.estado >= '6' ? 'danger' :  'secondary'"></b-icon>
										      <b-icon stacked icon="check-all" scale="0.5" variant="white"  ></b-icon>
										    </b-iconstack>
					            </div>
					            Calificado por el usuario
					            
					        </li>

					        
					        
					    </ul>


					  
					


				

									<div class="ml-auto mr-auto" v-show="datoExtraordinario.estado == '1'">
		
												 <b-card
											    tag="article"
											    style="max-width: 40rem;"
											    class="mb-2"
											    
											  >
												    <b-card-text>
												      <b-list-group>
															  <b-list-group-item button>Fecha de registro: 
															</b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> La atencion sera dentro de las 24 hrs.</small>
															  <b-list-group-item button>I am a button</b-list-group-item>
															</b-list-group>
												    </b-card-text>
											  	</b-card>
									</div>
									<div class="ml-auto mr-auto" v-show="datoExtraordinario.estado == '2'">
		
												 <b-card
											    tag="article"
											    style="max-width: 40rem;"
											    class="mb-2"
											     
											  >
												    <b-card-text>
												      <b-list-group>
															  <b-list-group-item button>Fecha de registro: 
															</b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> La atencion sera dentro de las 24 hrs.</small>
															  <b-list-group-item button>Fecha de envio: </b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> El envio es automatico</small>
															  <b-list-group-item button>I am a button</b-list-group-item>
															</b-list-group>
												    </b-card-text>
											  	</b-card>
									</div>
									<div class="ml-auto mr-auto" v-show="datoExtraordinario.estado == '3'">
		
												 <b-card
											    tag="article"
											    style="max-width: 40rem;"
											    class="mb-2"
											    
											  >
												    <b-card-text>
												      <b-list-group>
															  <b-list-group-item button>Fecha de registro: 
															</b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> La atencion sera dentro de las 24 hrs.</small>
															  <b-list-group-item button>Fecha de envio: </b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> El envio es automatico</small>
															  <b-list-group-item button>Fecha de derivacion: </b-list-group-item>
															  <b-list-group-item button>I am a button</b-list-group-item>
															</b-list-group>
												    </b-card-text>
											  	</b-card>
									</div>
									<div class="ml-auto mr-auto" v-show="datoExtraordinario.estado == '4'">
		
												 <b-card
											    tag="article"
											    style="max-width: 40rem;"
											    class="mb-2"
											     
											  >
												    <b-card-text>
												      <b-list-group>
															  <b-list-group-item button>Fecha de registro: 
															</b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> La atencion sera dentro de las 24 hrs.</small>
															  <b-list-group-item button>Fecha de envio: </b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> El envio es automatico</small>
															  <b-list-group-item button>Fecha de derivacion: </b-list-group-item>
															  <b-list-group-item button>Aceptado por el tecnico: </b-list-group-item>
															  <b-list-group-item button>I am a button</b-list-group-item>
															</b-list-group>
												    </b-card-text>
											  	</b-card>
									</div>
									<div class="ml-auto mr-auto" v-show="datoExtraordinario.estado == '5'">
		
												 <b-card
											    tag="article"
											    style="max-width: 40rem;"
											    class="mb-2"
											    
											  >
												    <b-card-text>
												      <b-list-group>
															  <b-list-group-item button>Fecha de registro: 
															</b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> La atencion sera dentro de las 24 hrs.</small>
															  <b-list-group-item button>Fecha de envio: </b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> El envio es automatico</small>
															  <b-list-group-item button>Fecha de derivacion: </b-list-group-item>
															  <b-list-group-item button>Aceptado por el tecnico: </b-list-group-item>
															  <b-list-group-item button>Atendido el: </b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> El registro fue atendido</small>
															  <b-list-group-item button>I am a button</b-list-group-item>
															</b-list-group>
												    </b-card-text>
											  	</b-card>
									</div>
									<div class="ml-auto mr-auto" v-show="datoExtraordinario.estado == '6'">
		
												 <b-card
											    tag="article"
											    style="max-width: 40rem;"
											    class="mb-2"
											    
											  >
												    <b-card-text>
												      <b-list-group>
															  <b-list-group-item button>Fecha de registro: 
															</b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> La atencion sera dentro de las 24 hrs.</small>
															  <b-list-group-item button>Fecha de envio: </b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> El envio es automatico</small>
															  <b-list-group-item button>Fecha de derivacion: </b-list-group-item>
															  <b-list-group-item button>Aceptado por el tecnico: </b-list-group-item>
															  <b-list-group-item button>Atendido el: </b-list-group-item>
															  <small class="text-muted"><i class="flaticon-message"></i> El registro fue atendido</small>
															  <b-list-group-item button>I am a button</b-list-group-item>
															</b-list-group>
												    </b-card-text>
											  	</b-card>
									</div>

								
					</div>

					
</b-modal>

</base-layout>

</template>

<script>

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';


export default{
	components: {
		Breadcrumbs,
		
		
	},



	data(){
		return {
			data : {
				
			},

			mostrar: true,
			mostrarBusqueda: false,
			asignoMasivo: false,
			asignarTecnicoModal: false,
			editAsignarTecnicoModal: false,
			mostrarDetalleModal: false,

			selected:[],
			selectede:[],
			options:[],

			tipoBusquedas:[
					{ value: null, text: 'Please select an option', disabled: true },
          { value: '1', text: 'Reconexion' },
          { value: '2', text: 'Reparacion' },
          { value: '3', text: 'Todo' }
			],


			extraordinarios: [],
			extraordinariosMasivo: [],
			tipoExtraordinarios: [],
			sedes: [],
			colaboradores: [],
			datosAsignarTecnico:{},

			buscarExtraordinarios:{},
			prueba:{
				tipoBusqueda:'null',
			},
			masivo:{
				colaborador:'',
			},
			estadoExtraordinario:[],

			editDatosAsignarTecnico:{},
			datoExtraordinario:{},

			
		}
	},


	methods : {

		async addMasivo(){
			const formData = new FormData();
                  
           formData.append('empresacolaborador_id', this.masivo.colaborador);
           formData.append('estadoextraordinario_id', this.estadoExtraordinario);

				const res = await this.callApi('post','app/empresaColaborador', formData)
					if (res.status==201) {
						 // console.log('datos buscados',res.data )
		           //       this.extraordinariosMasivo= res.data
		          // window.open('/back/app/service/extraordinarioservice');
							this.$swal('Se asignaron','Correctamente','success')
		           window.location.href = '/service/extraordinarioservice'
					}
						else{
							this.$swal('Ocurrio algun error','Intentelo nuevamente','error')
						}


		},

		async editAsignarTecnicoDatos(extraordinario, index){
			//console.log('datosestraordinarios',extraordinario);

			let obj ={
			/*	id : user.id,
				name : user.name,
				email : user.email,
				fullName : user.fullName,*/
				id : extraordinario.id,
				estadoextraordinario_id : extraordinario.estado_extraordinario.id,
				suministro_id : extraordinario.suministro_id,
				ApellidoMaterno : extraordinario.suministro.ApellidoMaterno,
				ApellidoPaterno : extraordinario.suministro.ApellidoPaterno,
				Nombre : extraordinario.suministro.Nombre,
				NombreSuministro : extraordinario.suministro.NombreSuministro,
				DireccionPredio : extraordinario.suministro.DireccionPredio,
				NombreDepartamento : extraordinario.suministro.NombreDepartamento,
				NombreProvincia : extraordinario.suministro.NombreProvincia,
				NombreDistrito : extraordinario.suministro.NombreDistrito,
				SerieMedidor : extraordinario.suministro.SerieMedidor,
				NombreZonaAdministrativa : extraordinario.suministro.NombreZonaAdministrativa,
				NombreTipoSistema : extraordinario.suministro.NombreTipoSistema,
				tipoExtraordinario_id : extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id,
				




			}
			this.editExtAsignarData = obj
			this.editAsignarTecnicoModal=true
			this.index = index

		},

		async editAsignarTectico(editExtAsignarData){
			//console.log('datitos', this.extAsignarData.estadoextraordinario_id);

			this.editDatosAsignarTecnico.estadoextraordinario_id=this.editExtAsignarData.estadoextraordinario_id
			this.editDatosAsignarTecnico.tipoExtraordinario_id =this.editExtAsignarData.tipoExtraordinario_id 

			const res = await this.callApi('put','app/serviceEditExtraordinarioAsignar', this.editDatosAsignarTecnico)
				if (res.status==201) {
					  //console.log('datos buscados',res.data )
	                  //this.extraordinariosMasivo= res.data
	                  ///this.extraordinarios[this.index].estado_extraordinario.estado = 2
										//this.users[this.index] = this.editData
									//	console.log('datitos',this.index)

	                  //this.roles[this.index].roleName = this.editData.roleName
                //this.extraordinarios[this.index] = this.extAsignarData
                //this.extraordinarios.estado_extraordinario = this.extAsignarData
								this.$swal('Actualizado !','Cambiós Tecnico correctamente','success')
								this.editAsignarTecnicoModal=false
								//this.$router.push({name: 'extraordinarioService'})
							//	window.location.href = '/service/extraordinarioservice'
				}else if(res.status==400){
					console.log('status',res.data);
					this.$swal('Ocurrio algun problema !',res.data.message,'warning')

				}
					else{
						this.$swal('Ocurrio algun error','Intentelo nuevamente','error')
					}


		},


		async asignarTecnicoDatos(extraordinario, index){
			//console.log('datosestraordinarios',extraordinario);

			let obj ={
			/*	id : user.id,
				name : user.name,
				email : user.email,
				fullName : user.fullName,*/
				id : extraordinario.id,
				estadoextraordinario_id : extraordinario.estado_extraordinario.id,
				suministro_id : extraordinario.suministro_id,
				ApellidoMaterno : extraordinario.suministro.ApellidoMaterno,
				ApellidoPaterno : extraordinario.suministro.ApellidoPaterno,
				Nombre : extraordinario.suministro.Nombre,
				NombreSuministro : extraordinario.suministro.NombreSuministro,
				DireccionPredio : extraordinario.suministro.DireccionPredio,
				NombreDepartamento : extraordinario.suministro.NombreDepartamento,
				NombreProvincia : extraordinario.suministro.NombreProvincia,
				NombreDistrito : extraordinario.suministro.NombreDistrito,
				SerieMedidor : extraordinario.suministro.SerieMedidor,
				NombreZonaAdministrativa : extraordinario.suministro.NombreZonaAdministrativa,
				NombreTipoSistema : extraordinario.suministro.NombreTipoSistema,
				tipoExtraordinario_id : extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id,



			}
			this.extAsignarData = obj
			this.asignarTecnicoModal=true
			this.index = index

		},

		async asignarTectico(extAsignarData){
			//console.log('datitos', this.extAsignarData.estadoextraordinario_id);

			this.datosAsignarTecnico.estadoextraordinario_id=this.extAsignarData.estadoextraordinario_id
			this.datosAsignarTecnico.tipoExtraordinario_id =this.extAsignarData.tipoExtraordinario_id 

			const res = await this.callApi('post','app/serviceExtraordinarioAsignar', this.datosAsignarTecnico)
				if (res.status==201) {
					  //console.log('datos buscados',res.data )
	                  //this.extraordinariosMasivo= res.data
	                  ///this.extraordinarios[this.index].estado_extraordinario.estado = 2
										//this.users[this.index] = this.editData
									//	console.log('datitos',this.index)

	                  //this.roles[this.index].roleName = this.editData.roleName
                //this.extraordinarios[this.index] = this.extAsignarData
                //this.extraordinarios.estado_extraordinario = this.extAsignarData
								this.$swal('Excelent !','Asigno registro correctamente','success')
								this.asignarTecnicoModal=false
								//this.$router.push({name: 'extraordinarioService'})
								window.location.href = '/service/extraordinarioservice'
				}
					else{
						this.$swal('Ocurrio algun error','Intentelo nuevamente','error')
					}


		},


		async Masivo(page = 1){
			this.asignoMasivo=true;
			
			console.log('Dato enviado',this.prueba.tipoBusqueda);
			const formData = new FormData();
                  
           formData.append('tipoBusqueda', this.prueba.tipoBusqueda);

			const res = await this.callApi('post','app/serviceExtraordinarioMasivo?page=' + page, formData)
			if (res.status==200) {
				  console.log('datos buscados',res.data )
                  this.extraordinariosMasivo= res.data
			}
				else{
					this.$swal('Ocurrio algun error','Intentelo nuevamente','error')
				}

		
		},

		getResultsGeneral(page = 1) {
            axios.get('app/serviceExtraordinario?page=' + page,{
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
                   
                    console.log('estraodinarios',response.data)
                });
        },

    getResults(page = 1) {
          axios.get('app/serviceExtraordinarioBuscar?page=' + page,{
             params: {
             	tipoSearch: this.searchData.tipoSearch,
               	search: this.searchData.search

             }
          })
              .then(response => {
                  this.buscarExtraordinarios = response.data;
                  this.buscarExtraordinarioR = response.data;
                  this.mostrarBusqueda = true
                  this.mostrar = false
                 
                  console.log(response.data)
              });
      },


    async mostrarDetalle(extraordinario, index){

    	let obj ={
				id : extraordinario.id,
				estadoextraordinario_id : extraordinario.estado_extraordinario.id,
				suministro_id : extraordinario.suministro_id,
				ApellidoMaterno : extraordinario.suministro.ApellidoMaterno,
				ApellidoPaterno : extraordinario.suministro.ApellidoPaterno,
				Nombre : extraordinario.suministro.Nombre,
				NombreSuministro : extraordinario.suministro.NombreSuministro,
				DireccionPredio : extraordinario.suministro.DireccionPredio,
				NombreDepartamento : extraordinario.suministro.NombreDepartamento,
				NombreProvincia : extraordinario.suministro.NombreProvincia,
				NombreDistrito : extraordinario.suministro.NombreDistrito,
				SerieMedidor : extraordinario.suministro.SerieMedidor,
				NombreZonaAdministrativa : extraordinario.suministro.NombreZonaAdministrativa,
				NombreTipoSistema : extraordinario.suministro.NombreTipoSistema,
				tipoExtraordinario_id : extraordinario.obs_tipo_extraordinario.tipoExtraordinario_id,

				tipo_extraordinario :   extraordinario.obs_tipo_extraordinario.tipo_extraordinario.nombreTipoExt,
				estado :   extraordinario.estado_extraordinario.estado,
				fechaAtencion :   extraordinario.estado_extraordinario.fechaAtencion,
				fechaFinal :   extraordinario.estado_extraordinario.fechaFinal,
				fechaInicio :   extraordinario.estado_extraordinario.fechaInicio,
				fechaRegistro :   extraordinario.estado_extraordinario.fechaRegistro,
				fechaAtencion :   extraordinario.estado_extraordinario.fechaAtencion,

			}

			this.datoExtraordinario = obj
			this.index = index





			this.mostrarDetalleModal=true
		},

	


	},

		async created(){
			try	{
				
				this.getResultsGeneral();

				const [  resTipoExtraordinario, resSede, rescol] = await Promise.all([
						//this.callApi('get', 'app/extraordinario'),
						this.callApi('get', '/back/app/getTipoExtraordinario'),
						this.callApi('get', '/back/app/getSedes'),
						this.callApi('get', 'app/empresaColaboradores')
					])
				
					
					this.tipoExtraordinarios = resTipoExtraordinario.data,
					this.sedes = resSede.data,
					this.colaboradores = rescol.data,
					
					
					console.log('los datos del colaboradores son',this.colaboradores)
					

				} catch {
					this.$swal('Any fool can use a computer','de','error')
				}
				
				
			},


		

		


	




}




  </script>