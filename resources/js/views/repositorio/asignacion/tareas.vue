<template>
<base-layout>
<Breadcrumbs>
  <template v-slot:titulo_breadcrumbs> Roles
  </template>
  
  <template v-slot:prueba>
      <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li><a href="#">Tareas para la gestion</a></li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>

    <li>Tareas</li>
    </template>
</Breadcrumbs>

  <div class="card mb-3">
    <div class="card-header d-flex">
      <span>
        <i class="fas fa-chart-area"></i>
          Administrar Tareas
      </span>
    <button class="btn btn-primary btn-sm ml-auto" @click="addModalTareas=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
     
    </div>
  </div>
    <div class="row">
      <div class="col-md-12  ml-auto mr-auto">
        <div class="card">
          <div class="card-body">
            <div class="row">

              
                <b-table responsive
                  id="table-transition-example"
                  :items="tareas.data"
                  :fields="fields"
                  hover
                  striped
                  small
                  primary-key="id"
                  :tbody-transition-props="transProps"
                >

                <template #cell(created_at)="row">
                    <b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
                        <b-dropdown-item href="#" v-if="isReadPermitted" @click="showExtraordinarioModal(row.item, row.index)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-eye"></span></button> Asignar Colaboradores y Reporte
                        </b-dropdown-item>
                        <b-dropdown-item href="#" v-if="isReadPermitted" @click="editTareas(row.item, row.index)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-edit"></span></button> Editar Tarea
                        </b-dropdown-item>
                        <b-dropdown-item href="#" v-if="isReadPermitted" @click="eliminarTarea(row.item, row.index)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-trash-alt"></span></button> Eliminar Tarea
                        </b-dropdown-item>
                    </b-dropdown>
                </template>

                <template #cell(updated_at)="row">
                  <b-button size="sm" @click="row.toggleDetails" variant="outline-success">
                    {{ row.detailsShowing ? 'Ocultar' : 'Mostrar' }} Descripcion
                  </b-button>
                </template>
                <template #row-details="row">
                  <b-card>
                     <p>{{row.item.descripcion}}</p>
                  </b-card>
                </template>

                </b-table>
                <div class="card mb-3">               
                  <advanced-laravel-vue-paginate :data="tareas" @paginateTo="getResultsGeneral"></advanced-laravel-vue-paginate>
                </div>


   
            </div>

          </div>
        </div>
      </div>
    </div>
  
