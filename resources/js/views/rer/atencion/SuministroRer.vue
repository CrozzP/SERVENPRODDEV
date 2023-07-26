<template>
<base-layout>
<Breadcrumbs>
  <template v-slot:titulo_breadcrumbs> Suministro RER
  </template>
  
  <template v-slot:prueba>
      <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    

    <li>Usuario RER</li>
    </template>
</Breadcrumbs>



  <div class="card mb-3">
    <div class="card-header d-flex">
      <span>
        <i class="fas fa-chart-area"></i>
           Suministros RER
      </span>
    


    <div class="form-inline my-2 my-lg-0 ml-auto" >


      <b-form-select v-model="searchData.tipoSearch" :options="options"></b-form-select>
      <b-form-input id="search"  v-model="searchData.search" type="text" placeholder="Search" aria-label="Search" v-on:keyup.enter="getResults">
            </b-form-input>
      
      
    </div>
      <button class="btn btn-outline-primary my-2 my-sm-0" @click="getResults"><span class="fas fa-search"></span> Buscars</button>

      <button class="btn btn-success btn-sm"  @click="getProvincias"><span class="fas fa-file-pdf"></span> Reporte Global</button>

    </div>
  </div>


  

    <div class="row">
      <div class="col-md-12  ml-auto mr-auto">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <table class="table table-hover">
                
                <thead>
                  <tr>
                    <td class=" text-white text-center" style="background-color: #6861ce !important;">ID</td>
                    <td class=" text-white text-center" style="background-color: #6861ce !important;">Suministro</td>
                    <td class=" text-white text-center" style="background-color: #6861ce !important;">Titular</td>
                    <td  class=" text-white text-center" style="background-color: #6861ce !important;">Centro Poblado</td>
                    
                    <td class=" text-white text-center" style="background-color: #6861ce !important;">Accion</td>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr v-for="(buscarSuministrorer, i) in buscarSuministrosrer.data" :key="i" v-if="buscarSuministrosrer.data.length">
                    <td>{{i+1}}</td>
                    <td>{{buscarSuministrorer.CodigoUsuario}}</td>
                    <td>{{buscarSuministrorer.Nombres}}</td>
                    <td>{{buscarSuministrorer.Distrito}}</td>
                    
                    
                    <td>
                      <b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
                        
                        <b-dropdown-item href="#"  @click="showSumistro(buscarSuministrorer,i)" ><button class="btn btn-primary btn-sm"  ><span class="fa fa-eye"></span></button> Ver
                        </b-dropdown-item>
                           
                        <b-dropdown-item href="#"  @click="showComprobante(buscarSuministrorer,i)"  >
                          <button class="btn btn-primary btn-sm" ><span class="fas fa-folder-open">
                            </span>
                          </button> Comprobantes
                        </b-dropdown-item>

                        <b-dropdown-item href="#"  >
                          <button class="btn btn-danger btn-sm" ><span class="fa fa-trash"></span></button> Eliminar
                        </b-dropdown-item>

                        <b-dropdown-item href="#"  @click="reportePDFRER(buscarSuministrorer, i)" >
                          <button class="btn btn-danger btn-sm"  ><span class="fas fa-file-pdf"></span></button> Reporte Deuda
                        </b-dropdown-item>

                        
                      </b-dropdown>
                    </td>

                    
                    
                  </tr>
                </tbody>
              </table>

              <div class="card mb-3">

                
              <advanced-laravel-vue-paginate :data="buscarSuministrosrer" @paginateTo="getResults"></advanced-laravel-vue-paginate>


              

    
              </div>


            </div>

          </div>
        </div>
      </div>
    </div>
