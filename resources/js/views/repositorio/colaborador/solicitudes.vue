<template>
<base-layout>
<Breadcrumbs>
  <template v-slot:titulo_breadcrumbs> Solicitudes
  </template>
  
  <template v-slot:prueba>
      <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li><a href="#">Pendientes</a></li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>

    <li>Solicitudes Asignadas</li>
    </template>
</Breadcrumbs>

  <div class="card mb-3">
    <div class="card-header d-flex">
      <span>
        <i class="fas fa-chart-area"></i>
          Administrar Solicitudes
      </span>

    <button class="btn btn-primary btn-sm ml-auto"  v-b-toggle.collapse-1 ><span class="fa fa-filter"></span> Filtro</button>
      
    </div>
    
     <b-collapse id="collapse-1" class="mt-2 marginCard">
       <b-card class="marginCard">
           <b-row>
          

          
          <b-col cols="6" md="3">

               <b-card
               border-variant="primary"
                 align="center"
                 class="marginCard"
              >
              <h6>Seleccione Colaborador:</h6>
                  <b-card-text>
                     <b-form-checkbox v-model="filtroData.colaboradorAll" name="check-button" switch  v-on:change="mostrarColaborador(filtroData)"  >
                        Colaborador - Todos
                     </b-form-checkbox>
                  </b-card-text>
                  <div v-if="mostrarColaboradores">
                     <b-form-select v-model="filtroData.colaborador"  >                                    
                        <b-form-select-option :value="null" disabled>-- Seleccione Colaborador --</b-form-select-option>
                        <b-form-select-option :value="colaborador.id" v-for="(colaborador, i) in colaboradores" :key="i" v-if="colaboradores.length">{{colaborador.nombre}} </b-form-select-option>
                     </b-form-select>
                  </div>
              </b-card>

         </b-col>
         <b-col cols="6" md="2">

            <b-card
               border-variant="primary"
                 align="center"
                 class="marginCard"
              >
              <h6>Periodo:</h6>
                 <b-card-text>
                     <b-form-checkbox v-model="filtroData.periodoIdAll" name="check-button" switch  v-on:change="mostrarPeriodo(filtroData)"  >
                        Periodo - Todos
                     </b-form-checkbox>
                  </b-card-text>
                  <div v-if="mostrarPeriodos">
                     <b-form-select v-model="filtroData.periodoId"   >
                           <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                           <b-form-select-option :value="[listPeriodo.id,listPeriodo.nombre]" v-for="(listPeriodo, i) in listPeriodos.data" :key="i" v-if="listPeriodos.data.length" :disabled="listPeriodo.estado == '2' ? false: true" >{{listPeriodo.nombre}}</b-form-select-option>
                     </b-form-select>
                  </div>
                
              </b-card>

         </b-col>

          <b-col cols="6" md="1">
            <button class="btn btn-outline-primary my-2 my-sm-0" @click="getsolicitudesFiltro"><span class="fas fa-search"></span> Buscars</button>
         </b-col>
      </b-row>
       </b-card>
     </b-collapse>

  

  </div>
    <div class="row">
      <div class="col-md-12  ml-auto mr-auto">
        <div class="card">
          <div class="card-body">
            <div class="row">


                <b-table responsive
                  id="table-transition-example"
                  :items="solicitudes.data"
                  :fields="fields"
                  hover
                  small
                  primary-key="id"
                  :tbody-transition-props="transProps"
                  :tbody-tr-class="rowClass"
                >

                <template #cell(opciones)="row">
                    <b-button @click="showAtender(row.item, row.index)" :variant="(row.item.estadosolicitud == 1) ? 'primary' : (row.item.estadosolicitud == 2) ? 'success' : 'warning'">Atender</b-button>
                </template>



                </b-table>
                <div class="card mb-3">               
                  <advanced-laravel-vue-paginate :data="solicitudes" @paginateTo="getsolicitudes"></advanced-laravel-vue-paginate>
                </div>

            </div>
         </div>
       
        </div>
      </div>
    </div>
  