<b-modal  hide-footer v-model="tareaRepTraRegModal" title="Asignar Reportes" :mask-closable="false" :closable="false" size="xl">  
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
                   <h3>Enviar notificacion por correo...</h3>
                
              </b-button>

          <!-- We add an SR only text for screen readers -->
          
        </div>
      </template>
 <b-container class="bv-example-row text-light text-center">
  
  <b-row cols-sm="1" cols-md="1" cols-lg="3" cols-xl="3">
    <b-col >
      <b-card>
        <b-card-title>Seleccionar Colaborador:</b-card-title>
        <b-card-text>
          
          <b-form-select v-model="filtro.colaborador"  class="mb-3" name="colaboradores" @change='getObsTipoExtraordinario()' :select-size="5">
            
            <b-form-select-option :value="null" disabled>-- Seleccione al Colaborador--</b-form-select-option>
          
            <b-form-select-option :value="[colaborador.id,colaborador.colaborador.nombre]" v-for="(colaborador, i) in colaboradores" :key="i" v-if="colaboradores.length">{{colaborador.colaborador.nombre}}</b-form-select-option>
          
        </b-form-select>
      
        </b-card-text>
        
      </b-card>
      
    </b-col>
    <b-col >
      <b-card>
         <div>
            <label for="example-datepicker">Seleccione el periodo :</label>

               <b-form-select v-model="filtro.periodo"  class="mb-3" name="periodo" @change='busquedaPeriodo()'>
                     <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                     <b-form-select-option :value="[listPeriodo.id,listPeriodo.nombre]" v-for="(listPeriodo, i) in listPeriodos.data" :key="i" v-if="listPeriodos.data.length" :disabled="listPeriodo.estado == '2' ? false: true" >{{listPeriodo.nombre}}</b-form-select-option>
               </b-form-select> 
         </div>
      </b-card>
      <b-card>
        <div>
              
          <label for="example-datepicker">Registrar fecha Limite :</label>
          <b-form-datepicker id="example-datepicker" v-model="filtro.fechalimite" class="mb-2"></b-form-datepicker>
        </div>
        <b-card-title>Acciones</b-card-title>
        <b-button block variant="outline-danger" @click="addTarRepTra(tarRep, i)">Asignar</b-button>

      </b-card>
    </b-col>
    <b-col  >
      <b-card>
        <b-card-title>Seleccionar Reporte:</b-card-title>
        <b-card-text>
          
          <b-form-select v-model="filtro.tarRep"  class="mb-3" name="tareaReporte" @change="switchView($event)" :select-size="5">
          
            <b-form-select-option :value="[tarRep.id, i, tarRep.nombre, tarRep.fechalimite, tarRep.tarea_id]" v-for="(tarRep, i) in tareaReporte" :key="i" v-if="tareaReporte.length " >{{tarRep.nombre}} 
            </b-form-select-option>
          
          </b-form-select>
      
        </b-card-text>
        
      </b-card>
      
    </b-col>
  </b-row>
  <b-row cols-sm="1" cols-md="1" cols-lg="1" cols-xl="1">
    <b-col >
      <b-card>
        <b-card-title>Reportes Asignados: Periodo - {{filtro.periodoNombre}}</b-card-title>
       
         <b-table
            id="table-transition-example"
            :items="listRegAsig.data"
            :fields="fieldsL"
            striped
            small
            primary-key="id"
            :tbody-transition-props="transProps"
            :tbody-tr-class="rowClass"
            responsive
          >
          <template #cell(estado)="row">
                
                   <div>
                   
                     <b-badge variant="danger" v-if="row.item.estado == '1'">No se entrego</b-badge>
                     <b-badge variant="warning" v-if="row.item.estado == '2'">Falta validar</b-badge>
                     <b-badge variant="primary" v-if="row.item.estado == '3'">Listo</b-badge>

                   </div>

             </template>

          <template #cell(acciones)="row">

                <b-button variant="outline-danger"  @click="showDelRepAsig(row.item, row.index)" v-if="(isDeletePermitted) && (row.item.estado == '1') && (userA.id == row.item.user_id) || (userA.roleAd == '1') " ><span class="fa fa-trash"></span></b-button>
                
                
                <b-button variant="outline-primary" @click="showTarRepDetalle(row.item, row.index)"><span class="fa fa-eye"></span></b-button>
              
          </template>
            
          </b-table>
      </b-card>
      <div class="card mb-3">               
        <advanced-laravel-vue-paginate :data="listRegAsig" @paginateTo="getResultadoRepAsig"></advanced-laravel-vue-paginate>
      </div>
    </b-col>
  </b-row>
</b-container>

</b-overlay>
</b-modal> 

<b-modal  hide-footer v-model="tarRepDetalleModal" size="lg">
   <template #modal-title>
     
      <h5>Detalle Reporte: {{reporteReportesDetalle.nombre}}</h5>
              
    </template>
 
      <div>
        
         <b-table-simple responsive >
           <b-thead>
             <b-tr>
               <b-th sticky-column>Tarea</b-th>
               <b-th>{{reporteTareaDetalle.nombre}}</b-th>
               
             </b-tr>
           </b-thead>
           <b-tbody>
             <b-tr>
               <b-th sticky-column>Reporte</b-th>
               <b-td>{{reporteReportesDetalle.nombre}}</b-td>
             </b-tr>
             <b-tr>
               <b-th sticky-column>Detalle Reporte</b-th>
               <b-td>{{reporteReportesDetalle.descripcion}}</b-td>
               
             </b-tr>
             <b-tr>
               <b-th sticky-column>Responsable</b-th>
               <b-td>{{reporteColaboradorDetalle.nombres}}</b-td>
             </b-tr>
             <b-tr>
               <b-th sticky-column>Fecha de Asignacion</b-th>
               <b-td>{{reporteDetalle.created_at}}</b-td>
             </b-tr>
             <b-tr>
               <b-th sticky-column>Fecha Limite</b-th>
               <b-td>{{reporteDetalle.fechalimite}}</b-td>
             </b-tr>
             <b-tr>
               <b-th sticky-column>Fecha Atencion</b-th>
               <b-td>{{reporteDetalle.fechaatencionh}}</b-td>
             </b-tr>
             <b-tr>
               <b-th sticky-column>Fecha Validacion</b-th>
               <b-td>{{reporteDetalle.fechavalidacionh}}</b-td>
             </b-tr>
           </b-tbody>
         </b-table-simple>

          
      </div>
     


