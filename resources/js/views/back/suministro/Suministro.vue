<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Suministro
	</template>
	
	<template v-slot:prueba>
	    <li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>
		<li><a href="#">Suministros del sistema</a></li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li><a href="#">Serven</a></li>
		<li class="separator">
			<i class="flaticon-right-arrow"></i>
		</li>

		<li>Suministros</li>
  	</template>
</Breadcrumbs>

	<div class="card mb-3">
		<div class="card-header d-flex">
			<span>
				<i class="fas fa-chart-area"></i>
					Busqueda
			</span>
		


		<div class="form-inline my-2 my-lg-0 ml-auto" >


			<b-form-select v-model="searchData.tipoSearch" :options="options"></b-form-select>
			<b-form-input id="search"  v-model="searchData.search" type="text" placeholder="Search" aria-label="Search" v-on:keyup.enter="getResults">
            </b-form-input>
			
			
		</div>
			<button class="btn btn-outline-primary my-2 my-sm-0" @click="getResults"><span class="fas fa-search"></span> Buscar</button>


		</div>
	</div>
		<div class="row">
			<div class="col-md-12  ml-auto mr-auto">
				<div class="card border-primary">
					<div class="card-body">
						<div class="row  justify-content-md-center">
                     <div class="table-responsive-xl">

					
                     <table class="table table-hover tablaSuministro">

								
								<thead>
									<tr>
										<td class="bg-primary text-white text-center">ID</td>
										<td class="bg-primary text-white text-center">Suministro</td>
										<td class="bg-primary text-white text-center">Titular</td>
										<td class="bg-primary text-white text-center" >Zona Administrativa</td>
										<td  class="bg-primary text-white text-center">Direccion</td>
										
										<td class="bg-primary text-white text-center">Accion</td>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(buscarSuministro, i) in buscarSuministros.data" :key="i" v-if="buscarSuministros.data.length">
										<td>{{i+1}}</td>
										<td>{{buscarSuministro.CodigoSuministro}}</td>
										<td>{{buscarSuministro.NombreSuministro}}</td>
										<td class="bg-primary text-white"  >{{buscarSuministro.NombreZonaAdministrativa}}</td>
										<td>{{buscarSuministro.DireccionPredio}}</td>
										
										
										<td>
											<b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
										   

										    <b-dropdown-item href="#"  @click="regExtraordinarioModal(buscarSuministro, i)" v-if="isWritePermitted" >
										    	<button class="btn btn-primary btn-sm" ><span class="fas fa-plus">
											</span></button> Registrar
										    </b-dropdown-item>

                                  <b-dropdown-item href="#"  @click="showRegCorreoModal(buscarSuministro, i)" v-if="isWritePermitted" >
                                    <button class="btn btn-primary btn-sm" ><span class="fas fa-at">
                                 </span></button> Actualizar Datos
                                  </b-dropdown-item>

                                  <b-dropdown-item href="#"  @click="showCargarAutorizacion(buscarSuministro, i)" v-if="isWritePermitted" >
                                    <button class="btn btn-warning btn-sm" ><span class="fas fa-upload">
                                 </span></button> Cargar Autorizacion
                                  </b-dropdown-item>

										    <b-dropdown-item href="#" @click="showdeletingModal(buscarSuministro, i)" :loading="buscarSuministro.isDeleting" v-if="isDeletePermitted">
										    	<button class="btn btn-danger btn-sm" ><span class="fa fa-trash"></span></button> Eliminar
										    </b-dropdown-item>


										  </b-dropdown>
										</td>

										
										
									</tr>
								</tbody>
							</table>
							
							</div>
							
								
							<advanced-laravel-vue-paginate :data="buscarSuministros" @paginateTo="getResults"></advanced-laravel-vue-paginate>


						</div>

					</div>
				</div>
			</div>
		</div>



