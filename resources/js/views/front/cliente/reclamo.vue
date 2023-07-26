<template>

    <div class="tara">
          <b-card>
            

            <template #header>
        <h3 class="mb-0">Registrar Reclamo</h3>
      </template>

      <b-tabs
      v-model="tabIndex"
        active-nav-item-class="font-weight-bold text-uppercase text-danger"
        active-tab-class="font-weight-bold text-success"
        content-class="mt-3"
        vertical
      >
           <form v-on:submit.prevent="addReclamo">
                <b-tab  active>
                    

                    
                    <b-card title="Datos del Solicitante">

                        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                          <b-col>
                            
                            <b-form-group id="input-group-1" label="Dni : *" label-for="dni" >
                                <b-form-input id="dni" v-model="dataReg.dni" type="text" placeholder="Ingresar el dni" maxlength="8"  :state="dataRegDni" trim>
                                </b-form-input>
                                    <b-form-invalid-feedback id="input-live-feedback" v-if="dataRegdni" >
                                      Ingresar 8 digitos
                                    </b-form-invalid-feedback>
                            </b-form-group>

                            <b-form-group  id="input-group-1" label="Apellido paterno :" label-for="apellPat" >
                                <b-form-input id="apellPat" v-model="dataReg.apellPat" type="text" placeholder="Ingresar el Apellido Paterno"  >
                                </b-form-input>
                            </b-form-group>
                                               
                          </b-col>
                          <b-col>
                            
                                 <b-form-group  id="input-group-1" label="Apellido Materno :" label-for="apellMat" >
                                    <b-form-input id="apellMat" v-model="dataReg.apellMat" type="text" placeholder="Ingresar el Apellido Materno" >
                                    </b-form-input>
                                 </b-form-group>
                                 <b-form-group  id="input-group-1" label="Nombres :" label-for="nombre">
                                    <b-form-input id="nombre" v-model="dataReg.nombre" type="text" placeholder="Ingresar los nombres" >
                                    </b-form-input>
                                 </b-form-group>
                          </b-col>
                        </b-row>

                        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                         
                          <b-col>
                            <b-form-group id="input-group-1" label="Direccion :" label-for="direccion" >
                                    <b-form-input id="direccion" v-model="dataReg.direccion" type="text" placeholder="Ingresar la direccion" >
                                    </b-form-input>
                                 </b-form-group>

                                 <b-form-group id="input-group-1" label="Telefono :" label-for="telefono" >
                                    <b-form-input id="telefono" v-model="dataReg.telefono" type="text" placeholder="Ingresar el telefono" >
                                    </b-form-input>
                                 </b-form-group>
                                 
                          </b-col>
                          <b-col>
                            

                            <b-form-group id="input-group-1" label="Relacion:" label-for="id">
                                <b-form-select v-model="dataReg.idRelacion"  class="mb-3" name="idRelacion"  >
                                  
                                    <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                  
                                  <b-form-select-option :value="relacion.id" v-for="(relacion, i) in relacions" :key="i" v-if="relacions.length">{{relacion.nombre}}</b-form-select-option>
                                  
                                </b-form-select>


                            </b-form-group>

                            <b-form-group id="input-group-1" label="Email : *" label-for="email" >
                                  <b-form-input id="email" v-model="dataReg.email" type="email" placeholder="Ingresar el email"   :state="dataRegEmail" trim>
                                  </b-form-input>

                                        <b-form-invalid-feedback id="input-live-feedback" v-if="dataRegemail" >
                                        ejemplo - prueba@correo.com
                                        </b-form-invalid-feedback>
                               </b-form-group>


                          </b-col>
                        </b-row>

                       

                        <div role="group">
   
 
  </div>
                

                    </b-card>

                </b-tab>
                <b-tab  ><p>
                    
                    <b-card title="Registra tu Reclamo">

                        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                          <b-col>
                            <b-form-group id="input-group-1" label="Suministro :" label-for="suministro" >
                                  
                                  <b-form-input id="suministro" v-model="dataReg.suministro" type="number" placeholder="Ingresar el suministro" maxlength="11" v-on:keyup="getSuministro" >
                                                </b-form-input>
                            </b-form-group>
                            

                               
  <div>
  
    <b-collapse id="collapse-4" v-model="visible" class="mt-2">

      
    <div class="bg-light ">
      