</b-modal>

<b-modal  hide-footer v-model="addModalTareas" size="sm">
   <template #modal-title>
     
      <h5>Crear Nueva Tarea</h5>
              
   </template>
         <b-form-group
           id="input-group-1"
           label="Nombre de la Tarea:"
           label-for="input-1"
           description="Nombre que identificara la tarea"
         >
            <b-form-input
             id="input-1"
             v-model="form.nombre"
             placeholder="Ingrese nombre de la tarea"
             required
           ></b-form-input>
         </b-form-group>

      <b-form-group id="input-group-2" label="Descripcion:" label-for="input-2">
        <b-form-textarea
            id="textarea"
            v-model="form.descripcion"
            placeholder="Ingrese la descripion de la tarea..."
            rows="3"
            max-rows="6"
          ></b-form-textarea>
      </b-form-group>

      <b-form-group id="input-group-2" label="¿Habilitar tarea?" label-for="input-2">
         <b-form-checkbox v-model="form.estador" name="check-button" switch>
         
       </b-form-checkbox>
      </b-form-group>


      <b-button  variant="primary" @click="regTarea()" >Crear</b-button>
    


</b-modal>

<b-modal  hide-footer v-model="showEditModalTareas" size="sm">
   <template #modal-title>
     
      <h5>Detalle Reporte: {{reporteReportesDetalle.nombre}}</h5>
              
   </template>
         <b-form-group
           id="input-group-1"
           label="Nombre de la Tarea:"
           label-for="input-1"
           description="Nombre que identificara la tarea"
         >
            <b-form-input
             id="input-1"
             v-model="dataTareaAsig.nombre"
             placeholder="Ingrese nombre de la tarea"
             required
           ></b-form-input>
         </b-form-group>

      <b-form-group id="input-group-2" label="Descripcion:" label-for="input-2">
        <b-form-textarea
            id="textarea"
            v-model="dataTareaAsig.descripcion"
            placeholder="Ingrese la descripion de la tarea..."
            rows="3"
            max-rows="6"
          ></b-form-textarea>
      </b-form-group>

      <b-form-group id="input-group-2" label="¿Habilitar tarea?" label-for="input-2">
         <b-form-checkbox v-model="dataTareaAsig.estador" value="1" unchecked-value="0" name="check-button" switch>
         
       </b-form-checkbox>
      </b-form-group>


      <b-button  variant="primary" @click="editRegTarea(dataTareaAsig)" >Actualizar</b-button>
    


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

      tareaRepTraRegModal: false,
      tarRepDetalleModal: false,
      addModalTareas: false,
      showEditModalTareas: false,

      cargaremail: false,

      tareas:[],
      userA:[],
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
          { key: 'estado',label:'Estado', sortable: true },
          { key: 'fechaasignacionh',label:'Fecha de registro', sortable: true },
          { key: 'acciones',label:'ACCIONES', sortable: true },
        ],
        form:{},
      filtro:{
        tipoBusqueda:'null',
      },

       transProps: {
          // Transition name
          name: 'flip-list'
        },
        dataTareaAsig:{

        },

     
        fields: [
          { key: 'id',label:'#', sortable: true, stickyColumn: true, isRowHeader: true},
          { key: 'nombre',label:'NOMBRE', sortable: true, stickyColumn: true },
          { key: 'created_at',label:'CREATE', sortable: true },
          { key: 'updated_at',label:'OPCIONES', sortable: true }
        ],
        reporteDetalle:{},
        reporteTareaDetalle:{},
        reporteReportesDetalle:{},
        reporteColaboradorDetalle:{},
        listPeriodos:[],
       
    }
  },


  methods : {

   rowClass(listRegAsig, type) {
    // console.log('dentritossssssss____________',listRegAsig )
     //console.log('fecha_hoy',this.fecha_hoy )
       // if (!listRegAsig || type != 'row') return
       // //if (listRegAsig.r_estado == '1') return 'table-success'
       // if ((listRegAsig.t_totalasignado == listRegAsig.t_totalatendido) && (listRegAsig.t_totalatendido > 0)) return 'table-success'
       // if (listRegAsig.t_totalasignado == '2') return 'table-warning'

       //if (listRegAsig.trc_estado == '1') return 'table-primary'
       if (listRegAsig.estado == '2') return 'table-warning'
       if (listRegAsig.estado == '3') return 'table-success'
      },

    regTarea(){
      console.log('dentro de regTarea----:',this.form)

      axios.get('app/regTarea',{
          params: {
             //tipoSearch: this.searchData.tipoSearch,
             
             descripcion: this.form.descripcion,
             nombre: this.form.nombre,
             estador: this.form.estador,

          }
       }).then(res => {
         if (res.status == 201) {
           //console.log('index__',this.tareas.data[editData.index])
           //console.log('res___',res.data)
         this.tareas.data.unshift(res.data)
         this.addModalTareas = false
         //this.listRegAsig.data.unshift(res.data.trc)

            this.showEditModalTareas = false

            this.$swal('La creacion de la tarea fue','Exitosa','success')

         }else{
            this.$swal('Intentelo nuevamente','Error','error')

         }



              //this.documentos= response.data
              
              //console.log(response.data)
           });
   },

   editTareas(dataTarea, index){
      console.log('dentro de edit TAreaas___:',dataTarea)
      console.log('dentro de edit TAreaas___:',index)


      let obj={
         
         descripcion: dataTarea.descripcion,
         estador: dataTarea.estador,
         fechafinal: dataTarea.fechafinal,
         id: dataTarea.id,
         nombre: dataTarea.nombre,
         index: index
      }
      this.dataTareaAsig = obj
      this.showEditModalTareas = true


   },

   editRegTarea(editData){
      console.log('listo para editar:___',editData)
       axios.put(`app/editRegTarea/${editData.id}`,{
          params: {
             //tipoSearch: this.searchData.tipoSearch,
             
             descripcion: editData.descripcion,
             nombre: editData.nombre,
             estador: editData.estador,

          }
       }).then(res => {
         if (res.status == 200) {
            console.log('index__',this.tareas.data[editData.index])
            console.log('res___',res.data)
            this.tareas.data[editData.index].estador = res.data.estador
            this.tareas.data[editData.index].nombre = res.data.nombre
            this.tareas.data[editData.index].descripcion = res.data.descripcion

            this.showEditModalTareas = false

            this.$swal('La actualizacion fue','Exitosa','success')

         }else{
            this.$swal('Intentelo nuevamente','Error','error')

         }
              //this.documentos= response.data
              
              //console.log(response.data)
         });

   },

   eliminarTarea(delData,index){
     //let obj={
     //   
     //   descripcion: dataTarea.descripcion,
     //   estador: dataTarea.estador,
     //   fechafinal: dataTarea.fechafinal,
     //   id: dataTarea.id,
     //   nombre: dataTarea.nombre,
     //   index: index
     //}
     //this.dataTareaAsig = obj
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
                  this.deleteTareas(delData,index)
                } else {
                  this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
                }
              })
   },
   
   async deleteTareas(deleteItem, index){
         //this.isDeleing = true
         //const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
         
         const res = await this.callApi('delete', `app/deleteTareas/${deleteItem.id}`, deleteItem)
         if(res.status==200){
            this.tareas.data.splice(index, 1)

                  this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
         /*   this.$swal({
                 
                 icon: 'success',
                 title: 'Eliminado',
                 text: 'Usted elimino el registro corecctamente',
                 showConfirmButton: false,
                 timer: 2500
               });
*/
         }else if(res.status==409) {
            console.log('respuesta________', res)
            this.$swal({
                 toast: true,
                 position: 'top-end',
                 icon: 'error',
                 title: 'Error',
                 text: res.data[0],
                 showConfirmButton: false,
                 timer: 5500
               });
         }else {
            this.$swal({

                      toast: true,
                 position: 'top-end',
                 icon: 'error',
                 title: 'Intentelo nuevamente',
                 showConfirmButton: false,
                 timer: 5500
               });
         }
        // this.isDeleing = false
         //this.showDeleteModal = false
      },

   
    
    getResultsGeneral(page = 1) {
          axios.get('app/tarea?page=' + page,{
             params: {
              

             }
          })
              .then(response => {
                  //this.buscarExtraordinarios = response.data;
                  //this.buscarExtraordinarioR = response.data;
                  //this.mostrarBusqueda = true
                  //this.mostrar = false
                  console.log('datos buscados',response.data )
                  this.tareas= response.data.tareas
                  this.userA= response.data.users
                 
                  console.log(response.data)
              });
      },



    showExtraordinarioModal(tarea, i){
      console.log('tdo tareas_____________',tarea)


      let obj ={
        id : tarea.id,
        estado : tarea.estado,
        nombre : tarea.nombre,
      }

      this.datoTareaRepTra = obj
      this.buscarTarRepCol(tarea, i)
      //this.buscarTarRep(tarea, i)
      
      this.tareaRepTraRegModal= true

      //LIMPIAR MODAL

      this.filtro.colaborador=[]
      this.filtro.tarRep=[]
      this.filtro.fechalimite=''
      this.filtro.periodo=''
      this.tareaReporte=''


      this.listRegAsig=''
      //this.getResultadoRepAsig();
      this.index = index




    },

    busquedaPeriodo(){
      console.log('dentro de busqueda Periodo++++++++++++++')
      console.log('dentro de busqueda Periodo++++++++++++++' ,this.tarea)

      this.buscarTarRep()
      this.getResultadoRepAsig();
    },
    

    buscarTarRepCol(datoTareaRepTra,i){
      console.log('consultas mostrados',datoTareaRepTra)
          axios.get('app/empColaborador',{
           params: {
             idReporte: this.datoTareaRepTra.id
           }
          }).then(function(res){
                console.log('consultas',res.data)
                
                this.colaboradores = res.data;
            }.bind(this));

    },

    buscarTarRep(datoTareaRepTra,i){
      console.log('consultas tar rep',datoTareaRepTra)
          axios.get('app/tareaReporte',{
           params: {
             idReporte: this.datoTareaRepTra.id,
             periodoId: this.filtro.periodo[0],
           }
          }).then(function(res){
                console.log('consultas',res.data)
                
                this.tareaReporte = res.data;
            }.bind(this));

    },
    
     switchView(event) {
      //var values = this.choices.map(function(o) { return o.value })
      //console.log('mas pruebas: ',values.indexOf(event) );
      //console.log(event.target.options[event.target.selectedIndex].attributes['data-item-type'].value);

      //console.log('pruebitaaaas: ',event);
      //console.log('otra prueba [0]',this.filtro.tarRep[0])
      //console.log('otra prueba [1]',this.filtro.tarRep[1])
    },

    async addTarRepTra(tarRep, i){

      if (this.filtro.fechalimite==undefined) return this.$swal('La fecha limite es','Requerido','warning')
      //if (this.filtro.fechalimite.length != 0){
      //    return this.$swal('La echa limite es','Requerido','warning')

      //}

        //console.log('nuevamente',this.filtro.fechalimite.trim())
        //console.log('nuevamente',this.filtro.fechalimite)

      //console.log('otra prueba',this.filtro.tarRep[0] )
      
      const formTRT = new FormData();
            formTRT.append('colaborador_id', this.filtro.colaborador[0]);
            formTRT.append('tareaReporte_id', this.filtro.tarRep[0]);
            formTRT.append('tarea_id', this.filtro.tarRep[4]);
            formTRT.append('fechalimite', this.filtro.fechalimite);
            formTRT.append('periodoId', this.filtro.periodo[0]);

      const [ res] = await Promise.all([
        this.callApi('post', 'app/asignarTarRepCol', formTRT)
        ])
      if (res.status==200) {
        //this.$swal('Se asigno correctamente','Felicitaciones','success')

        //this.personaID = res.data
        //console.log('Se asignoo las',this.personaID)

        //console.log('pruebitas: ',this.tareaReportes.data[index].estado_extraordinario.estado);
        console.log('___________________: ',res.data)
        //console.log('pruebitas2: ',res.data.tr.estadoasignado);
        //
        //console.log('pruebitas XD: ',this.tareaReporte[0].estadoasignado);
        this.tareaReporte[this.filtro.tarRep[1]].estadoasignado = res.data.tr.estadoasignado

      //console.log('insertar_______________: ',this.filtro.tarRep[2])
      //console.log('insertar_______________++: ',res.data.tr)
      this.listRegAsig.data.unshift({
                                      id:res.data.trc.id, 
                                      'colaborador.nombre':this.filtro.colaborador[1],
                                      'tarea_reporte.reportes.nombre': this.filtro.tarRep[2],
                                      'reporteId': this.filtro.tarRep[0],
                                      'fechalimite' : this.filtro.fechalimite,
                                      'tarea_id' : this.filtro.tarRep[4],
                                      estado: '1',
                                      //'xds' : this.filtro.tarRep.[3],
                                    })

      this.filtro.colaborador=[]
      this.filtro.tarRep=[]
     // this.filtro.fechalimite=''
      this.filtro.periodo=''

      //this.getNotification(res.data)

      }else if(res.status==266) {
          //console.log('detro del 266',res)
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

   async getNotification(sendData) {
      console.log('datos send data____', sendData)
      console.log('datos filtrados', sendData.trc)
      console.log('datos filtrados user_id', sendData.trc.user_id)

   //},
   //getMailExtraordinario(extraordinario, index){

      //sendData.URL = window.location.href
      //sendData.URL2 = window.location.hostname
      //sendData.URL3 = window.location.host
      sendData.URL = window.location.origin
      this.cargaremail = true
      const [ res] = await Promise.all([
        this.callApi('post', 'app/getNotification', sendData)
        ])
      if (res.status==200) {
         this.cargaremail = false
         this.$swal('Excelent !','El correo se envio satisfactoriamente','success')
      } else {
         this.cargaremail = false
            this.$swal('Algo salio mal','Verifique los correos','error')
         }

   },

        //////////////////////////////////////

    getResultadoRepAsig(page=1 ) {

      //const page=1
      //console.log('tet buscar filtro.periodo:_________________',this.filtro.periodo[0])
      console.log('tet buscar registros:_________________',this.datoTareaRepTra)
          axios.get('app/ResultadoRepAsig?page=' + page,{
             params: {
              tareaId: this.datoTareaRepTra.id,
              periodoId: this.filtro.periodo[0],

             }
          }).then(response => {
                  //this.buscarExtraordinarios = response.data;
                  //this.buscarExtraordinarioR = response.data;
                  //this.mostrarBusqueda = true
                  //this.mostrar = false
                 // console.log('datos buscados',response.data )
                  this.listRegAsig= response.data
                  this.filtro.periodoNombre=this.filtro.periodo[1]
                 
                  //console.log(response.data)
              });
          //console.log('tet buscar registros:*********************',this.datoTareaRepTra)
      },
    showTarRepDetalle(reportito, i){
      console.log('+++++++++++++++++++++++++++++++++++', reportito)
      this.reporteDetalle = reportito

      


      this.reporteTareaDetalle = reportito.tarea_reporte.tareas
      this.reporteReportesDetalle = reportito.tarea_reporte.reportes
      this.reporteColaboradorDetalle = reportito.colaborador
      console.log('________________________________________________', this.reporteDetalle.created_at)
      this.tarRepDetalleModal = true

    },
    

    showDelRepAsig(reportito, i){
      console.log('tdossssssssssss tareas',reportito)

      if(reportito.reporteId == undefined){
        console.log('sin datos')
        let obj={
          id : reportito.id,
          tareareporteId : reportito.tareareporte_id,
          tarea_Id : reportito.tarea_reporte.tarea_id,
        }
     this.datoDelRepAsig = obj
      }else{
        console.log('con datos')
        let obj={
          id : reportito.id,
          //tareareporteId : reportito.tareareporte_id,
          tarea_Id : reportito.tarea_id,
          tareareporteId : reportito.reporteId,
        }
     this.datoDelRepAsig = obj
      }

  // let obj ={
  //   id : reportito.id,
  //   tareareporteId : reportito.tareareporte_id,
  //   reporteId : reportito.reporteId,
  //   tarea_Id : reportito.tarea_reporte,
  //  // xds: reportito.xds
  //   //tareaId : reportito.tarea_reporte.tarea_id,
  //   //estado : reportito.estado,
  //  // nombre : reportito.nombre,
  // }


     console.log('tdossssssssssss tareas xd',this.datoDelRepAsig)
   /* 
      this.buscarTarRepCol(tarea, i)
      this.buscarTarRep(tarea, i)
      this.tareaRepTraRegModal= true
      this.getResultadoRepAsig();
      this.index = index
*/

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
                this.delRepAsig(this.datoDelRepAsig, i)
                //this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
              } else {
                this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
              }
            })

    },

    async delRepAsig(datoDelRepAsig, index){
      console.log('emilinados tareas',datoDelRepAsig)
      console.log('emilinados tareas',index)
      //this.listRegAsig.data.splice(index, 1)
     // this.isDeleing = true
      //const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
       //axios.get('app/ResultadoRepAsig?page=' + page,{
      const res = await this.callApi('delete', `app/EliminarRepAsig/${datoDelRepAsig.id}`, this.datoDelRepAsig)
      if(res.status==200){
        this.listRegAsig.data.splice(index, 1)

       // this.tareaReporte[index].estadoasignado = res.data.trr.estadoasignado
       //AUI ES DONDE REGRESA AL LUGAR ANTERIOR
      // this.tareaReporte.unshift(res.data.rep)
       /* this.tareaReporte.unshift({
                                      id:res.data.trc.id, 
                                      'estadoasignado':this.filtro.colaborador.[1],
                                      'tarea_reporte.reportes.nombre': this.filtro.tarRep.[2] })*/
         this.$swal('La asignacion', 'Fue Eliminada', 'success')
        //this.$swal({
        //   position: 'top-end',
        //   icon: 'success',
        //   title: 'La asignacion fue Eliminada',
        //   showConfirmButton: false,
        //   timer: 2500
        //  });

      }else if(res.status==409){
         console.log('--------------------------: ', res.data[0])
         this.$swal({
              toast: true,
              position: 'top-end',
              icon: 'error',
              title: 'Accion no permitida',
              text: res.data[0],
              showConfirmButton: true,
              timer: 5000
            });

      }else {
        this.$swal({
            position: 'top-end',
            icon: 'error',
            title: 'El reporte fue derivado y/o tiene informacion',
            showConfirmButton: false,
            timer: 2500
          });
      }
      this.isDeleing = false
      //this.showDeleteModal = false
      
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



  },


    
  async created(){
    try {

      this.getResultsGeneral();
      this.listaPeriodos();
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