                                 
                                 
<template>
<base-layout>
<Breadcrumbs>
   <template v-slot:titulo_breadcrumbs> Actualizacion de Datos
   </template>
   
   <template v-slot:prueba>
       <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>
      <li><a href="#">Datos suministros</a></li>
      <li class="separator">
         <i class="flaticon-right-arrow"></i>
      </li>

      <li>Actualizacion de Datos</li>
   </template>
</Breadcrumbs>

   <div class="card mb-3">
      <div class="card-header d-flex">
         <span>
            <i class="fas fa-chart-area"></i>
               Administrar Registros
         </span>
      <button class="btn btn-primary btn-sm ml-auto" @click="addModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
       
      </div>
   </div>
      <div class="row">
         <div class="col-md-12  ml-auto mr-auto">
            <div class="card">
               <div class="card-body">
                  <b-row>
                      
                      <b-col  cols="12" sm="12" md="9" lg="9" >
                         <b-card>
                           

                                 
                             <b-row cols="1" cols-sm="1" cols-md="3" cols-lg="3">
                               

                               <b-col>
                                 
                                   <b-form-group  id="input-group-1" label="Espeficicar tipo busqueda: :" label-for="fechabusqueda"  >
                                      <b-form-checkbox v-model="filtroDatos.busquedaEspecifica" name="check-button" switch>
                                       <b> {{ filtroDatos.busquedaEspecifica ? 'SI' : 'NO' }} </b>
                                     </b-form-checkbox>
                                   </b-form-group>

                                   <b-form-group  id="input-group-1" label="Tipo de busqueda:" label-for="selectTipo"  v-if="filtroDatos.busquedaEspecifica==1">
                                      <b-form-select v-model="filtroDatos.tipoBusqueda" :options="dataTipoBusqueda"></b-form-select>
                                   </b-form-group>  
                                   <b-form-group  id="input-group-1" label="Consignar dato :" label-for="busqueda" v-if="filtroDatos.busquedaEspecifica==1">
                                      <b-form-input id="busqueda" v-model="filtroDatos.datoBusqueda" type="text" placeholder="Ingresar los dato" >
                                      </b-form-input>
                                   </b-form-group>

                               </b-col>
                               <b-col>
                                   <b-form-group  id="input-group-1" label="Fecha busqueda :" label-for="fechabusqueda"  >
                                      <b-form-checkbox v-model="filtroDatos.fechaBusqueda" name="check-button" switch>
                                       <b> {{ filtroDatos.fechaBusqueda ? 'Buscar entre 2 fechas' : 'Hoy' }} </b>
                                     </b-form-checkbox>
                                   </b-form-group>

                                   <b-form-group  id="input-group-1" label="Fecha inicio :" label-for="fechaInicio"   v-if="filtroDatos.fechaBusqueda==1">
                                       <b-form-datepicker id="fechaInicio" v-model="filtroDatos.fechaInicio" class="mb-2"></b-form-datepicker>
                                   </b-form-group>

                                   <b-form-group  id="input-group-1" label="Fecha final :" label-for="fechaFinal"   v-if="filtroDatos.fechaBusqueda==1">
                                       <b-form-datepicker id="fechaFinal" v-model="filtroDatos.fechaFinal" class="mb-2"></b-form-datepicker>
                                   </b-form-group>

                                 
                                   
                               </b-col>
                               <b-col>
                                 <b-form-group  id="input-group-1" label="Seleccionar Sedes :" label-for="selectSede" >

                                    <b-dropdown id="dropdown-buttons" variant="outline-primary"  text="Seleccionar Sedes"  >

                                       <b-dropdown-group>
                                          <b-form-checkbox
                                        v-model="filtroDatos.allSelected"
                                        @change="toggleAll"
                                        switch 
                                      >
                                      <b>
                                         
                                        {{ filtroDatos.allSelected ? 'Anular seleccion' : 'Seleccionar todo' }}
                                      </b>
                                      </b-form-checkbox>
                                        </b-dropdown-group>

                                        <b-dropdown-divider></b-dropdown-divider>

    
                                         <b-form-checkbox-group
                                           id="filtroDatos.sede"
                                           v-model="filtroDatos.sede"
                                           :options="sedeFiltros"
                                           name="filtroDatos.sede"
                                           switches
                                           stacked
                                         ></b-form-checkbox-group>
                                       </b-dropdown>

                                      
                                   </b-form-group>
                                   
                               </b-col>
                               
                               
                             </b-row>

                            
                        </b-card>
                      </b-col>
                      <b-col  cols="12" sm="12" md="3" lg="3">
                         <b-card>

                           <div class="text-center mt-3">

                              
                              <b-button block variant="primary" class="mb-2" @click="getBuscar">
                                 <b-icon icon="search" aria-hidden="true"></b-icon> Buscar
                               </b-button>

                               <b-button block variant="success" class="mb-2" @click="getCorreoSuministroExport">
                                 <b-icon icon="file-earmark-excel" aria-hidden="true"></b-icon> Excel
                               </b-button>

                              <b-button block variant="warning" class="mb-2">
                                 <b-icon icon="file-earmark" aria-hidden="true"></b-icon> csv
                               </b-button>
                              <b-button block variant="danger" class="mb-2">
                                 <b-icon icon="cloud-arrow-up" aria-hidden="true"></b-icon> Enviar reporte
                               </b-button>
                              <b-button block variant="primary" class="mb-2" @click="getGrafico">
                                 <b-icon icon="file-earmark-bar-graph" aria-hidden="true"></b-icon> Graficos
                               </b-button>



                        
                           </div>
                        </b-card>
                      </b-col>


                    </b-row>
                 
                     

                     <b-row >
                        <b-col cols="12">
                        <b-card  v-if="tablaReporte" >
                           <div class="table-responsive">

                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <td class="bg-primary text-white text-center">#</td>
                                    <td class="bg-primary text-white text-center">DNI SOLICITANTE</td>
                                    <td class="bg-primary text-white text-center">SUMINISTRO</td>
                                    <td class="bg-primary text-white text-center">TITULAR SUMINISTRO</td>
                                    <td class="bg-primary text-white text-center">CORREO </td>
                                    <td class="bg-primary text-white text-center">ESTADO CORREO</td>
                                    <td class="bg-primary text-white text-center">CELULAR</td>
                                    <td class="bg-primary text-white text-center">ACCIONES</td>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr v-for="(dataBusqueda, i) in dataCorreoSuministro.data" :key="i" v-if="dataCorreoSuministro.data.length">
                                    <td>{{dataBusqueda.id}}</td>
                                    <td>{{dataBusqueda.person.dni}}</td>
                                    <td>{{dataBusqueda.suministro_id}}</td>
                                    <td>{{dataBusqueda.suministro.NombreSuministro}}</td>
                                    <td>{{dataBusqueda.correo}}</td>
                                    <td>{{ dataBusqueda.estadoConfirmacion == 1 ? 'Verificado' : 'Sin verificar' }}</td>
                                    <td>{{dataBusqueda.celular}}</td>
                                    <td>Acciones</td>
                                 </tr>

                              </tbody>
                           </table>
                           <advanced-laravel-vue-paginate :data="dataCorreoSuministro" @paginateTo="getBuscar"></advanced-laravel-vue-paginate>

                           </div>
                        </b-card>
                        </b-col>
                     </b-row>

                     <b-row v-if="graficoReporte">
                        <b-col cols="12">
                        <b-card>
                           holas grafico
                        </b-card>
                        </b-col>
                     </b-row>

                     <b-row >
                        <b-col cols="12">
                        <b-card>
                           holas grafico

                           {{ dataSedes}}
                           <br>
                           {{ dataBarras}}

                           <div class="col-md-10">
                              <b-card border-variant="success" header="Dia" align="center">
                                <canvas id="chart"></canvas>
                              </b-card>
                           </div >

                          


                           <div class="col-md-10">
                              <b-card border-variant="success" header="Dia" align="center">
                                <canvas id="chart2"></canvas>
                              </b-card>  
                           </div >

                        </b-card>
                        </b-col>
                     </b-row>

                     


               </div>
            </div>
         </div>
      </div>
   

