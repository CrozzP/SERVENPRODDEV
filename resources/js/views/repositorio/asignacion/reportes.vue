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
    <button class="btn btn-primary btn-sm ml-auto" @click="addReportesModal=true" v-if="isWritePermitted" ><span class="fa fa-plus"></span> Nuevo</button>
     
    </div>
  </div>
    <div class="row">
      <div class="col-md-12  ml-auto mr-auto">
        <div class="card">
          <div class="card-body">
            <div class="row">

              
                <b-table responsive
                  id="table-transition-example"
                  :items="reportes.data"
                  :fields="fields"
                  hover
                  striped
                  small
                  primary-key="id"
                  :tbody-transition-props="transProps"
                >

                <template #cell(created_at)="row">
                    <b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
                        <b-dropdown-item href="#" v-if="isReadPermitted" @click="tareasRegModal(row.item, row.index)" ><button class="btn btn-success btn-sm"  ><span class="fa fa-eye"></span></button> Asignar a Tareas
                        </b-dropdown-item>
                        <b-dropdown-item href="#" v-if="isReadPermitted" @click="editReporte(row.item, row.index)" ><button class="btn btn-primary btn-sm"  ><span class="fas fa-edit"></span></button> Editar Reporte
                        </b-dropdown-item>
                        <b-dropdown-item href="#" v-if="isReadPermitted" @click="eliminarReporte(row.item, row.index)" ><button class="btn btn-danger btn-sm"  ><span class="fas fa-trash-alt"></span></button> Eliminar Reporte
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
                     <h6>Descrion del reporte:</h6>
                     <p>{{row.item.descripcion}}</p>
                  </b-card>
                </template>

                </b-table>
                <div class="card mb-3">               
                  <advanced-laravel-vue-paginate :data="reportes" @paginateTo="getResultsGeneral"></advanced-laravel-vue-paginate>
                </div>


    

            </div>

          </div>
        </div>
      </div>
    </div>
  

<b-modal  hide-footer v-model="asignarATareasModal" title="Asignar Reportes" :mask-closable="false" :closable="false" size="lg">

   <b-row cols-sm="1" cols-md="1" cols-lg="2" cols-xl="2">
       <b-col >
         <b-card>
         <div>
            <label for="example-datepicker">Seleccione el periodo :</label>

               <b-form-select v-model="filtro.periodo"  class="mb-3" name="periodo" @change='buscarTareas()'>
                     <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
                     <b-form-select-option :value="[listPeriodo.id,listPeriodo.nombre]" v-for="(listPeriodo, i) in listPeriodos.data" :key="i" v-if="listPeriodos.data.length" :disabled="listPeriodo.estado == '2' ? false: true" >{{listPeriodo.nombre}}</b-form-select-option>
               </b-form-select> 
         </div>
      </b-card>
      </b-col>
      <b-col >
         <b-card> 
            <b-form-group>
      
              <b>Tareas:</b><br>             
            

              <b-form-checkbox-group
                id="tareas"
                v-model="seleccionado"
                :options="tareas"
                
                name="tareas"
                class="ml-4"
                aria-label="Individual flavours"

                
                stacked

              ></b-form-checkbox-group>

              

            </b-form-group>

            <div>
            
              seleccionado: <strong>{{ seleccionado }}</strong><br>
            </div>
         </b-card>
      </b-col>
   </b-row>
   

      <div class="text-ringth">
      <button type="button" class="btn btn-default" v-on:click="asignarATareasModal=false">Cancelar</button>
      
      <button class="btn btn-primary" v-on:click="tareaReportes()" ><span class="fa fa-check"></span>Actualizar</button>
    </div>

</b-modal>

