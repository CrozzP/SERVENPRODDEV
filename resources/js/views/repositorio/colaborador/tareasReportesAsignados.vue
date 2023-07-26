<template>
<base-layout>
<Breadcrumbs>
  <template v-slot:titulo_breadcrumbs> Asignados
  </template>
  
  <template v-slot:prueba>
      <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li><a href="#">Pendientes</a></li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>

    <li>Tareas Asignadas</li>
    </template>
</Breadcrumbs>

  <div class="card mb-3">
    <div class="card-header d-flex">
      <span>
        <i class="fas fa-chart-area"></i>
          Administrar Tareas
      </span>

    <button class="btn btn-primary btn-sm ml-auto"  v-b-toggle.collapse-1 ><span class="fa fa-filter"></span> Filtro</button>
      
    </div>
    
     <b-collapse id="collapse-1" class="mt-2 marginCard">
       <b-card class="marginCard">
           <b-row>
          <b-col cols="12" md="3">
               <b-card
                 border-variant="primary"
                 align="center"
                 class="marginCard"
              >
               <h6>Seleccione tarea:</h6>
                  <b-card-text>
                     <b-form-checkbox v-model="filtroData.tipoTareaAll" name="check-button" switch  v-on:change="mostrarTipoTarea(filtroData)"  >
                        Tarea - Todos
                     </b-form-checkbox>
                  </b-card-text>
                  <div v-if="mostrarTipoTareas">
                     <b-form-select v-model="filtroData.tipoTarea"  >                                    
                        <b-form-select-option :value="null" disabled>-- Seleccione Tarea --</b-form-select-option>
                        <b-form-select-option :value="tarea.id" v-for="(tarea, i) in tareas" :key="i" v-if="tareas.length">{{tarea.nombre}}</b-form-select-option>
                     </b-form-select>
                  </div>
              </b-card>
         
          </b-col>

          <b-col cols="6" md="3">
               <b-card
               border-variant="primary"
                 align="center"
                 class="marginCard"
              >
              <h6>Seleccione Reporte:</h6>
                  <b-card-text>
                     <b-form-checkbox v-model="filtroData.tareasEstadoAll" name="check-button" switch  v-on:change="mostrarTareasEstado(filtroData)"  >
                        Estado Reporte - Todos
                     </b-form-checkbox>
                  </b-card-text>
                  <div v-if="mostrarTareasEstados">
                     <b-form-select v-model="filtroData.tareasEstado" :options="tareasEstado"></b-form-select>
                  </div>
              </b-card>

          </b-col>
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
                     <b-form-select v-model="filtroData.periodoId"  class="mb-3" name="periodo" >
                           <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                           <b-form-select-option :value="[listPeriodo.id,listPeriodo.nombre]" v-for="(listPeriodo, i) in listPeriodos.data" :key="i" v-if="listPeriodos.data.length" :disabled="listPeriodo.estado == '2' ? false: true" >{{listPeriodo.nombre}}</b-form-select-option>
                     </b-form-select>
                  </div>
                
              </b-card>

         </b-col>

          <b-col cols="6" md="1">
            <button class="btn btn-outline-primary my-2 my-sm-0" @click="getResults"><span class="fas fa-search"></span> Buscars</button>
         </b-col>
      </b-row>
       </b-card>
     </b-collapse>

  

  </div>
    <div class="row">
      <div class="col-md-12  ml-auto mr-auto">
        <div class="card">
          <div class="card-body">
            <div class="row" v-if="mostrar">
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
                                           <h3>Envian notificacion por correo...</h3>
                                        
                                      </b-button>

                                  <!-- We add an SR only text for screen readers -->
                                  
                                </div>
                              </template>

              
                <b-table responsive
                  id="table-transition-example"
                  :items="tareasRepAsi.data"
                  :fields="fields"
                  hover
                  
                  small
                  primary-key="trc_id"
                  :tbody-transition-props="transProps"
                  :tbody-tr-class="rowClass"
                >


                <template #cell(r_nombre)="row">
                  {{row.item.r_nombre}}  
                      <div>
                        <b-badge variant="success" v-if="(row.item.trc_fechalimite > fechas.fechapasmañana) && (row.item.trc_estado == 1)">Te quedan mas de 3 dias</b-badge>
                        <b-badge variant="dark" v-if="(row.item.trc_fechalimite == fechas.fechapasmañana) && (row.item.trc_estado == 1)">Te quedan 3 dias</b-badge>
                        <b-badge variant="primary" v-if="(row.item.trc_fechalimite == fechas.fechamañana) && (row.item.trc_estado == 1)">Te queda 2 dia</b-badge>
                        <b-badge variant="warning" v-if="(row.item.trc_fechalimite == fechas.fechahoy) && (row.item.trc_estado == 1)">Hoy termina su fecha limite</b-badge>
                        <b-badge variant="danger" v-if="(row.item.trc_fechalimite < fechas.fechahoy) && (row.item.trc_estado == 1)">Tu fecha limite fue vencido</b-badge>
                      </div>

                </template>

                <template #cell(opciones)="row">
                    <b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
                        <b-dropdown-item href="#" v-if="isReadPermitted" @click="showAtender(row.item, row.index)" ><button class="btn btn-success btn-sm"  ><span class="fas fa-eye"></span>    </button> Atender Reporte
                        </b-dropdown-item>

                        <b-dropdown-item href="#" v-if="(isReadPermitted) && (row.item.trc_estado == 1) && (row.item.trc_estador != ( 4 ||  6 || 10 || 12)) && (row.item.trc_user_id != row.item.c_user_id) " @click="showSolicitud(row.item, row.index)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-hourglass-end"></span>    </button> Solicitar Ampliacion
                        </b-dropdown-item>

                        <b-dropdown-item href="#" v-if="(isReadPermitted) && (row.item.trc_estado == 1) && (row.item.trc_estador ==4 || row.item.trc_estador ==6 || row.item.trc_estador ==10 || row.item.trc_estador ==12)" @click="showCancelSolicitud(row.item, row.index)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-grin-beam-sweat"></span>    </button> Cancelar Solicitud
                        </b-dropdown-item>
                        <b-dropdown-item href="#" v-if="(isReadPermitted) && (row.item.trc_estado == 1) && (row.item.trc_user_id != row.item.c_user_id)" @click="showDerivar(row.item, row.index)" ><button class="btn btn-warning btn-sm"  ><span class="fas fa-user-friends"></span>    </button> Derivar Reporte
                        </b-dropdown-item>
                        
                    </b-dropdown>

                </template>


                <template #cell(updated_at)="row">

                  <b-button size="sm" @click="row.toggleDetails" v-if="row.item.trc_estador > 3" :variant="(row.item.trc_estador ==4 || row.item.trc_estador ==6 || row.item.trc_estador ==10 || row.item.trc_estador ==12) ? 'warning' : (row.item.trc_estador == 5 || row.item.trc_estador == 7 || row.item.trc_estador == 11 || row.item.trc_estador == 13) ? 'success' : (row.item.trc_estador == 8 || row.item.trc_estador == 9 || row.item.trc_estador == 14 || row.item.trc_estador == 15) ? 'danger' : 'info'">
                    {{ row.detailsShowing ? 'Ocultar' : 'Mostrar' }} Solicitud
                  </b-button>
                </template>
                <template #row-details="row">
                  <b-card>
                     <b-table-simple hover>
                        <b-tbody>
                           <b-tr>
                              <b-th>Estado Solicitud :</b-th>
                              <b-td>{{row.item.er_nombre}}</b-td>
                           </b-tr>
                           <b-tr>
                              <b-th>Fecha Asignada :</b-th>
                              <b-td>{{row.item.s_fechaasignadah_old}}</b-td>
                           </b-tr>
                           <b-tr>
                              <b-th>Fecha Solicitada :</b-th>
                              <b-td>{{row.item.s_fechasolicitadah}}</b-td>
                           </b-tr>
                           <b-tr>
                              <b-th>Fecha Aprobada :</b-th>
                              <b-td>{{row.item.s_fechaasignadah_new}}</b-td>
                           </b-tr>
                        </b-tbody>
                     </b-table-simple>
                     
                  </b-card>
                </template>

                </b-table>
                <div class="card mb-3">               
                  <advanced-laravel-vue-paginate :data="tareasRepAsi" @paginateTo="tareasReportesAsignados"></advanced-laravel-vue-paginate>
                </div>
                </b-overlay>

            </div>


            <div class="row" v-if="mostrarFiltro">

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
                                           <h3>Envian notificacion por correo...</h3>
                                        
                                      </b-button>

                                  <!-- We add an SR only text for screen readers -->
                                  
                                </div>
                              </template>

                <b-table responsive
                  id="table-transition-example"
                  :items="tareasRepAsi.data"
                  :fields="fields"
                  hover
                  
                  small
                  primary-key="trc_id"
                  :tbody-transition-props="transProps"
                  :tbody-tr-class="rowClass"
                >


                <template #cell(r_nombre)="row">
                  {{row.item.r_nombre}}  
                      <div>
                        <b-badge variant="success" v-if="(row.item.trc_fechalimite > fechas.fechapasmañana) && (row.item.trc_estado == 1)">Te quedan mas de 3 dias</b-badge>
                        <b-badge variant="dark" v-if="(row.item.trc_fechalimite == fechas.fechapasmañana) && (row.item.trc_estado == 1)">Te quedan 3 dias</b-badge>
                        <b-badge variant="primary" v-if="(row.item.trc_fechalimite == fechas.fechamañana) && (row.item.trc_estado == 1)">Te queda 2 dia</b-badge>
                        <b-badge variant="warning" v-if="(row.item.trc_fechalimite == fechas.fechahoy) && (row.item.trc_estado == 1)">Hoy termina su fecha limite</b-badge>
                        <b-badge variant="danger" v-if="(row.item.trc_fechalimite < fechas.fechahoy) && (row.item.trc_estado == 1)">Tu fecha limite fue vencido</b-badge>
                      </div>

                </template>

                <template #cell(opciones)="row">
                    <b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
                        <b-dropdown-item href="#" v-if="isReadPermitted" @click="showAtender(row.item, row.index)" ><button class="btn btn-success btn-sm"  ><span class="fas fa-eye"></span>    </button> Atender Reporte
                        </b-dropdown-item>

                        <b-dropdown-item href="#" v-if="(isReadPermitted) && (row.item.trc_estado == 1) && (row.item.trc_estador != ( 4 ||  6 || 10 || 12)) && (row.item.trc_user_id != row.item.c_user_id) " @click="showSolicitud(row.item, row.index)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-hourglass-end"></span>    </button> Solicitar Ampliacion
                        </b-dropdown-item>

                        <b-dropdown-item href="#" v-if="(isReadPermitted) && (row.item.trc_estado == 1) && (row.item.trc_estador ==4 || row.item.trc_estador ==6 || row.item.trc_estador ==10 || row.item.trc_estador ==12)" @click="showCancelSolicitud(row.item, row.index)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-grin-beam-sweat"></span>    </button> Cancelar Solicitud
                        </b-dropdown-item>
                        <b-dropdown-item href="#" v-if="(isReadPermitted) && (row.item.trc_estado == 1) && (row.item.trc_user_id != row.item.c_user_id)" @click="showDerivar(row.item, row.index)" ><button class="btn btn-warning btn-sm"  ><span class="fas fa-user-friends"></span>    </button> Derivar Reporte
                        </b-dropdown-item>
                        
                    </b-dropdown>

                </template>

                <template #cell(updated_at)="row">

                  <b-button size="sm" @click="row.toggleDetails" v-if="row.item.trc_estador > 3" :variant="(row.item.trc_estador ==4 || row.item.trc_estador ==6 || row.item.trc_estador ==10 || row.item.trc_estador ==12) ? 'warning' : (row.item.trc_estador == 5 || row.item.trc_estador == 7 || row.item.trc_estador == 11 || row.item.trc_estador == 13) ? 'success' : (row.item.trc_estador == 8 || row.item.trc_estador == 9 || row.item.trc_estador == 14 || row.item.trc_estador == 15) ? 'danger' : 'info'">
                    {{ row.detailsShowing ? 'Ocultar' : 'Mostrar' }} Solicitud
                  </b-button>
                </template>
                <template #row-details="row">
                  <b-card>
                     <b-table-simple hover>
                        <b-tbody>
                           <b-tr>
                              <b-th>Estado Solicitud :</b-th>
                              <b-td>{{row.item.er_nombre}}</b-td>
                           </b-tr>
                           <b-tr>
                              <b-th>Fecha Asignada :</b-th>
                              <b-td>{{row.item.s_fechaasignadah_old}}</b-td>
                           </b-tr>
                           <b-tr>
                              <b-th>Fecha Solicitada :</b-th>
                              <b-td>{{row.item.s_fechasolicitadah}}</b-td>
                           </b-tr>
                           <b-tr>
                              <b-th>Fecha Aprobada :</b-th>
                              <b-td>{{row.item.s_fechaasignadah_new}}</b-td>
                           </b-tr>
                        </b-tbody>
                     </b-table-simple>
                     
                  </b-card>
                </template>

                </b-table>
                <div class="card mb-3">               
                  <advanced-laravel-vue-paginate :data="tareasRepAsi" @paginateTo="getResults"></advanced-laravel-vue-paginate>
                </div>
                </b-overlay>


            </div>

          </div>
        </div>
      </div>
    </div>
  