</base-layout>

</template>

<script>

import Breadcrumbs from '../../../components/layouts/back/includes/Breadcrumbs.vue';
import * as categoryService from '../../../services/category_service';
import Chart from 'chart.js/auto';


export default{
   components: {
      Breadcrumbs,
      Chart,
      
      
   },



   data(){
      return {
         data : {
            
         },
         tablaReporte: false,
         graficoReporte: false,



         sedeFiltros: [],
         dataSedes: [],
         dataBarras: [],
         dataPie: [],
         xd: [],
        

         filtroDatos:{
            allSelected: false,
            busquedaEspecifica: false,
            fechaBusqueda: false,
            sede:[],
         },

         dataTipoBusqueda: [
          { value: null, text: 'Please select an option' },
          { value: 'Documento', text: 'DNI' },
          { value: 'CodigoSuministro', text: 'Suministro' },
          { value: 'CodigoRutaSuministro', text: 'Ruta' },
          { value: 'NombreSuministro', text: 'Apellidos y Nombres' }
          
        ],

         //filtro: [],
         filtro:{
            apellPat: '',
         },
         dataCorreoSuministro:{},
         
      }
   },


   methods : {


      toggleAll(checked) {
        // console.log('__cheked___',checked)
        

        if (checked == true) {
            for (var i = 0; i < this.sedeFiltros.length; i++) {
              this.ddx=this.sedeFiltros[i].value
              this.filtroDatos.sede.push(this.ddx)
           }
        
        }else{
        
           this.filtroDatos.sede = []

        }


      },

      getBuscar(page = 1) {
            axios.get('app/correoSuministroBuscar?page=' + page,{
                params: {
                  allSelected: this.filtroDatos.allSelected,
                  fechaBusqueda: this.filtroDatos.fechaBusqueda,
                  fechaInicio: this.filtroDatos.fechaInicio,
                  fechaFinal: this.filtroDatos.fechaFinal,
                  sedes: this.filtroDatos.sede,
                  tipoBusqueda: this.filtroDatos.tipoBusqueda,
                  datoBusqueda: this.filtroDatos.datoBusqueda,
                  busquedaEspecifica: this.filtroDatos.busquedaEspecifica

                }
             })
                .then(response => {
                    this.dataCorreoSuministro = response.data;

                    this.tablaReporte = true          
                             // console.log(response.data)
                });
        },


      getCorreoSuministroExport(){
         /*   if (this.sede.length == 0) return this.$swal('La Sede es obligatorio','Seleccione una sede como minimo','warning')
            if (this.filtroData.tipoExtraordinario_id.length == 0) return this.$swal('Tipo Registro es','Obligatorio','warning')
            if (this.filtroData.FechaInicio.length == 0) return this.$swal('La fecha de Inicio es','Obligatorio','warning')
            if (this.filtroData.FechaFinal.length == 0) return this.$swal('La fecha Final es','Obligatorio','warning')
            if (this.filtroData.FechaFinal < this.filtroData.FechaInicio) return this.$swal('Error en Fecha Final','La fecha Final no puede ser inferior a la fecha de inicio','warning')
            */
         console.log('dentro del exportar exel')
         //this.cargarexcel =true
         axios.get(`/back/app/getCorreoSuministroExport`, {
             responseType: 'arraybuffer',
             params: {
                  allSelected: this.filtroDatos.allSelected,
                  fechaBusqueda: this.filtroDatos.fechaBusqueda,
                  fechaInicio: this.filtroDatos.fechaInicio,
                  fechaFinal: this.filtroDatos.fechaFinal,
                  sedes: this.filtroDatos.sede,
                  tipoBusqueda: this.filtroDatos.tipoBusqueda,
                  datoBusqueda: this.filtroDatos.datoBusqueda,
                  busquedaEspecifica: this.filtroDatos.busquedaEspecifica
             }
            }).then(response => {
                //RESPUESTA
                if (response.status==200) {

                  console.log('exceltiempo de la ejecucion',response.request.timeout)
               let blob = new Blob([response.data], { type: 'application/vnd.ms-excel' });
               let link = document.createElement('a');
               link.href = window.URL.createObjectURL(blob);
               link.download = 'ReporteActualizacionDatos.xlsx';
               link.click();

                  this.$swal('Excelent !','El archivo se descargo satisfactoriamente','success')
                    this.cargarexcel =false

                } else {
                  this.cargarexcel = false
                     this.$swal('Algo salio mal','Verifique los correos','error')
                  }

                
            })
      },

      async getGrafico(){
         console.log('dentro del grafico',this.filtroDatos)

        

         const res = await axios.get("app/getGrafico",{
                params: {
                  allSelected: this.filtroDatos.allSelected,
                  fechaBusqueda: this.filtroDatos.fechaBusqueda,
                  fechaInicio: this.filtroDatos.fechaInicio,
                  fechaFinal: this.filtroDatos.fechaFinal,
                  sedes: this.filtroDatos.sede,
                  tipoBusqueda: this.filtroDatos.tipoBusqueda,
                  datoBusqueda: this.filtroDatos.datoBusqueda,
                  busquedaEspecifica: this.filtroDatos.busquedaEspecifica

                }
             })

            if (res.status==201 || res.status==200) {
                this.xd= res.data;

               }else{//this.cargar= false
                     this.$swal('Ocurrio algun problema','Revisar los datos para el registro (DNI)','warning')
                  }

            this.dataBarras= this.xd.barras
            this.dataSedes= this.xd.sedes
            this.dataPie= this.xd.pie
            
            
           




             
            this.cc = this.dataSedes

             console.log('0000dataBarras__s',this.dataBarras)
             console.log('0000dataSedes__s',this.dataSedes.nombre)

            //var chart = this.$refs.chart;
            //var chart2 = this.$refs.chart2;
//
            //var ctx = chart.getContext("2d");
            //var ctx2 = chart2.getContext("2d");
            const ctx = document.getElementById('chart');
            const ctx2 = document.getElementById('chart2');

            


           new Chart(ctx, {
                type: 'bar',
                data: {
                    
                    
                    labels: this.dataSedes,
                    //labels: this.dataBarras.x,
                    //labels: ['uno','dos','tres','cuatro','cinco'],

                    datasets: [{
       
        
    
        
                     borderWidth: 3,
                     borderColor: [
                        'rgba(230, 70, 22, 1)',                
                        'rgba(248, 177, 1, 1)',                
                        'rgba(148, 190, 18, 1)',                
                        'rgba(0, 147, 102, 1)',                
                        'rgba(0, 151, 146, 1)',
                        'rgba(0, 157, 224, 1)',
                        'rgba(2, 106, 179, 1)',
                        'rgba(147, 17, 126, 1)',
                        'rgba(230, 70, 22, 1)',                
                        'rgba(248, 177, 1, 1)',                
                        'rgba(148, 190, 18, 1)',                
                        'rgba(0, 147, 102, 1)',                
                        'rgba(0, 151, 146, 1)',
                        'rgba(0, 157, 224, 1)',
                        'rgba(2, 106, 179, 1)',
                        'rgba(147, 17, 126, 1)',
                     ],
                     backgroundColor: [
                        'rgba(230, 70, 22, 0.8)',                
                        'rgba(248, 177, 1, 0.8)',                
                        'rgba(148, 190, 18, 0.8)',                
                        'rgba(0, 147, 102, 0.8)',                
                        'rgba(0, 151, 146, 0.8)',
                        'rgba(0, 157, 224, 0.8)',
                        'rgba(2, 106, 179, 0.8)',
                        'rgba(147, 17, 126, 0.8)',
                        'rgba(230, 70, 22, 0.8)',                
                        'rgba(248, 177, 1, 0.8)',                
                        'rgba(148, 190, 18, 0.8)',                
                        'rgba(0, 147, 102, 0.8)',                
                        'rgba(0, 151, 146, 0.8)',
                        'rgba(0, 157, 224, 0.8)',
                        'rgba(2, 106, 179, 0.8)',
                        'rgba(147, 17, 126, 0.8)',
                     ],


                    data: this.dataBarras,
                    //data: [{'x':'uno', 'y':20}, {'x':'tres', 'y':10}, {'x':'dos', 'y':9},{}, {'x':'cinco', 'y':9}],
                    label: 'Cantidad'
                    }



                    ],

                },
                options: {


        plugins: {
            legend: {
                display: true,
                labels: {
                    color: 'rgb(255, 99, 132)'
                }
            }
        },


                  responsive: true, 
                    scales: {
                        y: {
                            stacked: true
                        }
                    },
 
            layout: {
               padding: {
                  left: 0.1,
                  right: 0.1,
                  top: 0.1,
                  bottom: 0.1
               }
            },

                   
          
                }
            });



            var myPieChart = new Chart(ctx2, {
           
                type: 'doughnut',
                data: {
                    //labels: response.data.month,
                    //labels: response.data.datac,
                    labels: this.dataSedes,
                    datasets: [{
                     //backgroundColor :["#1d7af3","#f3545d","#fdaf4b","#f3000d","#ddaf4b"],
                  //borderWidth: 0,
                     borderWidth: 2,
                     borderColor: [
                        'rgba(255, 255, 255, 1)',                
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',                
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',                
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',                
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',                
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',                
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',                
                        'rgba(255, 255, 255, 1)',
                        'rgba(255, 255, 255, 1)',                
                        'rgba(255, 255, 255, 1)',  
                     ],
                     backgroundColor: [
                        'rgba(230, 70, 22, 0.8)',                
                        'rgba(248, 177, 1, 0.8)',                
                        'rgba(148, 190, 18, 0.8)',                
                        'rgba(0, 147, 102, 0.8)',                
                        'rgba(0, 151, 146, 0.8)',
                        'rgba(0, 157, 224, 0.8)',
                        'rgba(2, 106, 179, 0.8)',
                        'rgba(147, 17, 126, 0.8)',
                        'rgba(230, 70, 22, 0.8)',                
                        'rgba(248, 177, 1, 0.8)',                
                        'rgba(148, 190, 18, 0.8)',                
                        'rgba(0, 147, 102, 0.8)',                
                        'rgba(0, 151, 146, 0.8)',
                        'rgba(0, 157, 224, 0.8)',
                        'rgba(2, 106, 179, 0.8)',
                        'rgba(147, 17, 126, 0.8)',
                     ],

                     hoverOffset: 4,
                    // pointBorderColor: '#2554FF',

                        //label: '# of Votes',
                        //label: response.data.datac,
                        labels: this.dataSedes,
                        //data: response.data.data,
                        data: this.dataPie,
                        
                    }]
                },
                options: {
                  responsive: true, 
                   
          
                }
            });




      },
        


      



        
      




   },


   async created(){
      try   {
         //console.log(this.isWritePermitted)
         //console.log('esto es el permiso')
        // this.getResultsGeneral();
         

         //const [res, resRol, resEmp, resSedFil] = await Promise.all([
         const [resSedFil] = await Promise.all([
               //this.callApi('get', 'app/user'),
               //this.callApi('get', 'app/role'),
               //this.callApi('get', 'app/empresa'),
               this.callApi('get', 'app/getSedes')
            ])
         
         // this.usuario=this.user

           // console.log('el usuario es:',this.usuario)

           
            this.sedeFiltros = resSedFil.data

            //console.log('es el usuario',this.users)
            //console.log('es el usuario logueado ',this.userLogged['permissions'])

         } catch {
            this.$swal('Ocurrio algun error','de','error')
         }
      
      
   },



      

      


   




}




  </script>