<b-modal  hide-footer v-model="atenderModal" title="Atender Solicitud" :mask-closable="false" :closable="false" size="lg" :header-bg-variant=" (datoSelAtender.estadosolicitud == 2) ? 'success' : (datoSelAtender.estadosolicitud == 3) ? 'danger' : 'primary' " >

   
      <b-row >
         <b-col sm="12" lg="12">
         <b-card border-variant="primary"
            header-bg-variant="primary"
            header-text-variant="white">

            <b-card-title  class="text-center" >Datos de la Solicitud</b-card-title>

            <b-row >

               <b-col sm="12" lg="6">
                   <b-row style="border-bottom: solid 2px #f1f1f1; border-radius: 5px;">
                     <b-col sm="5">
                       <h6>Colaborador: </h6>
                     </b-col>
                     <b-col sm="7">
                       <b>{{datoSelAtender.c_nombres}}</b>
                     </b-col>
                   </b-row>
                   <b-row style="border-bottom: solid 2px #f1f1f1; border-radius: 5px;">
                     <b-col sm="5">
                       <h6>Reporte: </h6>
                     </b-col>
                     <b-col sm="7">
                       <b>{{datoSelAtender.r_nombre}}</b>
                     </b-col>
                   </b-row>
                   <b-row style="border-bottom: solid 2px #f1f1f1; border-radius: 5px;">
                     <b-col sm="5">
                       <h6>Tarea: </h6>
                     </b-col>
                     <b-col sm="7">
                       <b>{{datoSelAtender.t_nombre}}</b>
                     </b-col>
                   </b-row>
                   <b-row style="border-bottom: solid 2px #f1f1f1; border-radius: 5px;">
                     <b-col sm="5">
                       <h6>Fecha Asignada:</h6>
                     </b-col>
                     <b-col sm="7">
                       <b>{{datoSelAtender.fechaasignadah_old}}</b>
                     </b-col>
                   </b-row>
                  <b-row style="border-bottom: solid 2px #f1f1f1; border-radius: 5px;">
                     <b-col sm="5">
                       <h6>Fecha Propuesta: </h6>
                     </b-col>
                     <b-col sm="7">
                       <b>{{datoSelAtender.fechasolicitadah}}</b>
                     </b-col>
                   </b-row>
               </b-col>
               <b-col sm="12" lg="6">
                  <b-row style="border-bottom: solid 2px #f1f1f1; border-radius: 5px;">
                     <b-col sm="12">
                       <h6>Sustento: </h6>
                     </b-col>
                     <b-col sm="12">
                       <b>{{datoSelAtender.fundamento}}</b>
                     </b-col>
                 
                   </b-row>
                        
               </b-col>
            </b-row>
         </b-card>
            
            
         </b-col>
         <b-col sm="12" lg="12">
            <b-card>
               <b-card-title  class="text-center" >Validar solicitud</b-card-title>         

            <b-row  style="border-bottom: solid 2px #f1f1f1; border-radius: 5px;">
               <b-col sm="12" lg="6">
                  <b-row >
                     <b-col sm="12" lg="10">
                        ¿Esta de acuerdo con la fecha propuesta?
                          
                     </b-col>
                     <b-col sm="12" lg="2">
                        
                          <b-form-checkbox v-model="regdata.validar" name="check-button" switch v-on:change="mostrarFechaAprobada()" >
                           </b-form-checkbox>
                     </b-col>
                     
                  </b-row>
                        
               </b-col>
               <b-col sm="12" lg="6" v-if="mostrarFecha">
                  <b-row >
                     <b-col sm="12" lg="12">
                        <b-row>
                           <b-col sm="6">
                             <b-form-datepicker id="example-datepicker" v-model="regdata.fecha" class="mb-2" ></b-form-datepicker>
                           </b-col>
                           <b-col sm="6">
                             <b-form-timepicker v-model="regdata.hora" locale="en"></b-form-timepicker>
                           </b-col>
                       
                        </b-row>

                     </b-col>

                  </b-row>
               </b-col>
            </b-row>
                  
             </b-card>
         </b-col>
      </b-row>
 
      <footer >
            
            <b-row>
               <b-col sm="12" lg="6">
                    <b-button block variant="primary"  @click="aceptarSolicitud(datoSelAtender)">
                      Aceptar Solicitud <span class="fas fa-user-check"></span>
                    </b-button>
               </b-col>
               <b-col sm="12" lg="6">
                    <b-button block variant="danger"  @click="denegarSolicitud(datoSelAtender)">
                      Denegar Solicitud <span class="fas fa-user-times "></span>
                    </b-button>
               </b-col>
            </b-row>
      </footer>
    
