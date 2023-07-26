<template>
<base-layout>
<Breadcrumbs>
	<template v-slot:titulo_breadcrumbs> Matricula
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

	
	  <b-card class="card mb-3">
		  	<h5 class="Card-title mb-3"> <i class="fas fa-chart-area"></i> Administrar Matricula</h5>
		    <b-row cols-sm="1" cols-md="2" cols-lg="2">
				<b-col  >
			    	<b-col >
			    		<b-form-group  id="input-group-1" label="" label-for="referencia" class="navbar-left navbar-form nav-search mr-md-3">
								
								<div class="input-group">
								
				                    <b-form-select v-model="filtro.tipofiltro" :options="options"></b-form-select>
				                </div>

				            </b-form-group>
			    	</b-col>
			    </b-col>

			    <b-col  >
			    	<b-col >
			    		<div class=" ml-auto" id="search-nav">
							

							<b-form-group  id="input-group-1" label="" label-for="referencia" >
								<div class="input-group">
								<div class="input-group-prepend">
										<button type="submit" class="btn btn-search pr-1">
											<i class="fa fa-search search-icon"></i>
										</button>
									</div>
				                    <b-form-input id="referencia"  v-model="filtro.referencia"  type="text" placeholder="Ingresar codigo de matricula"  v-on:keyup="getEstudiante" maxlength="8" >
				                    </b-form-input>
				                </div>
				            </b-form-group>
						</div>
			    	</b-col>
			    </b-col>
			</b-row>

	  </b-card>
	

		<div class="row" v-if="EstudianteAll"  >
			

			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">

							
							<table class="table table-head-bg-primary">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">nombres</th>
										<th scope="col">Last</th>
										<th scope="col">Last</th>
										<th scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(estMatricula, i) in estMatriculas" :key="i" v-if="estMatriculas.length">
										
										<td>{{estMatricula.id}}</td>
										
										<td>{{estMatricula.persona.nombre}}</td>
										<td>{{estMatricula.añoEgreso}}</td>
										<td>{{estMatricula.estado}}</td>
										<td> 
											<button type="button" class="btn btn-icon  btn-warning">
												<i class="fa fa-exclamation-circle"></i>
											</button> 
											<button type="button" class="btn btn-icon btn-round btn-success " data-toggle="tooltip" data-placement="top" title="opciones del boton">
												<i class="fab fa-python fa-lg"></i>
											</button> 
										</td>
										
										
									</tr>
									
									
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="row" v-if="filtEstudiante" >
			

			<div class="col-md-12  ml-auto mr-auto">
				<div class="card">
					<div class="card-body">
						<div class="row">

							
							<table class="table table-head-bg-primary">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">DNI</th>
										<th scope="col">APELLIDOS Y NOMBRES</th>
										<th scope="col">ESTADO</th>
										<th scope="col">Acciones</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(filtroEstudiante, i) in filtroEstudiantes" :key="i" v-if="filtroEstudiantes.length">
										
										<td>{{filtroEstudiante.id}}</td>
										<td>{{filtroEstudiante.dni}}</td>
										
										
										<td>{{filtroEstudiante.apellPat}} {{filtroEstudiante.apellMat}} {{filtroEstudiante.nombre}}</td>
										<td v-if="filtroEstudiante.estado == 1">
											
												<i class=" fas fa-check fa-lg btn  btn-success btn-round "></i>
												
											
										</td>
										<td v-else>
											<button type="button" class="btn btn-icon btn-round btn-danger">
												<i class="fas fa-times fa-lg " ></i>
											</button> 
										</td>
										
										<td> 
											
											<button type="button" class="btn btn-icon btn-sm btn-warning" @click="matriculaEstudiante(filtroEstudiante, i)" v-if="isWritePermitted">
												<i class="fas fa-plus"></i>
											</button> 
											<button type="button" class="btn btn-icon btn-sm btn-primary " @click="editRegistroEst(filtroEstudiante, i)" v-if="isUpdatePermitted">
												<i class="fas fa-edit"></i>
											</button> 
											<button type="button" class="btn btn-icon btn-sm btn-danger " data-toggle="tooltip" data-placement="top" title="opciones del boton">
												<i class="fas fa-trash-alt"></i>
											</button>
										</td>
										
										
									</tr>
									
									
								</tbody>
							</table>

						</div>

					</div>
				</div>
			</div>
		</div>

	<b-modal  hide-footer size="xl"  v-model="editRegEst" title="Editar datos del estudiante" :mask-closable="false" :closable="false">
      <div class="d-block ">
      	<form v-on:submit.prevent="editRegEst">

      		
			  <b-tabs
			    active-nav-item-class="font-weight-bold text-uppercase text-danger"
			    active-tab-class="font-weight-bold text-success"
			    content-class="mt-3"
			    justified
			  >


				    <b-tab title="DATOS DEL ESTUDIANTE" active>
				    	
				    	<b-row cols-sm="1" cols-md="2" cols-lg="5" >
					      	
							    <b-col  >
							    	<b-col >
							    		<b-form-group  id="input-group-1" label="DNI :" label-for="editEstDni">
					                    <b-form-input id="editEstDni" v-model="editEstPersona.dni"  type="text" placeholder="Ingresar los nombres" >
					                    </b-form-input>
					                 </b-form-group>
							    	</b-col>
							    	<b-col >
							    		<b-form-group  id="input-group-1" label="DIRECCION :" label-for="editEstDireccion">
						                    <b-form-input id="editEstDireccion" v-model="editEstPersona.direccion"  type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    	</b-col>
							    	
							    	
							    </b-col>
							    <b-col  >
							    	<b-col >
							    		<b-form-group  id="input-group-1" label="APELLIDO PATERNO :" label-for="editEstApellPat">
					                    <b-form-input id="editEstApellPat" v-model="editEstPersona.apellPat" type="text" placeholder="Ingresar los nombres" >
					                    </b-form-input>
					                 </b-form-group>
							    	</b-col>
							    	<b-col >
							    		<b-form-group  id="input-group-1" label="TELEFONO :" label-for="editEstTelefono">
						                    <b-form-input id="editEstTelefono" v-model="editEstPersona.telefono" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    	</b-col>
							    	
							    </b-col>
							    <b-col  >
							    	<b-col >
							    		<b-form-group  id="input-group-1" label="APELLIDO MATERNO :" label-for="editEstApellMat">
						                    <b-form-input id="editEstApellMat" v-model="editEstPersona.apellMat" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    		
							    	</b-col>
							    	<b-col >
							    		<b-form-group  id="input-group-1" label="EMAIL :" label-for="editEstEmail">
						                    <b-form-input id="editEstEmail" v-model="editEstPersona.email"  type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    	</b-col>
							    	
							    </b-col>
							    <b-col  >
							    	<b-col >
							    		<b-form-group  id="input-group-1" label="NOMBRES :" label-for="nombre">
						                    <b-form-input id="nombre" v-model="editEstPersona.nombre" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    		
							    	</b-col>
							    	<b-col >


							    		
							    		<b-form-group  id="input-group-1" label="SEXO :" label-for="editEstSexo">
						                    <b-form-radio v-model="editEstPersona.sexo" name="some-radios" value="0">femenino</b-form-radio>
						                  <b-form-radio v-model="editEstPersona.sexo" name="some-radios" value="1">Masculino</b-form-radio>
						                 </b-form-group>
							    	</b-col>
							    	
							    </b-col>
							    <b-col >
							    	
							    		<b-img thumbnail rounded fluid :src="`/storage/${editEstudianteID.image}`" ref="newDescuentoImageDisplay" alt="Image 1"  class="w-150px"></b-img>
							    	
							    </b-col>
							</b-row>

							<b-row cols-sm="1" cols-md="3" cols-lg="4">
							    
							    <b-col >
							    	

							    	<b-form-group id="input-group-1" label="DEPARTAMENTO :" label-for="areaMat">
								        <b-form-select v-model="editEstPersona.departamento_id"  class="mb-3" name="areaMat" @change='getEstProvincia()' >
									      
									        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
									      
									      <b-form-select-option :value="departamento.id" v-for="(departamento, i) in departamentos" :key="i" v-if="departamentos.length" >{{departamento.nameDepartamento}}</b-form-select-option>
									      
									    </b-form-select>
								    </b-form-group>

								    

							    </b-col>
							    <b-col >

							    	 

							    	<b-form-group id="input-group-1" label="PROVINCIA :" label-for="areaMat" v-if="edEstProv">
								        <b-form-select v-model="editEstPersona.provincia_id"  class="mb-3" name="areaMat" @change='getEstDistrito()' >
								        
									      
									        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>

									      
									      <b-form-select-option :value="provincia.id" v-for="(provincia, i) in provincias
									      " :key="i" v-if="provincias.length" >{{provincia.nameProvincia}}</b-form-select-option>
									      
									    </b-form-select>
								    </b-form-group>

							    	<b-form-group  id="input-group-1" label="PROVINCIA :" label-for="email" v-if="estProv">
					                    <b-form-input id="email" v-model="editEstPersona.provincia.nameProvincia" v-if="editEstPersona.provincia"  type="text" placeholder="Ingresar los nombres" disabled>
					                    </b-form-input>
					                 </b-form-group>

					                 
							    </b-col>
							    <b-col >
							    	

							    	<b-form-group  id="input-group-1" label="DISTRITO :" label-for="direccion" v-if="edEstDis">
					                    

					                    <b-form-select v-model="editEstPersona.distrito_id"  v-if="editEstPersona.distrito" class="mb-3" name="areaMat" @change='getEstDistrito()'   >
								        
									      
									        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
									      
									      <b-form-select-option :value="distrito.id" v-for="(distrito, i) in distritos" :key="i" v-if="distritos.length" >{{distrito.nameDistrito}}</b-form-select-option>
									      
									    </b-form-select>
					                 </b-form-group>

					                 <b-form-group  id="input-group-1" label="DISTRITO :" label-for="email" v-if="estProv">
					                    <b-form-input id="email" v-model="editEstPersona.distrito.nameDistrito" v-if="editEstPersona.distrito"  type="text" placeholder="Ingresar los nombres" disabled>
					                    </b-form-input>
					                 </b-form-group>

							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="CARGAR IMAGEN :" label-for="direccion">
						                <b-form-file
					                    v-model="estudianteID.persona"
					                    ref="file-input"
					                    placeholder="Cambiar archivo..."
					                    drop-placeholder="Drop file here..."
					                    :headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
					                  ></b-form-file>
						            </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="DNI ESCANEADO :" label-for="direccion">
						                    
											<b-button variant="outline-primary" size="sm">
												<i class="fas fa-cloud-download-alt "> DESCARGAR</i> 
											</b-button>
						                 </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group id="input-group-1" label="CARGAR DNI:" label-for="archivo" >
								            
					                	<b-form-file
					                    v-model="estudianteID.persona"
					                    ref="file-input"
					                    placeholder="Cambiar archivo..."
					                    drop-placeholder="Drop file here..."
					                    :headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
					                  ></b-form-file>

					        		</b-form-group>

							    	
							    </b-col>
							  
							  
							  </b-row>

				    </b-tab>
				    
				    <b-tab title="DATOS DEL PAGO - SEGUN BOUCHER">
				    	
				    	<b-row cols-sm="1" cols-md="2" cols-lg="5">
							    <b-col >
							    	<b-form-group  id="input-group-1" label="DNI :" label-for="editDniBoucher">
					                    <b-form-input id="editDniBoucher" v-model="editEstPago.boucher_pago.dni" v-if="editEstPago.boucher_pago" type="text" placeholder="Ingresar los nombres" >
					                    </b-form-input>
					                 </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="SERIE :" label-for="editSerieBoucher">
						                    <b-form-input id="editSerieBoucher" v-model="editEstPago.boucher_pago.serie" v-if="editEstPago.boucher_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="FECHA :" label-for="editFechaBoucher">
						                    <b-form-input id="editFechaBoucher" v-model="editEstPago.boucher_pago.fecha" v-if="editEstPago.boucher_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="MONTO :" label-for="editImporteBoucher">
						                    <b-form-input id="editImporteBoucher" v-model="editEstPago.boucher_pago.importe" v-if="editEstPago.boucher_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>

							    <b-col >
							    	<b-form-group  id="input-group-1" label="TIPO DE DESCUENTO :" label-for="editTipoApoderado">
						                    <b-form-input id="editTipoApoderado" v-model="editEstPago.boucher_pago.serie" v-if="editEstPago.boucher_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="ARCHIVO DESCUENTOO :" label-for="serieMat">
						                    <b-form-input id="serieMat" v-model="pagoMat.boucher_pago.serie" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="CARGAR DESCUENTO :" label-for="fechaMat">
						                    <b-form-input id="fechaMat" v-model="pagoMat.boucher_pago.fecha" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="ARCHIVO BOUCHER :" label-for="importeMat">
						                    <b-form-input id="importeMat" v-model="pagoMat.boucher_pago.importe" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>
							    <b-col >
							    	<b-form-group  id="input-group-1" label="CARGAR BOUCHER :" label-for="importeMat">
						                    <b-form-input id="importeMat" v-model="pagoMat.boucher_pago.importe" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>

							    <b-col >
							    	<b-form-group  id="input-group-1" label="TIPO DEL PAGO :" label-for="editTipoPago">
						                    <b-form-input id="editTipoPago" v-model="editEstPago.tipo_pago.nameTipoPago" v-if="editEstPago.tipo_pago" type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                    <b-form-input id="editTipoPagoi" v-model="editEstPago.tipoPago_id"  type="text" placeholder="Ingresar los nombres" >
						                    </b-form-input>
						                 </b-form-group>
							    </b-col>

							  </b-row>

				    </b-tab>
				    <b-tab title="DATOS DEL APODERADO " >
				    	
				    	<b-row cols-sm="1" cols-md="2" cols-lg="6">

							<b-col >

								<b-form-group id="input-group-1" label="DNI :" label-for="sedeMat">
							        <b-form-select v-model="matData.sede_id"  class="mb-3" name="sedeMat" @change='getAula()' >
								      
								        <b-form-select-option :value="null" >-- Please select an option --</b-form-select-option>
								      
								      <b-form-select-option :value="sede.id" v-for="(sede, i) in sedesMat" :key="i" v-if="sedesMat.length" >{{sede.nameSede}}</b-form-select-option>
								      
								    </b-form-select>
							    </b-form-group>
							</b-col>
							<b-col >

							    <b-form-group id="input-group-1" label="APELLIDO PATERNO :" label-for="areaMat">
							        <b-form-select v-model="matData.area_id"  class="mb-3" name="areaMat" @change='getAula()' >
								      
								        <b-form-select-option :value="null" >-- Please select an option --</b-form-select-option>
								      
								      <b-form-select-option :value="area.id" v-for="(area, i) in areasMat" :key="i" v-if="areasMat.length" >{{area.nameArea}}</b-form-select-option>
								      
								    </b-form-select>
							    </b-form-group>
							</b-col>
							<b-col >
							    <b-form-group id="input-group-1" label="APELLIDO MATERNO :" label-for="turnoMat">
							        <b-form-select v-model="matData.turno_id"  class="mb-3" name="turnoMat" @change='getAula()' >
								      
								        <b-form-select-option :value="null" >-- Please select an option --</b-form-select-option>
								      
								      <b-form-select-option :value="turno.id" v-for="(turno, i) in turnosMat" :key="i" v-if="turnosMat.length" >{{turno.nameTurno}}</b-form-select-option>
								      
								    </b-form-select>
							    </b-form-group>
							</b-col>
							<b-col >
							    <b-form-group id="input-group-1" label="NOMBRES :" label-for="aulaMat">
							        <b-form-select v-model="matData.aula_id"  class="mb-3" name="aulaMat" @change='getAula()' >
								      
								        <b-form-select-option :value="null" >-- Please select an option --</b-form-select-option>
								      
								      <b-form-select-option :value="aulaMat.id" v-for="(aulaMat, i) in aulasMat" :key="i" v-if="aulasMat.length" >{{aulaMat.nameAula}}  -({{aulaMat.locales.nameLocal}})</b-form-select-option>
								      
								    </b-form-select>
							    </b-form-group>
							</b-col>
							<b-col >
								

							    <b-form-group id="input-group-1" label="SEXO :" label-for="sedeMat">
							        <b-form-select v-model="matData.sede_id"  class="mb-3" name="sedeMat" @change='getAula()' >
								      
								        <b-form-select-option :value="null" >-- Please select an option --</b-form-select-option>
								      
								      <b-form-select-option :value="sede.id" v-for="(sede, i) in sedesMat" :key="i" v-if="sedesMat.length" >{{sede.nameSede}}</b-form-select-option>
								      
								    </b-form-select>
							    </b-form-group>
							</b-col>
							<b-col >
							    <b-form-group id="input-group-1" label="TELEFONO :" label-for="areaMat">
							        <b-form-select v-model="matData.area_id"  class="mb-3" name="areaMat" @change='getAula()' >
								      
								        <b-form-select-option :value="null" >-- Please select an option --</b-form-select-option>
								      
								      <b-form-select-option :value="area.id" v-for="(area, i) in areasMat" :key="i" v-if="areasMat.length" >{{area.nameArea}}</b-form-select-option>
								      
								    </b-form-select>
							    </b-form-group>
							</b-col>
							<b-col >
							    <b-form-group id="input-group-1" label="EMAIL :" label-for="turnoMat">
							        <b-form-select v-model="matData.turno_id"  class="mb-3" name="turnoMat" @change='getAula()' >
								      
								        <b-form-select-option :value="null" >-- Please select an option --</b-form-select-option>
								      
								      <b-form-select-option :value="turno.id" v-for="(turno, i) in turnosMat" :key="i" v-if="turnosMat.length" >{{turno.nameTurno}}</b-form-select-option>
								      
								    </b-form-select>
							    </b-form-group>
							</b-col>
							<b-col >
							    <b-form-group id="input-group-1" label="FECHA NACIMIENTO :" label-for="aulaMat">
							        <b-form-select v-model="matData.aula_id"  class="mb-3" name="aulaMat" @change='getAula()' >
								      
								        <b-form-select-option :value="null" >-- Please select an option --</b-form-select-option>
								      
								      <b-form-select-option :value="aulaMat.id" v-for="(aulaMat, i) in aulasMat" :key="i" v-if="aulasMat.length" >{{aulaMat.nameAula}}  -({{aulaMat.locales.nameLocal}})</b-form-select-option>
								      
								    </b-form-select>
							    </b-form-group>

							</b-col>
							<b-col >
						    	<b-form-group  id="input-group-1" label="TIPO APODERADO :" label-for="fechaMat">
				                    <b-form-input id="fechaMat" v-model="pagoMat.boucher_pago.fecha" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" >
				                    </b-form-input>
					            </b-form-group>
							</b-col>
							<b-col >
						    	<b-form-group  id="input-group-1" label="DEPARTAMENTO :" label-for="importeMat">
				                    <b-form-input id="importeMat" v-model="pagoMat.boucher_pago.importe" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" >
				                    </b-form-input>
					            </b-form-group>
							</b-col>   
							<b-col >
						    	<b-form-group  id="input-group-1" label="PROVINCIA :" label-for="fechaMat">
				                    <b-form-input id="fechaMat" v-model="pagoMat.boucher_pago.fecha" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" >
				                    </b-form-input>
					            </b-form-group>
							</b-col>
							<b-col >
						    	<b-form-group  id="input-group-1" label="DISTRITO :" label-for="importeMat">
				                    <b-form-input id="importeMat" v-model="pagoMat.boucher_pago.importe" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" >
				                    </b-form-input>
					            </b-form-group>
							</b-col> 
							    
							    
							    
							  </b-row>

				    </b-tab>
			    	<b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab>
			  </b-tabs>
			
	      
	      <br>
	      <a href="#" class="btn btn-primary">Go somewhere</a>
	      
		</form>
        
        
      </div>
	</b-modal>

	<b-modal  hide-footer size="lg"  v-model="matriculaEst" title="Matricular estudiante" :mask-closable="false" :closable="false">
    	<div class="d-block ">
	      	<form v-on:submit.prevent="matriculaEst">
	      		


		      <b-container class="bv-example-row">
		      	<b-row cols-sm="1" cols-md="1" cols-lg="1">
				    <b-col  >
				    	<p>DATOS DEL ESTUDIANTE :  
	      			
					
					<a href="#" class="btn btn-primary  btn-round btn-sm">
						<span class="btn-label">
							<i class="fas fa-address-card fa-lg"></i> DNI
						</span>
						
					</a>
				</p> 
				    </b-col>
				</b-row>

		      	<b-row cols-sm="1" cols-md="2" cols-lg="3">
				    <b-col  >
				    	<b-col >
				    		<b-form-group  id="input-group-1" label="DNI :" label-for="dni">
		                    <b-form-input id="dni" v-model="estudianteID.persona.dni" v-if="estudianteID.persona" type="text" placeholder="Ingresar los nombres" disabled>
		                    </b-form-input>
		                 </b-form-group>
				    	</b-col>
				    	<b-col >
				    		<b-form-group  id="input-group-1" label="APELLIDO PATERNO :" label-for="dni">
			                    <b-form-input id="apellPat" v-model="estudianteID.persona.apellPat" v-if="estudianteID.persona" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    	</b-col>
				    </b-col>
				    <b-col  >
				    	<b-col >
				    		<b-form-group  id="input-group-1" label="NOMBRE :" label-for="nombre">
			                    <b-form-input id="nombre" v-model="estudianteID.persona.nombre" v-if="estudianteID.persona" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    		
				    	</b-col>
				    	<b-col >
				    		<b-form-group  id="input-group-1" label="APELLIDO MATERNO :" label-for="apellMat">
			                    <b-form-input id="apellMat" v-model="estudianteID.persona.apellMat" v-if="estudianteID.persona" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    	</b-col>
				    </b-col>
				    <b-col >
				    	<b-col>
				    		<b-img thumbnail rounded fluid :src="`/storage/${estudianteID.image}`" ref="newDescuentoImageDisplay" alt="Image 1"  class="w-150px"></b-img>
				    	</b-col>
				    </b-col>
				</b-row>

				<b-row cols-sm="1" cols-md="2" cols-lg="3">
				    <b-col >
				    	<b-form-group  id="input-group-1" label="TELEFONO :" label-for="telefono">
			                    <b-form-input id="telefono" v-model="estudianteID.persona.telefono" v-if="estudianteID.persona" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    </b-col>
				    <b-col >
				    	<b-form-group  id="input-group-1" label="EMAIL :" label-for="email">
			                    <b-form-input id="email" v-model="estudianteID.persona.email" v-if="estudianteID.persona" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    </b-col>
				    <b-col >
				    	<b-form-group  id="input-group-1" label="DIRECCION :" label-for="direccion">
			                    <b-form-input id="direccion" v-model="estudianteID.persona.direccion" v-if="estudianteID.persona" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    </b-col>
				  </b-row>

				  <p>DATOS DEL PAGO:
				  	<a href="#" class="btn btn-primary  btn-round btn-sm">
						<span class="btn-label">
							<i class="fas fa-dollar-sign fa-lg"></i> BOUCHER
						</span>
						
					</a>
					<a href="#" class="btn btn-primary  btn-round btn-sm">
						<span class="btn-label">
							<i class="fas fa-user-graduate fa-lg"></i> ESTUDIOS
						</span>
						
					</a>
					<a href="#" class="btn btn-primary  btn-round btn-sm">
						<span class="btn-label">
							<i class="fas fa-gavel fa-lg"></i> DESCUENTO (tipo del descuento)
						</span>
						
					</a>
				  </p>

				<b-row cols-sm="1" cols-md="2" cols-lg="4">
				    <b-col >
				    	<b-form-group  id="input-group-1" label="DNI :" label-for="dniMat">
			                    <b-form-input id="dniMat" v-model="pagoMat.boucher_pago.dni" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    </b-col>
				    <b-col >
				    	<b-form-group  id="input-group-1" label="SERIE :" label-for="serieMat">
			                    <b-form-input id="serieMat" v-model="pagoMat.boucher_pago.serie" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    </b-col>
				    <b-col >
				    	<b-form-group  id="input-group-1" label="FECHA :" label-for="fechaMat">
			                    <b-form-input id="fechaMat" v-model="pagoMat.boucher_pago.fecha" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    </b-col>
				    <b-col >
				    	<b-form-group  id="input-group-1" label="MONTO :" label-for="importeMat">
			                    <b-form-input id="importeMat" v-model="pagoMat.boucher_pago.importe" v-if="pagoMat.boucher_pago" type="text" placeholder="Ingresar los nombres" disabled>
			                    </b-form-input>
			                 </b-form-group>
				    </b-col>
				  </b-row>

				  <p>DATOS DE LA MATRICULA:</p>

				<b-row cols-sm="1" cols-md="2" cols-lg="4">

					<b-form-group id="input-group-1" label="SEDE :" label-for="sedeMat">
				        <b-form-select v-model="matData.sede_id"  class="mb-3" name="sedeMat" @change='getAula()' >
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="sede.id" v-for="(sede, i) in sedesMat" :key="i" v-if="sedesMat.length" >{{sede.nameSede}}</b-form-select-option>
					      
					    </b-form-select>
				    </b-form-group>

				    <b-form-group id="input-group-1" label="AREA :" label-for="areaMat">
				        <b-form-select v-model="matData.area_id"  class="mb-3" name="areaMat" @change='getAula()' >
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="area.id" v-for="(area, i) in areasMat" :key="i" v-if="areasMat.length" >{{area.nameArea}}</b-form-select-option>
					      
					    </b-form-select>
				    </b-form-group>

				    <b-form-group id="input-group-1" label="TURNO :" label-for="turnoMat">
				        <b-form-select v-model="matData.turno_id"  class="mb-3" name="turnoMat" @change='getAula()' >
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="turno.id" v-for="(turno, i) in turnosMat" :key="i" v-if="turnosMat.length" >{{turno.nameTurno}}</b-form-select-option>
					      
					    </b-form-select>
				    </b-form-group>

				    <b-form-group id="input-group-1" label="AULA :" label-for="aulaMat">
				        <b-form-select v-model="matData.aula_id"  class="mb-3" name="aulaMat" @change='getAula()' >
					      
					        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
					      
					      <b-form-select-option :value="aulaMat.id" v-for="(aulaMat, i) in aulasMat" :key="i" v-if="aulasMat.length" >{{aulaMat.nameAula}}  -({{aulaMat.locales.nameLocal}})</b-form-select-option>
					      
					    </b-form-select>
				    </b-form-group>
				    
				    
				  </b-row>

		        

		        


		      </b-container>
		      
		      
		      
			</form>
			<div class="modal-footer">

				<button type="button" class="btn btn-primary">Matricular</button>
				<button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
			</div>
        
        
      	</div>
	</b-modal>
	