<b-modal  hide-footer v-model="addReportesModal" size="sm">
   <template #modal-title>
     
      <h5>Crear Reporte </h5>
              
   </template>
      <b-form-group
           id="input-group-1"
           label="Nombre del Reporte:"
           label-for="input-1"
           description="Nombre que identificara el reporte"
         >
            <b-form-input
             id="input-1"
             v-model="form.nombre"
             placeholder="Ingrese nombre del reporte"
             required
           ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Descripcion:" label-for="input-2">
        <b-form-textarea
            id="textarea"
            v-model="form.descripcion"
            placeholder="Ingrese la descripion del reporte..."
            rows="3"
            max-rows="6"
          ></b-form-textarea>
      </b-form-group>

      <b-form-group id="input-group-2" label="Formato del reporte:" label-for="input-2">
         <b-form-select v-model="form.tipo"  class="mb-3" name="periodo" >
               <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
               <b-form-select-option :value="1" >PDF</b-form-select-option>
               <b-form-select-option :value="2" >EXCEL xlsx</b-form-select-option>
               <b-form-select-option :value="3" >EXCEL xls</b-form-select-option>
               <b-form-select-option :value="4" >TEXT csv</b-form-select-option>
               <b-form-select-option :value="5" >WORD</b-form-select-option>
               <b-form-select-option :value="6" >POWER POINT</b-form-select-option>
               <b-form-select-option :value="7" >OTROS</b-form-select-option>
              
         </b-form-select> 
      </b-form-group>

      <b-form-group id="input-group-2" label="Seleccione tipo de informacion adicional:" label-for="input-2">
         

         <b-form-select v-model="form.tipoinformacion"  class="mb-3" >
               <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
               <b-form-select-option :value="(datTipInf.id)" v-for="(datTipInf, i) in datoTipoInformacion" :key="i" v-if="datoTipoInformacion.length" >{{datTipInf.nombre}}</b-form-select-option>
         </b-form-select>
      </b-form-group>

      <b-form-group id="input-group-2" label="¿Habilitar reporte?" label-for="input-2">
         <b-form-checkbox v-model="form.estador" name="check-button" switch>
         
       </b-form-checkbox>
      </b-form-group>
      <b-button  variant="primary" @click="regReporte()" >Crear</b-button>
</b-modal>

