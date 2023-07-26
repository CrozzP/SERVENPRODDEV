<template>
      

                  
                        

                  <div class="row mt--1">
                        <div class="col-md-12">
                             <b-card no-body v-show="registroTab">
                                    
                                    <b-tabs
                                        v-model="tabIndex"
                                        active-nav-item-class="font-weight-bold text-uppercase text-success"
                                        active-tab-class="font-weight-bold text-success"
                                        content-class="mt-3"
                                        nav-wrapper-class="w-30"

                                        vertical
                                      >
                                      
                                        

                                        <b-tab title="Datos Personales" active>
                                          
                                            <form v-on:submit.prevent="addPersonaEstudiante">

                                                <b-container class="bv-example-row">
                                                        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                                          <b-col>
                                                            <b-form-group id="input-group-1" label="Dni :" label-for="dni" >
                                                                  <b-form-input id="dni" v-model="personaEst.dni" type="text" placeholder="Ingresar el dni" >
                                                                  </b-form-input>
                                                            </b-form-group>
                                                            <b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat" >
                                                                    <b-form-input id="apellPat" v-model="personaEst.apellPat" type="text" placeholder="Ingresar el Apellido Paterno" >
                                                                    </b-form-input>
                                                                 </b-form-group>
                                                                               
                                                          </b-col>
                                                          <b-col>
                                                            
                                                                 <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat" >
                                                                    <b-form-input id="apellMat" v-model="personaEst.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
                                                                    </b-form-input>
                                                                 </b-form-group>
                                                                 <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre">
                                                                    <b-form-input id="nombre" v-model="personaEst.nombre" type="text" placeholder="Ingresar los nombres" >
                                                                    </b-form-input>
                                                                 </b-form-group>
                                                          </b-col>
                                                        </b-row>

                                                        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                                          <b-col>
                                                            <b-form-group id="input-group-1" label="Sexo">
                                                                  <b-form-radio v-model="personaEst.sexo" name="some-radios" value="0">femenino</b-form-radio>
                                                                  <b-form-radio v-model="personaEst.sexo" name="some-radios" value="1">Masculino</b-form-radio>
                                                                </b-form-group>
                                                                <b-form-group id="input-group-1" label="Fecha de Nacimiento :" label-for="fechaNacimiento" >
                                                                    <b-form-input id="fechaNacimiento" v-model="personaEst.fechaNacimiento" type="date" placeholder="Ingresar la fecha de nacimiento" >
                                                                    </b-form-input>
                                                                 </b-form-group>
                                                                    
                                                                               
                                                          </b-col>
                                                          <b-col>
                                                            <b-form-group id="input-group-1" label="Direccion :" label-for="direccion" >
                                                                    <b-form-input id="direccion" v-model="personaEst.direccion" type="text" placeholder="Ingresar la direccion" >
                                                                    </b-form-input>
                                                                 </b-form-group>

                                                                 <b-form-group id="input-group-1" label="Telefono :" label-for="telefono" >
                                                                    <b-form-input id="telefono" v-model="personaEst.telefono" type="text" placeholder="Ingresar el telefono" >
                                                                    </b-form-input>
                                                                 </b-form-group>
                                                                 
                                                          </b-col>
                                                        </b-row>

                                                </b-container>

                                                <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
                                                          <b-col>

                                                           <b-form-group id="input-group-1" label="Email :" label-for="email" >
                                                              <b-form-input id="email" v-model="personaEst.email" type="email" placeholder="Ingresar el email" >
                                                              </b-form-input>
                                                           </b-form-group>

                                                            </b-col>
                                                </b-row>

                                                <b-row cols="1" cols-sm="1" cols-md="3" cols-lg="3">
                                                  <b-col>

                                                    <b-form-group id="input-group-1" label="Seleccionar el Departamento:" label-for="departamento_id">
                                                            <b-form-select v-model="personaEst.departamento_id"  class="mb-3" name="departamento" @change='getProvinciaEst()' >
                                                                
                                                                  <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                                
                                                                <b-form-select-option :value="departamento.id" v-for="(departamento, i) in departamentosEst" :key="i" v-if="departamentosEst.length">{{departamento.nameDepartamento}}</b-form-select-option>
                                                                
                                                              </b-form-select>
                                                          </b-form-group>



                                                    </b-col>
                                                    <b-col>

                                                          <b-form-group id="input-group-1" label="Seleccionar Provincia:" label-for="provincia_id">
                                                            <b-form-select v-model="personaEst.provincia_id" class="mb-3" name="provincia" @change='getDistritoEst()' >
                                                                
                                                                  <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                                
                                                                <b-form-select-option :value="provinciaEst.id" v-for="(provinciaEst, i) in provinciasEst" :key="i" v-if="provinciasEst.length">{{provinciaEst.nameProvincia}}</b-form-select-option>
                                                                
                                                              </b-form-select>
                                                          </b-form-group>


                                                    </b-col>
                                                    <b-col>

                                                          <b-form-group id="input-group-1" label="Seleccionar Distrito:" label-for="distrito_id">
                                                            <b-form-select v-model="personaEst.distrito_id"  class="mb-3" name="distrito">
                                                                
                                                                  <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                                
                                                                <b-form-select-option :value="distritoEst.id" v-for="(distritoEst, i) in distritosEst" :key="i" v-if="distritosEst.length">{{distritoEst.nameDistrito}}</b-form-select-option>
                                                                
                                                              </b-form-select>
                                                          </b-form-group>

                                                    </b-col>
                                                </b-row>
 
                                                  <br>
                                                  
                                            </form>
                                        
                                        </b-tab>

                                        <b-tab title="Registrar datos de estudio">
                                                <form v-on:submit.prevent="addEstudianteCol">


	                                            	<b-container class="bv-example-row">

	                                                	<b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
	                                                  <b-col>
	                                                       
	                                                    <b-form-group  id="input-group-1" label="Año de egreso :" label-for="añoEgreso" >
	                                                            <b-form-input id="añoEgreso" v-model="estudiante.añoEgreso" type="text" placeholder="Ingresar el año de egreso">
	                                                            </b-form-input>
	                                                         </b-form-group>

	                                                         
	                                                     
	                                                  </b-col>
	                                                  <b-col>

          <b-form-group id="input-group-1" label="Seleccionar el Departamento:" label-for="departamento_id">
                  <b-form-select v-model="colegio.departamento_id"  class="mb-3" name="departamento" @change='getProvinciaCol()' >
                      
                        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                      
                      <b-form-select-option :value="departamento.id" v-for="(departamento, i) in departamentos" :key="i" v-if="departamentos.length">{{departamento.nameDepartamento}}</b-form-select-option>
                      
                    </b-form-select>
                </b-form-group>

	                                                    </b-col>
	                                                	</b-row>

                                                    </b-container>

                                                    <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                                      
                                                        <b-col>

                                                              <b-form-group id="input-group-1" label="Seleccionar Provincia:" label-for="provincia_id">
                                                                <b-form-select v-model="colegio.provincia_id" class="mb-3" name="provincia" @change='getDistritoCol()' >
                                                                    
                                                                      <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                                    
                                                                    <b-form-select-option :value="provincia.id" v-for="(provincia, i) in provinciasCol" :key="i" v-if="provinciasCol.length">{{provincia.nameProvincia}}</b-form-select-option>
                                                                    
                                                                  </b-form-select>
                                                              </b-form-group>

                                                        </b-col>
                                                        <b-col>

                                                              <b-form-group id="input-group-1" label="Seleccionar Distrito:" label-for="distrito_id">
                                                                <b-form-select v-model="colegio.distrito_id"  class="mb-3" name="distrito" @change='getColegio()'>
                                                                    
                                                                      <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                                    
                                                                    <b-form-select-option :value="distrito.id" v-for="(distrito, i) in distritosCol" :key="i" v-if="distritosCol.length">{{distrito.nameDistrito}}</b-form-select-option>
                                                                    
                                                                  </b-form-select>
                                                              </b-form-group>

                                                        </b-col>
                                                    </b-row>

                                                    <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
                                                      <b-col>

                                                      <b-form-group id="input-group-1" label="Seleccionar Colegio:" label-for="distrito_id">
                                                          <b-form-select v-model="estudiante.colegio_id"  class="mb-3" name="colegio">
                                                              
                                                                <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                              
                                                              <b-form-select-option :value="colegio.id" v-for="(colegio, i) in colegios" :key="i" v-if="colegios.length">{{colegio.nameColegio}}</b-form-select-option>
                                                              
                                                            </b-form-select>
                                                        </b-form-group>

                                                        </b-col>
                                                    </b-row>

                                                      <br>
                                                     
                                                </form>

                                        </b-tab>
                                        <b-tab title="Registrar estudiante">
                                                <form v-on:submit.prevent="addAula">
                                                      
                                                      <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                                          <b-col>

                                                            


                                                            <b-form-group id="input-group-1" label="Seleccionar el Sede:" label-for="sede_id">
                                                                    <b-form-select v-model="data.sede_id"  class="mb-3" name="sede" @change='getAula()' >
                                                                        
                                                                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                                        
                                                                        <b-form-select-option :value="sede.id" v-for="(sede, i) in sedes" :key="i" v-if="sedes.length">{{sede.nameSede}}</b-form-select-option>
                                                                        
                                                                      </b-form-select>
                                                                  </b-form-group>


                                                            <b-form-group id="input-group-1" label="Subir imagen :" label-for="image">
                                                                        <input type="file" v-on:change="attachImage" ref="newDescuentoImage" class="form-control" id="descuento.image" aria-describedby="emailHelp"


                                                                  :headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
                                                                      >
                                                                    
                                                                  </b-form-group>

                                                            </b-col>
                                                            <b-col >
                                                                  
                                                                  <b-img thumbnail rounded fluid src="https://picsum.photos/250/250/?image=54" ref="newDescuentoImageDisplay" alt="Image 1" ></b-img>

                                                            
                                                            
                                                          </b-col>
                                                            
                                                        </b-row>


                                                        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                                          <b-col>

                                                            <b-form-group id="input-group-1" label="Seleccionar el Area:" label-for="area_id">
                                                                    <b-form-select v-model="data.area_id"  class="mb-3" name="area" @change='getAula()' >
                                                                        
                                                                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                                        
                                                                        <b-form-select-option :value="area.id" v-for="(area, i) in areas" :key="i" v-if="areas.length">{{area.nameArea}}</b-form-select-option>
                                                                        
                                                                      </b-form-select>
                                                                  </b-form-group>
                                                            </b-col>
                                                            
                                                            <b-col>

                                                                  <b-form-group id="input-group-1" label="Seleccionar Turno:" label-for="turno_id">
                                                                    <b-form-select v-model="data.turno_id"  class="mb-3" name="turno" @change='getAula()'>
                                                                        
                                                                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                                        
                                                                        <b-form-select-option :value="turno.id" v-for="(turno, i) in turnos" :key="i" v-if="turnos.length">{{turno.nameTurno}}</b-form-select-option>
                                                                        
                                                                      </b-form-select>
                                                                  </b-form-group>

                                                            </b-col>
                                                        </b-row>

                                                        <b-form-group id="input-group-1" label="Seleccionar Aula:" label-for="aula_id">
                                                                  <p v-model="data.aula" :value="aula.id" v-for="(aula, i) in aulasreg" :key="i" v-if="aulasreg.length" >
                                                                  
                                                                <b-alert variant="success" show  >{{aula.nameAula}}</b-alert>
                                                                
                                                            </p>
                                                            
                                                            <b-alert v-model="showDismissibleAlert" variant="danger" v-if="!aulasreg.length" >Cupos agotado !</b-alert>
                                                            

                                                        	<b-form-select v-model="estudiante.aula_id"  class="mb-3" name="aula_id">
                                                            
                                                              <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                                            
                                                            <b-form-select-option :value="aula.id" v-for="(aula, i) in aulasreg" :key="i" v-if="aulasreg.length">{{aula.nameAula}}</b-form-select-option>
                                                            
                                                        	</b-form-select>
                                                        </b-form-group>

                                                      
                                                      <br>
                                                      
                                                </form>

                                        </b-tab>

                                        <b-tab title="Registrar pago">
                                          
                          								<form v-on:submit.prevent="addPago">

                          								      <b-container class="bv-example-row">
                          								        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                          								          <b-col>
                          								            <b-form-group  id="input-group-1" label="DNI registrado en el boucher :" label-for="dni">
                          								                    <b-form-input id="dni" v-model="pago.dni" type="text" placeholder="Ingresar los nombres" >
                          								                    </b-form-input>
                          								                 </b-form-group>

                          								            <b-form-group id="input-group-1" label="Serie del boucher :" label-for="serie" >
                          								                  <b-form-input id="serie" v-model="pago.serie" type="text" placeholder="Ingresar la serie" >
                          								                  </b-form-input>
                          								            </b-form-group>
                          								                                           
                          								          </b-col>
                          								          <b-col>
                          								            
                          								                 <b-form-group  id="input-group-1" label="Fecha del boucher :" label-for="fecha" >
                          								                    <b-form-input id="fecha" v-model="pago.fecha" type="date" placeholder="Ingresar la fecha" >
                          								                    </b-form-input>
                          								                 </b-form-group>

                          								                 <b-form-group  id="input-group-1" label="Monto del boucher :" label-for="importe" >
                          								                    <b-form-input id="importe" v-model="pago.importe" type="text" placeholder="Ejemplo - 250.60" >
                          								                    </b-form-input>
                          								                 </b-form-group>


                          								                 
                          								          </b-col>
                          								        </b-row>

                          								        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                          								          <b-col>
                          								            <b-form-group id="input-group-1" label="Seleccionar el tipo del pago :" label-for="tipoPago_id">
                          								                    <b-form-select v-model="pago.tipoPago_id"  class="mb-3" name="tipoPago_id" >
                          								                        
                          								                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                          								                        
                          								                        <b-form-select-option :value="tipoPago.id" v-for="(tipoPago, i) in tipoPagos" :key="i" v-if="tipoPagos.length">{{tipoPago.nameTipoPago}}</b-form-select-option>
                          								                        
                          								                      </b-form-select>
                          								                  </b-form-group>



                          								               
                          								                               
                          								          </b-col>
                          								          <b-col>
                          								            <b-form-group id="input-group-1" label="Seleccionar el tipo de descuento :" label-for="tipoDescuento_id">
                          								                    <b-form-select v-model="descuento.tipoDescuento_id"  class="mb-3" name="tipoDescuento_id" @change='getDescuento()' >
                          								                        
                          								                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                          								                        
                          								                        <b-form-select-option :value="tipoDescuento.id" v-for="(tipoDescuento, i) in tipoDescuentos" :key="i" v-if="tipoDescuentos.length">{{tipoDescuento.nameTipoDescuento}}</b-form-select-option>
                          								                        
                          								                      </b-form-select>
                          								                  </b-form-group>



                          								               
                          								                               
                          								          </b-col>
                          								         
                          								        </b-row>
                          								        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2" v-if="descripcionDescuentoN">
                          								          
                          								          <b-col>
                          								                  
                          								            <b-form-group  id="input-group-1" label="Ingresar dni del hermano matriculad :" label-for="referencia">
                          								                    <b-form-input id="referencia" v-model="descuento.referencia" type="text" placeholder="Ingresar codigo de matricula"  v-on:keyup="getEstudianteID" maxlength="8" >
                          								                    </b-form-input>
                          								            </b-form-group>
                          								                 
                          								            <b-form-group  id="input-group-1" label="Dato del herma@:" label-for="referencia" v-if="ReferenciaDNI" >
                          								                   

                          								                     <b-form-input v-model="estudianteID.id"  id="input-valid" :state="true" v-for="(estudianteID, i) in estudiantesID" :key="i" v-if="estudiantesID.length" >{{estudianteID.id}}</b-form-input>

                          								                    
                          								                    <b-alert variant="success"  v-for="(estudianteID, i) in estudiantesID" :key="i" v-if="estudiantesID.length"  show>{{estudianteID.nombre}}</b-alert>

                          								                    <b-alert variant="danger"   v-if="!estudiantesID.length"  show>El estudiante no existe / no esta matriculado</b-alert>

                          								            </b-form-group>

                          								            

                          								            
                          								                             
                          								          </b-col>
                          								          <b-col>
                          								        		<b-form-group id="input-group-1" label="Subir archivo :" label-for="archivo" >
                          								              
                          								              
                          								                	<b-form-file
                          								                    v-model="descuento.archivo"
                          								                    ref="file-input"
                          								                    placeholder="Choose a file or drop it here..."
                          								                    drop-placeholder="Drop file here..."
                          								                    :headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
                          								                  ></b-form-file>

                          								        		</b-form-group>
                          								                               
                          								            </b-col>
                          								            
                          								        </b-row>

                          								        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2" v-if="descripcionDescuentoT">

                          								        	<b-col>
                          								      
                          								            	<b-form-group  id="input-group-1" label="Ingresar numero de Resolucion:" label-for="referencia">
                          								                    <b-form-input id="referencia" v-model="descuento.referencia" type="text" placeholder="Ingresar codigo de matricula" >
                          								                    </b-form-input>
                          								                 </b-form-group>
                          								                  
                          								            </b-col>
                          								            <b-col>
                          								        		<b-form-group id="input-group-1" label="Subir archivo :" label-for="archivo" >
                          								              
                          								              
                          								                	<b-form-file
                          								                    v-model="descuento.archivo"
                          								                    ref="file-input"
                          								                    placeholder="Choose a file or drop it here..."
                          								                    drop-placeholder="Drop file here..."
                          								                    :headers="{'x-csrf-token' : token, 'x-Requested-with' : 'XMLHttpRequest'}"
                          								                  ></b-form-file>

                          								        		</b-form-group>
                          								                               
                          								            </b-col>

                          								        </b-row>


                          								      </b-container>
                          								      
                          								      <br>
                          								      
                          								</form>


                                        </b-tab>

                                        <b-tab title="Registrar apoderado">
                                          

                          								<form v-on:submit.prevent="addPersonaEstudiante">

                          								      <b-container class="bv-example-row">
                          								        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                          								          <b-col>
                          								            <b-form-group id="input-group-1" label="Dni :" label-for="dni" >
                          								                  <b-form-input id="dni" v-model="personaApo.dni" type="text" placeholder="Ingresar el dni" >
                          								                  </b-form-input>
                          								            </b-form-group>
                          								            <b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat" >
                          								                    <b-form-input id="apellPat" v-model="personaApo.apellPat" type="text" placeholder="Ingresar el Apellido Paterno" >
                          								                    </b-form-input>
                          								                 </b-form-group>
                          								                               
                          								          </b-col>
                          								          <b-col>
                          								            
                          								                 <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat" >
                          								                    <b-form-input id="apellMat" v-model="personaApo.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
                          								                    </b-form-input>
                          								                 </b-form-group>
                          								                 <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre">
                          								                    <b-form-input id="nombre" v-model="personaApo.nombre" type="text" placeholder="Ingresar los nombres" >
                          								                    </b-form-input>
                          								                 </b-form-group>
                          								          </b-col>
                          								        </b-row>

                          								        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                          								          <b-col>
                          								            <b-form-group label="Sexo">
                          								                  <b-form-radio v-model="personaApo.sexo" name="some-radios" value="0">femenino</b-form-radio>
                          								                  <b-form-radio v-model="personaApo.sexo" name="some-radios" value="1">Masculino</b-form-radio>
                          								                </b-form-group>
                          								                <b-form-group id="input-group-1" label="Fecha de Nacimiento :" label-for="fechaNacimiento" >
                          								                    <b-form-input id="fechaNacimiento" v-model="personaApo.fechaNacimiento" type="date" placeholder="Ingresar la fecha de nacimiento" >
                          								                    </b-form-input>
                          								                 </b-form-group>
                          								                               
                          								          </b-col>
                          								          <b-col>
                          								                 <b-form-group id="input-group-1" label="Telefono :" label-for="telefono" >
                          								                    <b-form-input id="telefono" v-model="personaApo.telefono" type="text" placeholder="telefono o Celular" >
                          								                    </b-form-input>
                          								                 </b-form-group>

                          								                 <b-form-group id="input-group-1" label="Tipo de apoderado:" label-for="tipoApoderado_id">
                          								                    <b-form-select v-model="personaApo.tipoApoderado_id"  class="mb-3" name="tipoApoderado_id" >
                          								                        
                          								                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                          								                        
                          								                        <b-form-select-option :value="tipoApoderado.id" v-for="(tipoApoderado, i) in tipoApoderados" :key="i" v-if="tipoApoderados.length">{{tipoApoderado.nameTipoApoderado}}</b-form-select-option>
                          								                        
                          								                      </b-form-select>
                          								                  </b-form-group>


                          								                 
                          								          </b-col>
                          								        </b-row>

                          								      </b-container>


                          								        <b-row cols="1" cols-sm="1" cols-md="3" cols-lg="3">
                          								          <b-col>

                          								            <b-form-group id="input-group-1" label="Seleccionar el Departamento:" label-for="departamento_id">
                          								                    <b-form-select v-model="personaApo.departamento_id"  class="mb-3" name="departamentoApo" @change='getProvinciaApo()' >
                          								                        
                          								                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                          								                        
                          								                        <b-form-select-option :value="departamentoApo.id" v-for="(departamentoApo, i) in departamentosApo" :key="i" v-if="departamentosApo.length">{{departamentoApo.nameDepartamento}}</b-form-select-option>
                          								                        
                          								                      </b-form-select>
                          								                  </b-form-group>



                          								            </b-col>
                          								            <b-col>

                          								                  <b-form-group id="input-group-1" label="Seleccionar Provincia:" label-for="provincia_id">
                          								                    <b-form-select v-model="personaApo.provincia_id" class="mb-3" name="provinciaApo" @change='getDistritoApo()' >
                          								                        
                          								                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                          								                        
                          								                        <b-form-select-option :value="provinciaApo.id" v-for="(provinciaApo, i) in provinciasApo" :key="i" v-if="provinciasApo.length">{{provinciaApo.nameProvincia}}</b-form-select-option>
                          								                        
                          								                      </b-form-select>
                          								                  </b-form-group>


                          								            </b-col>
                          								            <b-col>

                          								                  <b-form-group id="input-group-1" label="Seleccionar Distrito:" label-for="distrito_id">
                          								                    <b-form-select v-model="personaApo.distrito_id"  class="mb-3" name="distritoApo">
                          								                        
                          								                          <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                          								                        
                          								                        <b-form-select-option :value="distritoApo.id" v-for="(distritoApo, i) in distritosApo" :key="i" v-if="distritosApo.length">{{distritoApo.nameDistrito}}</b-form-select-option>
                          								                        
                          								                      </b-form-select>
                          								                  </b-form-group>

                          								            </b-col>
                          								        </b-row>


                          								      
                          								      <br>
                          								      <div class="text-ringth">
                          								            <button type="button" class="btn btn-default" v-on:click="addModal=false">Cancelar</button>
                          								            
                          								            <button class="btn btn-primary"  :disabled="isAdding" :loading="isAdding"><span class="fa fa-check"></span>{{isAdding ? 'Adding..' : 'Add persona'}}</button>
                          								      </div>
                          								</form>

                                        </b-tab>


                                        <b-tab title="Disabled" disabled><p>I'm a disabled tab!</p></b-tab>

                                    </b-tabs>
                                          <div class="text-center mt-3">
                                                
                                                <button type="button" class="btn btn-outline-primary" @click="tabIndex--">Anterior</button>
                                                <button type="button" class="btn btn-outline-primary" @click="tabIndex++">Siguiente</button>
                                            
                                            
                                            <p class="font-weight-bold text-success">Avance : {{ tabIndex }} de 5</p>
                                        
                                          </div>
                                

                                   

                              </b-card>
                              
                          <b-card
                            title="Ficha del Estudiante"
                            img-src="https://picsum.photos/600/300/?image=25"
                            img-alt="Image"
                            img-top
                            tag="article"
                            style="max-width: 20rem;"
                             class="mx-auto text-center"
                            v-show="registroPdf"

                          >
                            <b-card-text>
                              Some quick example text to build on the card title and make up the bulk of the card's content.
                              <br>
                              {{estudianteRegistrado.id}}
                            </b-card-text>

                            <b-button href="#" variant="primary">Go somewhere</b-button>
                          </b-card>


                        </div>
                    
                  </div>

            