<b-modal  hide-footer v-model="regModal" title="Registrar Caso" size="xl">

	<div class="d-block ">
		<b-overlay :show="cargar" rounded="lg">
	      <template #overlay>
	        <div class="d-flex align-items-center">

	          <b-button variant="outline-primary" disabled>
					    <b-spinner small type="grow" variant="primary"></b-spinner>
		          <b-spinner type="grow" variant="primary"></b-spinner>
		          <b-spinner style="width: 3rem; height: 3rem;" label="Large Spinner" type="grow" variant="primary"></b-spinner>
		          <b-spinner type="grow" variant="primary"></b-spinner>
		          <b-spinner small type="grow" variant="primary"></b-spinner>
		          <br>
		          <h3>Espere a que el correo sea enviado...</h3>
					    
					  </b-button>
 
	        </div>
	      </template>
    	<div class="row mt--1">
         <div class="col-md-12" >
            <b-card no-body v-show="registroExtaordinario">
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
                 
                       	<form v-on:submit.prevent="regExtraordinario(regData)">
                       		<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                              <b-col>
                                 <b-form-group id="input-group-1" label="Verificar si existe un registro de este dia :" label-for="dni" >

                                 </b-form-group>
                              </b-col>
                              <b-col>
                                 <b-form-checkbox v-model="checkedSuministro" name="check-button" switch  v-on:change="getExtraordinarioR">
                                 <b> Verificar registros</b>
                                 </b-form-checkbox>
                              </b-col>
                           </b-row>

                           <b-container class="bv-example-row">

                             <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                               <b-col>
                                 <b-form-group id="input-group-1" label="CodigoSuministro :" label-for="CodigoSuministro" >
                                       <b-form-input id="CodigoSuministro" v-model="regData.CodigoSuministro" type="text" placeholder="Ingresar el CodigoSuministro" disabled>
                                       </b-form-input>
                                 </b-form-group>
                                 <b-form-group  id="input-group-1" label="CodigoRutaSuministro :" label-for="CodigoRutaSuministro" >
                                         <b-form-input id="CodigoRutaSuministro" v-model="regData.CodigoRutaSuministro" type="text" placeholder="Ingresar CodigoRutaSuministroPaterno" disabled>
                                         </b-form-input>
                                      </b-form-group>
                                                    
                               </b-col>
                               <b-col>
                                 	<b-form-group  id="input-group-1" label="Documento :" label-for="Documento">
                                         <b-form-input id="Documento" v-model="regData.Documento" type="text" placeholder="Ingresar los Documento" disabled>
                                         </b-form-input>
                                      </b-form-group>
                                      <b-form-group id="input-group-1" label="Direccion :" label-for="direccion" >
                                         <b-form-input id="direccion" v-model="regData.DireccionPredio" type="text" placeholder="Ingresar la direccion" disabled>
                                         </b-form-input>
                                      </b-form-group>
                                      
                               </b-col>
                             </b-row>

                             <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                               <b-col>
                                 
                               		<b-form-group  id="input-group-1" label="Nombre del Titular :" label-for="NombreSuministro" >
                                         <b-form-input id="NombreSuministro" v-model="regData.NombreSuministro" type="text" placeholder="Ingresar el NombreSuministro" disabled>
                                         </b-form-input>
                                      </b-form-group>
                                     <b-form-group id="input-group-1" label="Latitud :" label-for="Latitud" >
                                      <b-form-input id="Latitud" v-model="regData.Latitud" type="text" placeholder="Ingresar el Latitud" disabled>
                                      </b-form-input>
                                   </b-form-group>
                                         
                                                    
                               </b-col>
                               <b-col>
                                 
                               		<b-form-group  id="input-group-1" label="Telefono :" label-for="telefono" >
                                         <b-form-input id="telefono" v-model="regData.Telefono" type="text" placeholder="Sin telefono" disabled>
                                         </b-form-input>
                                      </b-form-group>
                                      <b-form-group id="input-group-1" label="Longitud :" label-for="Longitud" >
                                         <b-form-input id="Longitud" v-model="regData.Longitud" type="text" placeholder="Ingresar el Longitud" disabled>
                                         </b-form-input>
                                      </b-form-group>
                                      
                               </b-col>
                             </b-row>

                           </b-container>

                           <b-row cols="1" cols-sm="1" cols-md="3" cols-lg="3">
                              <b-col>

                                 <b-form-group  id="input-group-1" label="Departamento :" label-for="departamento" >
                                 <b-form-input id="departamento" v-model="regData.NombreDepartamento" type="text" placeholder="Ingresar el NombreDepartamento" disabled>
                                 </b-form-input>
                                 </b-form-group>
                              </b-col>
                              <b-col>
                                 <b-form-group  id="input-group-1" label="NombreProvincia :" label-for="NombreProvincia" >
                                    <b-form-input id="NombreProvincia" v-model="regData.NombreProvincia" type="text" placeholder="Ingresar el NombreProvincia" disabled>
                                    </b-form-input>
                                 </b-form-group>

                              </b-col>

                              <b-col>

                                 <b-form-group  id="input-group-1" label="NombreDistrito :" label-for="NombreDistrito" >
                                    <b-form-input id="NombreDistrito" v-model="regData.NombreDistrito" type="text" placeholder="Ingresar el ANombreDistrito" disabled>
                                    </b-form-input>
                                 </b-form-group>

                              </b-col>

                           </b-row>

                           <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">

                        		<b-col>
                                    
                                <b-form-group  id="input-group-1" label="Nombre Zona Administrativa :" label-for="NombreZonaAdministrativa" >
                                   <b-form-input id="NombreZonaAdministrativa" v-model="regData.NombreZonaAdministrativa" type="text" placeholder="Ingresar el ANombreDistrito" disabled>
                                   </b-form-input>
                                </b-form-group>
                                   
                            	</b-col>

                           </b-row>

                              <br>
                                                  
                        </form>
                 
               	     </div>   
                  </b-tab>

                  <b-tab title="Datos Solicitante"   v-if="regExtSolicitante">
                     <div class="d-block " >
                        <form v-on:submit.prevent="addPersona">
                           <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                              <b-col>
                                 <b-form-group id="input-group-1" label="Relacion:" label-for="id">
                                    <b-form-select v-model="regData.idRelacion"  class="mb-3" name="idRelacion" :state="state" >
                                       <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                       <b-form-select-option :value="relacion.id" v-for="(relacion, i) in relacions" :key="i" v-if="relacions.length">{{relacion.nombre}}</b-form-select-option>
                                    </b-form-select>
                                 </b-form-group>
                              </b-col>
                              <b-col v-if="descripcionDescuentoN">
                                 <b-form-group id="input-group-1" label="Tipo Documento:" label-for="id">
                                    <b-form-select v-model="regData.tipoDocumento"  class="mb-3" name="tipoDocumento"  >
                                       <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                       <b-form-select-option :value="tipoDocumento.id" v-for="(tipoDocumento, i) in tipoDocumentos" :key="i" v-if="tipoDocumentos.length">{{tipoDocumento.nombre}}</b-form-select-option>
                                    </b-form-select>
                                 </b-form-group>
                              </b-col>
                           </b-row>

                           <b-container class="bv-example-row" v-if="descripcionDescuentoN">
                              <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                 <b-col>
                                 	<b-form-group id="input-group-1" label="Numero Documento :" label-for="dni" >
                                   	   <b-form-input id="dni" v-model="regData.dni" type="number" placeholder="Ingresar numero del documento" maxlength="8" v-on:keyup="getPersonaID" >
                                   	   </b-form-input>
                                 	</b-form-group>
                                 	<b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat"  v-if="formPersona" >
                                      <b-form-input id="apellPat" v-model="personaID.apellPat" type="text" placeholder="Ingresar el Apellido Paterno"  >
                                      </b-form-input>
                                   </b-form-group>		     	 
                                 </b-col>
                                 <b-col>
                                   <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat" v-if="formPersona" >
                                      <b-form-input id="apellMat" v-model="personaID.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
                                      </b-form-input>
                                   </b-form-group>
                                   <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre" v-if="formPersona" >
                                      <b-form-input id="nombre" v-model="personaID.nombre" type="text" placeholder="Ingresar los nombres" >
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
                                    <b-form-group id="input-group-1" label="Telefono :" label-for="telefono" >
                                       <b-form-input id="telefono" v-model="personaID.telefono" type="text" placeholder="Ingresar el telefono" >
                                       </b-form-input>
                                    </b-form-group>
                               </b-col>
                              	<b-col >
                                  	<b-form-group label="Sexo">
                              	      <b-form-radio v-model="personaID.sexo" name="some-radios" value="0">femenino</b-form-radio>
                              	      <b-form-radio v-model="personaID.sexo" name="some-radios" value="1">Masculino</b-form-radio>
                              	    </b-form-group>	     	 
                                  </b-col>
                              </b-row>
                           </b-container>            			
                    	   </form>
                    
                     </div>                
                  </b-tab>

                 	<b-tab title="Registrar Caso" v-if="regExtCaso">
                     <div class="d-block ">
                        <form v-on:submit.prevent="addExtraordinario">
                           <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                              <b-col>

                                 <b-form-group id="input-group-1" label="Seleccionar el Tipo de Registro:" label-for="id">
                                    <b-form-select v-model="tipoExtraordinario.id"  class="mb-3" name="tipoExtraordinario" @change='getObsTipoExtraordinario()' >

                                       <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>

                                       <b-form-select-option :value="tipoExtraordinario.id" v-for="(tipoExtraordinario, i) in tipoExtraordinarios" :key="i" v-if="tipoExtraordinarios.length">{{tipoExtraordinario.nombreTipoExt}}</b-form-select-option>
                                    </b-form-select>
                                 </b-form-group>
                              </b-col>
                              <b-col>
                                 <b-form-group id="input-group-1" label="Seleccionar Descripcion del Registro:" label-for="obsTipoExtraordinario_id">
                                    <b-form-select v-model="regData.obsTipoExtraordinario_id" class="mb-3" name="obsTipoExtraordinario"  >
                                       <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                       <b-form-select-option :value="obsTipoExtraordinario.id" v-for="(obsTipoExtraordinario, i) in obsTipoExtraordinarios" :key="i" v-if="obsTipoExtraordinarios.length">{{obsTipoExtraordinario.nombreObsTipoExt}}</b-form-select-option>
                                    </b-form-select>
                                 </b-form-group>
                              </b-col>
                           </b-row>
                           <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                              <b-col>
                                 <b-form-group id="input-group-1" label="Observacion :" label-for="referencia" >
                                    <b-form-textarea
                                       id="referencia"
                                       v-model="regData.referencia" 
                                       placeholder="Ingresar el referencia..."
                                       rows="3"
        
                                     ></b-form-textarea>

                                    
                                 </b-form-group>
                              </b-col>
                              <b-col>
                                 <b-alert show variant="danger">
                                   <b-form-group id="input-group-1" label="Seleccionar provincia - SERVICE:" label-for="IdProvincia">
                                  
                                       <b-form-select v-model="regData.IdProvincia" class="mb-3" name="IdProvincia" >
                                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option  variant="success">
                                          <b-form-select-option :value="datasede.id" v-for="(datasede, i) in dataSedes" :key="i" v-if="dataSedes.length">{{datasede.nombre}}</b-form-select-option>
                                       </b-form-select>

                                    </b-form-group>
                                 </b-alert>

                              </b-col>
                           </b-row>
                           <br>
                           <div class="text-center mt-3">
                              <button type="button" class="btn btn-outline-danger" v-on:click="regModal=false">Cancelar</button>
                              <button class="btn btn-outline-success"  v-if="RegistrarExtr"><span class="fa fa-check"></span>Registrar</button>
                           </div>
                        </form>
                	    </div>
                     	
                     </b-tab>

                     <div class="text-center mt-3" v-if="regExtSolicitante">
                                             
                         <button type="button" class="btn btn-outline-primary" @click="tabIndex--" v-if="tabIndex >= 1" >Anterior</button>
                         <button type="button" class="btn btn-outline-primary" @click="tabIndex++" v-if="tabIndex <= 1" >Siguiente</button>
                     
                     
                     <p class="font-weight-bold text-success">Avance : {{ tabIndex }} de 3</p>
                 
                     </div>
                  </b-tabs>
            </b-card>

             <b-card
                 title="Caso Registrado"
                 img-src="/assets/img/examples/product6.jpg"
                 img-alt="Image"
                 img-top
                 tag="article"
                 style="max-width: 20rem;"
                  class="mx-auto text-center"
                 v-show="registroPdf"

               >
             	<b-card-text>
                 	Datos del Registro.
                   <br>
                   Codigo: {{extraordinario.id}}
               </b-card-text>
                  <button type="button" class="btn btn-default" v-on:click="regModal=false">Aceptar</button>
                  <b-button :href="'/back/app/generate-pdf/'+extraordinario.id" variant="danger">PDF</b-button>
                 <!--
                  <b-dropdown-item href="#" v-if="isWritePermitted" @click="getMailExtraordinario(extraordinario, i)" >
                		<button class="btn btn-primary btn-sm"  ><span class="fas fa-paper-plane"></span></button> Enviar
				        </b-dropdown-item>
                  -->
             </b-card>
	        </div>
	    </div>
	  </b-overlay>
  	</div>
</b-modal>



<b-modal  hide-footer v-model="reiterativoModal" title="Registrar Reiterativo">
   <b-form-group id="input-group-1" label="observacioReiterativo :" label-for="observacioReiterativo" >
         <b-form-textarea id="observacioReiterativo" v-model="regRei.observacioReiterativo" type="text" placeholder="Ingresar la Observacion y/o reclamo" >
         </b-form-textarea>
   </b-form-group>

   <button type="button" class="btn btn-outline-primary" v-on:click="storeEstadoExtraordinario(datoRespuesta,regRei)">Aceptar</button>
   <button type="button" class="btn btn-outline-danger" v-on:click="reiterativoModal=false">Cancelar</button>
            

</b-modal>