</b-modal>





</base-layout>


</template>

<script>

import Breadcrumbs from '../../../components/layouts/repositorio/includes/Breadcrumbs.vue';

export default{
  components: {
    Breadcrumbs,
     

    
  },



  data(){
    return {
      transProps: {
          // Transition name
          name: 'flip-list'
        },


      atenderModal: false,
      solicitudModal: false,
      derivarModal: false,
      mostrarFiltro: false,
      mostrar: true,
      mostrarTipoTareas: false,
      mostrarTareasEstados: false,
      mostrarColaboradores: false,
      mostrarPeriodos: false,
      mostrarFecha: false,

      fields: [
          { key: 'id',label:'#', sortable: true, stickyColumn: true, isRowHeader: true},
          { key: 'tarrepcol.colaborador.nombres',label:'COLABORADOR', sortable: true },
          { key: 'tarrepcol.tarea_reporte.tareas.nombre',label:'TAREA', sortable: true },
          { key: 'tarrepcol.tarea_reporte.reportes.nombre',label:'REPORTE', sortable: true },
          { key: 'tarrepcol.periodo.nombre',label:'PERIODO', sortable: true },
          { key: 'opciones',label:'ACCIONES', sortable: true },
        ],


      colaboradores:[],
      tareaReporte:[],
      solicitudes:[],


      filtroData:{
         tipoTareaAll: true,
         tareasEstadoAll: true,
         colaboradorAll: true,
         periodoIdAll: true,
         periodoId:[],

        },

        listPeriodos:[],
        documentos:[],
        colaboradores:[],
        datoSelAtender:[],
        regdata:{
         validar : true,
        },
     
      

       
    }
  },


   methods : {

       rowClass(fields, type) {
       //if (fields.estadosolicitud == '2') return 'table-primary'
       if (fields.estadosolicitud == '2') return 'table-success'
       if (fields.estadosolicitud == '3') return 'table-danger'
      },

     mostrarFechaAprobada() {
      console.log('filtros 1________:', this.regdata)

           if (this.regdata.validar==false) {

              this.mostrarFecha=true
           
                 console.log('verdadero------------',this.regdata.validar)

           }else{

              this.mostrarFecha=false
                 console.log('falso--------------',this.regdata.validar)
           }
           
          
        },




        mostrarColaborador(filtroDatos) {
      console.log('filtros 3________:', filtroDatos)

            if (this.filtroData.colaboradorAll==false) {
               console.log('verdadero------------',this.filtroData.colaborador)
               this.mostrarColaboradores=true
            


            }else{

               console.log('falso------------',this.filtroData.colaborador)
               this.mostrarColaboradores=false
            }
            
          
        },

      showAtender(dataSol, index){

               console.log('falso------------',dataSol)
               console.log('falso------------',index)

         let obj ={
            fechaasignada_old : dataSol.fechaasignada_old, 
            id : dataSol.id, 
            estado : dataSol.estado, 
            estadosolicitud : dataSol.estadosolicitud, 
            tiposolicitud_id : dataSol.tiposolicitud_id, 
            fechaasignadah_old : dataSol.fechaasignadah_old, 
            fechasolicitadah : dataSol.fechasolicitadah, 
            fundamento : dataSol.fundamento, 
            tareareportecolaborador_id : dataSol.tareareportecolaborador_id, 
            
            trc_periodo_id : dataSol.tarrepcol.periodo_id,

            c_nombres : dataSol.tarrepcol.colaborador.nombres, 
            c_id : dataSol.tarrepcol.colaborador.id,
            
            tr_reporte_id : dataSol.tarrepcol.tarea_reporte.reporte_id,

            r_id : dataSol.tarrepcol.tarea_reporte.reportes.id,
            r_descripcion : dataSol.tarrepcol.tarea_reporte.reportes.descripcion,
            r_nombre : dataSol.tarrepcol.tarea_reporte.reportes.nombre,
            r_oficina_id : dataSol.tarrepcol.tarea_reporte.reportes.oficina_id,

            t_id : dataSol.tarrepcol.tarea_reporte.tareas.id,
            t_descripcion : dataSol.tarrepcol.tarea_reporte.tareas.descripcion,
            t_nombre : dataSol.tarrepcol.tarea_reporte.tareas.nombre,

            index: index,
      }
     
     this.datoSelAtender = obj
     this.atenderModal = true


      },

      async aceptarSolicitud(registro){

         console.log('------------------holitas desde solicitarAmpliacion----------',registro)
         console.log('------------------holitas desde trc_periodo_id----------',this.regdata)
         //console.log('+++++++++-holitas desde dataRegistro+++++++++++',this.dataRegistro)
         //console.log('this.dataRegistro.motivo_id',this.dataRegistro.motivo_id)

            const [ res] = await Promise.all([
              this.callApi('post', 'app/aceptarSolicitud', {
                
                s_id  : registro.id,
                s_fechaasignada_old  : registro.fechaasignada_old,
                s_fechaasignadah_old  : registro.fechaasignadah_old,
                s_fechasolicitadah  : registro.fechasolicitadah,
                s_tareareportecolaborador_id  : registro.tareareportecolaborador_id,
                s_trc_periodo_id  : registro.trc_periodo_id,

                fechaaprobada : this.regdata.fecha,
                horaaprobada : this.regdata.hora,
                validar : this.regdata.validar,

                 
             })
              ])

            if (res.status==200) {
               console.log('index_______________',this.solicitudes.data[registro.index]);
               console.log('response____________',res);
               console.log('index__________2_____',this.solicitudes.data[registro.index].estadosolicitud);
               console.log('response_______2_____',res.data['solicitud'].estadosolicitud);

           
               this.solicitudes.data[registro.index].estadosolicitud = res.data['solicitud'].estadosolicitud
               //this.tareasRepAsi.data[registro.index].ec_colaborador_id = res.data['trc'].empresacolaborador_id
               //this.tareasRepAsi.data[registro.index].trc_estador = res.data['trc'].estador
               this.$swal('Su solicitud se registro','Exitosamente','success')
               this.atenderModal = false
          
            }else if(res.status==422) {
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
                }else if(res.status==409 || res.status==410 ) {
                  console.log('dentro del error',res);
                    this.$swal({
                      toast: true,
                      position: 'top-end',
                      icon: 'error',
                      title: res.data[0],
                      showConfirmButton: false,
                      timer: 5000
                    });
                  
                }else{//this.cargar= false
                    this.$swal('Ocurrio algun problema','Contacte con el responsable','warning')
                  }
                  
      

      },



      async denegarSolicitud(registro){

         console.log('------------------holitas desde solicitarAmpliacion----------',registro)
         //console.log('+++++++++-holitas desde dataRegistro+++++++++++',this.dataRegistro)
         //console.log('this.dataRegistro.motivo_id',this.dataRegistro.motivo_id)

            const [ res] = await Promise.all([
              this.callApi('post', 'app/denegarSolicitud', {
                
               s_id  : registro.id,
               s_fechaasignada_old  : registro.fechaasignada_old,
               s_fechaasignadah_old  : registro.fechaasignadah_old,
               s_fechasolicitadah  : registro.fechasolicitadah,
               s_tareareportecolaborador_id  : registro.tareareportecolaborador_id,
               s_trc_periodo_id  : registro.trc_periodo_id,

               fechaaprobada : this.regdata.fecha,
               horaaprobada : this.regdata.hora,
               validar : this.regdata.validar,

                 
             })
              ])

            if (res.status==200) {
               console.log('index_______________',this.solicitudes.data[registro.index]);
               console.log('response____________',res);

           
               this.solicitudes.data[registro.index].estadosolicitud = res.data['solicitud'].estadosolicitud
               //this.tareasRepAsi.data[registro.index].ec_colaborador_id = res.data['trc'].empresacolaborador_id
               //this.tareasRepAsi.data[registro.index].trc_estador = res.data['trc'].estador
               this.$swal('La solicitud fue','Denegada','error')
               this.atenderModal = false
          
            }else if(res.status==422) {
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
                }else if(res.status==409 || res.status==410 ) {
                  console.log('dentro del error',res);
                    this.$swal({
                      toast: true,
                      position: 'top-end',
                      icon: 'error',
                      title: res.data[0],
                      showConfirmButton: false,
                      timer: 5000
                    });
                  
                }else{//this.cargar= false
                    this.$swal('Ocurrio algun problema','Contacte con el responsable','warning')
                  }
                 
      

      },




   mostrarPeriodo(filtroDatos) {
      console.log('filtros 4________:', filtroDatos)

            if (this.filtroData.periodoIdAll==false) {
               console.log('verdadero------------',this.filtroData.periodo)
               this.mostrarPeriodos=true
            


            }else{

               console.log('falso------------',this.filtroData.periodo)
               this.mostrarPeriodos=false
            }
            
          
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

       getColaboradores() {
          axios.get('app/listColaborador',{
             params: {
              

             }
          })
              .then(response => {
                  //this.buscarExtraordinarios = response.data;
                  //this.buscarExtraordinarioR = response.data;
                  //this.mostrarBusqueda = true
                  //this.mostrar = false
                 // console.log('datos buscados___XXX',response.data )
                  this.colaboradores= response.data
                 
                  console.log('getColaboradores----------------------',response.data)
              });
      },


       getsolicitudesFiltro(page = 1) {
         if (this.filtroData.periodoId==undefined) {

         console.log('-----------------',this.filtroData.periodoId)
         this.filtroData.periodoId[0] = 1
         }

         axios.get('app/getsolicitudesFiltro?page=' + page,{
             params: {
               //tipoTareaAll: this.filtroData.tipoTareaAll,
               //tareasEstadoAll: this.filtroData.tareasEstadoAll,
               colaboradorAll: this.filtroData.colaboradorAll,
               periodoIdAll: this.filtroData.periodoIdAll,

               //tipoTarea: this.filtroData.tipoTarea,
               //tareasEstado: this.filtroData.tareasEstado,
               colaborador: this.filtroData.colaborador,
               periodoId: this.filtroData.periodoId[0],

             }
          })
             .then(response => {
               console.log('getsolicitudesFiltro----------------------',response.data )
               this.solicitudes= response.data
             });
            
     },

      getsolicitudes(page = 1) {
       axios.get('app/getsolicitudes?page=' + page,{
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
               console.log('getsolicitudes____________________',response.data )
               this.solicitudes= response.data
               //this.fechas= response.data.fechas

              
              // this.makeToast(response.data);
               //console.log(response.data)
             });

      },





   },



    
  async created(){
    try {

      this.listaPeriodos();
      //this.tareasReportesAsignados();
      //this.getTareas();
      this.getColaboradores();
      this.getsolicitudes();
      
/*
      const [  res] = await Promise.all([
   
          this.callApi('get', 'app/tarea'),
   
        ])

        this.tareas = res.data
   
        console.log('los datos del tareas son',this.tareas)
     */

      } catch {
        this.$swal('Any fool can use a computer','de','error')
      }
    
    
  },


  




}




  </script>