<b-modal  hide-footer v-model="atenderModal" title="Atender Reporte" :mask-closable="false" :closable="false" size="xl">

  
      <b-tabs
          v-model="tabIndex"
          active-nav-item-class="font-weight-bold text-uppercase text-danger"
          active-tab-class="font-weight-bold text-success"
          content-class="mt-3"
          vertical
        >
          <b-tab title="Detalle del Reporte" active>
               <b-card >
             
                  <b-table-simple hover small caption-top stacked>
          
                    <b-tbody>
                      <b-tr>
                        <b-th rowspan="3" class="text-center">Detalles del Reporte <b style="color: #db14bc;" >{{datoRegAtender.dt_tr_periodo_nombre}}</b> </b-th>
                        <b-td stacked-heading="Nombre : " class="text-left"> {{ datoRegAtender.dt_r_nombre }} </b-td>
                        <b-td stacked-heading="Descripcion : " class="text-left">{{ datoRegAtender.dt_r_descripcion }}</b-td>
                        <b-td stacked-heading="Fecha Asignada : " class="text-left">{{ datoRegAtender.dt_trc_fechaasignacionh }}</b-td>
                        <b-td stacked-heading="Fecha Final :" variant="success" class="text-left">{{ datoRegAtender.dt_trc_fechalimite }}</b-td>
                        <b-td stacked-heading="Fecha de Subida : " class="text-left">{{ datoRegAtender.dt_trc_fechaatencionh }}</b-td>
                      </b-tr>
                     
                      
                    </b-tbody>
                    
                  </b-table-simple>
            
               </b-card>
          </b-tab>

          <b-tab title="Cargar Archivo">
                <b-card v-if="(documentos.length != 0) && (documentos.estadoarchivo > 0) ? false: true">
                    <div >
                      <label for="example-datepicker">Seleccionar Archivo :</label>
                      <b-form-file
                          v-model="datoReg.archivo"
                          :state="Boolean(datoReg.archivo)"
                          placeholder="Choose a file or drop it here..."
                          drop-placeholder="Drop file here..."
                          
                         
                          :disabled="(documentos.length != 0) && (documentos.estadoarchivo > 0) ? true: false" 
                        ></b-form-file>
                      
                     
                    </div>
                    <br>
                    <div>
                     
                            <b-button block variant="outline-danger" @click="regDocumento(datoRegAtender, datoRegAtender.index)" 
                          :disabled="(documentos.length != 0) && (documentos.estadoarchivo > 0) ? true: false" >Guardar Archivo</b-button>
                            
                    </div>
                    
               </b-card>
               <b-card v-if="(documentos.length == 0) ? false: true">
                      <b-form-group id="input-group-1" label="Validar Archivo:" label-for="id">
                              
                          <b-form-checkbox switch  value="1" unchecked-value="0" @change='getHabilitar(datoRegAtender, datoRegAtender.index )' v-model="documentos.estadoarchivo" size="lg" :disabled="(userA.roleAd == '1') ? false : ((documentos.estadoarchivo == '1') && (userColaborador.user_id != datoRegAtender.dt_trc_user_id)) ? true : false"></b-form-checkbox>
                      </b-form-group>
               </b-card>
               <div >
                  <b-button block  variant="success" v-if="datoRegAtender.dt_trc_estador == 1">Asignado</b-button>
                  <b-button block  variant="warning" v-if="datoRegAtender.dt_trc_estador > 1">Derivado <b-badge variant="light">{{datoRegAtender.dt_trc_estador}}</b-badge></b-button>
               </div>
               <b-card v-if="documentos.length != 0" >
                  <b-card-title>Archivo
                  </b-card-title>
                      
                        <b-button variant="warning" size="xl" v-if="(documentos.extencion == 'txt' || documentos.extencion == 'csv')" >
                          <span class="fas fa-file-alt fa-2x"></span>
                        </b-button>

                        <b-button variant="primary" size="xl" v-if="(documentos.extencion == 'doc' || documentos.extencion == 'docx')">
                          <span class="fas fa-file-word fa-2x"></span>
                        </b-button>

                        <b-button variant="danger" size="xl" v-if="documentos.extencion == 'pdf'" >
                          <span class="fas fa-file-pdf fa-2x"></span>
                        </b-button>

                        <b-button variant="success" size="xl" v-if="(documentos.extencion == 'xlc' || documentos.extencion == 'xlsx')" >
                          <span class="fas fa-file-excel fa-2x"></span>
                        </b-button>

                       
                        <div>
                          <h6 class="mb-2">
                            <b>
                              
                              <b-link  @click="descargarArchivo(documentos)">Descargar <small> archivo</small></b-link>
                            </b>
                          </h6>
                          <small class="text-muted">{{documentos.nombre}}</small>
                        </div>


                        <footer >
                   
                             <b-button block variant="danger" :disabled="(documentos.length != 0) && (documentos.estadoarchivo > 0) ? true: false" @click="eliminarArchivo(documentos,datoRegAtender.index )">
                               Eliminar Archivo <span class="fas fa-trash-alt "></span>
                             </b-button>
                        </footer>

                           
               </b-card>
          </b-tab>
          <b-tab title="Informacion Solicitada" v-if="(datoRegAtender.dt_r_tipoinformacion == 2 || datoRegAtender.dt_r_tipoinformacion ==  3 || datoRegAtender.dt_r_tipoinformacion ==  4 || datoRegAtender.dt_r_tipoinformacion ==  5)">
               <b-card  >
                  <b-row>
                     <b-col xl="4" lg="4" sm="12">
                        <b-card  >
                          <b-form-group
                             id="input-group-1"
                             label="MT"
                           >
                                <b-form-input
                                    size="sm"
                                  id="input-1"
                                  v-model="informacion.mt"
                                  type="number"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaNoResidencial(informacion);"
                                  required
                                ></b-form-input>
                              </b-form-group>
                             <b-form-group
                                id="input-group-1"
                                label="BT"
                              >
                                <b-form-input
                                    size="sm"
                                  id="input-1"
                                  v-model="informacion.bt"
                                  type="number"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaNoResidencial(informacion);"
                                  required
                                ></b-form-input>
                              </b-form-group>

                           <b-alert show variant="warning">
                              <p class="mb-0"> <strong>Calculo  No residencial</strong>
                                 {{ calculos.snr }}
                              </p>
                           </b-alert>
                           
                          <b-form-group
                             id="input-group-1"
                             label="NO RESIDENCIAL"
                           >
                             <b-form-input
                                 size="sm"
                               id="input-1"
                               v-model="informacion.no_residencial"
                               type="number"
                               :state="validationNR"
                              v-on:keyup="sumaSubTotalRegulado()"
                               required
                             ></b-form-input>
                              <b-form-invalid-feedback  v-if="validationNR == false">
                                 Numero consignado no es igual al valor calculado
                              </b-form-invalid-feedback>
                              <b-form-valid-feedback  v-if="validationNR == true">
                                Igualdad correcta al valor calculado
                              </b-form-valid-feedback>
                           </b-form-group>

                        </b-card>
                     </b-col>
                     <b-col xl="8" lg="8" sm="12">
                        <b-card  >
                        <b-row>
                           <b-col>

                             <b-form-group
                                id="input-group-1"
                                label="<0 a 30]"
                              >
                                <b-form-input
                                 size="sm"
                                  id="input-3"
                                  v-model="informacion.cero_treinta"
                                  type="number"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaResidencial_BT(informacion);"
                                  required
                                ></b-form-input>
                              </b-form-group>
                             <b-form-group
                                id="input-group-1"
                                label="<30 a 100]"
                              >
                                <b-form-input
                                 size="sm"
                                  id="input-3"
                                  v-model="informacion.treinta_cien"
                                  type="number"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaResidencial_BT(informacion);"
                                  required
                                ></b-form-input>
                              </b-form-group>
                             <b-form-group
                                id="input-group-1"
                                label="<100 a 150]"
                              >
                                <b-form-input
                                 size="sm"
                                  id="input-3"
                                  v-model="informacion.cien_ccincuenta"
                                  type="number"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaResidencial_BT(informacion);"
                                  required
                                ></b-form-input>
                              </b-form-group>
                           </b-col>

                           <b-col>
                             <b-form-group
                                id="input-group-1"
                                label="<150 a 300]"
                              >
                                <b-form-input
                                 size="sm"
                                  id="input-3"
                                  v-model="informacion.ccincuenta_trecientos"
                                  type="number"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaResidencial_BT(informacion);"
                                  required
                                ></b-form-input>
                              </b-form-group>
                             <b-form-group
                                id="input-group-1"
                                label="<300 a 500]"
                              >
                                <b-form-input
                                 size="sm"
                                  id="input-3"
                                  v-model="informacion.trecientos_quinientos"
                                  type="number"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaResidencial_BT(informacion);"
                                  required
                                ></b-form-input>
                              </b-form-group>
                             <b-form-group
                                id="input-group-1"
                                label=">500"
                              >
                                <b-form-input
                                 size="sm"
                                  id="input-3"
                                  v-model="informacion.mas_quinientos"
                                  type="number"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaResidencial_BT(informacion);"
                                  required
                                ></b-form-input>
                              </b-form-group>
                           </b-col>
                        </b-row>
                        <b-row>
                           <b-col >
                             <b-form-group
                                id="input-group-1"
                                label=" RESIDENCIAL (BT):"
                              >
                                <b-form-input
                                 size="sm"
                                  id="input-1"
                                  v-model="informacion.residencial_bt"
                                  type="number"
                                  :state="validationBT"
                                  placeholder="00.0000"
                                   v-on:keyup="sumaSubTotalRegulado()"
                                  required
                                ></b-form-input>
                                 <b-form-invalid-feedback  v-if="validationBT == false">
                                    Numero consignado no es igual al valor calculado
                                 </b-form-invalid-feedback>
                                 <b-form-valid-feedback  v-if="validationBT == true">
                                   Igualdad correcta al valor calculado
                                 </b-form-valid-feedback>
                              </b-form-group>
                           </b-col>
                           <b-col>

                           <b-alert show variant="warning">
                              <p class="mb-0"> <strong>Calculo  Residencial BT</strong>
                                 {{ calculos.residencial_bt }}
                              </p>
                           </b-alert>
                           </b-col>
                        </b-row>
                     </b-card  >
                     </b-col>
                  </b-row>
                  <b-row>
                     <b-col xl="8" lg="8" sm="12">
                     <b-card>
                        <b-row>
                           <b-col xl="5" lg="5" sm="12">

                              <b-alert show variant="success">
                                 <p class="mb-0"> <strong>Calculo Sub Total Regulado</strong>
                                    {{calculos.str}}
                                 </p>
                              </b-alert>

                           </b-col>
                           <b-col xl="7" lg="7" sm="12">
                             <b-form-group
                                id="input-group-1"
                                label="SUB TOTAL REGULADO :"
                              >
                                <b-form-input
                                    size="sm"
                                  id="input-1"
                                  v-model="informacion.st_regulado"
                                  type="number"
                                  placeholder="00.0000"
                                  :state="validationSTR"
                                  v-on:keyup="sumaTotal()"
                                  required
                                ></b-form-input>
                                 <b-form-invalid-feedback  v-if="validationSTR == false">
                                    Numero consignado no es igual al valor calculado
                                 </b-form-invalid-feedback>
                                 <b-form-valid-feedback  v-if="validationSTR == true">
                                   Igualdad correcta al valor calculado
                                 </b-form-valid-feedback>
                              </b-form-group>

                           </b-col>
                        </b-row>

                     </b-card>
                     </b-col>
                     
                     <b-col xl="4" lg="4" sm="12">
                     <b-card  >
                       <b-form-group
                          id="input-group-1"
                          label="SUB TOTAL LIBRE :"
                        >
                          <b-form-input
                              size="sm"
                            id="input-1"
                            v-model="informacion.st_libre"
                            type="number"
                            placeholder="00.0000"
                           v-on:keyup="sumaTotal()"
                            required
                          ></b-form-input>
                        </b-form-group>
                     </b-card  >

                     </b-col>
                     
                        
                     

                  </b-row>

                  <b-row>
                     <b-col>
                     <b-card>
                        <b-row>
                           <b-col xl="5" lg="5" sm="12">

                              <b-alert show variant="success">
                                 <p class="mb-0"> <strong>Calculo Total</strong>
                                    {{calculos.total}}
                                 </p>
                              </b-alert>

                           </b-col>
                           <b-col xl="7" lg="7" sm="12">
                             <b-form-group
                                id="input-group-1"
                                label="TOTAL :"
                              >
                                <b-form-input
                                    size="sm"
                                  id="input-1"
                                  v-model="informacion.total"
                                  type="number"
                                  placeholder="00.0000"
                                  :state="validationT"
                                  required
                                ></b-form-input>
                                 <b-form-invalid-feedback  v-if="validationT == false">
                                    Numero consignado no es igual al valor calculado
                                 </b-form-invalid-feedback>
                                 <b-form-valid-feedback  v-if="validationT == true">
                                   Igualdad correcta al valor calculado
                                 </b-form-valid-feedback>
                              </b-form-group>

                           </b-col>
                        </b-row>

                     </b-card>
                     </b-col>
                  </b-row>


                    <div>
                     
                            <b-button block variant="outline-danger" @click="regInformacion(informacion)" 
                          :disabled="(documentos.length != 0) && (documentos.estadoarchivo > 0) ? true: false" >Registrar Informacion</b-button>
                            
                    </div>
            </b-card>
          </b-tab>



          <b-tab title="Informacion Solicitada" v-if="(datoRegAtender.dt_r_tipoinformacion == 11)">
            <b-card  >
                  

                    <b-form inline
                       id="input-group-1"
                       label=" PORCENTAJE:"
                     >
                       <b-form-input
                        size="sm"
                         id="input-1"
                         v-model="informacion.porcentaje"
                         type="number"
                         placeholder="00.00 "
                          
                         required
                       ></b-form-input> <strong>%</strong>
                     </b-form> 
                  

                  <div>
                     
                     <b-button block variant="outline-danger" @click="regInformacion(informacion)" :disabled="(documentos.length != 0) && (documentos.estadoarchivo > 0) ? true: false" >Registrar Informacion</b-button>
                            
                  </div>

            </b-card>
          </b-tab>
            


      </b-tabs>

