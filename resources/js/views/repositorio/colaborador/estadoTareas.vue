<template>
<base-layout>
<Breadcrumbs>
  <template v-slot:titulo_breadcrumbs> Tareas
  </template>
  
  <template v-slot:prueba>
      <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li><a href="#">Pendientes</a></li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>

    <li>Estado Tareas</li>
    </template>
</Breadcrumbs>

 

   <div class="card ">
      <div class="col-md-12  ml-auto mr-auto card-header ">
         
            <b-row class="">
             <b-col cols="8">
               <span>
                 <i class="fas fa-chart-area"></i>
                   Administrar Tareas segun periodo
               </span>
             </b-col>
             <b-col cols="2">
               
               <label for="example-datepicker">Seleccione el periodo :</label>
            </b-col>
             <b-col cols="2">

               <b-form-select v-model="filtro.periodo"  class="mb-3" name="periodo" @change='EstadoTareas()'>
                     <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                     <b-form-select-option :value="[listPeriodo.id,listPeriodo.nombre]" v-for="(listPeriodo, i) in listPeriodos.data" :key="i" v-if="listPeriodos.data.length" :disabled="listPeriodo.estado == '2' ? false: true" >{{listPeriodo.nombre}}</b-form-select-option>
               </b-form-select> </b-col>
         </b-row>
 
      </div>
   </div>

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
                   <h3>Enviando notificaciones mediante correo...</h3>
                
              </b-button>

          <!-- We add an SR only text for screen readers -->
          
        </div>
      </template>
   
    <div class="row">
         <div class="col-md-12  ml-auto mr-auto">


            <div class="card">
               <div class="card-body">

                     <div class="row justify-content-center align-items-center mb-12">
                        <div class="col-md-3 pl-md-0 ampliar" v-for="(tarea, i) in tareas.data" :key="i" v-if="(tareas.data.length) && (tarea.tarea_reportes.length)">
                           
                           <div class="card-pricing2"
                              :class="(tarea.tp_totalasignado == tarea.tp_totalatendido) && (tarea.tp_totalatendido > 0) ? 'card-success' : (tarea.tp_totalasignado > tarea.tp_totalatendido) && (tarea.tp_totalatendido > 0) ? 'card-warning' :'card-danger'">
                              <div class="pricing-header">
                                 <h3 class="fw-bold">{{tarea.nombre}}</h3>
                                 <span class="sub-title">{{tarea.descripcion}}</span>
                               </div>
                               <div class="price-value">
                                 <div class="value">
                                  
                                   <span class="amount">{{ (tarea.tp_totalasignado == tarea.tp_totalatendido) && (tarea.tp_totalatendido > 0) ? 'LISTO' : 'FALTA' }}</span>
                                   <span class="month">{{tarea.fechafinal}} 
                                   </span>
                                   <strong >Fecha limite:</strong>
                                   
                                 </div>
                               </div>


                               <ul class="pricing-content">
                                 <li 
                                    v-for="(tareareporte, i) in tarea.tarea_reportes" 
                                    :key="i" 
                                    v-if="(tarea.tarea_reportes.length)"

                                    :class="(tareareporte.tarea_reporte_colaboradores.estado == 3) ? '' : (tareareporte.tarea_reporte_colaboradores.estado == 2) ? 'alerta' : 'disable'"
                                    
                                   
                                 >
                              

                                    {{tareareporte.reportes.nombre}} 
                                  
                                      
                                    <b-button size="sm" :id="`popover-1-${tareareporte.tarea_reporte_colaboradores.id}`" variant="outline-success" v-if="(tareareporte.tarea_reporte_colaboradores.documentos)" @click="descargarArchivo(tareareporte.tarea_reporte_colaboradores.documentos ,i)">
                                        <b-icon icon="download" ></b-icon>
                                    </b-button>
                                      <b-popover :target="`popover-1-${tareareporte.tarea_reporte_colaboradores.id}`" triggers="hover" placement="top" v-if="(tareareporte.tarea_reporte_colaboradores.documentos)">
                                        
                                        Descargar archivo - {{tareareporte.tarea_reporte_colaboradores.documentos.nombre}}
                                      </b-popover>
                                   

                                    <br>
                                    <b-link href="" v-if="(tareareporte.tarea_reporte_colaboradores.estado == 3)" @click="getMailNotificacion(tareareporte ,i,tarea)" class="text-success"><span class="fa fa-paper-plane"></span> Buen trabajo</b-link>
                                    <b-link href="" v-if="(tareareporte.tarea_reporte_colaboradores.estado == 1)" @click="getMailNotificacion(tareareporte ,i,tarea)" class="text-danger"><span class="fa fa-paper-plane"></span> Notificacion</b-link>
                                    <b-link href="" v-if="(tareareporte.tarea_reporte_colaboradores.estado == 2)" @click="getMailNotificacion(tareareporte ,i,tarea)" class="text-primary"><span class="fa fa-paper-plane"></span> Recordatorio</b-link>
                               
                                    
                                 </li>
                                 
                               </ul>
                               
                               
                                <b-dropdown
                                  text="Acciones"
                                  dropup
                                  block 
                                 
                                  :variant="(tarea.tp_totalasignado == tarea.tp_totalatendido) && (tarea.tp_totalatendido > 0) ? 'outline-success' : (tarea.tp_totalasignado > tarea.tp_totalatendido) && (tarea.tp_totalatendido > 0) ? 'outline-warning' :'outline-danger'"
                                  class="m-2"
                                  menu-class="w-100"
                                >
                                  <b-dropdown-item href="#" v-if="isReadPermitted"  @click="linkprueba2(tarea ,i)"><button class="btn btn-success btn-sm"  ><span class="fa fa-eye"></span>    
                                       </button> Visualizar tareas
                                  </b-dropdown-item>
                                  <b-dropdown-item href="#" v-if="isReadPermitted" @click="getMailReporte(tarea ,i)" ><button class="btn btn-primary btn-sm"  ><span class="fa fa-paper-plane"></span>    </button> Notificacion mediante correo
                                                         </b-dropdown-item>
                                </b-dropdown>
                           </div>
                        </div>
                     </div>
                     <div class="card mb-3">               
                        <advanced-laravel-vue-paginate :data="tareas" @paginateTo="EstadoTareas"></advanced-laravel-vue-paginate>
                      </div>
                </div>  

            </div>
         </div>
    </div>


  </b-overlay>



    