<div class="bd-example vue-example vue-example-b-aspect">
                                

                               
                                    <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                            <b-col>
                                                <b-form-group id="input-group-1" label="Verificar si existe un registro de este dia :" label-for="dni" >
                                                
                                                </b-form-group>
                                                
                                         </b-col>
                                           
                                        </b-row>

                                    <b-container class="bv-example-row">

                                            <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                              <b-col>
                                                <b-form-group id="input-group-1" label="CodigoSuministro :" label-for="CodigoSuministro" >
                                                      <b-form-input id="CodigoSuministro" v-model="sumin.CodigoSuministro" type="text" placeholder="Ingresar el CodigoSuministro" disabled>
                                                      </b-form-input>
                                                </b-form-group>
                                                <b-form-group  id="input-group-1" label="CodigoRutaSuministro :" label-for="CodigoRutaSuministro" >
                                                        <b-form-input id="CodigoRutaSuministro" v-model="sumin.CodigoRutaSuministro" type="text" placeholder="Ingresar CodigoRutaSuministroPaterno" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                                   
                                              </b-col>
                                              <b-col>
                                                    <b-form-group  id="input-group-1" label="Documento :" label-for="Documento">
                                                        <b-form-input id="Documento" v-model="sumin.Documento" type="text" placeholder="Ingresar los Documento" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     <b-form-group id="input-group-1" label="Direccion :" label-for="direccion" >
                                                        <b-form-input id="direccion" v-model="sumin.DireccionPredio" type="text" placeholder="Ingresar la direccion" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     
                                              </b-col>
                                            </b-row>

                                            <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                              <b-col>
                                                
                                                    <b-form-group  id="input-group-1" label="Nombre del Titular :" label-for="NombreSuministro" >
                                                        <b-form-input id="NombreSuministro" v-model="sumin.NombreSuministro" type="text" placeholder="Ingresar el NombreSuministro" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                                  
                                              </b-col>
                                              <b-col>
                                                
                                                    <b-form-group  id="input-group-1" label="Telefono :" label-for="telefono" >
                                                        <b-form-input id="telefono" v-model="sumin.Telefono" type="text" placeholder="Sin telefono" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     
                                              </b-col>
                                            </b-row>

                                    </b-container>

                                    

                                    <b-row cols="1" cols-sm="1" cols-md="3" cols-lg="3">
                                      <b-col>

                                              <b-form-group  id="input-group-1" label="Departamento :" label-for="departamento" >
                                                        <b-form-input id="departamento" v-model="sumin.NombreDepartamento" type="text" placeholder="Ingresar el NombreDepartamento" disabled>
                                                        </b-form-input>
                                                     </b-form-group>




                                        </b-col>
                                        <b-col>

                                             

                                              <b-form-group  id="input-group-1" label="NombreProvincia :" label-for="NombreProvincia" >
                                                        <b-form-input id="NombreProvincia" v-model="sumin.NombreProvincia" type="text" placeholder="Ingresar el NombreProvincia" disabled>
                                                        </b-form-input>
                                                     </b-form-group>


                                        </b-col>
                                       

                                         <b-col>
                                                
                                                     <b-form-group  id="input-group-1" label="NombreDistrito :" label-for="NombreDistrito" >
                                                        <b-form-input id="NombreDistrito" v-model="sumin.NombreDistrito" type="text" placeholder="Ingresar el ANombreDistrito" disabled>
                                                        </b-form-input>
                                                     </b-form-group>
                                                     
                                              </b-col>

                                    </b-row>

                                      <br>
                                                  
                                
                            
                            </div> 
    </div>
  

    </b-collapse>
  </div>






















                          </b-col>
                          <b-col>

                            <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
                                <b-col>
                                    <b-form-group  id="input-group-1" label="Notificacion via correo :" label-for="correo" >
                                        <b-form-checkbox v-model="dataReg.correo" switch size="sm"></b-form-checkbox>
                                    </b-form-group>
                                    
                                </b-col>
                                <b-col>
                                    <b-form-group id="input-group-1" label="El reporte es para:" label-for="dataRegTipoRegistro">
                                    
                                    <b-form-select v-model="dataRegTipoRegistro" :options="tipoRegistros" @change='getTipoRegistro()' >
                                       <template #first>
                                        <b-form-select-option :value="null" disabled>Seleccione el tipo de fallo</b-form-select-option>
                                      </template>
                                        
                                    </b-form-select>

                                </b-form-group>

                                    
                               </b-col>

                            </b-row>

                            
                            
                                

                               
                                

                                
                                <b-collapse id="collapse-4"  v-model="tipoRegistroBuscar" class="mt-2">
                                    <b-form-group id="input-group-1" label="Relacion:" label-for="id" >
                                        <b-form-select v-model="dataReg.tipoExtraordinario_id"  class="mb-3" name="tipoExtraordinario" @change='getObsTipoExtraordinario()' >
                                          
                                            <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                          
                                            <b-form-select-option :value="tipoExtraordinario.id" v-for="(tipoExtraordinario, i) in tipoExtraordinarios" :key="i" v-if="tipoExtraordinarios.length">{{tipoExtraordinario.nombreTipoExt}}</b-form-select-option>
                                          
                                        </b-form-select>
                                    </b-form-group>

                                </b-collapse>


                                <b-collapse id="collapse-4"   v-model="obsTipoRegistroBuscar" class="mt-2">
                                    <b-form-group id="input-group-1" label="Seleccionar Descripcion del Registro:" label-for="obsTipoExtraordinario_id" >
                                    <b-form-select v-model="dataReg.obsTipoExtraordinario_id" class="mb-3" name="obsTipoExtraordinario"  >
                                      
                                        <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                                      
                                     
                                      
                                        <b-form-select-option :value="obsTipoExtraordinario.id" v-for="(obsTipoExtraordinario, i) in obsTipoExtraordinarios" :key="i" v-if="obsTipoExtraordinarios.length">{{obsTipoExtraordinario.nombreObsTipoExt}}</b-form-select-option>
                                    </b-form-select>


                                </b-form-group>

                                </b-collapse>

                                

                                 <b-form-group  id="input-group-1" label="Solicitud :" label-for="solicitud">
                                    

                                    <b-form-textarea
                                        id="solicitud"
                                        v-model="dataReg.solicitud"
                                        placeholder="Consignar solicitud"
                                        rows="7"
                                      ></b-form-textarea>
                                 </b-form-group>
                          </b-col>
                        </b-row>

                       


                    </b-card>

                </p></b-tab>

                <div class="text-center mt-3" >
                                                   
                    <button type="button" class="btn btn-outline-primary" @click="tabIndex--" v-if="tabIndex >= 1" >Anterior</button>
                    <button type="button" class="btn btn-outline-primary" @click="tabIndex++" v-if="tabIndex < 1" >Siguiente</button>
                    
                    <button class="btn btn-outline-success"  v-if="RegistrarExtr && tabIndex==1"><span class="fa fa-check"></span>Registrar</button>
            
                </div>   
            </form>
      </b-tabs>
    </b-card>  
    </div>  
        

            