<b-modal  hide-footer v-model="showData" title="Informacion del Suministro" size="xl" header-bg-variant="primary-gradient" header-text-variant="white">

  <b-card
            
    img-top
    tag="article"
    style="max-width: auto;"
    class="mb-2"
    bg-variant="primary-gradient" 
    text-variant="white" 

  >
  <h5>Titular y/o Representante</h5>
    <b-card-text>
      <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="3" >
        <b-col>
          
          <div class="flex-1 ml-3 pt-1  mt-3 b-b1 pb-2 mb-2 fw-bold">
            <h6 class=" fw-bold mb-1">Codigo : </h6>
            <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.CodigoUsuario}}</span>
          </div>
        </b-col>
        <b-col>
          
          <div class="flex-1 ml-3 pt-1  mt-3 b-b1 pb-2 mb-2 fw-bold">
            <h6 class=" fw-bold mb-1">Nombres : </h6>
            <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.Nombres}}</span>
          </div>
        </b-col>
        <b-col>
          <div class="flex-1 ml-3 pt-1 mt-3 b-b1 pb-2 mb-2 fw-bold">
            <h6 class=" fw-bold mb-1">Tipo Representante : </h6>
            <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.NombreTipoRepresentante}}</span>
          </div>
        </b-col>
        
      </b-row>

  <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="3">
    <b-col>
          
          <div class="flex-1 ml-3 pt-1  mt-3 b-b1 pb-2 mb-2 fw-bold">
            <h6 class=" fw-bold mb-1">Estado : </h6>
            <span class="text-uppercase text-warning pl-3">FALTA</span>
          </div>
        </b-col>
        <b-col>
          
          <div class="flex-1 ml-3 pt-1  mt-3 b-b1 pb-2 mb-2 fw-bold">
            <h6 class=" fw-bold mb-1">DNI : </h6>
            <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.Dni}}</span>
          </div>
        </b-col>
        <b-col>
          <div class="flex-1 ml-3 pt-1 mt-3 b-b1 pb-2 mb-2 fw-bold">
            <h6 class=" fw-bold mb-1">Nombre Representante : </h6>
            <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.ApellidoMaternoRepresentante}} {{datoSuministroRer.ApellidoPaternoRepresentante}} {{datoSuministroRer.NombreRepresentante}}</span>
          </div>
        </b-col>
        
  </b-row>

    <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="3">
    <b-col>
          
          <div class="flex-1 ml-3 pt-1">
            <h6 class=" fw-bold mb-1">Sexo : </h6>
            <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.Sexo}}</span>
          </div>
        </b-col>
        <b-col>
          
          <div class="flex-1 ml-3 pt-1">
            <h6 class=" fw-bold mb-1">Fecha Nacimiento : </h6>
            <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.FechaNacimiento}}</span>
          </div>
        </b-col>
        <b-col>
          <div class="flex-1 ml-3 pt-1">
            <h6 class=" fw-bold mb-1">DNI Representante : </h6>
            <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.dniRepresentante}}</span>
          </div>
        </b-col>
        
  </b-row>
      

    </b-card-text>

    
  </b-card>
  <div class="row">
    
  
  <div class="col-md-6">

    <b-card
              
      img-top
      tag="article"
      style="max-width: auto;"
      class="mb-2"
      bg-variant="primary" 
      text-variant="white" 

    >
      <h5>Localidad</h5>
      <b-card-text>
        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2" >
          <b-col>
            
            <div class="flex-1 ml-3 pt-1  mt-3 b-b1 pb-2 mb-2 fw-bold">
              <h6 class=" fw-bold mb-1">Departamento : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.Departamento}}</span>
            </div>
          </b-col>
          <b-col>
            <div class="flex-1 ml-3 pt-1 mt-3 b-b1 pb-2 mb-2 fw-bold">
              <h6 class=" fw-bold mb-1">Provincia : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.Provincia}}</span>
            </div>
          </b-col>
          
        </b-row>

    <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
      <b-col>
            
            <div class="flex-1 ml-3 pt-1  mt-3 b-b1 pb-2 mb-2 fw-bold">
              <h6 class=" fw-bold mb-1">Distrito : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.Distrito}}</span>
            </div>
          </b-col>
          <b-col>
            <div class="flex-1 ml-3 pt-1 mt-3 b-b1 pb-2 mb-2 fw-bold">
              <h6 class=" fw-bold mb-1">Coordenadas : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.LatitudWG}}, {{datoSuministroRer.LongitudWG}}</span>
            </div>
          </b-col>
          
    </b-row>

      <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
      <b-col>
            
            <div class="flex-1 ml-3 pt-1">
              <h6 class=" fw-bold mb-1">Centro Poblado : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.CentroPoblado}}</span>
            </div>
          </b-col>
          <b-col>
            <div class="flex-1 ml-3 pt-1">
              <h6 class=" fw-bold mb-1">Ubicacion : </h6>
              <span class="text-uppercase text-warning pl-3">
                <a :href="`https://maps.google.com/?q=${datoSuministroRer.LatitudWG},${datoSuministroRer.LongitudWG}&z=18`" target="_blank">
                  Mapa
                </a>
              </span>
              <span class="text-uppercase text-warning pl-3">
                <a :href="`https://maps.google.com/?q=${datoSuministroRer.LatitudWG},${datoSuministroRer.LongitudWG}&z=18&t=k`" target="_blank">
                  Satelite
                </a>
              </span>
              
              
              

               

            </div>
          </b-col>
          
    </b-row>
        

      </b-card-text>

      
    </b-card>
  </div>

   <div class="col-md-6">

    <b-card
              
      img-top
      tag="article"
      style="max-width: auto;"
      class="mb-2"
      bg-variant="primary" 
      text-variant="white" 

    >
      <h5>Instalacion</h5>
      <b-card-text>
        <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2" >
          <b-col>
            
            <div class="flex-1 ml-3 pt-1  mt-3 b-b1 pb-2 mb-2 fw-bold">
              <h6 class=" fw-bold mb-1">Fecha Instalacion : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.FechaInstalacion}}</span>
            </div>
          </b-col>
          <b-col>
            <div class="flex-1 ml-3 pt-1 mt-3 b-b1 pb-2 mb-2 fw-bold">
              <h6 class=" fw-bold mb-1">Tipo Instalacion : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.CodigoTipoInstalacion}}</span>
            </div>
          </b-col>
          
        </b-row>

    <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
      <b-col>
            
            <div class="flex-1 ml-3 pt-1  mt-3 b-b1 pb-2 mb-2 fw-bold">
              <h6 class=" fw-bold mb-1">Calificacion : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.Calificacion}}</span>
            </div>
          </b-col>
          <b-col>
            <div class="flex-1 ml-3 pt-1 mt-3 b-b1 pb-2 mb-2 fw-bold">
              <h6 class=" fw-bold mb-1">Zona UTM : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.ZonaUTM}}</span>
            </div>
          </b-col>
          
    </b-row>

      <b-row cols="1" cols-sm="1" cols-md="2" cols-lg="2">
      <b-col>
            
            <div class="flex-1 ml-3 pt-1">
              <h6 class=" fw-bold mb-1">Operativo : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.Funcionando}}</span>
            </div>
          </b-col>
          <b-col>
            <div class="flex-1 ml-3 pt-1">
              <h6 class=" fw-bold mb-1">Contrato : </h6>
              <span class="text-uppercase text-warning pl-3">{{datoSuministroRer.ConContrato}}</span>
            </div>
          </b-col>
          
    </b-row>
        

      </b-card-text>

      
    </b-card>
  </div>

            