</template>

<script>
  export default {
    data() {
      return {
            showDismissibleAlert: false,
            descripcionDescuentoN: false,
            descripcionDescuentoT: false,
            ReferenciaDNI: false,
            registroTab: true,
            registroPdf: false,
            mainProps: { 
                  
                  width: 200, 
                  height: 200, 
                  
            },
            data:{
                  sede_id: '',
                  area_id: '',
                  turno_id: '',
                  aula: '',
                  local_id: '',
                  

            },
            colegio:{
                  departamento_id: '',
                  provincia_id: '',
                  distrito_id: '',
                  colegio_id: '',
                  

            },
            estudiante:{
                  
                  image: '',
                        name: '',
                  añoEgreso: '',
                  aula_id: '',
                  colegio_id: '',
                  
            },
            file: null,

      
            persona : { 
                  dni : '',
                  nombre : '',
                  apellPat : '',
                  apellMat : '',
                  sexo : '',
                  fechaNacimiento : '',
                  direccion : '',
                  telefono : '',
                  email : '',
                  departamento_id : '',
                  provincia_id : '',
                  distrito_id : '',
            },
            personaEst : {
                  dni : '',
                  nombre : '',
                  apellPat : '',
                  apellMat : '',
                  sexo : '',
                  fechaNacimiento : '',
                  direccion : '',
                  telefono : '',
                  email : '',
                  departamento_id : '',
                  provincia_id : '',
                  distrito_id : '',
            },
            personaApo : {
                  dni : '',
                  nombre : '',
                  apellPat : '',
                  apellMat : '',
                  sexo : '',
                  fechaNacimiento : '',
                  direccion : '',
                  telefono : '',
                  email : '',
                  departamento_id : '',
                  provincia_id : '',
                  distrito_id : '',
            },
            provincia: {
                  id: 0,
                  nameProvincia: '',

            },
            distrito: {
                  id: 0,
                  nameDistrito: '',

            },

            provinciaEst: {
                  id: 0,
                  nameProvincia: '',

            },
            distritoEst: {
                  id: 0,
                  nameDistrito: '',

            },

            provinciaApo: {
                  id: 0,
                  nameProvincia: '',

            },
            distritoApo: {
                  id: 0,
                  nameDistrito: '',

            },
            descuento: {
                  archivo:'',
                  image:'',

                        name: '',
                        estidi:'',
                        tipoDescuento_id:'',
                        referencia:'',


            },
            tipoDescuento: {
                  

            },
            estudianteID: {
                  nombre : '',
                 
            },

            provinciasApo: [],
            distritosApo: [],
            provinciasEst: [],
            distritosEst: [],
            provinciasCol: [],
            distritosCol: [],
            colegios: [],
            provincias: [],
            distritos: [],
            tipoPagos: [],
            tipoApoderados: [],
            tipoDescuentos: [],
            local: {
                        id: 0,
                        nameLocal: '',

                  },
                  area: {
                        id: 0,
                        nameArea: '',

                  },

            aulas: [],
            aulasreg: [],
            areas: [],
            
            sedes: [],
            turnos: [],
            estudiantesID: [],

            pago:{
                  dni : '',
                  serie : '',
                  fecha : '',
                  importe : '',
                  tipoPago_id : '',

            },

            tabIndex: 1,
            isAdding : false,
            departamentos: [],
            departamentosEst: [],
            departamentosApo: [],
            estudianteRegistrado: [],
        form: {
          email: '',
          name: '',
          food: null,
          checked: []
        },
        foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
        show: true
      }
    },
    methods: {
      onSubmit(evt) {
        evt.preventDefault()
        alert(JSON.stringify(this.form))
      },
      onReset(evt) {
        evt.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      },

      clearFiles() {
        this.$refs['file-input'].reset()
      },

      async addPersonaEstudiante(){

            if (this.personaEst.dni.trim()=='') return this.$swal('Ingresar el DNI','Datos personales','warning')
            if (this.personaEst.apellPat.trim()=='') return this.$swal('Apellido Paterno Requerido','Datos personales','warning')
            if (this.personaEst.apellMat.trim()=='') return this.$swal('Apellido Materno Requerido','Datos personales','warning')
            if (this.personaEst.nombre.trim()=='') return this.$swal('Ingresar el Nombre','Datos personales','warning')
            if (this.personaEst.sexo.trim()=='') return this.$swal('Seleccione el Sexo','Datos personales','warning')
            if (this.personaEst.direccion.trim()=='') return this.$swal('La direccion es Requerida','Datos personales','warning')
            if (this.personaEst.fechaNacimiento.trim()=='') return this.$swal('Ingresar la Fecha de Nacimiento','Datos personales','warning')
            if (this.personaEst.telefono.trim()=='') return this.$swal('El telefono es Requerido','Datos personales','warning')
            if (this.personaEst.email.trim()=='') return this.$swal('El correo electronico es Requerido','Datos personales','warning')
            if (this.personaEst.departamento_id.length === 0) return this.$swal('El Departamento es requerido','Datos personales','warning')
            if (this.personaEst.provincia_id.length === 0) return this.$swal('Seleccionar una Provincia','Datos personales','warning')
            if (this.personaEst.distrito_id.length === 0) return this.$swal('Seleccione un Distrito','Datos personales','warning')
            
     
 

            if (this.estudiante.añoEgreso.trim()=='') return this.$swal('El año de egreso es Requerido','Registrar datos de estudio','warning')
            if (this.colegio.departamento_id.length === 0) return this.$swal('El Departamento del Colegio es Requerido','Registrar datos de estudio','warning')
            if (this.colegio.provincia_id.length === 0) return this.$swal('La Provincia del Colegio es Requerido','Registrar datos de estudio','warning')
            if (this.colegio.distrito_id.length === 0) return this.$swal('El Distrito del Colegio es Requerido','Registrar datos de estudio','warning')
            if (this.estudiante.colegio_id.length === 0) return this.$swal('El Colegio es Requerido','Registrar datos de estudio','warning')

      
            if (this.data.sede_id.length === 0) return this.$swal('La sede es requerida','Registrar estudiante','warning')
            if (this.descuento.image.length === 0) return this.$swal('La imagen del estudiante es requerida','Registrar estudiante','warning')
            if (this.data.area_id.length === 0) return this.$swal('El area es requerida','Registrar estudiante','warning')
            if (this.data.turno_id.length === 0) return this.$swal('El turno es requerido','Registrar estudiante','warning')
            if (this.estudiante.aula_id.length === 0) return this.$swal('El aula es requerido','Registrar estudiante','warning')



if (this.pago.dni.trim()=='') return this.$swal('El DNI del boucher es requerido','Registrar pagos','warning')
if (this.pago.serie.trim()=='') return this.$swal('La serie del boucher es requerido','Registrar pagos','warning')
if (this.pago.fecha.trim()=='') return this.$swal('La fecha del boucher es requerido','Registrar pagos','warning')
if (this.pago.importe.trim()=='') return this.$swal('El importe del boucher es requerido','Registrar pagos','warning')


if (this.pago.tipoPago_id.length === 0) return this.$swal('Seleccione el tipo del pago','Registrar pagos','warning')
if (this.descuento.tipoDescuento_id.length === 0) return this.$swal('Seleccione el tipo de descuento','Registrar pagos','warning')
if (this.descuento.referencia.trim()=='' && this.descuento.tipoDescuento_id == 2) return this.$swal('Ingresar el codigo de referencia','Registrar pagos','warning')
	

if (this.descuento.archivo.length === 0 && this.descuento.tipoDescuento_id > 1) return this.$swal('Cargar el archivo en .pdf','Registrar pagos','warning')



            const config = {
                    headers: {
                        'content-type': 'multipart/form-data',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    }
                }
         
        const formData = new FormData();
                  //formData.append('photo', this.photo);
                  formData.append('archivo', this.descuento.archivo);
                  formData.append('image', this.descuento.image);
                  formData.append('tipoDescuento_id', this.descuento.tipoDescuento_id);

                  formData.append('personaEst_dni', this.personaEst.dni);
                  formData.append('personaEst_nombre', this.personaEst.nombre);
                  formData.append('personaEst_apellPat', this.personaEst.apellPat);
                  formData.append('personaEst_apellMat', this.personaEst.apellMat);
                  formData.append('personaEst_sexo', this.personaEst.sexo);
                  formData.append('personaEst_fechaNacimiento', this.personaEst.fechaNacimiento);
                  formData.append('personaEst_direccion', this.personaEst.direccion);
                  formData.append('personaEst_telefono', this.personaEst.telefono);
                  formData.append('personaEst_email', this.personaEst.email);
                  formData.append('personaEst_departamento_id', this.personaEst.departamento_id);
                  formData.append('personaEst_provincia_id', this.personaEst.provincia_id);
                  formData.append('personaEst_distrito_id', this.personaEst.distrito_id);

                  formData.append('estudiante_image', this.estudiante.image);
                  formData.append('estudiante_name', this.estudiante.name);
                  formData.append('estudiante_añoEgreso', this.estudiante.añoEgreso);
                  formData.append('estudiante_aula_id', this.estudiante.aula_id);
                  formData.append('estudiante_colegio_id', this.estudiante.colegio_id);

                  formData.append('pago_dni', this.pago.dni);
                  formData.append('pago_serie', this.pago.serie);
                  formData.append('pago_fecha', this.pago.fecha);
                  formData.append('pago_importe', this.pago.importe);
                  formData.append('pago_tipoPago_id', this.pago.tipoPago_id);
                  formData.append('pago_dniserie', this.pago.dni + this.pago.serie);

                  formData.append('personaApo_dni', this.personaApo.dni);
                  formData.append('personaApo_nombre', this.personaApo.nombre);
                  formData.append('personaApo_apellPat', this.personaApo.apellPat);
                  formData.append('personaApo_apellMat', this.personaApo.apellMat);
                  formData.append('personaApo_sexo', this.personaApo.sexo);
                  formData.append('personaApo_fechaNacimiento', this.personaApo.fechaNacimiento);
                  formData.append('personaApo_direccion', this.personaApo.direccion);
                  formData.append('personaApo_telefono', this.personaApo.telefono);
                  formData.append('personaApo_email', this.personaApo.email);
                  formData.append('personaApo_departamento_id', this.personaApo.departamento_id);
                  formData.append('personaApo_provincia_id', this.personaApo.provincia_id);
                  formData.append('personaApo_distrito_id', this.personaApo.distrito_id);
                  formData.append('personaApo_tipoApoderado_id', this.personaApo.tipoApoderado_id);

                  formData.append('hermano_hermano', this.descuento.referencia);
                  

                  if (this.estudiantesID.length!=0) {
                  	formData.append('referencia', this.estudiantesID[0].id);
                  }else{
                  	formData.append('referencia', 'sin referencia');
                  }

                  /*const json = JSON.stringify({
                      personaEst: this.pago.dni.this.pago.serie,
                      estudiante: this.pago.serie
                      
                  });
                  formData.append('pago_dniserie', json);*/


                  /*const json = JSON.stringify({
                      personaEst: this.personaEst,
                      estudiante:this.estudiante,
                      pago:this.pago,
                      personaApo:this.personaApo,
                  });
                  formData.append('registroEstudiante', json);*/

                  

           // const [res, resest] = await Promise.all([
            /*const res = await Promise.all([
                  //this.callApi('post', 'app/estudiante', [this.personaEst, this.colegio]),
                  //this.callApi('post', 'app/estudiante', {personaEst: this.personaEst, estudiante:this.estudiante, pago:this.pago, config},formData),
                  this.callApi('post', 'app/estudiante', formData),
                  //this.callApi('post', 'app/estudiante', formData),
                  //this.callApi('post', 'app/postDescuento', {estidi: this.estidi , descuento:this.descuento}),
                  //this.callApi('post', 'app/postDescuento', formData),
                 // this.callApi('post', 'app/postDescuento', formData, config),
                  
                  

            ])*/
            const res = await this.callApi('post', 'app/estudiante', formData)

                  //const res = await this.callApi('post', 'app/createPersonaEst', this.personaEst)

                  //console.log(res.status);
                  if (res.status===201) {
                  this.$swal('Estudiante registrado Correctamente','Felicitaciones!','success');
                 // console.log('entraste al 201 : ',res.status);
                        //this.tags.unshift(res.data)
                       // this.$swal('Estudiante registrado','Correctamente','success');
                      //  this.addModal = false
                      	this.estudianteRegistrado = res.data
                      	this.registroTab = false
            			this.registroPdf = true
            			console.log('datos del estudiante registrado : ',this.estudianteRegistrado)
                        //this.data.formData = ''

                  } else {
                  	if (res.status==422) {
                            for(let i in res.data.errors){
								this.$swal({
									toast: true,
								  position: 'top-end',
								  icon: 'error',
								  title: res.data.errors[i][0],
								  showConfirmButton: false,
								  timer: 9000
								});

								this.flashMessage.error({
								message: res.data.errors[i][0],
								time: 5000
							});
							}
                        } else {
                               this.$swal('Ocurrio algun problema ','Intentelo nuevamente!!','warning')
                        }
                    }
                  
            },

            



      //async getProvincia(){
      getProvinciaApo: function() {

            
            axios.get('app/getProvincia',{
             params: {
               departamento_id: this.personaApo.departamento_id,
               
             }
          }).then(function(response){
                this.provinciasApo = response.data;
            }.bind(this));
           

        },

        getDistritoApo: function() {
            
            axios.get('app/getDistrito',{
             params: {
               provincia_id: this.personaApo.provincia_id
             }
          }).then(function(response){
                this.distritosApo = response.data;
            }.bind(this));

        },
      getProvinciaEst: function() {

            
            axios.get('app/getProvincia',{
             params: {
               departamento_id: this.personaEst.departamento_id,
               
             }
          }).then(function(response){
                this.provinciasEst = response.data;
            }.bind(this));
           

        },

        getDistritoEst: function() {
            
            axios.get('app/getDistrito',{
             params: {
               provincia_id: this.personaEst.provincia_id
             }
          }).then(function(response){
                this.distritosEst = response.data;
            }.bind(this));

        },

        getProvinciaCol: function() {

            axios.get('app/getProvincia',{
             params: {
               departamento_id: this.colegio.departamento_id
             }
          }).then(function(response){
                this.provinciasCol = response.data;
            }.bind(this));

        },

        getDistritoCol: function() {
            
            axios.get('app/getDistrito',{
             params: {
               provincia_id: this.colegio.provincia_id
             }
          }).then(function(response){
                this.distritosCol = response.data;
            }.bind(this));

        },

        getColegio: function() {
            
            axios.get('app/getColegio',{
             params: {
               distrito_id: this.colegio.distrito_id,
              // area_id: this.data.area_id,
              // turno_id: this.data.turno_id
              
             }
          }).then(function(response){
                
                        this.colegios = response.data;
               
              
                
            }.bind(this));

        },


        getProvincia: function() {

            axios.get('app/getProvincia',{
             params: {
               departamento_id: this.persona.departamento_id
             }
          }).then(function(response){
                this.provincias = response.data;
            }.bind(this));

        },

        getDistrito: function() {
            
            axios.get('app/getDistrito',{
             params: {
               provincia_id: this.persona.provincia_id
             }
          }).then(function(response){
                this.distritos = response.data;
            }.bind(this));

        },


        getAula: function() {
            
            axios.get('app/getAula',{
             params: {
               sede_id: this.data.sede_id,
               area_id: this.data.area_id,
               turno_id: this.data.turno_id
             }
          }).then(function(response){
                this.aulasreg = response.data;
                //console.log(response.data.[0].id)
                        //console.log(this.data.turno_id)
                        
                if (response.data.length && this.aulasreg[0].length!=0) {
                        //console.log('si array',this.aulasreg[0])
                        //console.log('no array',this.aulasreg[0].id)
                        

                this.showDismissibleAlert=true

                }

            }.bind(this));

        },

        getDescuento: function() {
            
            axios.get('app/getDescuento',{
             params: {
               tipoDescuento_id: this.descuento.tipoDescuento_id,
               
             }
          }).then(function(response){
                this.tipoDescuentoReg = response.data;
                console.log(this.descuento.tipoDescuento_id)
                        //console.log(this.data.turno_id)
                        
                if (this.descuento.tipoDescuento_id == 2) {
                        //console.log('si array',this.aulasreg[0])
                        //console.log('no array',this.aulasreg[0].id)
                        //console.log(this.descuento.tipoDescuento_id)

                this.descripcionDescuentoN=true
                this.descripcionDescuentoT=false
                console.log('cantidad de referecia :', this.descuento.referencia.length)
                     

                }else if(this.descuento.tipoDescuento_id > 2){
                  this.descripcionDescuentoN=false
                  this.descripcionDescuentoT=true
                }else{
                  this.descripcionDescuentoN=false
                  this.descripcionDescuentoT=false
                }

            }.bind(this));

        },

        getEstudianteID: function () {
            if (this.descuento.referencia.length == 8){
                  
                  axios.get('app/getEstudianteID',{
                   params: {
                     referencia: this.descuento.referencia,
                     
                   }
                }).then(function(response){
                      this.estudiantesID = response.data;
                      //console.log('id del estudiante', this.estudiantesID[0].id)

                  }.bind(this));
                this.ReferenciaDNI=true
          
            }else{
                  this.ReferenciaDNI=false
            }
          
        },


        getEstudianteIDsd: function() {
            
            axios.get('app/getEstudianteID',{
             params: {
               referencia: this.descuento.referencia,

               
             }
          }).then(function(response){
                this.tipoDescuentoReg = response.data;
                console.log(this.descuento.referencia)
                        //console.log(this.data.turno_id)
                        
                if (this.descuento.tipoDescuento_id > 1) {
                        //console.log('si array',this.aulasreg[0])
                        //console.log('no array',this.aulasreg[0].id)
                        console.log(this.descuento.tipoDescuento_id)

                this.descripcionDescuento=true

                }else{
                  this.descripcionDescuento=false
                }

            }.bind(this));

        },

        attachImage(){
                        this.descuento.image = this.$refs.newDescuentoImage.files[0];
                        let reader = new FileReader();
                        reader.addEventListener('load', function(){
                              this.$refs.newDescuentoImageDisplay.src = reader.result;
                        }.bind(this), false);
                        reader.readAsDataURL(this.descuento.image);
                  },




    },

    async created(){
                  try   {
                        const [res, resDep, resAul, resSed, resAre, resTur, resTip, restpA, restpD] = await Promise.all([
                              this.callApi('get', 'app/persona'),
                              this.callApi('get', 'app/getDepartamento'),

                              this.callApi('get', 'app/getAula'),
                              this.callApi('get', 'app/getSede'),
                              this.callApi('get', 'app/getArea'),
                              this.callApi('get', 'app/getTurno'),
                              this.callApi('get', 'app/getTipoPago'),
                              this.callApi('get', 'app/getTipoApoderado'),
                              this.callApi('get', 'app/getTipoDescuento'),

                        ])
                  
                        this.personas = res.data
                        this.departamentos = resDep.data
                        this.departamentosEst = resDep.data
                        this.departamentosApo = resDep.data

                        this.aulas = resAul.data.aula
                        this.sedes = resSed.data
                        this.areas = resAre.data
                        this.turnos = resTur.data
                        this.tipoPagos = resTip.data
                        this.tipoApoderados = restpA.data
                        this.tipoDescuentos = restpD.data

                        


                  //    console.log('esto esd:',this.departamentos)
                  //    console.log('esto esd2:',this.departamentosEst)
                        //console.log('esto es:',this.personas)
                        //console.log('esto es:',this.departamentos)

                  } catch {
                        this.$swal('Any fool can use a computer','de','error')
                  }

                  

                  
                  
            },

            

  }
</script>