</base-layout>


</template>

<script>

import Breadcrumbs from '../../../components/layouts/repositorio/includes/Breadcrumbs.vue';

export default{
  components: {
   
     

    
  },



  data(){
    return {
      data : {
        
      },

      cargaremail:false,
      tareas:[],
      listPeriodos:[],

      filtro: {},

      

    


       
    }
  },


  methods : {

   EstadoTareas(page = 1) {
      console.log('veriamos:___',this.filtro.periodo[0])
          axios.get('app/estadoTareas?page=' + page,{
             params: {
              periodoId: this.filtro.periodo[0],

             }
          })
              .then(response => {
                  //this.buscarExtraordinarios = response.data;
                  //this.buscarExtraordinarioR = response.data;
                  //this.mostrarBusqueda = true
                  //this.mostrar = false
                  console.log('datos buscados',response.data )
                  this.tareas= response.data
                 
                  console.log(response.data)
              });
      },

     linkprueba(){
        //this.$router.push('/repositorio/tareasReportesAsignados')
//        this.$router.push(this.xdd())

        //window.open(this.$router.push(this.xdd()), '_blank');
         let routeData = this.$router.resolve({path: '/back/extraordinario?page=1', query: {tipoSearch: 'Nombres', search: 'Mamani',}});
         window.open(routeData.href, '_blank');
     },

     linkprueba2(tareareportesDatos, index){
      console.log('datos refrescos_____',tareareportesDatos);
      console.log('datos periodo',this.filtro.periodo[0]);
        //this.$router.push('/repositorio/tareasReportesAsignados')
//        this.$router.push(this.xdd())

        //window.open(this.$router.push(this.xdd()), '_blank');
     // this.$router.push({ path: '/back/extraordinario', params: {tipoSearch: 'Nombres', search: 'Mamani',} })

      this.$router.push({ 
            //name: 'extraordinario', 
            name: 'tareasReportesAsignados', 
            params: { tipoTareaAll: 'false', tareasEstadoAll: 'true', colaboradorAll: 'true', tipoTarea:tareareportesDatos.id, periodoIdAll:'false', periodoId:this.filtro.periodo[0] },
         })

        // let routeData = this.$router.push({path: '/back/extraordinario?page=1', params: {tipoSearch: 'Nombres', search: 'Mamani',}});
         //window.open(routeData.href, '_blank');
     },

     getMailNotificacion(tareareportesDatos ,index,tarea){

         console.log('dentro de get mail-------------getMailNotificacion----------------', tareareportesDatos)
         console.log('dentro de get mail-------------mas----------------', tarea)
         console.log('dentro de get mail-------------this.$router+++++++', this.$route)
         //console.log('dentro de get mail-------------this.$hostooo+++++++', window.location.hostname)
         //console.log(window.location.href);
         //this.cargaremail =false
            //axios.get(`/back/app/getMailNotificacion`,{
            axios.get('app/getMailNotificacion',{
             params: {
               empresacolabordaor_id: tareareportesDatos.tarea_reporte_colaboradores.empresacolaborador_id,
               fechalimite: tareareportesDatos.tarea_reporte_colaboradores.fechalimite,
               estado_trc: tareareportesDatos.tarea_reporte_colaboradores.estado,
               fechacreacion_trc: tareareportesDatos.tarea_reporte_colaboradores.created_at,
               tareareporte_id: tareareportesDatos.id,
               tarea_id: tareareportesDatos.tarea_id,
               nombre_t: tarea.nombre,
               descripcion_t: tarea.descripcion,
               descripcion_r: tareareportesDatos.reportes.descripcion,
               nombre_r: tareareportesDatos.reportes.nombre,
               reporte_id: tareareportesDatos.reporte_id,
               fechavalidacion_trc: tareareportesDatos.tarea_reporte_colaboradores.fechavalidacionh,
               fechaatencion_trc: tareareportesDatos.tarea_reporte_colaboradores.fechaatencionh,
               URL: window.location.href,


             }
          }).then(function(response){

            if (response.status==200) {
           console.log('datos ____:::',response.data)
               //this.cargaremail =false
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
                  //this.cargaremail =false
                  this.$swal('Algo salio mal','Verifique los correos','error')
               }
            }
            }.bind(this));
     },

     getMailRecordatorio(tareareportesDatos ,index){
      
         console.log('dentro de get mail-------------getMailRecordatorio----------------', tareareportesDatos)
     },

     async getMailReporte(tareareportesDatos ,index){
     //getMailReporte(tareareportesDatos ,index){
         console.log('dentro de get mail-----------------------------', tareareportesDatos)
      tareareportesDatos.URL = window.location.origin
      this.cargaremail = true
        const [ res] = await Promise.all([
                             this.callApi('post', 'app/getMailReporte', tareareportesDatos)
                          ])
         if (res.status==200) {
           
               this.cargaremail =false
               this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
               
               
            } else {
                  this.cargaremail =false
                  this.$swal('Algo salio mal','Intente nuevamente y/o consulte con soporte','error')
               }
           
         //this.cargaremail =true
           // axios.get(`/back/app/getMailExtraordinario`,{
           /* axios.post(`app/getMailReporte`,{
             params: {
               //tipoExtraordinario_id: extraordinario.id
tareareportesDatos
             }
          }).then(function(response){
              

                 if (response.status==200) {
           
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
          
*/
        },




     linkprueba3(){
      //console.log('datos refrescos_____',tareareportesDatos);
        //this.$router.push('/repositorio/tareasReportesAsignados')
//        this.$router.push(this.xdd())

        //window.open(this.$router.push(this.xdd()), '_blank');
     // this.$router.push({ path: '/back/extraordinario', params: {tipoSearch: 'Nombres', search: 'Mamani',} })
      this.$router.push({ 
            name: 'extraordinario',  
            params: { tipoSearch: 'Nombres', search: 'diaz',},
         })

        // let routeData = this.$router.push({path: '/back/extraordinario?page=1', params: {tipoSearch: 'Nombres', search: 'Mamani',}});
         //window.open(routeData.href, '_blank');
     },

      xdd(page = 1) {
            axios.get('/back/app/extraordinarioBuscar?page=' + page,{
                params: {
                 //tipoSearch: this.searchData.tipoSearch,
                  //   search: this.searchData.search,
                  tipoSearch: 'Nombres',
                     search: 'Mamani',

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


       listaPeriodos(page = 1) { 
          axios.get('app/listaPeriodos?page=' + page,{
             params: {
                //tipoSearch: this.searchData.tipoSearch,
                //search: this.searchData.search

             }
          })
              .then(response => {
                  //this.buscarExtraordinarios = response.data;
                  //this.buscarExtraordinarioR = response.data;
                  //this.mostrarBusqueda = true
                  //this.mostrar = false
                 //console.log('datos buscados',response.data )
                 this.listPeriodos= response.data
                 
                 //console.log(response.data)
              });
      },

       descargarArchivo(datosDocumento, index) {


            console.log('dentro de reportePDFRER_____',datosDocumento)
            window.open(`/repositorio/app/descargarArchivo/${datosDocumento.id}`);
            
          
      },


  


  },


    
  async created(){
    try {
      //this.EstadoTareas();
      this.listaPeriodos();

      //this.listaPeriodos();
      //this.tareasReportesAsignados();
      
/*
      const [  res] = await Promise.all([
   
          this.callApi('get', 'app/tarea'),
   
        ])

        this.tareas = res.data
   
        console.log('los datos del tareas son',this.tareas)
     */

      } catch {
        //this.$swal('Any fool can use a computer','de','error')
      }
    
    
  },


  




}




  </script>