</div>


</b-modal>


<b-modal  hide-footer v-model="comprobatesData" title="Comprabantes del Suministro" size="xl">
    <table class=" table  table-hover">
          
          <thead>
            <tr>
              <td class=" text-white text-center" style="background-color: #6861ce !important;">#</td>
              <td class=" text-white text-center" style="background-color: #6861ce !important;">NUMERO DE COMPROBANTE</td>
              <td  class=" text-white text-center" style="background-color: #6861ce !important;">SERIE SUMINISTRO</td>
              <td class=" text-white text-center" style="background-color: #6861ce !important;">PERIODO COMERCIAL</td>
              
              <td class=" text-white text-center" style="background-color: #6861ce !important;">ESTADO PAGO</td>
              <td class=" text-white text-center" style="background-color: #6861ce !important;">ACCIONES</td>
            </tr>
          </thead>
          <tbody>
            <tr  v-for="(comprobanteEncontrado, i) in comprobanteEncontrados" :key="i" v-if="comprobanteEncontrados.length">
              <td>{{i+1}}</td>
              <td>{{comprobanteEncontrado.NumeroComprobante}}</td>
              <td>{{comprobanteEncontrado.SerieSuministro}}</td>
              <td>{{comprobanteEncontrado.PERIODOCOMERCIAL}}</td>
              <td v-if="comprobanteEncontrado.estadoPago == 0" >
                <b-button pill variant="danger" size="sm">Pendiente</b-button>
              </td>
              <td v-else-if="comprobanteEncontrado.estadoPago == 1" >
                
                <b-button pill variant="success" size="sm">Cancelado</b-button>

              </td>
              <td v-else-if="comprobanteEncontrado.estadoPago == 2" >
                
                <b-button pill variant="primary" size="sm">Bono-RER</b-button>

              </td>
              
              
              <td>
                <b-dropdown id="dropdown-dropleft" dropleft text="Acciones" variant="outline-primary" class="m-2">
                  <div>
                  <b-dropdown-item href="#" v-if="comprobanteEncontrado.estadoPago == 0" @click="pdfComprobante(comprobanteEncontrado, i)"><button class="btn btn-primary btn-sm"  ><span class="far fa-file-pdf"></span></button> Mostrar Comprobante
                  </b-dropdown-item>
                    
                  </div>


                  <b-dropdown-item href="#"   if="isWritePermitted" >
                    <button class="btn btn-primary btn-sm" ><span class="fas fa-plus">
                </span></button> Registrar
                  </b-dropdown-item>

                  <b-dropdown-item href="#"   v-if="isDeletePermitted">
                    <button class="btn btn-danger btn-sm" ><span class="fa fa-trash"></span></button> Eliminar
                  </b-dropdown-item>

                  

                  
                </b-dropdown>
              </td>

              
              
            </tr>
          </tbody>
        </table>