</base-layout>

</template>

<script>

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
//import * as categoryService from '../../../services/category_service';

export default{
	components: {
		Breadcrumbs,
		
		
	},



	data(){
		return {
			estProv: true,
			edEstProv: false,
			estDis: true,
			edEstDis: false,
			filtEstudiante: false,
			
			EstudianteAll: false,
			matriculaEst : false,
			editRegEst : false,
			mainProps: { blank: true, width: 75, height: 75, class: 'm1' },
			data : {
				
			},
			filtro: {
				referencia: '',
				tipofiltro: null,
			},

			matData : {

				sede_id: '',
				area_id: '',
				turno_id: '',
				local_id: '',
				
				
			},
			editEstPersona : {
				dni: '',
				departamento_id:'',
			},
			provincias : {
				id:'',
				nameProvincia: '',
			},

			
	        options: [
	          { value: null, text: 'Please select some item', disabled: true },
	          { value: 'id', text: 'CODIGO' },
	          { value: 'dni', text: 'DNI' },
	          { value: 'nombre', text: 'NOMBRES' },
	         
	        ],
			
			aulasMat: [],
			estMatriculas: [],
			estudianteID: [],
			pagoMat: [],
			sedesMat: [],
			filtroEstudiantes: [],

			editEstudianteID: [],
			editEstApoderado: [],
			editEstAula: [],
			editEstColegio: [],
			editEstPago: [],
			editEstPersona: [],
			editEstDescuento: [],

			departamentos: [],
			provincias: [],
			distritos: [],
			
			
		}
	},


	methods : {


		getEstudiante: function() {
			//this.estudiante.añoEgreso.trim()==''
			if (this.filtro.referencia.trim() != '' && this.filtro.tipofiltro != null){
            
            axios.get('app/filtroEstudiante',{
             params: {
               referencia: this.filtro.referencia,
               tipofiltro: this.filtro.tipofiltro,

               
             }
          }).then(function(response){
                this.filtroEstudiantes = response.data;
                //console.log(this.descuento.referencia)
                        console.log('losmestudiantes son filtroEstudiantes: ', this.filtroEstudiantes)

                       this.EstudianteAll=false
                       this.filtEstudiante=true
                        
                /*if (this.descuento.tipoDescuento_id > 1) {
                        //console.log('si array',this.aulasreg[0])
                        //console.log('no array',this.aulasreg[0].id)
                        console.log(this.descuento.tipoDescuento_id)

                this.descripcionDescuento=true

                }else{
                  this.descripcionDescuento=false
                }*/

            }.bind(this));
      }

        },

       
      /*  matriculaEstudiante(filtroEstudiante, index){
			let obj ={
				id : filtroEstudiante.id,
				roleName : filtroEstudiante.roleName,
				description : filtroEstudiante.description,

			}
			this.editData = obj
			this.editModal = true
			this.index = index
		},
*/
		async matriculaEstudiante(filtroEstudiante, index) {
console.log('es DEL FILTRO ESTUDIANTE',filtroEstudiante)
			let obj ={
				//id : filtroEstudiante.id,
				//roleName : filtroEstudiante.roleName,
				//description : filtroEstudiante.description,
				sede_id : filtroEstudiante.sede_id,
				area_id : filtroEstudiante.area_id,
				turno_id : filtroEstudiante.turno_id,
				local_id : filtroEstudiante.local_id

			}
			this.matData = obj
			//this.estudiante.añoEgreso.trim()==''
            try	{
			//this.token = window.Laravel.csrfToken
			this.matriculaEst = true
			const [res] = await Promise.all([
					this.callApi('get', `app/matriculaEstudiante/${filtroEstudiante.id}`),
					
				])

				//const res = await this.callApi('get', `app/matriculaEstudiante/${filtroEstudiante.id}`);
					this.estudianteID = res.data.estudiante
					this.pagoMat = res.data.pagoMat
					this.sedesMat = res.data.sedes
					this.areasMat = res.data.areas
					this.turnosMat = res.data.turnos
					this.localesMat = res.data.locales
					//console.log('Buscar est con id: ', this.estudianteID.persona.nombre)
					//console.log('Buscar est persona id: ', this.estudianteID.persona)
					console.log('Buscar est total id: ', res.data)
				} catch {
					this.$swal('Any fool can use a computer','de','error')
				}
      	

        },

        getAula: function() {
        	
            axios.get('app/getAula',{
             params: {
               sede_id: this.matData.sede_id,
               area_id: this.matData.area_id,
               turno_id: this.matData.turno_id
             }
          }).then(function(res){
                this.aulasMat = res.data;
                console.log('aulas que existen', this.aulasMat )
            }.bind(this));

        },

        getEstProvincia: function() {
        	
            axios.get('app/getEstProvincia',{
             params: {
               departamento_id: this.editEstPersona.departamento_id,
               
             }
          }).then(function(res){
                this.provincias = res.data;
                this.estProv = false
                this.edEstProv = true
                this.estDis = false
                this.edEstDis = false
                
                //console.log('aulas que existen', this.aulasMat )
            }.bind(this));

        },

        getEstDistrito: function() {
        	
            axios.get('app/getEstDistrito',{
             params: {
               provincia_id: this.editEstPersona.provincia_id,
               
             }
          }).then(function(res){
                this.distritos = res.data;
                this.estDis = false
                this.edEstDis = true
                //this.estadoSelectProv= false;
               // console.log('aulas que existen', this.aulasMat )
            }.bind(this));

        },

        async editRegistroEst(filtroEstudiante, index) {
			//console.log('es DEL FILTRO ESTUDIANTE',filtroEstudiante)

			
			/*let obj ={
				//id : filtroEstudiante.id,
				//roleName : filtroEstudiante.roleName,
				//description : filtroEstudiante.description,
				sede_id : filtroEstudiante.sede_id,
				area_id : filtroEstudiante.area_id,
				turno_id : filtroEstudiante.turno_id,
				local_id : filtroEstudiante.local_id

			}
			this.matData = obj*/
			//this.estudiante.añoEgreso.trim()==''
			
            try	{
			//this.matriculaEst = false
            	this.editRegEst = true
            	
			//this.token = window.Laravel.csrfToken
			//this.matriculaEst = true
			const [res] = await Promise.all([
					this.callApi('get', `app/editRegistroEstudiante/${filtroEstudiante.id}`),
					
				])
			
				this.editEstudianteID = res.data
				this.editEstApoderado = res.data.apoderado
				this.editEstAula = res.data.aula
				this.editEstColegio = res.data.colegio
				this.editEstPago = res.data.pago
				this.editEstPersona = res.data.persona
				this.editEstDescuento = res.data.descuento

				

				//const res = await this.callApi('get', `app/matriculaEstudiante/${filtroEstudiante.id}`);
					//this.pagoMat = res.data.pagoMat
					//this.sedesMat = res.data.sedes
					//this.areasMat = res.data.areas
					//this.turnosMat = res.data.turnos
					//this.localesMat = res.data.locales
					//console.log('Buscar est con id: ', this.estudianteID.persona.nombre)
					//console.log('Buscar est persona id: ', this.estudianteID.persona)
					console.log('editEstudianteID: ', this.editEstudianteID)
					console.log('editEstApoderado: ', this.editEstApoderado)
					console.log('editEstAula: ', this.editEstAula)
					console.log('editEstColegio: ', this.editEstColegio)
					console.log('editEstPago: ', this.editEstPago)
					console.log('editEstPersona: ', this.editEstPersona)

					this.estProv = true
                	this.estDis = true
                	this.edEstProv = false
                	this.edEstDis = false
					
				} catch {
					this.$swal('Any fool can use a computer','de','error')
				}
				
      	

        },
		




	},


		async created(){
			try	{
				const [res] = await Promise.all([
					this.callApi('get', 'app/estMatricula'),
					//this.callApi('get', 'app/getDepartamento')
				])
			
				this.estMatriculas = res.data.estudiantes
				this.departamentos = res.data.departamentos
				this.provincias = res.data.provincias
				this.distritos = res.data.distritos
				//this.departamentos = resDep.data

				console.log('esto k:',res.data)
				//console.log('esto es:',this.personas)
				//console.log('esto es:',this.departamentos)

			} catch {
				this.$swal('Any fool can use a computer','de','error')
			}

			

			
			
		},

		


	




}




  </script>