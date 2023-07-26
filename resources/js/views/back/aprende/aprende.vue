<template>
<base-layout>
<Breadcrumbs>
   <template v-slot:titulo_breadcrumbs> Aprender
   </template>
   
   <template v-slot:prueba>
       <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li><a href="#">Aprender</a></li>
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
               Administrar Registros
         </span>
      <button class="btn btn-primary btn-sm ml-auto" @click="addModalEvento=true" v-if="(isWritePermitted) &&  (filtroData.oficina_id !='')" ><span class="fa fa-plus"></span> Crear Evento</button>
       
      </div>
   </div>
      <div class="row">
         <div class="col-md-12  ml-auto mr-auto">
            <div class="card" no-body>
               <div class="card-body">
                  <b-row>
                     <b-col sm="4">
                        
                        <b-card  no-body class="text-center">
                           <b-form-group id="input-group-1" label="Seleccionar Gerencia:" label-for="id">
                              <b-form-select v-model="filtroData.organo_id"  class="mb-3" name="organo_id" @change='getUnidadesOrganicas()' >

                                 <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>

                                 <b-form-select-option :value="organo.id" v-for="(organo, i) in organos" :key="i" v-if="organos.length">{{organo.nombre}}</b-form-select-option>
                              </b-form-select>
                           </b-form-group>
                        </b-card>
                        
                     </b-col>
                     <b-col sm="4">
                        <b-collapse v-model="UnidadOrganica">
                           <b-card no-body class="text-center">
       
                              <b-form-group id="input-group-1" label="Seleccionar Unidad Organica:" label-for="id" >
                                 <b-form-select v-model="filtroData.unidadorganica_id"  class="mb-3" name="unidadorganica_id" @change='getOficinas()' >

                                    <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>

                                    <b-form-select-option :value="unidadOrganica.id" v-for="(unidadOrganica, i) in unidadesOrganicas" :key="i" v-if="unidadesOrganicas.length">{{unidadOrganica.nombre}}</b-form-select-option>
                                 </b-form-select>
                              </b-form-group>
       
                           </b-card>
                        </b-collapse>


                     </b-col>
                     <b-col sm="4">
                        <b-collapse v-model="Oficina">
                           <b-card  no-body class="text-center">
                              <b-form-group id="input-group-1" label="Seleccionar Oficina:" label-for="id" >
                                 <b-form-select v-model="filtroData.oficina_id"  class="mb-3" name="oficina_id" @change='getEvento()' >

                                    <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>

                                    <b-form-select-option :value="oficina.id" v-for="(oficina, i) in oficinas" :key="i" v-if="oficinas.length">{{oficina.nombre}}</b-form-select-option>
                                 </b-form-select>
                              </b-form-group>
                           </b-card>
                        </b-collapse>
                     </b-col>

                  </b-row>

               </div>
            </div>
         </div>

         <div class="col-md-12  ml-auto mr-auto">
            <div class="card">
               <div class="card-body">
                  
                  <div role="tablist">

                     <b-row v-for="(evento, i) in eventos" :key="i" v-if="eventos.length">
                        <b-col>
                          <b-button block  v-b-toggle="'accordion-'+evento.id"  variant="outline-primary">{{evento.nombre}}
                          <b-card-text class="small text-muted" >
                          fecha de publicacion</b-card-text></b-button>
                          
                        </b-col>
                        <b-col sm="8">
                           <b-collapse :id="'accordion-'+evento.id" visible accordion="my-accordion" role="tabpanel">
                         
                              <b-card >

                                 <b-row>
                                    <b-col cols="auto" class="mr-auto p-3">
                                       <strong>{{evento.nombre}}</strong>
                                       
                                    </b-col>
                                    <b-col cols="auto" class="p-3"><button class="btn btn-success btn-sm ml-auto" @click="addModalContenido=true" v-if="(isWritePermitted)" ><span class="fa fa-plus"></span></button>
                                    </b-col>
                                 </b-row>

                                 <b-row>
                                    <b-col cols="auto" class="mr-auto p-3">
                                       <p>
                                          {{evento.descripcion}}
                                       </p>
                                    </b-col>
                                 </b-row>
                                 <div v-for="(contenidoevento, i) in evento.contenido_evento" :key="i" v-if="evento.contenido_evento.length">
                                    
                                       <p v-if="contenidoevento.tipocontenido_id == 9">{{ contenidoevento.contenido }}</p>
                                       <b-card-text v-if="contenidoevento.tipocontenido_id == 8">
                                          <b-iconstack font-scale="1" >
                                             <b-icon stacked icon="plug-fill" variant="info" scale="0.95" ></b-icon>
                                          </b-iconstack>  {{ contenidoevento.contenido }}
                                       </b-card-text>

                                       <b-card-text v-if="contenidoevento.tipocontenido_id == 1">
                                          <b-iconstack font-scale="1" >
                                             <b-icon stacked icon="file-earmark-pdf-fill" variant="danger" scale="0.95" ></b-icon>
                                          </b-iconstack>
                                          <b-link  @click="descargarContenido(contenidoevento)">{{ contenidoevento.contenido }} <small> archivo</small></b-link>

                                       </b-card-text>

                                       <b-card-text v-if="contenidoevento.tipocontenido_id == 2">
                                          <b-iconstack font-scale="1" >
                                             <b-icon stacked icon="file-earmark-word-fill" variant="primary" scale="0.95" ></b-icon>
                                          </b-iconstack>
                                          <b-link  @click="descargarContenido(contenidoevento)">{{ contenidoevento.contenido }} <small> archivo</small></b-link>
                                       </b-card-text>

                                       <b-card-text v-if="contenidoevento.tipocontenido_id == 3">
                                          <b-iconstack font-scale="1" >
                                             <b-icon stacked icon="file-earmark-excel-fill" variant="success" scale="0.95" ></b-icon>
                                          </b-iconstack>
                                          <b-link  @click="descargarContenido(contenidoevento)">{{ contenidoevento.contenido }} <small> archivo</small></b-link>
                                          
                                       </b-card-text>
                                       <b-card-text v-if="contenidoevento.tipocontenido_id == 4">
                                          <b-iconstack font-scale="1" >
                                             <b-icon stacked icon="file-earmark-ppt-fill" variant="warning" scale="0.95" ></b-icon>
                                          </b-iconstack>
                                          <b-link  @click="descargarContenido(contenidoevento)">{{ contenidoevento.contenido }} <small> archivo</small></b-link>
                                       </b-card-text>
                                       <b-card-text v-if="contenidoevento.tipocontenido_id == 5">
                                          <b-iconstack font-scale="1" >
                                             <b-icon stacked icon="file-earmark-text-fill" variant="warning" scale="0.95" ></b-icon>
                                          </b-iconstack>
                                          <b-link  @click="descargarContenido(contenidoevento)">{{ contenidoevento.contenido }} <small> archivo</small></b-link>
                                       </b-card-text>

                                       <b-container v-if="contenidoevento.tipocontenido_id == 6">

                                             <b-img thumbnail fluid src="https://www.adslzone.net/app/uploads-adslzone.net/2019/04/borrar-fondo-imagen.jpg"  alt="Image 1" style="width: 600px;"></b-img>

                                             <b-img thumbnail fluid src="/storage/aprende/imagen/prueba.jpg"  alt="Image 1" style="width: 600px;"></b-img>
                                           
                                       </b-container>

                                       <b-card-text v-if="contenidoevento.tipocontenido_id == 7">Enlace compartido: <a target="_blank"  :href="'/contenido/'+contenidoevento.contenido" class="card-link">{{ contenidoevento.contenido }}</a>

                                       </b-card-text>

                                       <div v-if="contenidoevento.tipocontenido_id == 10">
                                         
                                         <b-embed
                                           type="iframe"
                                           aspect="16by9"
                                           src="/storage/aprende/video/prueba.mp4"
                                           allowfullscreen
                                         ></b-embed>
                                       </div>
                                                                           
                                    
                                 </div>

                                                                  


                                  
                              </b-card>

                           </b-collapse>
                        </b-col>
                     </b-row>

                  </div>



                

               </div>
            </div>
         </div>
      </div>