</b-modal>

<b-modal  hide-footer v-model="showPdfComprobante" title="Datos del comprobante" size="lg">



  <template>
      
      
      <button class="btn btn-primary btn-sm" @click="pdfImprimir(datopdfComprobante)">
        <span class="fas fa-print">
        </span> Imprimir:
      </button>

      
                       
      
        
    <pdf ref="myPdfComponent" v-bind:src="'' + datopdfComprobante.prueba3" v-if="datopdfComprobante.tipoComprobante == 'B112'"></pdf>
    <pdf ref="myPdfComponent" v-bind:src="'' + datopdfComprobante.prueba" v-if="datopdfComprobante.tipoComprobante == 'B012'"></pdf>
    <pdf ref="myPdfComponent" v-bind:src="'' + datopdfComprobante.prueba2" v-if="datopdfComprobante.tipoComprobante == 'F012'"></pdf>
    <pdf ref="myPdfComponent" v-bind:src="'' + datopdfComprobante.pruebav2" v-if="datopdfComprobante.tipoComprobante == 'S012'"></pdf>
    <pdf ref="myPdfComponent" v-bind:src="'' + datopdfComprobante.prueba2v2" v-if="datopdfComprobante.tipoComprobante == 'S112'"></pdf>
    <pdf ref="myPdfComponent" v-bind:src="'' + datopdfComprobante.prueba3v2" v-if="datopdfComprobante.tipoComprobante == 'S113'"></pdf>

      

       
      
      
  </template>

</b-modal>

<b-modal  hide-footer v-model="ModalReporte" title="Reporte Morosidad">
  
   <strong>El filtro se realiza con el ubigeo de los Recibos/comprobantes.</strong>

      <b-form-group id="input-group-1" label="Seleccionar Provincia" label-for="provincia_id">
           <b-form-select v-model="filtroCCPP.provincia_id" class="mb-3" name="provinciaId"   v-on:change="getDistritos(filtroCCPP.provincia_id)">
            
              <b-form-select-option :value="null" disabled>-- Seleccione una opcion --</b-form-select-option>
              <b-form-select-option :value="provinciaId.id"  v-for="(provinciaId, i) in provincias" :key="i" v-if="provincias.length">{{provinciaId.nameProvincia}}</b-form-select-option>
          </b-form-select>


      </b-form-group>


      <b-form-group id="input-group-1" label="Seleccionar Distrito" label-for="distrito_id">
           <b-form-select v-model="filtroCCPP.distrito_id" class="mb-3" name="provinciaId"  v-on:change="getCentrosPoblados(filtroCCPP.distrito_id)" >
            
              <b-form-select-option :value="null" disabled>-- Seleccione una opcion --</b-form-select-option>
              <b-form-select-option :value="distritoId.nameDistrito"  v-for="(distritoId, i) in distritos" :key="i" v-if="distritos.length">{{distritoId.nameDistrito}}</b-form-select-option>
          </b-form-select>


      </b-form-group>


      <b-form-group id="input-group-1" label="Seleccionar Centro Poblado/Comunidad" label-for="ccpp_id">
           <b-form-select v-model="filtroCCPP.ccpp_id" class="mb-3" name="provinciaId"  >
            
              <b-form-select-option :value="null" disabled>-- Seleccione una opcion --</b-form-select-option>
              <b-form-select-option :value="ccppId.nombreccpp"  v-for="(ccppId, i) in centrosPoblados" :key="i" v-if="centrosPoblados.length">{{ccppId.nombreccpp}}</b-form-select-option>
          </b-form-select>


      </b-form-group>

      

      <b-button block variant="primary" @click="descargarReporte(filtroCCPP)">
         <span class="fas fa-print">
        </span> Descargar Reporte
      </b-button>