</template>

<script>
  export default {
    data() {
      return {
           
        tabIndex: 1,
        name:'',
        direc:'',
        restriccion: true,
        restriccionc: true,
        dataRegdni: true,
        dataRegemail: true,
        visible: false,
        tipoRegistroBuscar: false,
        obsTipoRegistroBuscar: false,
        relacions:[],
        tipoExtraordinarios:[],
        obsTipoExtraordinarios:[],
        RegistrarExtr: true,


        tipoRegistros: [
         
          { text: 'Vivienda', value: '2' },
          { text: 'Vecinos', value: '3' },
        ],
        
        dataReg:{
            dni: '',
            email: '',

        },
        dataRegTipoRegistro: null,
        
        sumin:{},

      }
    },

    


    methods: {

        addReclamo(){
            console.log('enviar registros')
        },


        getSuministro() {
            if (this.dataReg.suministro.length == 11){

                // axios.get('/front/app/getSuministro',{
                 axios.get('app/getSuministro',{
                     params: {
                       suministroID: this.dataReg.suministro

                     }
                  }).then(function(response){

                     
                        this.visible= true
                        this.sumin = response.data;

                    }.bind(this));

                  
                 
               // this.ReferenciaDNI=true
                this.formPersona=true
          
            }
            else{
                //this.formPersona=false
                this.formPersona=false
                this.visible= false
                 // this.ReferenciaDNI=false
            }
          
        },

        getTipoRegistro() {
            
            axios.get('app/getTipoRegistro',{
             params: {
               tipoRegistro: this.dataRegTipoRegistro

             }
          }).then(function(response){
            if (response.status==200) {
                console.log('dentro de 1')
                this.tipoExtraordinarios = response.data;
                this.tipoRegistroBuscar= true
                this.obsTipoRegistroBuscar= false
                this.dataReg.tipoExtraordinario_id=''
                this.dataReg.obsTipoExtraordinario_id=''

            }else{
                this.tipoRegistroBuscar= false
                this.obsTipoRegistroBuscar= false
                this.dataReg.tipoExtraordinario_id=''
                this.dataReg.obsTipoExtraordinario_id=''
                }
                

            }.bind(this));

        },

        getObsTipoExtraordinario() {
            
            axios.get('app/getObsTipoExtraordinario',{
             params: {
               tipoExtraordinario_id: this.dataReg.tipoExtraordinario_id

             }
          }).then(function(response){
            if (response.status==200 && this.dataReg.tipoExtraordinario_id.length!=0) {
                console.log('dentro de 2')
                this.obsTipoExtraordinarios = response.data;
                this.obsTipoRegistroBuscar= true
                this.dataReg.obsTipoExtraordinario_id=''
            }else{
                this.obsTipoRegistroBuscar= false
                this.dataReg.obsTipoExtraordinario_id=''
            }
                
            }.bind(this));

        },


       


    },
    computed: {
      dataRegDni() {
         if (this.dataReg.dni.length == 8) {
            return (this.dataRegdni=false, true)
         } else{
            return (this.dataRegdni=true, false)
         }
      },

      dataRegEmail() {
        var asd = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

         
         if (asd.test(this.dataReg.email)) {
            return (this.dataRegemail=false, true)
         } else{
            return (this.dataRegemail=true, false)
         }
      },

      nameState() {
        
       // return this.name.length > 2 ? true : false

        // this.restriccion=false

         if (this.name.length > 2 && this.name.length < 5) {
            return (this.restriccion=false, true)
            
         } else{
            return (this.restriccion=true, false)
         }


        //this.restriccion = false
      },
      direcState() {
        
       // return this.name.length > 2 ? true : false

        // this.restriccion=false

         

         if (this.direc.length > 2 && this.direc.length < 5) {
            return (this.restriccionc=false, true)
            
         } else{
            return (this.restriccionc=true, false)
         }
        //this.restriccion = false
      },
    },

    async created(){
        try {
            //this.getResults();
            //console.log(this.isWritePermitted)
            //console.log('esto es el permiso')
            

            //const [res, resTipoExtraordinario] = await Promise.all([
            const [ res] = await Promise.all([
                    //this.callApi('get', 'app/suministro'),
                    this.callApi('get', 'app/relacion')
                ])
            

                //this.suministros = res.data
                console.log('datos de la relaciuon', res.data )
                this.relacions = res.data
                //console.log('los datos del suministro son',resTipoExtraordinario.data)
                //console.log('los datos del suministro son',this.tipoExtraordinarios)

                //console.log('es el usuario',this.users)
                //console.log('es el usuario logueado ',this.userLogged['permissions'])

            } catch {
                this.$swal('Algo salio mal','intente nuevamente','error')
            }
                  

                  
                  
            },

    
   

    

            

  }
</script>