<b-modal  hide-footer scrollable  v-model="addModalEvento" title="Crear Evento" >

   <form v-on:submit.prevent="regEvento(dataEvento)">
      <b-row cols="1" cols-sm="1" cols-md="1" cols-lg="1">
          <b-col>
            <b-form-group
              id="input-group-1"
              label="Nombre:"
              label-for="input-1"
            >
              <b-form-input
                id="input-1"
                v-model="dataEvento.nombre"
                placeholder="Ingresar el nombre del evento"
                required
              ></b-form-input>
            </b-form-group>
                               
          </b-col>
          <b-col>

            <b-form-group
              id="input-group-1"
              label="Descripcion:"
              label-for="input-1"
            >
              <b-form-textarea
               id="textarea"
               v-model="dataEvento.descripcion"
               placeholder="Ingresar la descripcion del evento."
               rows="3"
               max-rows="6"
             ></b-form-textarea>

            </b-form-group>

            
              
                 
          </b-col>
        </b-row>

      <br>
      <div class="text-center mt-3">
         <button type="button" class="btn btn-outline-danger" v-on:click="addModalEvento=false">Cancelar</button>
         <button class="btn btn-outline-success"> <span class="fa fa-check"></span>Registrar</button>
      </div>
   </form>

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

         UnidadOrganica: false,
         Oficina: false,
         addModalEvento: false,

         
         filtroData:{
            oficina_id: '',
            organo_id: '',
            unidadorganica_id: ''
         },
         dataEvento:{},

         orientaciones: [],
         eventos: [],
         organos: [],
         unidadesOrganicas: [],
         oficinas: [],
         
      }
   },


   methods : {


      descargarContenido(datosDocumento) {

            console.log('dentro de reportePDFRER',datosDocumento.id)
            window.open(`app/descargarContenido/${datosDocumento.id}`);

      },



      getUnidadesOrganicas(){
         console.log('dentro de getUnidadesOrganicas')

         axios.get('app/getUnidadesOrganicas',{
             params: {
               organo_id: this.filtroData.organo_id

             }
          }).then(function(response){
            if (response.status==200 && response.data.length != 0) {
               
                  //this.$swal('Algo salio mal','Verifique los correos','success')
               
                this.unidadesOrganicas = response.data
                this.filtroData.unidadorganica_id = ''
                this.filtroData.oficina_id = ''
                this.eventos = ''

                this.UnidadOrganica = true
                this.Oficina = false
            } else {
                this.filtroData.unidadorganica_id = ''
                this.filtroData.oficina_id = ''
                this.eventos = ''
                this.UnidadOrganica = false
                this.Oficina = false
                  this.$swal('Sin datos','No cuenta con Unidades Organicas','warning')
               }
            
            }.bind(this));


      },

      getOficinas(){
         console.log('dentro de getOficinas')

         axios.get('app/getOficinas',{
             params: {
               unidadorganica_id: this.filtroData.unidadorganica_id

             }
          }).then(function(response){

               if (response.status==200 && response.data.length != 0) {
               
                  //this.$swal('Algo salio mal','Verifique los correos','success')
                this.oficinas = response.data
                this.filtroData.oficina_id = ''
                this.eventos = ''

                this.Oficina = true
               
                
            } else {
                this.filtroData.oficina_id = ''
                this.eventos = ''
                
               this.Oficina = false
               //this.$swal('Sin datos','No cuenta con xxx','warning')
               }

            }.bind(this));


      },

      getEvento(){
         console.log('dentro de getEvento')

         axios.get('app/getEvento',{
             params: {
               oficina_id: this.filtroData.oficina_id

             }
          }).then(function(response){
         console.log('dentro de getEvento__data:',response.data)

                this.eventos = response.data

            }.bind(this));


      },


     async regEvento(getDataEvento){
          console.log('dentro de regEvento', getDataEvento)
         getDataEvento.oficina_id = this.filtroData.oficina_id
         getDataEvento.organo_id = this.filtroData.organo_id
         getDataEvento.unidadorganica_id = this.filtroData.unidadorganica_id

         //const res = await this.callApi('post', 'app/edit_tags', this.editData)
         const res = await this.callApi('post', 'app/regEvento', getDataEvento)
      
         //const res = await this.callApi('put', `app/user/${editData.id}`, this.editData)

         if (res.status==201) {
            console.log('response_____',res.data)
            this.eventos.unshift(res.data)
            //console.log('response_____',this.getDataSuministro.index)
            //console.log('Valores index____:',this.buscarSuministros.data[this.getDataSuministro.index] )
            //this.roles[this.index].roleName = this.editData.roleName

            //this.users[this.index] = this.editData
            //this.buscarSuministros.data[this.getDataSuministro.index].correo_suministro = res.data
            this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
            this.addModalEvento = false
            
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


    

      

     




   },

    async created(){

     try {

         const [reso] = await Promise.all([

                 //this.callApi('get', 'front/app/orientacion')
                 //this.callApi('get', 'app/getEvento'),
                 this.callApi('get', 'app/organo')
             ])
             //this.orientaciones = res.data
             //this.eventos = res.data
             this.organos = reso.data

         } catch {
             this.$swal('Algo salio mal','intente nuevamente','error')
         }
               

               
               
         },




}




  </script>