</b-modal>

</base-layout>

</template>

<script>

import Breadcrumbs from '../../../components/layouts/rer/includes/Breadcrumbs.vue';
import pdf from 'vue-pdf';

export default{
  components: {
    Breadcrumbs,
    pdf,
    
    
  },



  data(){
    return {
      data : {
        
      },

      searchData:{
        tipoSearch: null,

      },
      

      comprobatesData:false,
      showData:false,
      showPdfComprobante:false,
      ModalReporte:false,

      options: [
          { value: null, text: 'Please select an option' },
          { value: 'dni', text: 'DNI' },
          { value: 'CodigoUsuario', text: 'Suministro' },
          { value: 'Nombres', text: 'Apellidos y Nombres' }
          
        ],


      provincias: [],
      distritos: [],
      centrosPoblados: [],


      filtroCCPP: {},

        datopdfComprobante:{},
      buscarSuministrorer:{},
      buscarSuministrosrer:{},
      buscarSuministrosrerR:{},

      comprobanteEncontrado: {},
      comprobanteEncontrados: [],

      datoSuministroRer: {},
      
    }
  },


  methods : {

    
    async showSumistro(buscarSuministrorer,i){

      let obj ={
        CodigoUsuario: buscarSuministrorer.CodigoUsuario,
        Dni: buscarSuministrorer.dni,
        Nombre: buscarSuministrorer.Nombre,
        ApellidoPaterno: buscarSuministrorer.ApellidoPaterno,
        ApellidoMaterno: buscarSuministrorer.ApellidoMaterno,
        Nombres: buscarSuministrorer.Nombres,
        Sexo: buscarSuministrorer.Sexo,
        Departamento: buscarSuministrorer.Departamento,
        Departamento_id: buscarSuministrorer.Departamento_id,
        Provincia: buscarSuministrorer.Provincia,
        Provincia_id: buscarSuministrorer.Provincia_id,
        Distrito: buscarSuministrorer.Distrito,
        Distrito_id: buscarSuministrorer.Distrito_id,
        CentroPoblado: buscarSuministrorer.CentroPoblado,
        FechaNacimiento: buscarSuministrorer.FechaNacimiento,

        Reniec: buscarSuministrorer.Reniec,


        Calificacion: buscarSuministrorer.Calificacion,
        CodigoTipoInstalacion: buscarSuministrorer.CodigoTipoInstalacion,
        FechaInstalacion: buscarSuministrorer.FechaInstalacion,
        Funcionando: buscarSuministrorer.Funcionando,
        LatitudWG: buscarSuministrorer.LatitudWG,
        LongitudWG: buscarSuministrorer.LongitudWG,
        ZonaUTM: buscarSuministrorer.ZonaUTM,



        NombreInstitucion: buscarSuministrorer.NombreInstitucion,
        RazonSocial: buscarSuministrorer.RazonSocial,
        ruc: buscarSuministrorer.ruc,




        NombreRepresentante: buscarSuministrorer.NombreRepresentante,
        NombreTipoRepresentante: buscarSuministrorer.NombreTipoRepresentante,
        ApellidoMaternoRepresentante: buscarSuministrorer.ApellidoMaternoRepresentante,
        ApellidoPaternoRepresentante: buscarSuministrorer.ApellidoPaternoRepresentante,
        dniRepresentante: buscarSuministrorer.dniRepresentante,

        ConCapacitacion: buscarSuministrorer.ConCapacitacion,
        ConContrato: buscarSuministrorer.ConContrato,
        ConDeterioro: buscarSuministrorer.ConDeterioro,
        ConDeudaInstalacion: buscarSuministrorer.ConDeudaInstalacion,
        ConLimpieza: buscarSuministrorer.ConLimpieza,
        ConMaterialInformativoFuncion: buscarSuministrorer.ConMaterialInformativoFuncion,
        ConMaterialInformativoMantenimiento: buscarSuministrorer.ConMaterialInformativoMantenimiento,
        ConMaterialInformativoOperatividad: buscarSuministrorer.ConMaterialInformativoOperatividad,
        ConMaterialInformativoUso: buscarSuministrorer.ConMaterialInformativoUso,
        ConObservacion: buscarSuministrorer.ConObservacion,
        ConReclamo: buscarSuministrorer.ConReclamo,
        ConTtrabajoPendiente: buscarSuministrorer.ConTtrabajoPendiente,



      }


      this.datoSuministroRer = obj

      this.showData=true

    }, 

    async addSuministroRerAtencion(datopdfComprobante){

       const res = await this.callApi('post', '/rer/app/suministroreratencion', this.datopdfComprobante)
                //const res = await this.callApi('post', 'back/app/user', this.editData)
                  
                if (res.status==201) {
                  //this.roles[this.index].roleName = this.editData.roleName
                  //this.users[this.index] = this.editData
                  //this.$swal('Excelent !','Actualizo sus datoscorrectamente','success')
                  //this.editModal = false
                  this.$refs.myPdfComponent.print()
                  //this.showPdfComprobante=false
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
                    //this.$refs.myPdfComponent.print()
                    this.$swal('Intentelo nuevamente','de','error')
                  }
                }


    }, 
    async pdfImprimir(datopdfComprobante){

      console.log('info print',datopdfComprobante)

      this.$swal({
              title: '¿ Estas seguro ?',
              text: 'No puedes revertir despues de esta accion',
              icon: 'warning',
              
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si, Deseo Imprimir!',
              cancelButtonText: 'No, Deseo Cancelar!',
              showCloseButton: true,
              showLoaderOnConfirm: true,
            }).then((result) => {
              if(result.value) {
                //this.$swal('Eliminado', 'Usted elimino el registro corecctamente', 'success')
               this.addSuministroRerAtencion(datopdfComprobante);
                
              } else {
                this.$swal('Cancelado', 'Usted cancelo la impresion', 'info')
              }
            })

      

    }, 

    async pdfComprobante(comprobanteEncontrado, index){

      //console.log('datos del comprobante:',comprobanteEncontrado)
      //console.log('PERIODOCOMERCIAL-full:',comprobanteEncontrado.PERIODOCOMERCIAL)
     // console.log('PERIODOCOMERCIAL-edit:',(comprobanteEncontrado.PERIODOCOMERCIAL).substring(3,-1))
let obj ={
        
      //  PERIODOCOMERCIAL : comprobanteEncontrado.PERIODOCOMERCIAL,
     //   distrito : comprobanteEncontrado.NOMBDIST,
     //   Bloque_id : comprobanteEncontrado.Bloque_id,
     //   periodoAño : `${ comprobanteEncontrado.PERIODOCOMERCIAL }`.substring(0,4),
     //   periodoMes : `${ comprobanteEncontrado.PERIODOCOMERCIAL }`.substring(4,2),
     //   serieNumeroComprobante : `${ comprobanteEncontrado.SerieSuministro }`.substring(0,13),
        //CodigoRutaSuministro : extraordinario.suministro.CodigoRutaSuministro,
        //prueba: '/storage/pdf/'+ comprobanteEncontrado.Bloque_id+'/' +`${comprobanteEncontrado.NOMBDIST}` +'/'+ `${ comprobanteEncontrado.PERIODOCOMERCIAL }`.substring(0,4)+'/20557294849-03-'+`${ comprobanteEncontrado.SerieSuministro }`.substring(0,13)+'.pdf',

        prueba: '/storage/pdf/'
                + comprobanteEncontrado.Bloque_id
                +'/' 
                +`${comprobanteEncontrado.PERIODOCOMERCIAL}`.substring(6,4)
                +'/' 
                +`${comprobanteEncontrado.NOMBDIST}` 
                +'/'
                 +'20557294849-03-'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(0,13)
                 +'.pdf',

        pruebav2: '/storage/pdf/'
                + comprobanteEncontrado.Bloque_id
                +'/' 
                +`${comprobanteEncontrado.PERIODOCOMERCIAL}`.substring(6,4)
                +'/' 
                +`${comprobanteEncontrado.NOMBDIST}` 
                +'/'
                 +'20557294849-14-'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(0,5)
                 +'00'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(5,13)
                 +'.pdf',

        prueba2: '/storage/pdf-R2R3/'
                + comprobanteEncontrado.Bloque_id
                +'/' 
                +`${comprobanteEncontrado.PERIODOCOMERCIAL}`.substring(6,4)
                +'/' 
                +`${comprobanteEncontrado.NOMBDIST}` 
                +'/'
                 +'20557294849-01-'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(0,13)
                 +'.pdf',

        prueba2v2: '/storage/pdf-R2R3/'
                + comprobanteEncontrado.Bloque_id
                +'/' 
                +`${comprobanteEncontrado.PERIODOCOMERCIAL}`.substring(6,4)
                +'/' 
                +`${comprobanteEncontrado.NOMBDIST}` 
                +'/'
                 +'20557294849-14-'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(0,5)
                 +'00'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(5,13)
                 +'.pdf',

        prueba3: '/storage/pdf-R2R3/'
                + comprobanteEncontrado.Bloque_id
                +'/' 
                +`${comprobanteEncontrado.PERIODOCOMERCIAL}`.substring(6,4)
                +'/' 
                +`${comprobanteEncontrado.NOMBDIST}` 
                +'/'
                 +'20557294849-03-'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(0,13)
                 +'.pdf',

        prueba3v2: '/storage/pdf-R2R3/'
                + comprobanteEncontrado.Bloque_id
                +'/' 
                +`${comprobanteEncontrado.PERIODOCOMERCIAL}`.substring(6,4)
                +'/' 
                +`${comprobanteEncontrado.NOMBDIST}` 
                +'/'
                 +'20557294849-14-'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(0,5)
                 +'00'
                 +`${ comprobanteEncontrado.SerieSuministro }`.substring(5,13)
                 +'.pdf',

        tipoComprobante: comprobanteEncontrado.NUMERODESERIEDECOMPROBANTE,
        suministrorer_id:comprobanteEncontrado.Suministro_id,
        comprobante_id:comprobanteEncontrado.Id,

       // prueba:'/storage/pdfj/prueba.pdf'
      }


      this.datopdfComprobante = obj
     // console.log('PERIODOCOMERCIAL-full:',this.datopdfComprobante.PERIODOCOMERCIAL)
     // console.log('PERIODOCOMERCIAL-edit:',this.datopdfComprobante.PERIODOCOMERCIAL)
     // 
     // console.log(`${ this.datopdfComprobante.PERIODOCOMERCIAL }`.substring(0,4))
//
    //
     // console.log(`${ comprobanteEncontrado.PERIODOCOMERCIAL }`.substring(0,4))
//
//`${ this.text.substring(0,36) }...
console.log(this.datopdfComprobante)
console.log(this.datopdfComprobante.PERIODOCOMERCIAL)
console.log(this.datopdfComprobante.periodoAño)
console.log(this.datopdfComprobante.periodoMes)
console.log(this.datopdfComprobante.serieNumeroComprobante)
console.log('1', this.datopdfComprobante.prueba)
console.log('2', this.datopdfComprobante.prueba2)
console.log('1v2', this.datopdfComprobante.pruebav2)
console.log('2v2', this.datopdfComprobante.prueba2v2)
console.log(this.datopdfComprobante.distrito +'/'+ this.datopdfComprobante.periodoMes)
      this.showPdfComprobante=true
    },

//    async showComprobante(){
//
//      this.comprobatesData=true
//    },

    async showComprobante(buscarSuministrorer, index){
      this.comprobatesData=true
      let obj ={
        
        Suministro_id : buscarSuministrorer.Id,
        //CodigoRutaSuministro : extraordinario.suministro.CodigoRutaSuministro,
        
      }


      this.datoSuministro = obj


    

      //axios.get(`/back/app/personaExtraordinario`, {
      //const res = await this.callApi('delete', `app/extraordinario/${deleteItem.id}`, this.deleteItem)
     // axios.get(`/rer/app/buscarComprobante/${this.datoSuministro.Suministro_id}`,{
      //const res = await this.callApi('get', '/rer/app/buscarComprobante', this.datoSuministro.Suministro_id)
      axios.get(`/rer/app/buscarComprobante`,{
             params: {
               persona_id: this.datoSuministro.Suministro_id

             }
          }).then(function(response){
               
                 if (response.status==200) {

                    this.comprobanteEncontrados = response.data
                    console.log('datos del comprobante',this.comprobanteEncontrado)
      
                    
                        
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
                          this.$swal('Algo salio mal','Verifique los correos','error')
                        }
                      }

            }.bind(this));



    },











    getResults(page = 1) {
            axios.get('app/suministrorerBuscar?page=' + page,{
               params: {
                tipoSearch: this.searchData.tipoSearch,
                  search: this.searchData.search

               }
            })
                .then(response => {
                    this.buscarSuministrosrer = response.data;
                    this.buscarSuministrosrerR = response.data;
                   
                    console.log(response.data)
                });
        },

    reportePDFRER(buscarSuministrorer, index){

        

      console.log('dentro de reportePDFRER',buscarSuministrorer.Id)
      window.open(`/rer/app/generate-rerpdf/${buscarSuministrorer.Id}`);
      
      //redirect: '/back/app/generate-pdf'
      //window.location.href = '/back/app/generate-pdf'
      //window.location.href = `/back/app/generate-pdf/${this.editData.tipoExtraordinario_id}`
      
      ///window.location.href = `/back/app/generate-pdf/${extraordinario.id}`
      //window.open(`/back/app/generate-pdf/${extraordinario.id}`, '_blank');
          
            /*axios.get(`/back/app/generate-pdf/${extraordinario.id}`,{
             params: {
               tipoExtraordinario_id: extraordinario.id

             }
          }).then(function(response){
                this.obsTipoExtraordinarios = response.data;
                //window.open('/back/app/generate-pdf');
            }.bind(this));*/

        },

      async getProvincias(){
         console.log('_______-------------________')
         this.ModalReporte=true
            


         const res = await this.callApi('post', `/rer/app/provincia/getProvincia`)
         if (res.status == 200) {

                     this.provincias = res.data;
                     this.filtroCCPP.provincia_id =''
                     this.filtroCCPP.distrito_id =''
                     this.filtroCCPP.ccpp_id =''

         }else {
                  this.$swal('Algo salio mal','Contactarse con soporte','error')
               
            }


      },

      async getDistritos(){
         console.log('_______-------------_____DISTRITO___')
        // this.ModalReporte=true
            


         const res = await this.callApi('post', `/rer/app/distrito/getDistrito`,this.filtroCCPP)
         if (res.status == 200) {

                     this.distritos = res.data;
                     this.filtroCCPP.distrito_id =''
                     this.filtroCCPP.ccpp_id =''

         }else {
                  this.$swal('Algo salio mal','Contactarse con soporte','error')
               
            }


      },

      async getCentrosPoblados(){
         console.log('_______-------------_____DISTRITO___')
        // this.ModalReporte=true
            


         const res = await this.callApi('post', `/rer/app/ccpp/getCentroPoblado`,this.filtroCCPP)
         if (res.status == 200) {

                     this.centrosPoblados = res.data;
                     this.filtroCCPP.ccpp_id =''

         }else {
                  this.$swal('Algo salio mal','Contactarse con soporte','error')
               
            }


      },

      



    descargarReporte(datacpp){

        

      console.log('dentro de reportePDFRER___:::',datacpp)
     // window.open(`/rer/app/reporte-rerpdf/${datacpp}`);

         axios({
           method: 'post',
           url: 'app/reporte-rerpdf',
           responseType: 'arraybuffer',
           data: datacpp,
           //data: this.fff,
          
         }).then(function(response) {
           let blob = new Blob([response.data], { type: 'application/pdf'})
           let link = document.createElement('a')
           link.href = window.URL.createObjectURL(blob)
            //console.log(filename)
           //link.download = 'Report.pdf'
          // link.click()

            window.open(link.href)


         })


        },



    




  },


  async created(){
     try {
       this.getResults();
      // this.getProvincias();
   //    //console.log(this.isWritePermitted)
   //    //console.log('esto es el permiso')
   //    
   //
   //    //const [res, resTipoExtraordinario] = await Promise.all([
     //  const [ resProvincia] = await Promise.all([
     //      
     //         this.callApi('get', 'app/getProvincia')
     //    ])
     //  this.provincias = resProvincia.data
     // console.log('_________-------___________',this.provincias)
   //
   //      //this.suministros = res.data
   //      this.tipoExtraordinarios = resTipoExtraordinario.data
   //      console.log('los datos del suministro son',resTipoExtraordinario.data)
   //      //console.log('los datos del suministro son',this.tipoExtraordinarios)
   //
   //      //console.log('es el usuario',this.users)
   //      //console.log('es el usuario logueado ',this.userLogged['permissions'])
   //
       } catch {
         this.$swal('Algo salio mal','intente nuevamente','error')
       }
    
    
  },



    

    


  




}




  </script>