<b-modal  hide-footer v-model="regCorreoModal" title="Registro de correo para la emision de recibos" size="xl" >

   <b-overlay :show="cargarValidacion" rounded="lg"  variant="light" opacity="0.8">
         <template #overlay>
           <div class="text-center">
             <b-icon icon="stopwatch" font-scale="3" animation="cylon"></b-icon>
                      
             </div>
              <div class="d-flex align-items-center">
                    
                 <strong>Espere a que el correo para la validacion sea enviada...</strong>
             
              </div>
         </template>
   
      <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="2">
         <b-col>
            <b-card
            
                
                 border-varian="success"
                 header="Datos del Suministro"
                 header-bg-variant="success"
                 header-text-variant="white"
                 align="center"
              >
               
                <b-card-text>

                  <div>
                     <b-table-simple small caption-top stacked class="tablaInforme">
    
                      <b-tbody>
                        <b-tr>
                          <b-th stacked-heading="Codigo del suministro"  >{{getDataSuministro.CodigoSuministro}}</b-th>
                          <b-td stacked-heading="Codigo de Ruta">{{getDataSuministro.CodigoRutaSuministro}}</b-td>
                          <b-td stacked-heading="Nombre del Suministro">{{getDataSuministro.NombreSuministro}}</b-td>
                          <b-td stacked-heading="Documento">{{getDataSuministro.Documento}}</b-td>
                          <b-td stacked-heading="Direccion del Predio">{{getDataSuministro.DireccionPredio}}</b-td>
                          <b-td stacked-heading="Nombre Zona">{{getDataSuministro.NombreZonaAdministrativa}}</b-td>
                          <b-td stacked-heading="Distrito">{{getDataSuministro.NombreDistrito}}</b-td>
                          <b-td stacked-heading="Tarifa || Serie Medidor">{{getDataSuministro.Tarifa}} || {{getDataSuministro.SerieMedidor}}</b-td>
                          <b-td stacked-heading="Correo" :variant=" getDataRegistro.registroestadoConfirmacion == 1 ? 'success' : 'warning'">{{getDataSuministro.correo}}|| <strong class="text-info">{{getDataRegistro.registroCorreo }}
                                             </strong></b-td>

                          

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
                 header="Registro de Contacto"
                 header-bg-variant="primary"
                 header-text-variant="white"
                 align="center"
              >
                <b-card-text>

                  <b-form-group
                       id="input-group-1"
                       label="Correo"
                       label-for="input-1"
                       description="Ingresar el correo en donde se enviaran los recibos."
                       class="mb-0"
                     >
                       <b-form-input
                         id="input-1"
                         v-model="regCorreoData.correo"
                         type="email"
                         placeholder="Ingresar correo"
                         required
                         :disabled="(regCorreoData.estadoConfirmacion == '1' && habilitarEdit == true)"
                       ></b-form-input>
                  </b-form-group>

                  <b-form-group id="input-group-2" label="Celular" label-for="input-2"
                       description="El numero de celular sera util para cordinaciones." class="mb-0">
                       <b-form-input
                         id="input-2"
                         v-model="regCorreoData.celular"
                         placeholder="Ingresar el numero celular"
                         required
                         :disabled="(regCorreoData.estadoConfirmacion == '1' && habilitarEdit == true)"
                       ></b-form-input>
                  </b-form-group>
                     
                    

                     <b-col>
                        <label for="id"> <b>Relacion:</b> </label>  
                        
                           <b-form-select v-model="regCorreoData.relacion_id"  class="mb-3" name="idRelacion" :state="stateIdR" >
                              <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                              <b-form-select-option :value="relacion.id" v-for="(relacion, i) in relacions" :key="i" v-if="relacions.length" >{{relacion.nombre}}</b-form-select-option>
                           </b-form-select>
                        
                     </b-col>

                     <div v-if="registroREsponsableCorreo">
                        <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
                             
                              <b-col >
                                 <b-form-group id="input-group-1" label="Tipo Documento:" label-for="id" class="mb-0">
                                    <b-form-select v-model="regData.tipoDocumento"  class="mb-3" name="tipoDocumento"  >
                                       <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                       <b-form-select-option :value="tipoDocumento.id" v-for="(tipoDocumento, i) in tipoDocumentos" :key="i" v-if="tipoDocumentos.length">{{tipoDocumento.nombre}}</b-form-select-option>
                                    </b-form-select>
                                 </b-form-group>
                              </b-col>
                           </b-row>

                        <b-container class="bv-example-row" >
                           <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                              <b-col>
                                 <b-form-group id="input-group-1" label="Numero Documento :" label-for="dni" class="mb-0" >
                                    <b-form-input id="dni" v-model="regData.dni" type="number" placeholder="Ingresar numero del documento" maxlength="8" v-on:keyup="getPersonaID" >
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat"  v-if="formPersona" class="mb-0">
                                   <b-form-input id="apellPat" v-model="personaID.apellPat" type="text" placeholder="Ingresar el Apellido Paterno"  >
                                   </b-form-input>
                                </b-form-group>           
                              </b-col>
                              <b-col>
                                <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat" v-if="formPersona" class="mb-0">
                                   <b-form-input id="apellMat" v-model="personaID.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
                                   </b-form-input>
                                </b-form-group>
                                <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre" v-if="formPersona" class="mb-0">
                                   <b-form-input id="nombre" v-model="personaID.nombre" type="text" placeholder="Ingresar los nombres" >
                                   </b-form-input>
                                </b-form-group>
                              </b-col>
                           </b-row>

                           <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2"  >

                           </b-row>

                        </b-container>

                        
                     </div>


                     <b-col>
                        <b-alert show variant="warning">
                           <label for="IdProvincia">Seleccionar provincia del registro:</label>                      
                         
                              <b-form-select v-model="getDataSuministro.IdProvincia" class="mb-3" name="IdProvincia" >
                                 <b-form-select-option :value="null" disabled>-- Seleccione una provincia --</b-form-select-option  variant="success">
                                 <b-form-select-option :value="(datasede.id)" v-for="(datasede, i) in dataSedes" :key="i" v-if="dataSedes.length">{{datasede.nombre}}</b-form-select-option>
                              </b-form-select>

                           
                        </b-alert>

                     </b-col>

                        <b-container class="bv-example-row">

                           <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                              
                              <b-col >
                                 <b-form-group label="Sexo" class="mb-0">
                                    <b-form-radio v-model="personaID.sexo" name="some-radios" value="0">Femenino</b-form-radio>
                                    <b-form-radio v-model="personaID.sexo" name="some-radios" value="1">Masculino</b-form-radio>
                                  </b-form-group>         
                               </b-col>
                                 <b-form-group label="Datos completos?" class="mb-0">
                                     <b-form-checkbox v-model="regCorreoData.pdf" name="check-button" switch  v-if="(validardataC || regCorreoData.registrar == 1)">
                                          (NO / SI)
                                     </b-form-checkbox>
                                  </b-form-group> 
                           </b-row>
                        </b-container> 
                </b-card-text>

              </b-card>


            <b-card
                border-variant="danger"
                 header="Formato de autorizacion"
                 header-bg-variant="danger"
                 header-text-variant="white"
                 align="center"
                  v-if="(regCorreoData.pdf == '1')"
              >
                  <b-card-text>

                     <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1"  >
                        <b-col>
                        <button type="button" class="btn btn-outline-primary" v-on:click="formatPdf()"><span class="fas fa-print"></span> Imprimir formato</button>
                        </b-col>

                    
                     </b-row>

                  </b-card-text>

                
            </b-card>

         </b-col>

      </b-row>

      

   <button type="button" class="btn btn-outline-primary" v-if="(regCorreoData.estadoConfirmacion == '1' && habilitarEdit == true)" v-on:click="regCorreoSuministroEdit()">Habilitar edicion</button>
   <button type="button" class="btn btn-outline-primary" v-if="(regCorreoData.registrar == 2 && regCorreoData.estadoConfirmacion == 1 && regCorreoData.pdf == 1)"  v-on:click="editCorreoSuministro()">Actualizar</button>
   <button type="button" class="btn btn-outline-primary" v-if="((regCorreoData.registrar == 1 && regCorreoData.pdf == 1) || (regCorreoData.estadoConfirmacion == 0 && regCorreoData.pdf == 1))"  v-on:click="regCorreoSuministro()">Registrar</button>
   <button type="button" class="btn btn-outline-danger" v-on:click="regCorreoModal=false">Cancelar</button>
            
</b-overlay >
</b-modal>

<b-modal  hide-footer v-model="showModalCargarAutorizacion" title="Cargar Autorizacion"  >
   <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1"  >

      
         <b-col>
            <b-card
            
                
                 border-varian="success"
                 header="Datos del Suministro"
                 header-bg-variant="success"
                 header-text-variant="white"
                 align="center"
              >
               
                <b-card-text>

                  <div>
                     <b-table-simple small caption-top stacked class="tablaInforme">
    
                      <b-tbody>
                        <b-tr>
                          <b-th stacked-heading="Codigo del suministro"  >{{getDataSuministro.CodigoSuministro}}</b-th>
                          <b-td stacked-heading="Codigo de Ruta">{{getDataSuministro.CodigoRutaSuministro}}</b-td>
                          <b-td stacked-heading="Nombre del Suministro">{{getDataSuministro.NombreSuministro}}</b-td>
                          <b-td stacked-heading="Documento">{{getDataSuministro.Documento}}</b-td>
                          <b-td stacked-heading="Direccion del Predio">{{getDataSuministro.DireccionPredio}}</b-td>
                          <b-td stacked-heading="Distrito">{{getDataSuministro.NombreDistrito}}</b-td>
                          <b-td stacked-heading="Correo">ejemplo@ejemplo.com ||

                          <strong class="text-info">{{getDataRegistro.registroCorreo }}
                                             </strong>
                                          </b-td>
                          <b-td stacked-heading="Autorizacion"  v-if="getDataRegistro.registroestadoarchivo == 1"><button type="button" class="btn btn-outline-danger" v-if="getDataRegistro.registroestadoarchivo > 0" v-on:click="pdfArchivo()"><span class="fas fa-file-pdf"></span> Documento escaneado</button></b-td>

                        </b-tr>

                        
                      </b-tbody>

                      
                    </b-table-simple>


                  </div>


                </b-card-text>
                 
                     <b-button block variant="outline-warning"  v-b-toggle.collapse-1 v-if="getDataRegistro.registroestadoConfirmacion != null  "> Validacion Correo </b-button>
                    <b-collapse  id="collapse-1">
                      <b-card >
                        <b-form-checkbox v-model="getDataRegistro.registroestadoConfirmacion" name="check-button" switch  value="1" unchecked-value="0"  v-on:change="getValidarManual(getDataRegistro)">

                              <b> Correo Validado (NO / SI)</b>
                                 
                        </b-form-checkbox>
                      </b-card>
                    </b-collapse>
                  
 
              </b-card>
            </b-col>

      <b-col>

         <b-alert variant="warning" show v-if="getDataRegistro.registroestadoarchivo == null "   animation="throb" font-scale="4">Registre el correo electronico (Verificar correo)</b-alert>
         <b-card
                border-variant="danger"
                 header="Cargar Autorizacion"
                 header-bg-variant="danger"
                 header-text-variant="white"
                 align="center"
                  v-if="getDataRegistro.registroestadoarchivo != null "
                
              >
                <b-card-text>

                  <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1"  >
                     <b-col  v-if="getDataRegistro.registroestadoarchivo == 0 || getDataRegistro.registroestadoarchivo == null ">
                        <b-form-file
                           v-model="dataAutorizacion.archivo"
                           :state="Boolean(dataAutorizacion.archivo)"
                           placeholder="Elija un archivo o suéltelo aquí..."
                           drop-placeholder="Drop file here..."
                         ></b-form-file>
                     </b-col>

                     <b-col v-if="getDataRegistro.registroestadoarchivo == 1">
                       
                      <b-card>
                        <b-form-checkbox v-model="getDataRegistro.registroestadoarchivo" name="check-button" switch  value="1" unchecked-value="0" >

                              <b> Autorizacion Cargada</b>
                                 
                        </b-form-checkbox>
                        </b-card>

                     </b-col>

                    
                  </b-row>
  

               </b-card-text>
                  <b-button block variant="outline-primary" v-if="getDataRegistro.registroestadoarchivo == 0" v-on:click="cargarAutorizacion(dataAutorizacion, getDataSuministro)">Cargar documento</b-button>
                  <b-button block variant="outline-success" v-if="getDataRegistro.registroestadoarchivo == 1" @click="showModalCargarAutorizacion=false"> Aceptar </b-button>
                  
               </b-card>

         
        
      </b-col>

   </b-row>
 