</b-modal>


<b-modal  hide-footer v-model="solicitudModal" title="Solicitar Ampliacion de Reporte" :mask-closable="false" :closable="false" size="sm" >
   



         <b-form-group id="input-group-3" label="Fecha - propuesta" label-for="input-3">
           <b-form-datepicker id="example-datepicker" v-model="dataRegistro.fechapropuesta" class="mb-2"></b-form-datepicker>
         </b-form-group> 

         <b-form-group id="input-group-3" label="Hora - propuesta" label-for="input-3">
           <b-form-timepicker v-model="dataRegistro.fechapropuestah" locale="en"></b-form-timepicker>
         </b-form-group>  

         <b-form-group id="input-group-3" label="Fudamento" label-for="input-3">
           <b-form-textarea
              id="textarea-default"
              rows="8"
              placeholder="Especifique el sustento de la solicitud"
              v-model="dataRegistro.fundamento"
            ></b-form-textarea>
         </b-form-group>  

        <b-button block variant="primary"  @click="solicitarAmpliacion(datoRegAtender)">
          Enviar Solicitud 
        </b-button>


</b-modal>
<b-modal  hide-footer v-model="derivarModal" title="Derivar Reporte" :mask-closable="false" :closable="false" size="sm">
       
         <b-form-group id="input-group-3" label="Seleccione Colaborador:" label-for="input-3">
           <b-form-select v-model="dataRegistro.colaborador_id"   class="mb-3" name="colaboradores" >
               
               <b-form-select-option :value="null" disabled>-- Seleccione al Colaborador--</b-form-select-option>
             
               <b-form-select-option :value="colaborador.id" v-for="(colaborador, i) in colaboradores" :key="i" v-if="colaboradores.length">{{colaborador.nombre}}</b-form-select-option>
             
           </b-form-select>
         </b-form-group>



         <b-form-group id="input-group-3" label="Seleccione el Motivo" label-for="input-3">

           <b-form-select v-model="dataRegistro.motivo_id"   class="mb-3" name="colaboradores" >
               
               <b-form-select-option :value="null" disabled>-- Seleccione el motivo--</b-form-select-option>
             
               <b-form-select-option :value="motivo.id" v-for="(motivo, i) in derive" :key="i" v-if="derive.length">{{motivo.nombre}}</b-form-select-option>
             
           </b-form-select>

         </b-form-group>  
           
        <b-button block variant="warning"  @click="derivarRegistro(datoRegAtender)">
          Derivar 
        </b-button>
     

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
      data : {
        
      },
      

    

      atenderModal: false,
      solicitudModal: false,
      solicitudCancelarModal: false,
      derivarModal: false,
      mostrarFiltro: false,
      mostrar: true,
      mostrarTipoTareas: false,
      mostrarTareasEstados: false,
      mostrarColaboradores: false,
      mostrarPeriodos: false,
      cargaremail: false,

      tareas:[],
      filtroData:{},
      tareasRepAsi:[],
      tareasRepAsiFiltro:[],
      fechas:[],
      userColaborador:[],
      colaboradores:[],
      tareaReporte:[],
      listRegAsig:[],
      selectedIndex: 0,
      itemsEjm: [
          { a: 2, b: 'Two', c: 'Moose' },
          { a: 1, b: 'Three', c: 'Dog' },
          { a: 3, b: 'Four', c: 'Cat' },
          { a: 4, b: 'One', c: 'Mouse' }
        ],
        ejemplo: [
          { key: 'a', sortable: true },
          { key: 'b', sortable: true },
          { key: 'c', sortable: true }
        ],

        fieldsL: [
          { key: 'id',label:'#', sortable: true, stickyColumn: true, isRowHeader: true},
          { key: 'colaborador.nombre',label:'COLABORADOR', sortable: true, stickyColumn: true },
          { key: 'tarea_reporte.reportes.nombre',label:'REPORTE', sortable: true },
          { key: 'acciones',label:'ACCIONES', sortable: true },
          { key: 'tarea_reporte.tareas.nombre',label:'Estado', sortable: true },
          { key: 'empresacolaborador_id',label:'empresa col id', sortable: true },
          { key: 'fechalimite',label:'tar rep id', sortable: true }
        ],


           tareasEstado: [
            
             { value: null, text: 'Seleccione estado del reporte' },
             { value: '3', text: 'Listo' },
             { value: '2', text: 'Falta Validar' },
             { value: '1', text: 'Sin Atender' }
             
           ],


      dataRegistro:{
      },


      filtro:{
        tipoBusqueda:'null',
      },

       transProps: {
          // Transition name
          name: 'flip-list'
        },

     
        fields: [
          { key: 'trc_id',label:'#', sortable: true, stickyColumn: true, isRowHeader: true},
          { key: 't_nombre',label:'TAREA', sortable: true},
          { key: 'r_nombre',label:'REPORTE', sortable: true },
          { key: 'p_nombre',label:'PERIODO', sortable: true },
          { key: 'opciones',label:'OPCIONES', sortable: true },
          { key: 'updated_at',label:'OPCIONES', sortable: true },

        ],
        
        tiposolicitudes: [
          { value: null, text: 'Seleccione el motivo', disabled: true },
          { value: 1, text: 'Delegar reporte'  },
          { value: 2, text: 'No corresponde' },
          { value: 3, text: 'Otros' },
        ],
        
        options: [
          { value: null, text: 'Please select an option' },
          { value: '1', text: '202101', disabled: true  },
          { value: '2', text: '202102', disabled: true  },
          { value: '3', text: '202103' },
        ],
        
       /* derive: [
          { value: null, text: 'Please select an option' },
          { value: '1', text: '202101', disabled: true  },
          { value: '2', text: '202102', disabled: true  },
          { value: '3', text: '202103' },
        ],
        */
        derive:[],

        datoRegAtender:{},

        filtroData:{
         tipoTareaAll: true,
         tareasEstadoAll: true,
         colaboradorAll: true,
         periodoIdAll: true,
         periodoId:[],
        },

        datoReg:{
        //  periodo: 3,
        },
        listPeriodos:[],
        documentos:[],
        userA:[],
        colaboradores:[],
        toastCount: 0,
        calculos:{
         snr: 0,
         str: 0,
         total: 0,
         residencial_bt: 0,
        },
        informacion:{
         
        },

       
    }
  },


  methods : {

   
   sumaNoResidencial(snr) {
      //console.log('********',snr.mt)
      //$snr = 0;
      //this.calculos.snr = parseFloat(snr.mt) + parseFloat(snr.bt);
      this.p_mt = parseFloat(this.informacion.mt)
      this.p_bt = parseFloat(this.informacion.bt)
         
      //this.calculos.snr = parseFloat(this.informacion.mt) + parseFloat(this.informacion.bt);
      this.calculos.snrr = this.p_mt + this.p_bt;
      this.calculos.snr = this.calculos.snrr.toFixed(4);

           
     // console.log('********',this.calculos.snr)
     
      
   },
   
   sumaResidencial_BT(str) {
      console.log('********',str)
      //$snr = 0;
      //this.calculos.snr = parseFloat(snr.mt) + parseFloat(snr.bt);
      this.p_cero_treinta = parseFloat(this.informacion.cero_treinta)
      this.p_treinta_cien = parseFloat(this.informacion.treinta_cien)
      this.p_cien_ccincuenta = parseFloat(this.informacion.cien_ccincuenta)
      this.p_ccincuenta_trecientos = parseFloat(this.informacion.ccincuenta_trecientos)
      this.p_trecientos_quinientos = parseFloat(this.informacion.trecientos_quinientos)
      this.p_mas_quinientos = parseFloat(this.informacion.mas_quinientos)
    //     
    //  //this.calculos.snr = parseFloat(this.informacion.mt) + parseFloat(this.informacion.bt);
      this.calculos.residencial_btt = this.p_cero_treinta + this.p_treinta_cien + this.p_cien_ccincuenta + this.p_ccincuenta_trecientos + this.p_trecientos_quinientos + this.p_mas_quinientos;
      this.calculos.residencial_bt = this.calculos.residencial_btt.toFixed(4);

           
      console.log('********',this.calculos.residencial_bt)
     
      
   },
   
   sumaSubTotalRegulado() {
      //console.log('+++++++',this.informacion)


      this.p_no_residencial = parseFloat(this.informacion.no_residencial)
      this.p_residencial_bt = parseFloat(this.informacion.residencial_bt)
      //this.p_st_libre = parseFloat(this.informacion.st_libre)
      
      this.calculos.strr = this.p_no_residencial + this.p_residencial_bt;
      this.calculos.str = this.calculos.strr.toFixed(4);
           
      console.log('______',this.calculos.totall)
      console.log('++++++',this.calculos.total)
      
   },
   
   sumaTotal() {
      //console.log('+++++++',this.informacion)


      //this.p_no_residencial = parseFloat(this.informacion.no_residencial)
      //this.p_st_regulado = parseFloat(this.informacion.st_regulado)
      this.p_st_libre = parseFloat(this.informacion.st_libre)
      this.p_st_regulado = parseFloat(this.informacion.st_regulado)
      
      this.calculos.totall =  this.p_st_regulado + this.p_st_libre;
      this.calculos.total = this.calculos.totall.toFixed(4);
           
      console.log('______',this.calculos.totall)
      console.log('++++++',this.calculos.total)
      
   },

   mostrarTipoTarea(filtroDatos) {
      console.log('filtros 1________:', filtroDatos)

            if (this.filtroData.tipoTareaAll==false) {

               this.mostrarTipoTareas=true
            
                  console.log('verdadero------------',this.filtroData.tipoTareaAll)

            }else{

               this.mostrarTipoTareas=false
                  console.log('falso--------------',this.filtroData.tipoTareaAll)
            }
            
          
        },

   mostrarTareasEstado(filtroDatos) {
      console.log('filtros 2________:', filtroDatos)

            if (this.filtroData.tareasEstadoAll==false) {
               console.log('verdadero------------',this.filtroData.tareasEstadoAll)
               this.mostrarTareasEstados=true
            


            }else{

               console.log('falso------------',this.filtroData.tareasEstadoAll)
               this.mostrarTareasEstados=false
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

    
     

     rowClass(listRegAsig, type) {
     //console.log('dentritossssssss',listRegAsig.r_estado )
     //console.log('fecha_hoy',this.fecha_hoy )
       // if (!listRegAsig || type != 'row') return
       // //if (listRegAsig.r_estado == '1') return 'table-success'
       // if ((listRegAsig.t_totalasignado == listRegAsig.t_totalatendido) && (listRegAsig.t_totalatendido > 0)) return 'table-success'
       // if (listRegAsig.t_totalasignado == '2') return 'table-warning'

       //if (listRegAsig.trc_estado == '1') return 'table-primary'
       if (listRegAsig.trc_estado == '2') return 'table-warning'
       if (listRegAsig.trc_estado == '3') return 'table-success'
      },

    
    
    
    tareasReportesAsignados(page = 1) {
          axios.get('app/tareasReportesAsignados?page=' + page,{
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
                  console.log('datos buscados//////////////////',response.data )
                  this.tareasRepAsi= response.data.tareasReportesAsignados
                  this.fechas= response.data.fechas
                  this.userColaborador= response.data.userColaborador

                 
                  this.makeToast(response.data);
                  //console.log(response.data)
                });


          
          
    }, 

    getObsDerivado() {
          axios.get('app/getObsDerivado',{
             params: {
                //tipoSearch: this.searchData.tipoSearch,
                //search: this.searchData.search

             }
          })
              .then(response => {
                  //this.buscarExtraordinarios = response.data;
                  
                  this.derive= response.data

                 
                });  
    },

    getResults(page = 1) {


         axios.get('app/tareasReportesAsignadosFiltro?page=' + page,{
             params: {
               tipoTareaAll: this.filtroData.tipoTareaAll,
               tareasEstadoAll: this.filtroData.tareasEstadoAll,
               colaboradorAll: this.filtroData.colaboradorAll,
               periodoIdAll: this.filtroData.periodoIdAll,

               tipoTarea: this.filtroData.tipoTarea,
               tareasEstado: this.filtroData.tareasEstado,
               colaborador: this.filtroData.colaborador,
               periodoId: this.filtroData.periodoId[0],

             }
          })
             .then(response => {
               this.tareasRepAsi= response.data.tareasReportesAsignados
               this.fechas= response.data.fechas

               this.mostrarFiltro = true
               this.mostrar = false

              
               this.makeToast(response.data);
             });
     },

    getFiltroTRA(watchFiltros) {
console.log('dentro del get________________________:::::',watchFiltros)
this.page='1'
         axios.get('app/tareasReportesAsignadosFiltro?page=' + this.page,{
             params: {
               tipoTareaAll: watchFiltros.tipoTareaAll,
               tareasEstadoAll: watchFiltros.tareasEstadoAll,
               colaboradorAll: watchFiltros.colaboradorAll,
               periodoIdAll: watchFiltros.periodoIdAll,

               tipoTarea: watchFiltros.tipoTarea,
               periodoId: watchFiltros.periodoId,
               //tareasEstado: watchFiltros.tareasEstado,



             }
          })
             .then(response => {
               this.tareasRepAsi= response.data.tareasReportesAsignados
               this.fechas= response.data.fechas

               this.mostrarFiltro = true
               this.mostrar = false

              
               this.makeToast(response.data);
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

      showSolicitud(regAtender, index){
         console.log('modalllll-----showSolicitud----',regAtender)

        let obj ={
            dt_r_descripcion: regAtender.r_descripcion,
            dt_r_estado: regAtender.r_estado,
            dt_r_nombre: regAtender.r_nombre,
            dt_r_oficina: regAtender.r_oficina,
            dt_r_tipo: regAtender.r_tipo,
            dt_r_tipoinformacion: regAtender.r_tipoinformacion_id,
            dt_t_descripcion: regAtender.t_descripcion, 
            dt_t_estado: regAtender.t_estado,
            dt_t_nombre: regAtender.t_nombre, 
            dt_tr_estado: regAtender.tr_estado,
            dt_tr_estadoasignado: regAtender.tr_estadoasignado,
            dt_tr_reporte: regAtender.tr_reporte,
            dt_tr_tarea: regAtender.tr_tarea,
            dt_trc_empresacolaborador: regAtender.trc_empresacolaborador,
            dt_trc_estado: regAtender.trc_estado,
            dt_trc_estador: regAtender.trc_estador,
            dt_trc_fechaatencion: regAtender.trc_fechaatencion,
            dt_trc_fechaatencionh: regAtender.trc_fechaatencionh,
            dt_trc_fechalimite: regAtender.trc_fechalimite,
            dt_trc_fechaasignacionh: regAtender.trc_fechaasignacionh,
            dt_trc_id: regAtender.trc_id,
            dt_trc_user_id: regAtender.trc_user_id,
            dt_trc_tareareporte: regAtender.trc_tareareporte,
            dt_tr_periodo_id: regAtender.tr_periodo_id,
            dt_tr_periodo_nombre: regAtender.p_nombre,

            index: index,
      }
     
     this.datoRegAtender = obj

       // this.documentoReporte(this.datoRegAtender);
        this.solicitudModal=true

      },

      showCancelSolicitud(regAtender, index){
         console.log('modalllll-----showcancelSolicitud----',regAtender)

        let obj ={
            dt_r_descripcion: regAtender.r_descripcion,
            dt_r_estado: regAtender.r_estado,
            dt_r_nombre: regAtender.r_nombre,
            dt_r_oficina: regAtender.r_oficina,
            dt_r_tipo: regAtender.r_tipo,
            dt_r_tipoinformacion: regAtender.r_tipoinformacion_id,
            dt_t_descripcion: regAtender.t_descripcion, 
            dt_t_estado: regAtender.t_estado,
            dt_t_nombre: regAtender.t_nombre, 
            dt_tr_estado: regAtender.tr_estado,
            dt_tr_estadoasignado: regAtender.tr_estadoasignado,
            dt_tr_reporte: regAtender.tr_reporte,
            dt_tr_tarea: regAtender.tr_tarea,
            dt_trc_empresacolaborador: regAtender.trc_empresacolaborador,
            dt_trc_estado: regAtender.trc_estado,
            dt_trc_estador: regAtender.trc_estador,
            dt_trc_fechaatencion: regAtender.trc_fechaatencion,
            dt_trc_fechaatencionh: regAtender.trc_fechaatencionh,
            dt_trc_fechalimite: regAtender.trc_fechalimite,
            dt_trc_fechaasignacionh: regAtender.trc_fechaasignacionh,
            dt_trc_id: regAtender.trc_id,            
            dt_trc_user_id: regAtender.trc_user_id,
            dt_trc_tareareporte: regAtender.trc_tareareporte,
            dt_tr_periodo_id: regAtender.tr_periodo_id,
            dt_tr_periodo_nombre: regAtender.p_nombre,

            index: index,
      }
     
         this.datoRegAtender = obj

       // this.documentoReporte(this.datoRegAtender);
        //this.solicitudCancelarModal=true

        this.$swal({
                title: '¿ Estas seguro ?',
                text: 'No puedes revertir despues de esta accion',
                icon: 'warning',
                
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Cancelar Solicitud!',
                cancelButtonText: 'No, Mantener Solicitud!',
                showCloseButton: true,
                showLoaderOnConfirm: true
              }).then((result) => {
                if(result.value) {
                  this.solicitaCancelarAmpliacion(this.datoRegAtender)
                  //this.$swal('Cancelado', 'Usted cancelo la solicitud de ampliacion corecctamente', 'success')
                } else {
                  this.$swal('Resguardado', 'Usted mantiene la solicitud de ampliacion', 'info')
                }
              })

      },

      showDerivar(regAtender, index){
         console.log('modalllll----showDerivar-----',regAtender)

        let obj ={
            dt_r_descripcion: regAtender.r_descripcion,
            dt_r_estado: regAtender.r_estado,
            dt_r_nombre: regAtender.r_nombre,
            dt_r_oficina: regAtender.r_oficina,
            dt_r_tipo: regAtender.r_tipo,
            dt_r_tipoinformacion: regAtender.r_tipoinformacion_id,
            dt_t_descripcion: regAtender.t_descripcion, 
            dt_t_estado: regAtender.t_estado,
            dt_t_nombre: regAtender.t_nombre, 
            dt_tr_estado: regAtender.tr_estado,
            dt_tr_estadoasignado: regAtender.tr_estadoasignado,
            dt_tr_reporte: regAtender.tr_reporte,
            dt_tr_tarea: regAtender.tr_tarea,
            dt_trc_empresacolaborador: regAtender.trc_empresacolaborador,
            dt_trc_estado: regAtender.trc_estado,
            dt_trc_estador: regAtender.trc_estador,
            dt_trc_fechaatencion: regAtender.trc_fechaatencion,
            dt_trc_fechaatencionh: regAtender.trc_fechaatencionh,
            dt_trc_fechalimite: regAtender.trc_fechalimite,
            dt_trc_fechaasignacionh: regAtender.trc_fechaasignacionh,
            dt_trc_id: regAtender.trc_id,
            dt_trc_user_id: regAtender.trc_user_id,
            dt_trc_tareareporte: regAtender.trc_tareareporte,
            dt_tr_periodo_id: regAtender.tr_periodo_id,
            dt_tr_periodo_nombre: regAtender.p_nombre,
            dt_ec_colaborador_id: regAtender.ec_colaborador_id,

            index: index,
      }
     
     this.datoRegAtender = obj

       // this.documentoReporte(this.datoRegAtender);
       this.dataRegistro.colaborador_id = this.datoRegAtender.dt_ec_colaborador_id

        this.derivarModal=true
        this.getObsDerivado()




      //  this.derivarRegistro(datoRegAtender)

      },

   async solicitarAmpliacion(registro){


      console.log('------------------holitas desde solicitarAmpliacion----------',registro)
      //console.log('+++++++++-holitas desde dataRegistro+++++++++++',this.dataRegistro)
      //console.log('this.dataRegistro.motivo_id',this.dataRegistro.motivo_id)

         const [ res] = await Promise.all([
           this.callApi('post', 'app/solicitarAmpliacion', {
             
              trc_id  : registro.dt_trc_id,
              fechaasignadah_old : registro.dt_trc_fechaasignacionh,

              fechasolicitada : this.dataRegistro.fechapropuesta,
              fechasolicitadah : this.dataRegistro.fechapropuestah,
              fundamento : this.dataRegistro.fundamento,
              //tiposolicitud_id  : this.dataRegistro.tiposolicitud_id,
            })
           ])

         if (res.status==200) {
            console.log('index_______________',this.tareasRepAsi.data[registro.index]);
            console.log('response____________',res.data);

        
            this.tareasRepAsi.data[registro.index].trc_estador = res.data['trc_old'].estador
            this.tareasRepAsi.data[registro.index].er_nombre = 'Precione F5 / actualice la pagina'

            this.tareasRepAsi.data[registro.index].s_fechaasignada_new = res.data['solicitudes'].fechaasignada_new
            this.tareasRepAsi.data[registro.index].s_fechaasignadah_new = res.data['solicitudes'].fechaasignadah_new
            this.tareasRepAsi.data[registro.index].s_fechaasignada_old = res.data['solicitudes'].fechaasignada_old
            this.tareasRepAsi.data[registro.index].s_fechaasignadah_old = res.data['solicitudes'].fechaasignadah_old
            this.tareasRepAsi.data[registro.index].s_fechasolicitada = res.data['solicitudes'].fechasolicitada
            this.tareasRepAsi.data[registro.index].s_fechasolicitadah = res.data['solicitudes'].fechasolicitadah
            this.tareasRepAsi.data[registro.index].s_fundamento = res.data['solicitudes'].fundamento
            //this.tareasRepAsi.data[registro.index].ec_colaborador_id = res.data['trc'].empresacolaborador_id
            //this.tareasRepAsi.data[registro.index].trc_estador = res.data['trc'].estador
            this.solicitudModal=false
            //this.$swal('Su solicitud se registro','Exitosamente','success')
            this.cargaremail = true
            this.getSolicitudNotification(res.data)

              this.dataRegistro.fechapropuesta = ''
              this.dataRegistro.fechapropuestah = ''
              this.dataRegistro.fundamento = ''

       
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
                   timer: 6000
                 });
               
             }else{//this.cargar= false
                 this.$swal('Ocurrio algun problema','Contacte con el responsable','warning')
               }
               
   

   },

   async getSolicitudNotification(sendData) {
      console.log('datos send data____', sendData)
      console.log('datos filtrados', sendData.trc_old)
      console.log('datos filtrados user_id', sendData.trc_old.user_id)

   //},
   //getMailExtraordinario(extraordinario, index){

      //sendData.URL = window.location.href
      //sendData.URL2 = window.location.hostname
      //sendData.URL3 = window.location.host
      sendData.URL = window.location.origin
      const [ res] = await Promise.all([
        this.callApi('post', 'app/getSolicitudNotification', sendData)
        ])
      if (res.status==200) {
         this.cargaremail = false
         this.$swal('Solicitud registrado','Notificacion enviada','success')
      } else {
            this.cargaremail = false
            this.$swal('Algo salio mal','Verifique los correos','error')
         }

   },


   async solicitaCancelarAmpliacion(registro){


      console.log('------------------holitas desde solicitaCancelarAmpliacion----------',registro)
      //console.log('+++++++++-holitas desde dataRegistro+++++++++++',this.dataRegistro)
      //console.log('this.dataRegistro.motivo_id',this.dataRegistro.motivo_id)

         const [ res] = await Promise.all([
           this.callApi('post', 'app/solicitaCancelarAmpliacion', {
             
              trc_id  : registro.dt_trc_id,
              fechaasignadah_old : registro.dt_trc_fechaasignacionh,

              //fechasolicitada : this.dataRegistro.fechapropuesta,
              //fechasolicitadah : this.dataRegistro.fechapropuestah,
              //fundamento : this.dataRegistro.fundamento,
              //tiposolicitud_id  : this.dataRegistro.tiposolicitud_id,

              
          })
           ])

         if (res.status==200) {
            console.log('index_______________',this.tareasRepAsi.data[registro.index]);
            console.log('response____________',res.data);

        
            this.tareasRepAsi.data[registro.index].trc_estador = res.data['trc_old'].estador
            this.tareasRepAsi.data[registro.index].er_nombre = 'Precione F5 / actualice la pagina'

            this.tareasRepAsi.data[registro.index].s_fechaasignada_new = res.data['solicitudes'].fechaasignada_new
            this.tareasRepAsi.data[registro.index].s_fechaasignadah_new = res.data['solicitudes'].fechaasignadah_new
            this.tareasRepAsi.data[registro.index].s_fechaasignada_old = res.data['solicitudes'].fechaasignada_old
            this.tareasRepAsi.data[registro.index].s_fechaasignadah_old = res.data['solicitudes'].fechaasignadah_old
            this.tareasRepAsi.data[registro.index].s_fechasolicitada = res.data['solicitudes'].fechasolicitada
            this.tareasRepAsi.data[registro.index].s_fechasolicitadah = res.data['solicitudes'].fechasolicitadah
            this.tareasRepAsi.data[registro.index].s_fundamento = res.data['solicitudes'].fundamento
            //this.tareasRepAsi.data[registro.index].ec_colaborador_id = res.data['trc'].empresacolaborador_id
            //this.tareasRepAsi.data[registro.index].trc_estador = res.data['trc'].estador
            this.solicitudModal=false
            //this.$swal('Su solicitud se cancelo','Exitosamente','success')
            this.cargaremail = true
            this.getCancelarSolicitudNotification(res.data)

       
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
                   timer: 6000
                 });
               
             }else{//this.cargar= false
                 this.$swal('Ocurrio algun problema','Contacte con el responsable','warning')
               }
               
   

   },



   async getCancelarSolicitudNotification(sendData) {
      console.log('datos send data____', sendData)
      console.log('datos filtrados', sendData.trc_old)
      console.log('datos filtrados user_id', sendData.trc_old.user_id)

   //},
   //getMailExtraordinario(extraordinario, index){

      //sendData.URL = window.location.href
      //sendData.URL2 = window.location.hostname
      //sendData.URL3 = window.location.host
      sendData.URL = window.location.origin
      const [ res] = await Promise.all([
        this.callApi('post', 'app/getCancelarSolicitudNotification', sendData)
        ])
      if (res.status==200) {
         this.cargaremail = false
         this.$swal('Solicitud cancelada','Notificacion enviada','success')
         //this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
      } else {
            this.cargaremail = false
            this.$swal('Algo salio mal','Verifique los correos','error')
         }

   },

   async derivarRegistro(registro){

      console.log('------------------holitas desde derivarRegistro----------',registro)
      console.log('+++++++++-holitas desde dataRegistro+++++++++++',this.dataRegistro)
      console.log('this.dataRegistro.motivo_id',this.dataRegistro.motivo_id)
      this.cargaremail= true


         const [ res] = await Promise.all([
           this.callApi('post', 'app/derivarRegistro', {
             
               colaborador_id: this.dataRegistro.colaborador_id,
               motivo_id: this.dataRegistro.motivo_id,
               trc_id: registro.dt_trc_id,
               trc_tareareporte_id : registro.dt_trc_tareareporte,
               trc_fechalimite : registro.dt_trc_fechalimite,
               trc_periodo_id  : registro.dt_tr_periodo_id,
              
          })
           ])

         if (res.status==200) {
            console.log('index_______________',this.tareasRepAsi.data[registro.index]);
            console.log('response____________',res);

        
            this.tareasRepAsi.data[registro.index].trc_id = res.data['trc'].id
            this.tareasRepAsi.data[registro.index].ec_colaborador_id = res.data['trc'].empresacolaborador_id
            this.tareasRepAsi.data[registro.index].trc_estador = res.data['trc'].estador

            //this.$swal('El reporte fue derivado','Exitosamente','success')
            this.derivarModal=false
            this.getDerivarNotification(res.data)
       
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
                 this.cargaremail= false

               }
             }else if(res.status==409) {
               console.log('dentro del error',res);
                 this.$swal({
                   toast: true,
                   position: 'top-end',
                   icon: 'error',
                   title: res.data[0],
                   showConfirmButton: false,
                   timer: 6000
                 });
                 this.cargaremail= false

               
             }else{//this.cargar= false
                 this.$swal('Ocurrio algun problema','Contacte con el responsable','warning')
                 this.cargaremail= false

               }
        

   },


   async getDerivarNotification(sendData) {
      //console.log('datos send data____', sendData)
      //console.log('datos filtrados', sendData.trc_old)
      //console.log('datos filtrados user_id', sendData.trc_old.user_id)

   //},
   //getMailExtraordinario(extraordinario, index){

      //sendData.URL = window.location.href
      //sendData.URL2 = window.location.hostname
      //sendData.URL3 = window.location.host
      sendData.URL = window.location.origin
      const [ res] = await Promise.all([
        this.callApi('post', 'app/getDerivarNotification', sendData)
        ])
      if (res.status==200) {
         this.cargaremail = false
         this.$swal('Solicitud cancelada','Notificacion enviada','success')


         //this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
      } else {
            this.cargaremail = false
            this.$swal('Algo salio mal','Verifique los correos','error')
         }

   },


      showAtender(regAtender, index){
         console.log('modalllll---------',regAtender)

        let obj ={

           
            dt_r_descripcion: regAtender.r_descripcion,
            dt_r_estado: regAtender.r_estado,
            dt_r_nombre: regAtender.r_nombre,
            dt_r_oficina: regAtender.r_oficina,
            dt_r_tipo: regAtender.r_tipo,
            dt_r_tipoinformacion: regAtender.r_tipoinformacion_id,
            dt_t_descripcion: regAtender.t_descripcion, 
            dt_t_estado: regAtender.t_estado,
            dt_t_nombre: regAtender.t_nombre, 
            dt_tr_estado: regAtender.tr_estado,
            dt_tr_estadoasignado: regAtender.tr_estadoasignado,
            dt_tr_reporte: regAtender.tr_reporte,
            dt_tr_tarea: regAtender.tr_tarea,
            dt_trc_empresacolaborador: regAtender.trc_empresacolaborador,
            dt_trc_estado: regAtender.trc_estado,
            dt_trc_estador: regAtender.trc_estador,
            dt_trc_fechaatencion: regAtender.trc_fechaatencion,
            dt_trc_fechaatencionh: regAtender.trc_fechaatencionh,
            dt_trc_fechalimite: regAtender.trc_fechalimite,
            dt_trc_fechaasignacionh: regAtender.trc_fechaasignacionh,
            dt_trc_id: regAtender.trc_id,
            dt_trc_user_id: regAtender.trc_user_id,
            dt_trc_tareareporte: regAtender.trc_tareareporte,
            dt_tr_periodo_id: regAtender.tr_periodo_id,
            dt_tr_periodo_nombre: regAtender.p_nombre,

            index: index,

      }
      //this.index = index

     this.datoRegAtender = obj

       // console.log('dentro showAtender regAtender', regAtender )
       // console.log('dentro showAtender datoRegAtender', this.datoRegAtender )

        this.documentoReporte(this.datoRegAtender);
        this.atenderModal=true

      },


       async regDocumento(datoRegAtender, index){
          console.log('dentro de regDocumento__*-*-*-__',datoRegAtender)
         // console.log('dentro de regDocumento__INDEX__',index)
         // console.log('dentro de regDocumento',this.datoReg)

           // if (this.filtro.fechalimite==undefined) return this.$swal('La fecha limite es','Requerido','warning')

              //console.log('nuevamente',this.filtro.fechalimite)
            
            const formData = new FormData();
                formData.append('archivo', this.datoReg.archivo);
                formData.append('periodo', this.datoReg.periodo);
                formData.append('tareareportecolaborador_id', datoRegAtender.dt_trc_id);
                formData.append('dt_tr_tarea', datoRegAtender.dt_tr_tarea);
                formData.append('dt_tr_periodonombre', datoRegAtender.dt_tr_periodo_nombre);
                formData.append('dt_tr_reporte', datoRegAtender.dt_tr_reporte);
                 // formTRT.append('colaborador_id', this.filtro.colaborador[0]);
                 // formTRT.append('tareaReporte_id', this.filtro.tarRep.[0]);
                 // formTRT.append('fechalimite', this.filtro.fechalimite);

            const [ res] = await Promise.all([
              this.callApi('post', 'app/regDocumento', formData)
              ])
            if (res.status==200) {
           // this.$swal('Se asigno correctamente','Felicitaciones','success')
           // this.tareaReporte[this.filtro.tarRep.[1]].estadoasignado = res.data.tr.estadoasignado

           // console.log('insertar: ',this.filtro.tarRep.[2])
          // this.listRegAsig.data.unshift({
          //                                 id:res.data.trc.id, 
          //                                 'colaborador.nombre':this.filtro.colaborador.[1],
          //                                 'tarea_reporte.reportes.nombre': this.filtro.tarRep.[2],
          //                                 'reporteId': this.filtro.tarRep.[0],
          //                                 'fechalimite' : this.filtro.fechalimite
          //                                 //'xds' : this.filtro.tarRep.[3],
          //                               })
          // this.listRegAsig.data.unshift()
          // this.tareaReporte.unshift(res.data.rep)

          // this.tareaReporte[index].estadoasignado = res.data.trr.estadoasignado
          //console.log('dato res.data',res.data)
          //console.log('dato res.data',res.data)

            this.documentos = res.data.documentos
            this.datoReg.archivo=''
            this.datoReg.periodo=''
            this.tareasRepAsi.data[index].trc_estado = res.data.tareareportecolaborador.estado
            this.$swal('El archivo se actualizo','Correctamente','success')
           // this.filtro.colaborador=[]
           // this.filtro.tarRep=[]
           // this.filtro.fechalimite=''
           
           //this.datoReg.archivo=''


            }else if(res.status==201) {
           // this.$swal('Se asigno correctamente','Felicitaciones','success')
           // this.tareaReporte[this.filtro.tarRep.[1]].estadoasignado = res.data.tr.estadoasignado

           // console.log('insertar: ',this.filtro.tarRep.[2])
          // this.listRegAsig.data.unshift({
          //                                 id:res.data.trc.id, 
          //                                 'colaborador.nombre':this.filtro.colaborador.[1],
          //                                 'tarea_reporte.reportes.nombre': this.filtro.tarRep.[2],
          //                                 'reporteId': this.filtro.tarRep.[0],
          //                                 'fechalimite' : this.filtro.fechalimite
          //                                 //'xds' : this.filtro.tarRep.[3],
          //                               })
          // this.listRegAsig.data.unshift()
          // this.tareaReporte.unshift(res.data.rep)

          // this.tareaReporte[index].estadoasignado = res.data.trr.estadoasignado
          //console.log('dato res.data',res.data)
            this.documentos = res.data.documentos
            this.datoReg.archivo=''
            this.datoReg.periodo=''
            this.tareasRepAsi.data[index].trc_estado = res.data.tareareportecolaborador.estado
            this.$swal('El archivo se registro','Correctamente','success')
           // this.filtro.colaborador=[]
           // this.filtro.tarRep=[]
           // this.filtro.fechalimite=''
           
           //this.datoReg.archivo=''


            }else if(res.status==266) {
                  console.log('detro del 266',res)
                    this.$swal({
                      toast: true,
                      position: 'top-end',
                      icon: 'error', 
                      title: res.data.message,
                      showConfirmButton: true,
                      timer: 5000
                    });
                  
                }
                else if(res.status==422) {
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
            
        },

         documentoReporte(datoRegAtender) { 
          //console.log('documento ___:',datoRegAtender);
          axios.get('app/documentoReporte',{
             params: {
                //tipoSearch: this.searchData.tipoSearch,
                trc_id: datoRegAtender.dt_trc_id,

             }
          })
              .then(response => {
                  //this.buscarExtraordinarios = response.data;
                  //this.buscarExtraordinarioR = response.data;
                  //this.mostrarBusqueda = true
                  //this.mostrar = false
                 //console.log('datos buscados',response.data )
                 this.documentos= response.data.documento
                 this.userA= response.data.users
                 
                 //console.log(response.data)
              });
      },

      async getHabilitar(regAtender, index){
       //  console.log('ddddddddddddddddddddd', this.datoReg.periodo);
       //console.log('formDatac   c______', regAtender);
     //s  console.log('formDatac   c____INDEX__', index);

           const formData = new FormData();
                formData.append('trc_id', regAtender.dt_trc_id);
                formData.append('t_id', regAtender.dt_tr_tarea);
                formData.append('tr_periodoId', regAtender.dt_tr_periodo_id);
                formData.append('estadoarchivo', this.documentos.estadoarchivo);

        //console.log('formDatac   c', formData);

        const [ res] = await Promise.all([
              this.callApi('post', 'app/getHabilitar', formData)
              ])
         if (res.status==201) {
               console.log('**************:', res.data)
      //  console.log('formDatac   res.status', res.data);
            if (res.data.ejecutado == 1) { this.getMailEjecutado(res.data) }

            this.tareasRepAsi.data[index].trc_estado = res.data.tareareportecolaborador.estado
                this.$swal({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      title: res.data.message,
                      showConfirmButton: false,
                      timer: 5000
                    });

         }else if (res.status==200) {
               console.log('**************:', res.data)
            // console.log('formDatac   res.status', res.data);
            if (res.data.ejecutado == 1) { this.getMailEjecutado(res.data) }
            this.tareasRepAsi.data[index].trc_estado = res.data.tareareportecolaborador.estado
                this.$swal({
                      toast: true,
                      position: 'top-end',
                      icon: 'warning',
                      title: res.data.message,
                      showConfirmButton: false,
                      timer: 5000
                    });

            }else if(res.status==266) {
                  console.log('detro del 266',res)
                    this.$swal({
                      toast: true,
                      position: 'top-end',
                      icon: 'error', 
                      title: res.data.message,
                      showConfirmButton: true,
                      timer: 5000
                    });
                  
                }
                else if(res.status==422) {
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


                

      },

      async getMailEjecutado(sendData) {
         console.log('datos send data____', sendData)
         console.log('datos filtrados', sendData.tarea.nombre)
         console.log('datos filtrados user_id', sendData.tareareportecolaborador.user_id)


         //sendData.URL = window.location.href
         //sendData.URL2 = window.location.hostname
         //sendData.URL3 = window.location.host
         sendData.URL = window.location.origin
         const [ res] = await Promise.all([
           this.callApi('post', 'app/getMailEjecutado', sendData)
           ])
         if (res.status==200) {
            this.cargaremail = false
            this.$swal('Solicitud cancelada','Notificacion enviada','success')
            //this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
         } else {
               this.cargaremail = false
               this.$swal('Algo salio mal','Verifique los correos','error')
            }

      },

      
    
      descargarArchivo(datosDocumento) {


            //console.log('dentro de reportePDFRER',datosDocumento.id)
            window.open(`/repositorio/app/descargarArchivo/${datosDocumento.id}`);
            
          
      },
    
      eliminarArchivo(datosDocumento, index) {
        //console.log('datosDocumento ___:',datosDocumento);
        //console.log('datosDocumento __INDEX_:',index);

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
                    this.deleteArchivo(datosDocumento, index)
                    this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
                  } else {
                    this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
                  }
                })
        
      },



      async deleteArchivo(deleteItem ,index){
//console.log('datos erniados a deleteItem_____',deleteItem)
//console.log('datos erniados a deleteItem___INDEX__',index)
        let obj ={

           
            archivo: deleteItem.archivo,
            periodo: deleteItem.periodo_id,
            tareareportecolaborador_id: deleteItem.tareareportecolaborador_id,
            tarea_id: this.datoRegAtender.dt_tr_tarea,
            //indext: index,


      }
      //this.index = index

     this.datoElim = obj

    
      // console.log('datos erniados a eliminar',formData)
      // console.log('datos erniados a this.datoRegAtender.dt_tr_tarea',this.datoRegAtender.dt_tr_tarea)
          //this.isDeleing = true
          //const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
          
          //const res = await this.callApi('delete', `app/eliminarArchivo/${deleteItem.id}`, deleteItem)
          const res = await this.callApi('delete', `app/eliminarArchivo/${deleteItem.id}`, this.datoElim)
          if(res.status==200){

           //console.log('dato modificado',this.tareasRepAsi.data[index])
           //console.log('dato res.data.estado',res.data)
          
              this.documentos = ''
              this.tareasRepAsi.data[index].trc_estado = res.data.estado


          }else {
            this.$swal({
                position: 'top-end',
                icon: 'error',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              });
          }
          
         
        },

        getTareas(page = 1) {
          axios.get('app/tarea?page=' + page,{
             params: {
              

             }
          })
              .then(response => {
                  //this.buscarExtraordinarios = response.data;
                  //this.buscarExtraordinarioR = response.data;
                  //this.mostrarBusqueda = true
                  //this.mostrar = false
                 // console.log('datos buscados___XXX',response.data )
                  this.tareas= response.data.data
                 
                 // console.log(response.data)
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

      async regInformacion(inf){
         console.log('datitos-----', inf)
         inf.datos=this.datoRegAtender;
         const [res] = await Promise.all([
           this.callApi('post', 'app/regInformacion', inf)
           ])

         if (res.status == 201) {
            console.log('respuesta', res.data)
            this.$swal({
                position: 'top-end',
                icon: 'success',
                title: 'Informacion registrada corresctamente',
                showConfirmButton: false,
                timer: 1500
              });
            this.datoRegAtender =''
            this.calculos.snr=''
            this.calculos.str=''
            this.calculos.total=''
            this.calculos.residencial_bt=''

            this.informacion.mt=''
            this.informacion.bt=''
            this.informacion.ccincuenta_trecientos=''
            this.informacion.cero_treinta=''
            this.informacion.cien_ccincuenta=''
            this.informacion.mas_quinientos=''
            this.informacion.mas_quinientos=''
            this.informacion.no_residencial=''
            this.informacion.residencial_bt=''
            this.informacion.st_libre=''
            this.informacion.st_regulado=''
            this.informacion.total=''
            this.informacion.trecientos_quinientos=''
            this.informacion.treinta_cien=''
            this.informacion.porcentaje=''
            this.atenderModal=false
         }else{
            this.$swal({
                position: 'top-end',
                icon: 'error',
                title: 'Verifique la informacion',
                showConfirmButton: false,
                timer: 1500
              });
         }
      },



      async makeToast(append ) {
        console.log('alertr_____________:', this.tareasRepAsi);
        console.log('alertr______append_______:', append);

         const h = this.$createElement
          for(let i in append.tareasReportesAsignados.data){
            console.log(i,'__:',append.tareasReportesAsignados.data[i])
              this.toastCount++
             //this.$bvToast.toast(`This is toast number ${this.toastCount}`, {
             //  title: 'BootstrapVue Toast',
             //  autoHideDelay: 5000,
             //  appendToast: true,
             //  variant: 'primary',
             //})

              console.log('____trc_fechalimite___:',append.tareasReportesAsignados.data[i].trc_fechalimite)
              console.log('____trc_fechalimite___:',append.fechas.fechapasmañana)
              console.log('____trc_estado___:',append.tareasReportesAsignados.data[i].trc_estado)

            // v-if="(row.item.trc_fechalimite > fechas.fechapasmañana) && (row.item.trc_estado == 1)">Te quedan mas de 3 dias
            // <b-badge variant="success" v-if="(row.item.trc_fechalimite > fechas.fechapasmañana) && (row.item.trc_estado == 1)">Te quedan mas de 3 dias</b-badge>
            //  <b-badge variant="dark" v-if="(row.item.trc_fechalimite == fechas.fechapasmañana) && (row.item.trc_estado == 1)">Te quedan 3 dias</b-badge>
            //  <b-badge variant="primary" v-if="(row.item.trc_fechalimite == fechas.fechamañana) && (row.item.trc_estado == 1)">Te queda 2 dia</b-badge>
            //  <b-badge variant="warning" v-if="(row.item.trc_fechalimite == fechas.fechahoy) && (row.item.trc_estado == 1)">Hoy termina su fecha limite</b-badge>
            //  <b-badge variant="danger" v-if="(row.item.trc_fechalimite < fechas.fechahoy) && (row.item.trc_estado == 1)">Tu fecha limite fue vencido</b-badge>

              if ((append.tareasReportesAsignados.data[i].trc_fechalimite > append.fechas.fechapasmañana) && (append.tareasReportesAsignados.data[i].trc_estado == 1)) {
              //if ((append.tareasReportesAsignados.data[i].trc_fechalimite < append.fechas.fechapasmañana) ) {
                 const vNodesMsg = h(
                      'p',
                      { class: ['text-center', 'mb-0'] },
                      [
                        h('b-spinner', { props: { type: 'grow', small: true } }),
                        ' Flashy ',
                        h('strong', 'toast'),
                        ` message #${this.count} `,
                        h('b-spinner', { props: { type: 'grow', small: true } })
                      ]
                    )
                  this.$bvToast.toast([vNodesMsg], {
                    title: 'Notificacion',
                    autoHideDelay: 5000,
                    appendToast: true,
                    variant: 'success',
                  })
              }
                if ((append.tareasReportesAsignados.data[i].trc_fechalimite == append.fechas.fechapasmañana) && (append.tareasReportesAsignados.data[i].trc_estado == 1)) {
                  const vNodesMsg = h(
                      'p',
                      { class: ['text-center', 'mb-0'] },
                      [
                        h('b-spinner', { props: { type: 'grow', small: true } }),
                        ' Flashy ',
                        h('strong', 'toast'),
                        ` message #${this.count} `,
                        h('b-spinner', { props: { type: 'grow', small: true } })
                      ]
                    )
                  this.$bvToast.toast([vNodesMsg], {
                    title: 'Notificacion',
                    autoHideDelay: 5000,
                    appendToast: true,
                    variant: 'info',
                  })
              }
                if ((append.tareasReportesAsignados.data[i].trc_fechalimite == append.fechas.fechamañana) && (append.tareasReportesAsignados.data[i].trc_estado == 1)) {
                  const vNodesMsg = h(
                      'p',
                      { class: ['text-center', 'mb-0'] },
                      [
                        h('b-spinner', { props: { type: 'Spinning', small: true } }),
                        ' Flashy ',
                        h('strong', 'toast'),
                        ` message #${this.count} `,
                        h('b-spinner', { props: { type: 'Spinning', small: true } })
                      ]
                    )
                  this.$bvToast.toast([vNodesMsg], {
                    title: 'Notificacion',
                    autoHideDelay: 5000,
                    appendToast: true,
                    variant: 'primary',
                  })
              }
                if ((append.tareasReportesAsignados.data[i].trc_fechalimite == append.fechas.fechahoy) && (append.tareasReportesAsignados.data[i].trc_estado == 1)) {
                  const vNodesMsg = h(
                      'p',
                      { class: ['text-center', 'mb-0'] },
                      [
                        h('b-spinner', { props: { type: 'grow', small: true } }),
                        ' Flashy ',
                        h('strong', 'toast'),
                        ` message #${this.count} `,
                        h('b-spinner', { props: { type: 'grow', small: true } })
                      ]
                    )
                  this.$bvToast.toast([vNodesMsg], {
                    title: 'Notificacion',
                    autoHideDelay: 5000,
                    appendToast: true,
                    variant: 'warning',
                  })
              }
                if ((append.tareasReportesAsignados.data[i].trc_fechalimite < append.fechas.fechahoy) && (append.tareasReportesAsignados.data[i].trc_estado == 1)) {
                  console.log('dentro del alerta_____:',append.tareasReportesAsignados.data[i]);
                  console.log('dentro del alerta_____:',append.fechas);
                  const vNodesTitle = h(
                      'div',
                      { class: ['d-flex', 'flex-grow-1', 'align-items-baseline', 'mr-2'] },
                      [
                        h('strong', { class: 'mr-2' }, `${append.tareasReportesAsignados.data[i].r_nombre}`),
                        h('small', { class: 'ml-auto text-italics' }, `${append.tareasReportesAsignados.data[i].trc_fechalimite}`)
                      ]
                    )
                  const vNodesMsg = h(
                      'p',
                      { class: ['text-center', 'mb-0'] },
                      [
                        h('b-spinner', { props: { type: 'grow', small: true } }),
                        ' Tu fecha limite fue vencido : ',
                        h('strong', `${append.tareasReportesAsignados.data[i].r_nombre}`),
                        h('b-spinner', { props: { type: 'grow', small: true } })
                      ]
                    )
                  this.$bvToast.toast([vNodesMsg], {
                    title: [vNodesTitle],
                    autoHideDelay: 5000,
                    appendToast: true,
                    variant: 'danger',
                  })
              }

          }



      },




  },

  watch:{
         
   "$route.params":{
      immediate: true,
      handler(page){
         console.log('prueba_________***_____:', page)
         this.watchFiltro=page
         console.log('prueba______________+++++:', this.watchFiltro)
         if (!this.watchFiltro.tipoTarea == "") {
         console.log('dentro del if')
           
            this.getFiltroTRA(this.watchFiltro);

         }else{

            this.tareasReportesAsignados();
         }

      }
   }
},
computed:{


   validationNR() {
        //return this.userId.length > 4 && this.userId.length < 13
        if (this.calculos.snr - this.informacion.no_residencial == 0) {
         return true;
        }else{
         return false;
        }
        //return this.calculos.snr == this.informacion.no_residencial
      },
   validationSTR() {
        //return this.userId.length > 4 && this.userId.length < 13
        if (this.calculos.str - this.informacion.st_regulado == 0) {
         return true;
        }else{
         return false;
        }
        //return this.calculos.snr == this.informacion.no_residencial
      },
   validationBT() {
        //return this.userId.length > 4 && this.userId.length < 13
        if (this.calculos.residencial_bt - this.informacion.residencial_bt == 0) {
         return true;
        }else{
         return false;
        }
        //return this.calculos.snr == this.informacion.no_residencial
      },
   validationT() {
        //return this.userId.length > 4 && this.userId.length < 13
        if (this.calculos.total - this.informacion.total == 0) {
         return true;
        }else{
         return false;
        }
        //return this.calculos.snr == this.informacion.no_residencial
      },
},


    
  async created(){
    try {

      this.listaPeriodos();
      //this.tareasReportesAsignados();
      this.getTareas();
      this.getColaboradores();
      
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