<b-modal  hide-footer v-model="showEditModalReportes" size="sm">
   <template #modal-title>
     
      <h5>Registrar Reporte </h5>
              
   </template>
      <b-form-group
           id="input-group-1"
           label="Nombre del Reporte:"
           label-for="input-1"
           description="Nombre que identificara el reporte"
         >
            <b-form-input
             id="input-1"
             v-model="dataReporteAsig.nombre"
             placeholder="Ingrese nombre del reporte"
             required
           ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Descripcion:" label-for="input-2">
        <b-form-textarea
            id="textarea"
            v-model="dataReporteAsig.descripcion"
            placeholder="Ingrese la descripion del reporte..."
            rows="3"
            max-rows="6"
          ></b-form-textarea>
      </b-form-group>

      <b-form-group id="input-group-2" label="Formato del reporte:" label-for="input-2">
         <b-form-select v-model="dataReporteAsig.tipo"  class="mb-3" name="periodo" @change='buscarTareas()'>
               <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
               <b-form-select-option :value="1" >PDF</b-form-select-option>
               <b-form-select-option :value="2" >EXCEL xlsx</b-form-select-option>
               <b-form-select-option :value="3" >EXCEL xls</b-form-select-option>
               <b-form-select-option :value="4" >TEXT csv</b-form-select-option>
               <b-form-select-option :value="5" >WORD</b-form-select-option>
               <b-form-select-option :value="6" >POWER POINT</b-form-select-option>
               <b-form-select-option :value="7" >OTROS</b-form-select-option>
              
         </b-form-select> 
      </b-form-group>

      <b-form-group id="input-group-2" label="Seleccione tipo de informacion adicional:" label-for="input-2">
         <b-form-select v-model="dataReporteAsig.tipoinformacion"  class="mb-3" name="periodo" >
               <b-form-select-option :value="null" disabled>-- Please select an option --</b-form-select-option>
               <b-form-select-option :value="1" >Sin informe</b-form-select-option>
               <b-form-select-option :value="2" >Informacion Comercial</b-form-select-option>
              
         </b-form-select> 
      </b-form-group>

      <b-form-group id="input-group-2" label="¿Habilitar reporte?" label-for="input-2">
         <b-form-checkbox v-model="dataReporteAsig.estador" value="1" unchecked-value="0"  name="check-button" switch>
         
       </b-form-checkbox>
      </b-form-group>
      <b-button  variant="primary" @click="editRegReporte(dataReporteAsig)" >Actualizar</b-button>
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

      asignarATareasModal: false,
      addReportesModal: false,
      showEditModalReportes: false,

      reportes:[],
      tareas:[],
      seleccionado: [],
      nombreSeleccionado: [],
      flavours2: [],
      listPeriodos:[],
      datoTipoInformacion:[],
      form:{},

      filtro:{
        tipoBusqueda:'null',
      },

       transProps: {
          // Transition name
          name: 'flip-list'
        },
        dataReporteAsig:{

        },

     
        fields: [
          { key: 'id',label:'#', sortable: true, stickyColumn: true, isRowHeader: true},
          { key: 'nombre',label:'NOMBRE', sortable: true, stickyColumn: true },
          { key: 'tipo',label:'TIPO ARCHIVO', sortable: true, stickyColumn: true },
          { key: 'created_at',label:'OPCIONES', sortable: true },
          { key: 'updated_at',label:'DETALLE', sortable: true }
        ],
       
    }
  },


  methods : {

  
    
   getResultsGeneral(page = 1) {
      axios.get('app/reporte?page=' + page,{
         params: {
          

         }
      })
          .then(response => {
              //this.buscarExtraordinarios = response.data;
              //this.buscarExtraordinarioR = response.data;
              //this.mostrarBusqueda = true
              //this.mostrar = false
              console.log('datos buscados',response.data )
              this.reportes= response.data
             
              console.log(response.data)
          });
   },

   regReporte(){
      console.log('dentro de regReporte----:',this.form)

      axios.get('app/regReporte',{
          params: {
             //tipoSearch: this.searchData.tipoSearch,
             
            descripcion: this.form.descripcion,
            nombre: this.form.nombre,
            estador: this.form.estador,
            tipo: this.form.tipo,
            tipoinformacion: this.form.tipoinformacion,

          }
       }).then(res => {
         if (res.status == 201) {
           //console.log('index__',this.tareas.data[editData.index])
           //console.log('res___',res.data)
         this.reportes.data.unshift(res.data)
         this.addReportesModal = false
         //this.listRegAsig.data.unshift(res.data.trc)

        //    this.showEditModalTareas = false

            this.$swal('La creacion del reporte fue','Exitoso','success')

         }else{
            this.$swal('Intentelo nuevamente','Error','error')

         }



              //this.documentos= response.data
              
              //console.log(response.data)
           });
   },

   editReporte(dataReporte, index){
      console.log('dentro de edit TAreaas___:',dataReporte)
      console.log('dentro de edit TAreaas___:',index)


      let obj={
         
         descripcion: dataReporte.descripcion,
         estador: dataReporte.estador,
         tipo: dataReporte.tipo,
         tipoinformacion: dataReporte.tipoinformacion_id,
         fechafinal: dataReporte.fechafinal,
         id: dataReporte.id,
         nombre: dataReporte.nombre,
         estado: dataReporte.estado,
         index: index
      }
      this.dataReporteAsig = obj
      this.showEditModalReportes = true


   },

   editRegReporte(editData){
      console.log('listo para editar:___',editData)
       axios.put(`app/editRegReporte/${editData.id}`,{
          
             //tipoSearch: this.searchData.tipoSearch,
             
             descripcion: editData.descripcion,
             nombre: editData.nombre,
             estador: editData.estador,
             tipo: editData.tipo,
             tipoinformacion: editData.tipoinformacion,

          
       }).then(res => {
         if (res.status == 200) {
            console.log('index__',this.reportes.data[editData.index])
            console.log('res___',res.data)
            this.reportes.data[editData.index].estador = res.data.estador
            this.reportes.data[editData.index].nombre = res.data.nombre
            this.reportes.data[editData.index].descripcion = res.data.descripcion
            this.reportes.data[editData.index].tipo = res.data.tipo
            this.reportes.data[editData.index].tipoinformacion = res.data.tipoinformacion

            this.showEditModalReportes = false

            this.$swal('La actualizacion fue','Exitosa','success')

         }else{
            this.$swal('Intentelo nuevamente','Error','error')

         }
              //this.documentos= response.data
              
              //console.log(response.data)
         });

   },

   eliminarReporte(delData,index){
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
                  this.deleteReporte(delData,index)
                } else {
                  this.$swal('Cancelado', 'Usted cancelo la accion', 'info')
                }
              })
   },
   
   async deleteReporte(deleteItem, index){
         //this.isDeleing = true
         //const res = await this.callApi('post', 'app/delete_tags',this.deleteItem)
         
         const res = await this.callApi('delete', `app/deleteReporte/${deleteItem.id}`, deleteItem)
         if(res.status==200){
            this.reportes.data.splice(index, 1)

                  this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
          // this.$swal({
          //      
          //      icon: 'success',
          //      title: 'Eliminado',
          //      text: 'Usted elimino el registro corecctamente',
          //      showConfirmButton: false,
          //      timer: 2500
          //    });

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
      
///////////////////////***********************************************



    tareasRegModal(reporte, i){

      console.log('tdo mostrado',reporte)
      //this.asignarATareasModal= true

      let obj ={
        id : reporte.id,
        estado : reporte.estado,
        nombre : reporte.nombre,
        oficina_id : reporte.oficina_id,
        tipo : reporte.tipo,

        
      }
      //this.datoSedes = obj
      this.datoReportes = obj
      //this.buscarSedes(correo, i)
      //this.buscarTareas(reporte, i)
      this.filtro.periodo = '',
      this.flavours2 = '',
      this.seleccionado = '',

      this.asignarATareasModal= true
      //this.sedesModal = true
      this.index = index

    },

     buscarTareas() {
        console.log('dentro de buscarTareas',this.filtro.periodo[0])
        console.log('dentro de _________________',this.datoReportes.id)
         // axios.get('/back/app/sedesCorreo',{

            const formP = new FormData();
            formP.append('idReporte', this.datoReportes.id);
            formP.append('periodoId', this.filtro.periodo[0]);


        axios.get('app/tareasReporte',{
          //axios.get(`/app/sedesCorreo`,{
           params: {
             idReporte: this.datoReportes.id,
             periodoId: this.filtro.periodo[0],

           }
        }).then(function(res){

              

                   console.log('con________________sultas',res.status)
              if (res.status==200) {
                  this.flavours2 = res.data.datosReporte;
                  this.seleccionado = res.data.Seleccion;
                } else {
                   
                   this.$swal('Ocurrio algun problema','Actualice la pagina','warning')
                  
                }

              
          }.bind(this));



      },


      tareaReportes: function(datoReportes) {

console.log('dtos ingresados___', this.filtro.periodo[0])
         if (typeof this.filtro.periodo[0] === "undefined") return this.$swal({
                        toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Seleccione el periodo',
                    showConfirmButton: false,
                    timer: 5000
                  });


          //const res = await this.callApi('put', `app/user/${editData.id}`, this.editData)
            axios.post(`app/tareaReportes/${this.datoReportes.id}`,{
              // params: {
                 tareas_id: this.seleccionado,
                 periodoId: this.filtro.periodo[0],

               //}
            }).then(function(response){

            


          if (response.status==200) {
                    this.obsTipoExtraordinarios = response.data;
            
            this.$swal('Tareas actualizadas','Correctamente','success')
            this.asignarATareasModal = false
          } else {
             
              this.$swal('Ocurrio algun problema','Intentelo nuevamente','warning')
            
          }


              }.bind(this));

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

        getTipoInformacion(page = 1) { 
          axios.get('app/getTipoInformacion',{
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
                 this.datoTipoInformacion= response.data
                 
                 //console.log(response.data)
              });
      },

    



  },


    
  async created(){
    try {

      this.getResultsGeneral();
      this.listaPeriodos();
      this.getTipoInformacion();

      const [ res] = await Promise.all([
   
          this.callApi('get', 'app/getReporteTarea'),
   
        ])

        this.tareas = res.data
   
        console.log('los datos del tareas son',this.tareas)
     

      } catch {
        this.$swal('Any fool can use a computer','de','error')
      }
    
    
  },


  




}




  </script>