</b-modal>


<b-modal  hide-footer scrollable  v-model="showPdfArchivo" title="Archivo cargado" size="xl">

   <template>
           
    <pdf v-bind:src="'' + datopdfArchivo.prueba2" ></pdf>
    
   </template>

</b-modal>







</base-layout>

</template>

<script>

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';
import pdf from 'vue-pdf';

export default{
	components: {
		Breadcrumbs,
		
      pdf,
		
	},




	data(){
		return {
			data : {
				
			},


			botones: true,
			cargar: false,
		addModal : false,
		regModal : false,
      reiterativoModal: false,
      regCorreoModal: false,
      showModalCargarAutorizacion: false,
      showPdfArchivo: false,

      file1: null,


      validardataC: false,
      habilitarEdit: true,

		tabIndex: 1,

		checked: false,
		checkedSuministro: false,
		descripcionDescuentoN: false,
      registroREsponsableCorreo: false,
		regExtSolicitante: false,
		regExtCaso: false,
		formPersona: false,
      formPersonaData: false,

		RegistrarExtr: false,
      cargarValidacion: false,
		
		registroPdf: false,
		registroExtaordinario: false,

      selectedVA: [],
      
      validarArchivo: [
          { text: 'Red', value: 'red' },
          { text: 'Green', value: 'green' },
          { text: 'Yellow (disabled)', value: 'yellow', disabled: true },
          { text: 'Blue', value: 'blue' }
        ],

		
		
        options: [
          { value: null, text: 'Please select an option' },
          { value: 'Documento', text: 'DNI' },
          { value: 'CodigoSuministro', text: 'Suministro' },
          { value: 'CodigoRutaSuministro', text: 'Ruta' },
          { value: 'NombreSuministro', text: 'Apellidos y Nombres' }
          
        ],
      searchData:{
      	tipoSearch: null,

      },
      buscarSuministro:{},
      buscarSuministros:{},
      buscarSuministroR:{},
      extraordinario:{},
      regRei:{},
      getDataSuministro:{},
      getDataSuministroo:{},
      getDataRegistro:{},
      regCorreoData:{
      },
      getDataCorreoSuministro:{},

		//buscarSuministros: [],
      estadoExtraordinario:[],
		suministros: [],
        suministroPga:[],
        tipoExtraordinarios: [],
        obsTipoExtraordinarios: [],
        personaID: [],
        relacions:[],
        tipoDocumentos:[],
        dataSedes:[],
        datoRespuesta:[],
        datopdfArchivo: {},

       
			tipoExtraordinario : {
				
				
				
				
			},
			personaID : {
				
				nombre: '',
				
				
			},
			regData : {
				
				
				
				
			},
         dataAutorizacion : {

         },
			suministro: {
				CodigoSuministro: '',
			}

			
		}
	},

	 


	methods : {

		async addExtraordinario(){

			
   		this.registroPdf = false
   		
   		const formData = new FormData();
            //formData.append('photo', this.photo);
            formData.append('suministroCodigoSuministro', this.regData.CodigoSuministro);
            formData.append('obsTipoExtraordinario_id', this.regData.obsTipoExtraordinario_id);
            formData.append('referencia', this.regData.referencia);
            formData.append('idProvincia', this.regData.IdProvincia);


            formData.append('archivo', this.regData.referencia);

         //this.regData.dni.length == 8

         const formPers = new FormData();

  				/*	if ((this.regData.dni.length == 0) && (this.regData.Documento.length == 0)) {
  						this.regData.dni='10000008'
  						this.regData.Documento='10000008'
  					}*/

         console.log('datos de prueba',this.regData.Documento.length)

         //if (this.regData.idRelacion != 1 && (!this.regData.dni || !this.regData.Documento) ) return this.$swal('Seleccione Relacion','Obligatorio','warning')
         if (!this.regData.idRelacion){
         	return this.$swal('Seleccione Relacion','Obligatorio','warning')
         }else if (this.regData.idRelacion == 1 && this.regData.Documento.length != 8) {
         	//this.descripcionDescuentoN=true
         	if (!this.regData.tipoDocumento) return this.$swal('Seleccione tipo de documento','Obligatorio','warning')
         	if (!this.regData.dni) return this.$swal('Ingrese el numero de documento','Obligatorio','warning')
         	if (this.regData.tipoDocumento == 1 && this.regData.dni.length != 8) return this.$swal('El dni debe de tener ','8 digitos','warning')
            if (!this.personaID.nombre) return this.$swal('Ingresar Nombre del solicitante ','Indispensable','warning')
            if (!this.personaID.apellPat) return this.$swal('Ingresar Apellido Paterno del solicitante ','Indispensable','warning')
            if (!this.personaID.apellMat) return this.$swal('Ingresar Apellido Materno ','Indispensable','warning')
         	//return this.$swal('Es obligatorio registrar los datos del','Solicitante','warning')
         }else if (this.regData.idRelacion != 1 ){
         	if (!this.regData.tipoDocumento) return this.$swal('Seleccione tipo de documento','Obligatorio','warning')
         	if (!this.regData.dni) return this.$swal('Ingrese el numero de documento','Obligatorio','warning')
         	if (this.regData.tipoDocumento == 1 && this.regData.dni.length != 8) return this.$swal('El dni debe de tener ','8 digitos','warning')
            if (!this.personaID.nombre) return this.$swal('Ingresar Nombre del solicitante ','Indispensable','warning')
            if (!this.personaID.apellPat) return this.$swal('Ingresar Apellido Paterno del solicitante ','Indispensable','warning')
            if (!this.personaID.apellMat) return this.$swal('Ingresar Apellido Materno ','Indispensable','warning')
         }



         //if (!this.regData.tipoDocumento) return this.$swal('Email es','Requerido','warning')

			/*	if(!this.regData.dni && !this.regData.Documento){
			  			
			  			this.regData.dni='10000008'
						this.regData.Documento='10000008'
			  		} else if(!this.regData.dni){
			  				this.regData.Documento=this.regData.Documento
			  				this.regData.dni=this.regData.Documento
			  		}*/
					 
                  //if (this.checked==0){
        /* if (1 8) {
            enviar datos del suministro
         }else if(1 !=8){
            registrar datos si o si

         }else {
            mandar los datos del registro
         }*/


         if (this.regData.idRelacion==1 && this.regData.Documento.length == 8){
         	console.log('checked 1_ dentro de la condicion_______----')
         	
         	formPers.append('personaDni', this.regData.Documento);
         	formData.append('personaDni', this.regData.Documento);
         	formPers.append('personaTelefono', this.personaID.telefono);
         	formPers.append('personaNombre', this.regData.Nombre);
         	formPers.append('personaApellPat', this.regData.ApellidoPaterno);
         	formPers.append('personaApellMat', this.regData.ApellidoMaterno);
         	formPers.append('personaDireccion', this.regData.DireccionPredio)
         	formPers.append('personaSexo', this.personaID.sexo)
         	formPers.append('relacion', this.regData.idRelacion);
            formData.append('relacion', this.regData.idRelacion);
         	formPers.append('tipoDocumento', this.regData.TipoDocumento);
         	formPers.append('perstatus', this.personaID.perstatus);

         }
         else{
         	//console.log('checked 2')
         	
         	

         	//this.regData.dni='10000008'
						//this.regData.Documento='10000008'

         	if (!this.personaID.telefono) { this.personaID.telefono = '-'}
				//if (!this.personaID.nombre) { this.personaID.nombre = '-'}
				//if (!this.personaID.apellPat) { this.personaID.apellPat = '-'}
				//if (!this.personaID.apellMa) { this.personaID.apellMa = '-'}
				
				if (!this.personaID.sexo) { this.personaID.sexo = '1'}

				  			formPers.append('personaDni', this.regData.dni)
                  	formData.append('personaDni', this.regData.dni)
                  	formPers.append('personaNombre', this.personaID.nombre)
                  	formPers.append('personaApellPat', this.personaID.apellPat)
                  	formPers.append('personaApellMat', this.personaID.apellMat)
                  	formPers.append('personaTelefono', this.personaID.telefono)
                  	formPers.append('personaSexo', this.personaID.sexo)
                  	formPers.append('personaDireccion', this.regData.DireccionPredio)
                  	formPers.append('relacion', this.regData.idRelacion);
                     formData.append('relacion', this.regData.idRelacion);
                  	formPers.append('tipoDocumento', this.regData.tipoDocumento);
                  	formPers.append('perstatus', this.personaID.perstatus);

         }
                  
         // console.log('Es el dato suministro',this.regData.CodigoSuministro)
			formData.append('personaId', this.personaID.id)
			formPers.append('personaId', this.personaID.id)
				//persona no seencuentra
			const [res] = await Promise.all([
					this.callApi('post', 'app/persona', formPers)
			])
				if (res.status==201 || res.status==200) {
					this.$swal('Solicitante registrado','Presionar Registrar','warning')

					this.personaID = res.data
					console.log('datos de la persona',this.personaID)

					const [resp] = await Promise.all([
						this.callApi('post', 'app/extraordinario',formData)
					])
					if (resp.status==201 || resp.status==200) {
						this.extraordinario = resp.data.extraordinario
                  this.estadoExtraordinario = resp.data.estadoExtraordinario
					//console.log('Es el dato zxc',this.extraordinario)
						this.getMailExtraordinario(this.extraordinario, this.estadoExtraordinario)
						this.$swal('Registro creado','Correctamente','success')
					
						this.registroExtaordinario = false
						
						this.registroPdf = true
						
						this.regData.dni=''
						this.personaID.apellPat=''
						this.personaID.apellMat=''
						this.personaID.nombre=''
						this.personaID.telefono=''
						this.personaID.sexo=''
						
						this.tipoExtraordinario.id=''
						this.regData.obsTipoExtraordinario_id=''
						this.regData.referencia=''

					}
               else if (resp.status==233) {
                 // this.extraordinario = resp.data
             
                  
                  this.$swal({
                        toast: true,
                       position: 'top-end',
                       icon: 'error',
                       title: resp.data.message,
                       showConfirmButton: false,
                       timer: 5000
                     });
               
                 

               }else{
						if (resp.status==422) {
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
					}else{//this.cargar= false
							this.$swal('Ocurrio algun problema','Revisar los datos para el registro del servicio','warning')
						}

					}

				}else {
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
					}else{//this.cargar= false
							this.$swal('Ocurrio algun problema','Revisar los datos para el registro (DNI)','warning')
						}
		}
								



            

/*

            const [ res, resp] = await Promise.all([
							this.callApi('post', 'app/persona', formPers),
							this.callApi('post', 'app/extraordinario',formData)
						])
			
			if ((res.status==201 && resp.status==201)||(res.status==200 && resp.status==201)||(res.status==201 && resp.status==200)||(res.status==200 && resp.status==200) ) {
				
				this.extraordinario = resp.data
				//console.log('Es el dato zxc',this.extraordinario)
				this.getMailExtraordinario(this.extraordinario)
				this.$swal('Registro creado','Correctamente','success')
			
				this.registroExtaordinario = false
				
				this.registroPdf = true
				
				this.regData.dni=''
				this.personaID.apellPat=''
				this.personaID.apellMat=''
				this.personaID.nombre=''
				this.personaID.telefonop=''
				this.personaID.sexo=''
				
				this.tipoExtraordinario.id=''
				this.regData.obsTipoExtraordinario_id=''
				this.regData.referencia=''

				

			} else if(res.status==201 || resp.status==500){
					this.$swal('Solicitante registrado','Presionar Registrar','warning')
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
				}
				else{//this.cargar= false
					this.$swal('Ocurrio algun problema','Revisar los datos para el registro (DNI)','warning')
				}
			}
			*/
		},

		//back/app/persona/getPersonaID

		 getPersonaID: function () {
            if (this.regData.dni.length == 8){
                  
                  axios.get('app/getPersonaID',{
                   params: {
                     
                     dniPersona: this.regData.dni
                	
                     
                   }
                }).then(function(response){
                	if (response.data.length === 0) {
                			this.personaID = {nombre: ''};
                			//this.regData = {perstatus: 2};
                			this.personaID.perstatus =  2

                	console.log('lipio',this.personaID)
                	}else {

                	//console.log('busqueda de la persona',response.data)
                			this.personaID = response.data
                			this.personaID.perstatus =  1
                	}
                     // this.personaID = response.data
                      

                      //console.log('id de la persona es:', this.estudiantesID[0].id)
                      //console.log('id de la persona es:', this.personaID)

                  }.bind(this));
               // this.ReferenciaDNI=true
              //muestra form  this.formPersona=true
          
            }
            else{
                //this.formPersona=false
                //this.regData.dni=''
								this.personaID.apellPat=''
								this.personaID.apellMat=''
								this.personaID.nombre=''
								this.personaID.telefono=''
								this.personaID.sexo=''
                this.formPersona=true
                 // this.ReferenciaDNI=false
            }
          
        },

      getExtraordinarioR: function () {

         	if (this.checkedSuministro==true) {

         		

         		
                  
                     console.log('xd',this.regData.CodigoSuministro)
                  axios.get('app/getExtraordinarioR',{
                   params: {
                     CodigoSuministro: this.regData.CodigoSuministro
                     
                   }
                }).then(function(response){
                	
                	this.extraordinarioR = response.data.estado
                  this.datoRespuesta = response.data.datoRespuesta

                	console.log('de la cnsuta',response.data)

                	if (this.extraordinarioR == 1) {
						//console.log('es el 1')
										//this.$swal('Existe un registro pendiente','dentro de las 24 horas. '+ response.data.created,'warning')

                              this.$swal({
                                icon: 'warning',
                                title: 'Existe un registro pendiente',
                                text: 'dentro de las 24 horas. ',
                                footer: 'Fecha de registro: <strong> '+ response.data.created+'</strong>'
                              })

										this.RegistrarExtr=false
                	} else if (this.extraordinarioR == 2) {
						//console.log('es el +2')
                  //REITERATIVO
										//this.$swal('Excelente !','Puede registrar el caso','success')

                              this.$swal({
                                   title: 'Existe un registro que supera las 24 horas. ',
                                   text: "Desea solicitar un reiterativo? / Desea Confirmar la atencion pendiente?",
                                   footer: 'Fecha de registro: <strong> '+ response.data.created+'</strong>',

                                   
                                   icon: 'warning',
                                   showCancelButton: true,
                                   showDenyButton: true,
                                   confirmButtonColor: '#3085d6',
                                   denyButtonColor: '#339d10',
                                   cancelButtonColor: '#d33',
                                   confirmButtonText: 'Si, solicitar!',
                                   denyButtonText: `Confirmar atencion`,
                                 }).then((result) => {
                                   if (result.isConfirmed) {
                                    //this.storeEstadoExtraordinario(this.datoRespuesta)
                                     //this.$swal(
                                     //  'Cancelar!',
                                     //  'Your file has been deleted.',
                                     //  'success'
                                     //)
                                     this.reiterativoModal=true
                                    
                                       
                                   } else if (result.isDenied) {
                                       this.$swal({
                                         title: 'Está seguro?',
                                         text: "Confirmara la atencion pendiente!",
                                         icon: 'warning',
                                         showCancelButton: true,
                                         confirmButtonColor: '#3085d6',
                                         cancelButtonColor: '#d33',
                                         confirmButtonText: 'Si, confirmar!',
                                         cancelButtonText: 'Cancelar'
                                       }).then((result) => {
                                         if (result.isConfirmed) {

                                          this.confirmarAtencion(this.datoRespuesta)

                                           /*this.$swal(
                                             'Confirmado!',
                                             'Usted confirmo la atencion',
                                             'success'
                                           )*/
                                         }
                                       })
                                }
                                 })
                                 

                            

										
										//this.regExtSolicitante=true
										//this.regExtCaso=true
										//this.RegistrarExtr=true
                	} else {
                		//console.log('es el 3')
                     //REGISTRAR
                		this.$swal('Usted !','Puede registrar el caso','success')
                		
                		this.regExtSolicitante=true
                		this.regExtCaso=true
                		this.RegistrarExtr=true
                	}
                     // this.personaID = response.data
                      

                      //console.log('id de la persona es:', this.estudiantesID[0].id)
                      //console.log('id de la persona es:', this.personaID)

                  }.bind(this));
               // this.ReferenciaDNI=true
                //this.RegistrarExtr=true
          
            


         	}else{

         		console.log('dentro del false')
         
         		this.regExtSolicitante=false
         		this.regExtCaso=false
         		this.RegistrarExtr=false
         	}
            
          
        },



      async confirmarAtencion(datResConfAte){

         const res = await this.callApi('post', `app/confirmarAtencion`, datResConfAte)
         if (res.status==201) {

             this.$swal(
                  'Confirmado!',
                  'Usted confirmo la atencion',
                  'success'
                )
         }else{
               this.$swal('Ocurrio algun error','Intentelo nuevamente','error')

         }


      },




      async storeEstadoExtraordinario(reiterativo, obss){
         console.log('____reiterativo____:',reiterativo, obss)
         console.log('+++++++:', obss)
         const formData = new FormData();
                  //formData.append('photo', this.photo);
                  
                  formData.append('referencia', obss.observacioReiterativo);
                  formData.append('extraordinario_id', reiterativo.estado_extraordinario.extraordinario_id);
                  formData.append('estado', reiterativo.estado_extraordinario.estado);
                  formData.append('tipo', reiterativo.estado_extraordinario.tipo);
                  formData.append('idProvincia', reiterativo.estado_extraordinario.sede_id);
                  formData.append('id', reiterativo.estado_extraordinario.id);
                  
         const res = await this.callApi('post', `app/storeEstadoExtraordinario`, formData)
         if (res.status==201) {
            console.log('datos de respuesta :_______',res.data)
           

            let obj ={
            
               id : res.data.extraordinario_id,
               estado_extraordinario : {tipo : res.data.tipo,},
               //estado_extraordinario.tipo : res.data.tipo,
            }
            this.reiterativos = obj

            //this.getMailExtraordinario(this.reiterativos)
            this.reiterativoModal=false

            this.getMailExtraordinario(this.reiterativos, this.reiterativos.estado_extraordinario)

            //this.$swal('Excelent !','Reiterativo se registró correctamente','success')

            window.location.href = "/back/extraordinario"
            //this.showModalReiterativo = false

            
         } else if (res.status==233) {
                     this.$swal({
                        toast: true,
                          position: 'top-end',
                          icon: 'error',
                          title: res.data.message,
                          showConfirmButton: false,
                          timer: 5000
                        });

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


	
       


		async regExtraordinario(regData){
			
			

			//const res = await this.callApi('post', 'app/edit_tags', this.editData)
		
			const res = await this.callApi('put', `app/user/${editData.id}`, this.editData)
			//const res = await this.callApi('post', 'back/app/user', this.editData)
				
			if (res.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
				this.users[this.index] = this.editData
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
      regExtraordinarioModal(suministro, index){

         this.regData.dni=''
         this.personaID.apellPat=''
         this.personaID.apellMat=''
         this.personaID.nombre=''
         this.personaID.telefono=''
         this.personaID.sexo=''
         
         this.tipoExtraordinario.id=''
         this.regData.obsTipoExtraordinario_id=''
         this.regData.referencia=''

			this.checkedSuministro= false
		//	this.checked= false
			this.RegistrarExtr=false

			this.registroExtaordinario=true
			
			this.registroPdf=false
			let obj ={
				
				CodigoSuministro : suministro.CodigoSuministro,
				CodigoRutaSuministro : suministro.CodigoRutaSuministro,
				NombreSuministro : suministro.NombreSuministro,
				Nombre : suministro.Nombre,
				ApellidoPaterno : suministro.ApellidoPaterno,
				ApellidoMaterno : suministro.ApellidoMaterno,
				Documento : suministro.Documento,
				Telefono : suministro.Telefono,
				DireccionPredio : suministro.DireccionPredio,
				Longitud : suministro.Longitud,
				Latitud : suministro.Latitud,
				SerieMedidor : suministro.SerieMedidor,
				MarcaMedidor : suministro.MarcaMedidor,
				Tarifa : suministro.Tarifa,
				NombreZonaAdministrativa : suministro.NombreZonaAdministrativa,
				NombreDepartamento : suministro.NombreDepartamento,
				NombreProvincia : suministro.NombreProvincia,
				NombreDistrito : suministro.NombreDistrito,
				IdProvincia : suministro.IdProvincia,
            IdDistrito : suministro.IdDistrito,
            TipoDocumento : suministro.TipoDocumento,
            CodigoZonaAdministrativa : suministro.CodigoZonaAdministrativa,
            NombreTipoDocumentoIdentidad : suministro.NombreTipoDocumentoIdentidad,



			}
			this.regData = obj
			this.regModal = true
			this.index = index
			this.regExtSolicitante = false
			this.regExtCaso = false
		},

      showRegCorreoModal(suministro, index){
         //console.log('diomio_____',suministro)
         //console.log('hhhhhh',this.getDataSuministro)
         this.habilitarEdit = true
         this.validardataC = false
         this.formPersonaData = false
         this.validardataC = true

         this.regData.dni = ''
         this.regData.tipoDocumento = ''
            
      
         let obj ={
            
            CodigoSuministro : suministro.CodigoSuministro,
            CodigoRutaSuministro : suministro.CodigoRutaSuministro,
            NombreSuministro : suministro.NombreSuministro,
            Nombre : suministro.Nombre,
            ApellidoPaterno : suministro.ApellidoPaterno,
            ApellidoMaterno : suministro.ApellidoMaterno,
            Documento : suministro.Documento,
            Telefono : suministro.Telefono,
            DireccionPredio : suministro.DireccionPredio,
            Longitud : suministro.Longitud,
            Latitud : suministro.Latitud,
            SerieMedidor : suministro.SerieMedidor,
            MarcaMedidor : suministro.MarcaMedidor,
            Tarifa : suministro.Tarifa,
            NombreZonaAdministrativa : suministro.NombreZonaAdministrativa,
            NombreDepartamento : suministro.NombreDepartamento,
            NombreProvincia : suministro.NombreProvincia,
            NombreDistrito : suministro.NombreDistrito,
            IdProvincia : suministro.IdProvincia,
            //NombreProvincia : suministro.IdProvincia['1'],
            IdDistrito : suministro.IdDistrito,
            TipoDocumento : suministro.TipoDocumento,
            CodigoZonaAdministrativa : suministro.CodigoZonaAdministrativa,
            NombreTipoDocumentoIdentidad : suministro.NombreTipoDocumentoIdentidad,
            correo : suministro.correo,

            

         }

         this.getDataSuministro = obj


         if (suministro.correo_suministro != null) {
            //console.log('validar_____',suministro.correo_suministro.correo.length)

            let obj ={
               registroCorreo : suministro.correo_suministro.correo, 
               registroArchivo : suministro.correo_suministro.archivo, 
               registroCelular : suministro.correo_suministro.celular,
               registroestadoarchivo : suministro.correo_suministro.estadoarchivo,
               registroid : suministro.correo_suministro.id,
               registroestadoConfirmacion : suministro.correo_suministro.estadoConfirmacion,
               registroestado : suministro.correo_suministro.estado,
               registrovalidacionManual : suministro.correo_suministro.validacionManual,

            }
            this.getDataRegistro = obj
         } else{
            this.getDataRegistro = ''

         }
         this.index = index

         this.regCorreoData = {
            //correo:'',
            //celular:'',
            registrar: 1
         }

                  
         axios.get('/back/app/getCorreoSuministro',{
             params: {
               codigoSuministro_id: suministro.CodigoSuministro

             }
          }).then(function(response){
                //this.getDataCorreoSuministro = response.data;

                if (response.data.length != 0) {
                  this.regCorreoData = response.data;
                  this.regData.dni = response.data.person.dni;


                  this.regData.tipoDocumento = response.data.person.tipoDocumento_id
                  this.personaID.nombre = response.data.person.nombre
                  this.personaID.apellPat = response.data.person.apellPat
                  this.personaID.apellMat = response.data.person.apellMat
                  this.personaID.sexo = response.data.person.sexo
                  this.personaID.id = response.data.person.id
                  this.personaID.tipoDocumento_id = response.data.person.tipoDocumento_id
                  this.formPersonaData = false




                }else{
                  this.personaID.nombre = ''
                  this.personaID.apellPat = ''
                  this.personaID.apellMat = ''
                  this.personaID.sexo = ''
                  this.personaID.sexo = ''

                  if (this.getDataSuministro.Documento == '' || this.getDataSuministro.TipoDocumento != 1) {

                     this.formPersonaData = true
                  }
                }
            }.bind(this));

         this.regCorreoModal = true
      },




      async getValidarManual(){
         console.log('dentro del getDataRegistro',this.getDataSuministro)

         //const res = await this.callApi('post', 'app/edit_tags', this.editData)
         const res = await this.callApi('post', 'app/getValidarManual', this.getDataRegistro)
      
         //const res = await this.callApi('put', `app/user/${editData.id}`, this.editData)

         if (res.status==200) {
            console.log('response_____',res.data)
            console.log('response_____',this.getDataSuministro.index)
            console.log('Valores index____:',this.buscarSuministros.data[this.getDataSuministro.index] )
            //this.roles[this.index].roleName = this.editData.roleName

            //this.users[this.index] = this.editData
            this.buscarSuministros.data[this.getDataSuministro.index].correo_suministro = res.data
            this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
            //this.editModal = false
            
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


      showCargarAutorizacion(suministro, index){
         this.showModalCargarAutorizacion = true
         //this.getDataSuministro = ''

         let obj ={
            
            CodigoSuministro : suministro.CodigoSuministro,
            CodigoRutaSuministro : suministro.CodigoRutaSuministro,
            NombreSuministro : suministro.NombreSuministro,
            Nombre : suministro.Nombre,
            ApellidoPaterno : suministro.ApellidoPaterno,
            ApellidoMaterno : suministro.ApellidoMaterno,
            Documento : suministro.Documento,
            Telefono : suministro.Telefono,
            DireccionPredio : suministro.DireccionPredio,
            Longitud : suministro.Longitud,
            Latitud : suministro.Latitud,
            SerieMedidor : suministro.SerieMedidor,
            MarcaMedidor : suministro.MarcaMedidor,
            Tarifa : suministro.Tarifa,
            NombreZonaAdministrativa : suministro.NombreZonaAdministrativa,
            NombreDepartamento : suministro.NombreDepartamento,
            NombreProvincia : suministro.NombreProvincia,
            NombreDistrito : suministro.NombreDistrito,
            IdProvincia : suministro.IdProvincia,
            IdDistrito : suministro.IdDistrito,
            TipoDocumento : suministro.TipoDocumento,
            CodigoZonaAdministrativa : suministro.CodigoZonaAdministrativa,
            NombreTipoDocumentoIdentidad : suministro.NombreTipoDocumentoIdentidad,
            index : index,

           

         }
         if (suministro.correo_suministro != null) {
            //console.log('validar_____',suministro.correo_suministro.correo.length)

            let obj ={
               registroCorreo : suministro.correo_suministro.correo, 
               registroArchivo : suministro.correo_suministro.archivo, 
               registroCelular : suministro.correo_suministro.celular,
               registroestadoarchivo : suministro.correo_suministro.estadoarchivo,
               registroid : suministro.correo_suministro.id,
               registroestadoConfirmacion : suministro.correo_suministro.estadoConfirmacion,
               registroestado : suministro.correo_suministro.estado,
               registrovalidacionManual : suministro.correo_suministro.validacionManual,
            }
            this.getDataRegistro = obj
         } else{
            this.getDataRegistro = ''

         }

         this.getDataSuministro = obj
         //this.index = index


      },

     

      async cargarAutorizacion(regDataAutorizacion, regGetDataSuministro){

         const formData = new FormData();

                formData.append('archivo', regDataAutorizacion.archivo);
                formData.append('registroid', this.getDataRegistro.registroid);
                formData.append('registroestadoarchivo', this.getDataRegistro.registroestadoarchivo);
                formData.append('registroestadoConfirmacion', this.getDataRegistro.registroestadoConfirmacion);
                formData.append('registroestado', this.getDataRegistro.registroestado);
                formData.append('CodigoSuministro', regGetDataSuministro.CodigoSuministro);

                              

         const res = await this.callApi('post', 'app/cargarAutorizacion', formData)
      
         //const res = await this.callApi('get', `app/user/${editData.id}`, this.editData)
         //const res = await this.callApi('post', 'back/app/user', this.editData)
            
         if (res.status==200) {
            console.log('_____________---:', res.data)
            console.log('____regGetDataSuministro.index]_________---:', regGetDataSuministro.index)
            console.log('this.buscarSuministros[regGetDataSuministro.index].correo_suministro_____________---:', this.buscarSuministros.data[regGetDataSuministro.index].correo_suministro)
            //this.roles[this.index].roleName = this.editData.roleName
            //this.users[this.index] = this.editData


            this.buscarSuministros.data[regGetDataSuministro.index].correo_suministro = res.data
            this.getDataRegistro.registroArchivo = res.data.archivo
            this.getDataRegistro.registroestado = res.data.estado
            this.getDataRegistro.registroestadoarchivo = res.data.estadoarchivo


            

            this.$swal('Excelent !','Archivo cargado','success')
            //
            //this.showModalCargarAutorizacion = true
            
         } else {
            if (res.status==442) {
               for(let i in res.data.errors){
                  this.$swal({
                     toast: true,
                 position: 'top-end',
                 icon: 'error',
                 title: res.data.message,
                 showConfirmButton: false,
                 timer: 5000
               });
               }
            } else {
               this.$swal('Any fool can use a computer','de','error')
            }
         }
         
      },
      
		

		getObsTipoExtraordinario: function() {
        	
            axios.get('/back/app/getObsTipoExtraordinario',{
             params: {
               tipoExtraordinario_id: this.tipoExtraordinario.id

             }
          }).then(function(response){
                this.obsTipoExtraordinarios = response.data;
            }.bind(this));

        },

      /*  busquedaSuministro: function (page = 1) {
        	
        
        	console.log('mensaje de dios',this.searchData.search)
/*if (typeof page === 'undefined') {
                    page = 1;
                }*/
        	//axios.get('app/suministroBuscar',{
       /* 	axios.get('app/suministroBuscar?page=' + page,{
	             params: {
	             	tipoSearch: this.searchData.tipoSearch,
	               	search: this.searchData.search

	             }
	          })

        	.then(function(response){
	                this.buscarSuministros = response.data.data;
	                console.log(this.buscarSuministros)
	            }.bind(this));


        },*/

         getResults(page = 1) {
            axios.get('app/suministroBuscar?page=' + page,{
	             params: {
	             	tipoSearch: this.searchData.tipoSearch,
	               	search: this.searchData.search

	             }
	          })
                .then(response => {
                    this.buscarSuministros = response.data;
                    this.buscarSuministroR = response.data;
                    console.log(response.data)
                });
        },

         getMailExtraordinario(extraordinario, estadoExtraordinario){

				

			console.log('dentro de getMailExtraordinario',extraordinario,estadoExtraordinario)
			//window.open(`/back/app/getMailExtraordinario/${extraordinario.id}`);
			
			//redirect: '/back/app/generate-pdf'
			//window.location.href = '/back/app/generate-pdf'
			//window.location.href = `/back/app/generate-pdf/${this.editData.tipoExtraordinario_id}`
			
			///window.location.href = `/back/app/generate-pdf/${extraordinario.id}`
			//window.open(`/back/app/generate-pdf/${extraordinario.id}`, '_blank');
        	this.cargar =true
            axios.get(`/back/app/getMailExtraordinario`,{
             params: {
               //tipoExtraordinario_id: extraordinario.id
               tipoExtraordinario_id: extraordinario.id,
               estadoReiterativo: estadoExtraordinario.tipo,

             }
          }).then(function(response){
                //this.obsTipoExtraordinarios = response.data;
               // console.log('es el log del mail',response.data)
                //window.open('/back/app/generate-pdf');
                console.log('el estatus es: ',response.status)
                console.log('los datos de manda son: ',response)

                if (response.status==200) {
				//this.roles[this.index].roleName = this.editData.roleName
					this.cargar =false
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
					} else {this.cargar = false
						this.$swal('Algo salio mal','Verifique los correos','error')
					}
				}

            }.bind(this));

        },

     async regCorreoSuministro(){

   console.log('diosmio____', this.regCorreoData, this.getDataSuministro)
         this.cargarValidacion= true


   if (this.getDataSuministro.TipoDocumento == 1 && (this.getDataSuministro.Documento.length == '' || this.getDataSuministro.Documento.length != 8)) {
      console.log('___','tipodoucmento',this.getDataSuministro.TipoDocumento,'documento',this.getDataSuministro.Documento)
      console.log('___','dni',this.regData.dni)
      //console.log('___','dni.length',this.regData.dni.length)

         if (this.regData.tipoDocumento == 1 && this.regData.dni.length != 8) return this.$swal('El dni debe de tener ','8 digitos','warning')
         if (!this.regData.tipoDocumento) return this.$swal('Seleccione tipo de documento','Obligatorio','warning')
         if (!this.regData.dni) return this.$swal('Ingrese el numero de documento','Obligatorio','warning')
         if (!this.personaID.nombre) return this.$swal('Ingresar Nombre del solicitante ','Indispensable','warning')
         if (!this.personaID.apellPat) return this.$swal('Ingresar Apellido Paterno del solicitante ','Indispensable','warning')
         if (!this.personaID.apellMat) return this.$swal('Ingresar Apellido Materno ','Indispensable','warning')
         
      }else if (this.getDataSuministro.TipoDocumento != 1 ){

      console.log('dentro el  else if:___','tipodoucmento',this.getDataSuministro.TipoDocumento,'documento',this.getDataSuministro.Documento)

         if (!this.regData.tipoDocumento) return this.$swal('Seleccione tipo de documento','Obligatorio','warning')
         if (!this.regData.dni) return this.$swal('Ingrese el numero de documento','Obligatorio','warning')
         if (this.regData.tipoDocumento == 1 && this.regData.dni.length != 8) return this.$swal('El dni debe de tener ','8 digitos','warning')
         if (!this.personaID.nombre) return this.$swal('Ingresar Nombre del solicitante ','Indispensable','warning')
         if (!this.personaID.apellPat) return this.$swal('Ingresar Apellido Paterno del solicitante ','Indispensable','warning')
         if (!this.personaID.apellMat) return this.$swal('Ingresar Apellido Materno ','Indispensable','warning')
      }

   if (!this.regCorreoData.correo)  return this.$swal('Ingresar correo ','Es obligatorio','warning')

   const formPers = new FormData();
   const formData = new FormData();

   if (this.getDataSuministro.TipoDocumento==1 && this.getDataSuministro.Documento.length == 8){

      //if (this.getDataSuministro.Documento.length == 8) {}
            console.log('checked 1_ dentro de la condicion_______----')
            
            formPers.append('personaDni', this.getDataSuministro.Documento);
            formData.append('personaDni', this.getDataSuministro.Documento);
            formPers.append('personaTelefono', this.regCorreoData.celular);
            formPers.append('personaNombre', this.getDataSuministro.Nombre);
            formPers.append('personaApellPat', this.getDataSuministro.ApellidoPaterno);
            formPers.append('personaApellMat', this.getDataSuministro.ApellidoMaterno);
            formPers.append('personaDireccion', this.getDataSuministro.DireccionPredio)
            formPers.append('personaSexo', this.personaID.sexo)
            //formPers.append('relacion', this.getDataSuministro.idRelacion);
            //formData.append('relacion', this.getDataSuministro.idRelacion);
            formPers.append('tipoDocumento', this.getDataSuministro.TipoDocumento);
            formPers.append('perstatus', this.personaID.perstatus);
            
            formData.append('CSnombreSuministroR', this.getDataSuministro.ApellidoPaterno +' '+ this.getDataSuministro.ApellidoMaterno +' '+ this.getDataSuministro.Nombre)

         }
         else{
            console.log('dentro del otro else', this.getDataSuministro.TipoDocumento)

            if (!this.personaID.telefono) { this.personaID.telefono = '-'}
            
            if (!this.personaID.sexo) { this.personaID.sexo = '1'}

                  formPers.append('personaDni', this.regData.dni)
                  formData.append('personaDni', this.regData.dni)
                  formPers.append('personaNombre', this.personaID.nombre)
                  formPers.append('personaApellPat', this.personaID.apellPat)
                  formPers.append('personaApellMat', this.personaID.apellMat)
                  formPers.append('personaTelefono', this.regCorreoData.celular)
                  formPers.append('personaSexo', this.personaID.sexo)
                  formPers.append('personaDireccion', this.getDataSuministro.DireccionPredio)
                  //formPers.append('relacion', this.getDataSuministro.idRelacion);
                  //formData.append('relacion', this.getDataSuministro.idRelacion);
                  formPers.append('tipoDocumento', this.regData.tipoDocumento);
                  formPers.append('perstatus', this.personaID.perstatus);

                  formData.append('CSnombreSuministroR', this.personaID.apellPat +' '+ this.personaID.apellMat +' '+ this.personaID.nombre)
         }

         
         formPers.append('personaId', this.personaID.id)


               
         formData.append('CSemail', this.regCorreoData.correo)
         formData.append('CScelular', this.regCorreoData.celular)
         formData.append('CScodigoSuministro', this.getDataSuministro.CodigoSuministro)
         formData.append('CSnombreSuministro', this.getDataSuministro.NombreSuministro)
         formData.append('CSdireccionPredio', this.getDataSuministro.DireccionPredio)
         formData.append('CScodigoRutaSuministro', this.getDataSuministro.CodigoRutaSuministro)
         formData.append('idRelacion', this.regCorreoData.relacion_id)
         formData.append('IdProvincia', this.getDataSuministro.IdProvincia)
         formData.append('IdDistrito', this.getDataSuministro.IdDistrito)


      const [res] = await Promise.all([
                  this.callApi('post', 'app/persona', formPers)
            ])

      if (res.status==201 || res.status==200) {
                  this.$swal('Solicitante registrado','Presionar Registrar','warning')

                  this.personaID = res.data
                  formData.append('CSpersona_id', this.personaID.id)

                  //colocar la funcion AQUIIII
         const [resp] = await Promise.all([
                     this.callApi('post', 'app/regCorreoSuministro',formData)
                  ])
         console.log('el estatus es: ',resp.status)
                   console.log('los datos de manda son: ',resp)
                   this.cargarValidacion= false
                   this.regCorreoModal= false

               if (resp.status==201) {
               //this.roles[this.index].roleName = this.editData.roleName
                  //this.cargar =false
                  this.$swal('Excelent !','El correo para la validacion se envio satisfactoriamente','success')
                  
                  
               } else {
                  this.cargarValidacion= false
                  this.regCorreoModal= false
                  this.$swal('Algo salio mal','Verifique los correos','error')
                  
               }



   } else{
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
         }else{//this.cargar= false
               this.$swal('Ocurrio algun problema','Revisar los datos para el registro (DNI)','warning')
            }

   }

},



      
      regCorreoSuministroEdit(){
         console.log('____--',this.regCorreoData.estadoConfirmacion )
        // this.regCorreoData.estadoConfirmacion = 0
         this.regCorreoData.registrar = 2
         this.validardataC = true
         //this.regCorreoData.estadoConfirmacion == '1'
         this.habilitarEdit = false
         this.formPersonaData = true

         if (this.personaID.length == 0) {
            console.log('dentro del this___',this.personaID.length)
         }

         //this.personaID.apellPat = ''
         //this.personaID.apellMat = ''
         //this.personaID.nombre = ''
         //this.personaID.sexo = ''

      },

      
      async editCorreoSuministro(){
         console.log('ss____', this.regCorreoData)
         this.cargarValidacion= true
           
         axios.get(`/back/app/editCorreoSuministro`,{
             params: {
               regCorreo: this.regCorreoData.correo,
               regCelular: this.regCorreoData.celular,
               regSuministro_id: this.regCorreoData.suministro_id,
               regId: this.regCorreoData.id,

               CScodigoSuministro: this.getDataSuministro.CodigoSuministro,
               CSnombreSuministro: this.getDataSuministro.NombreSuministro,
               CSdireccionPredio: this.getDataSuministro.DireccionPredio,
               CScodigoRutaSuministro: this.getDataSuministro.CodigoRutaSuministro,

               PapellPat: this.personaID.apellPat,
               PapellMat: this.personaID.apellMat,
               Pnombre: this.personaID.nombre,
               Psexo: this.personaID.sexo,
               Pid: this.personaID.id,
               PtipoDocumento_id : this.personaID.tipoDocumento_id,

             }
          }
          ).then(function(response){
            this.cargarValidacion= false

                console.log('el estatus es: ',response.status)
                console.log('los datos de manda son: ',response)
                //this.cargarValidacion= false
                //this.regCorreoModal= false

                if (response.status==201) {

               this.$swal('Excelent !','El correo para la validacion se envio satisfactoriamente','success')
               this.regCorreoModal= false
               
               
            } else if(response.status==233){
               //this.cargarValidacion= false
               //this.regCorreoModal= false
               this.$swal('Algo salio mal','Verifique los correos','error')
               
            }else{
               this.$swal('Algo salio mal','Verifique los correos','error')

            }

            }.bind(this));

      },

      

      async formatPdf(){
         console.log('mmmm____',this.getDataSuministroo)

         if (this.getDataSuministro.TipoDocumento == 1 && (this.getDataSuministro.Documento.length == '' || this.getDataSuministro.Documento.length != 8)) {
      console.log('___','tipodoucmento',this.getDataSuministro.TipoDocumento,'documento',this.getDataSuministro.Documento)
      console.log('___','dni',this.regData.dni)
      //console.log('___','dni.length',this.regData.dni.length)

         if (this.regData.tipoDocumento == 1 && this.regData.dni.length != 8) return this.$swal('El dni debe de tener ','8 digitos','warning')
         if (!this.regData.tipoDocumento) return this.$swal('Seleccione tipo de documento','Obligatorio','warning')
         if (!this.regData.dni) return this.$swal('Ingrese el numero de documento','Obligatorio','warning')
         if (!this.personaID.nombre) return this.$swal('Ingresar Nombre del solicitante ','Indispensable','warning')
         if (!this.personaID.apellPat) return this.$swal('Ingresar Apellido Paterno del solicitante ','Indispensable','warning')
         if (!this.personaID.apellMat) return this.$swal('Ingresar Apellido Materno ','Indispensable','warning')
         
      }else if (this.getDataSuministro.TipoDocumento != 1 ){

      console.log('dentro el  else if:___','tipodoucmento',this.getDataSuministro.TipoDocumento,'documento',this.getDataSuministro.Documento)

         if (!this.regData.tipoDocumento) return this.$swal('Seleccione tipo de documento','Obligatorio','warning')
         if (!this.regData.dni) return this.$swal('Ingrese el numero de documento','Obligatorio','warning')
         if (this.regData.tipoDocumento == 1 && this.regData.dni.length != 8) return this.$swal('El dni debe de tener ','8 digitos','warning')
         if (!this.personaID.nombre) return this.$swal('Ingresar Nombre del solicitante ','Indispensable','warning')
         if (!this.personaID.apellPat) return this.$swal('Ingresar Apellido Paterno del solicitante ','Indispensable','warning')
         if (!this.personaID.apellMat) return this.$swal('Ingresar Apellido Materno ','Indispensable','warning')
      }
      if (!this.regCorreoData.correo)  return this.$swal('Ingresar correo ','Es obligatorio','warning')
      if (!this.regCorreoData.relacion_id)  return this.$swal('Seleccione la Relacion ','Es obligatorio','warning')


         //const formData = new FormData();
         //formData.append('estado_extraordinario', this.regReiterativo.referencia);

        // console.log('dentro de la funcion:::::::::')
         
         //console.log('---------user',this.userSedes[0].nombre )
         //console.log('---------',this.getDataSuministro)
         //console.log('---------',this.regCorreoData)
         const formData = new FormData();
            //formData.append('photo', this.photo);
            formData.append('NombreSuministro', this.getDataSuministro.NombreSuministro);
            formData.append('CodigoSuministro', this.getDataSuministro.CodigoSuministro);
            formData.append('CodigoRutaSuministro', this.getDataSuministro.CodigoRutaSuministro);
            formData.append('Documento', this.getDataSuministro.Documento);
            formData.append('DireccionPredio', this.getDataSuministro.DireccionPredio);
            formData.append('NombreDepartamento', this.getDataSuministro.NombreDepartamento);
            formData.append('NombreProvincia', this.getDataSuministro.NombreProvincia);
            formData.append('NombreDistrito', this.getDataSuministro.NombreDistrito);

            formData.append('CScelular', this.regCorreoData.celular);
            formData.append('CScorreo', this.regCorreoData.correo);
            formData.append('CSSede', this.userSedes[0].nombre );
            formData.append('IdProvincia', this.getDataSuministro.IdProvincia );
            formData.append('IdDistrito', this.getDataSuministro.IdDistrito );

            formData.append('idRelacion', this.regCorreoData.relacion_id );


               
            if (!this.regData.dni) {
               formData.append('CSpersonaDni', this.getDataSuministro.Documento);
            }else{
               formData.append('CSpersonaDni', this.regData.dni);
            }
   
            if (!this.personaID.apellPat && !this.personaID.apellMat) {
               formData.append('CSnombreSuministroR', this.getDataSuministro.NombreSuministro);
            }else{
               formData.append('CSnombreSuministroR', this.personaID.apellPat +' '+ this.personaID.apellMat +' '+ this.personaID.nombre);
            }


         //console.log('ddd',formData)

            axios({
              method: 'post',
              url: 'app/formatPdf',
              responseType: 'arraybuffer',
              data: formData,
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




    async pdfArchivo(){


   let obj ={
        
   

        

         prueba2: '/storage/documentos/autorizacionCorreo/'+ this.getDataRegistro.registroArchivo, 

       

       // prueba:'/storage/pdfj/prueba.pdf'
      }


      this.datopdfArchivo = obj
 
      this.showPdfArchivo=true
    },





        /* getResults(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }
      
                this.$http.get('app/suministroBuscar?page=' + page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                        this.buscarSuministros = data;
                    });
            },*/




	},


		

	async created(){
			try	{
				this.getResults();
            //this.gesDataSedes();
				//console.log(this.isWritePermitted)
				//console.log('esto es el permiso')
				

				//const [res, resTipoExtraordinario] = await Promise.all([
				const [ resTipoExtraordinario, resRel, resTiDoc, resDataSedes] = await Promise.all([
						//this.callApi('get', 'app/suministro'),
						this.callApi('get', 'app/getTipoExtraordinario'),
						this.callApi('get', 'app/relacion'),
						this.callApi('get', 'app/tipodocumento'),
                  this.callApi('get', 'app/getDataSedes'),
					])
				

					//this.suministros = res.data
					this.tipoExtraordinarios = resTipoExtraordinario.data
					this.relacions = resRel.data
					this.tipoDocumentos = resTiDoc.data
               this.dataSedes = resDataSedes.data
					console.log('los datos del suministro son',resTipoExtraordinario.data)
					//console.log('los datos del suministro son',this.tipoExtraordinarios)

					//console.log('es el usuario',this.users)
					//console.log('es el usuario logueado ',this.userLogged['permissions'])

				} catch {
					this.$swal('Algo salio mal','intente nuevamente','error')
				}
		
		
	},

	computed: {
      state() {
        //return this.value.length === 2
        //if (this.checked==1) {

        	if (!this.regData.idRelacion) 
        		{
        			this.descripcionDescuentoN=false
        		}else if (this.regData.idRelacion == 1 ) {
        		this.descripcionDescuentoN=false
        		if (this.regData.Documento.length != 8) {
        			this.descripcionDescuentoN=true
        		}

        	} else {this.descripcionDescuentoN=true}


        	

        /*if (this.regData.idRelacion>1 || (this.regData.idRelacion == 1 && this.regData.Documento.length != 8 && !this.regData.Documento )) {
        	

        	this.descripcionDescuentoN=true
        }
        else{
        	
        	

        	this.descripcionDescuentoN=false
        }*/
        

      },

      stateIdR() {
         //console.log('---------',this.regCorreoData.relacion_id)
        //return this.value.length === 2
        //if (this.checked==1) {
         //this.getDataSuministro.TipoDocumento != 1 || this.getDataSuministro.Documento == '' || this.formPersonaData || 
         // || this.regCorreoData.relacion_id != '1'


         if ((this.getDataSuministro.TipoDocumento != 1 || this.getDataSuministro.Documento == '' || this.formPersonaData || this.regCorreoData.relacion_id != '1') && (this.regCorreoData.relacion_id != undefined)) {
            //console.log('muestra formulario')
            this.registroREsponsableCorreo = true
         }else{

            //console.log('no muestra nada')
            this.registroREsponsableCorreo = false
         }


      },

      
     /* stateSuministro() {
        //return this.value.length === 2
        if (this.checkedSuministro==1) {
        	

        	this.descripcionDescuentoN=true
        }
        else{
        	
        	

        	this.descripcionDescuentoN=false
        }

      },*/
      
  	}


	




}




  </script>