<template>
<base-layout>
<Breadcrumbs>
  <template v-slot:titulo_breadcrumbs> Resumen 
  </template>
  
  <template v-slot:prueba>
      <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>
    <li><a href="#">Pendientes</a></li>
    <li class="separator">
      <i class="flaticon-right-arrow"></i>
    </li>

    <li>Resumen Reportes</li>
    </template>
</Breadcrumbs>

  <div class="card mb-3">
    <div class="card-header d-flex">
      <span>
        <i class="fas fa-chart-area"></i>
          Generar Resumen
      </span>

    <button class="btn btn-primary btn-sm ml-auto"  v-b-toggle.collapse-1 ><span class="fa fa-filter"></span> Filtro</button>
    <button class="btn btn-primary btn-sm ml-auto"  @click="modalShow = true"><span class="fa fa-filter"></span> Mostrar Prueba</button>
    <button class="btn btn-primary btn-sm ml-auto"  @click="getInformacionReportes()"><span class="fa fa-filter"></span> Mostrar Datos</button>
      <b-modal v-model="modalShow" size="xl">
         <table class="table table-responsive hover resumenTabla  table-hover"  >
                        <thead>
                          
                           
                        
                        
                           <tr style="background-color: rgb(180 198 231);">  
                              <th style="text-align: right;"  colspan="1" rowspan="2">
                                 Categoria
                              </th>  
                              <th style="text-align: center;"  rowspan="2">
                                 Tarifa
                              </th>  
                              <th  style="text-align: center; border-right: solid 1px;"  colspan="12">
                                 2021
                              </th> 
                              <th  style="text-align: center; border-right: solid 1px;"  colspan="12">
                                 2022
                              </th> 
                           </tr>
                           <tr style="background-color: rgb(180 198 231);">
                              <th style="text-align: center;" >
                                 Ene-21
                              </th>
                              <th style="text-align: center;" >
                                 Feb-21
                              </th>
                              <th style="text-align: center;" >
                                 Mar-21
                              </th>
                              <th style="text-align: center;" >
                                 Abr-21
                              </th>
                              <th style="text-align: center;" >
                                 May-21
                              </th>
                              <th style="text-align: center;" >
                                 Jun-21
                              </th>
                              <th style="text-align: center;" >
                                 Jul-21
                              </th>
                              <th style="text-align: center;" >
                                 Ago-21
                              </th>
                              <th style="text-align: center;" >
                                 Set-21
                              </th>
                              <th style="text-align: center;" >
                                 Oct-21
                              </th>
                              <th style="text-align: center;" >
                                 Nov-21
                              </th>
                              <th style="text-align: center;" >
                                 Dic-21
                              </th>
                              <th style="text-align: center;" >
                                 Ene-22
                              </th>
                              <th style="text-align: center;" >
                                 Feb-22
                              </th>
                              <th style="text-align: center;" >
                                 Mar-22
                              </th>
                              <th style="text-align: center;" >
                                 Abr-22
                              </th>
                              <th style="text-align: center;" >
                                 May-22
                              </th>
                              <th style="text-align: center;" >
                                 Jun-22
                              </th>
                              <th style="text-align: center;" >
                                 Jul-22
                              </th>
                              <th style="text-align: center;" >
                                 Ago-22
                              </th>
                              <th style="text-align: center;" >
                                 Set-22
                              </th>
                              <th style="text-align: center;" >
                                 Oct-22
                              </th>
                              <th style="text-align: center;" >
                                 Nov-22
                              </th>
                              <th style="text-align: center;" >
                                 Dic-22
                              </th>
                           </tr>
                                  

                        </thead>
                        <tbody  >

                           <td>

                           </td>

                           <td  >
                              <tr>
                                 <th rowspan="12" style="text-align: center; border-right: solid 1px;">         
                                    REGULADOS
                                 </th>
                              </tr>
                              
                              <tr>
                                 <td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-align: left; padding-left: 10px !important; "><0 a 30]</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</td>
                              </tr>
                              <tr>
                                 <td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</td>
                              </tr>
                              <tr>
                                 <th  scope="col" style="white-space: nowrap;">SUB TOTAL REGULADO</th>
                              </tr>

                              <tr>
                                 <th rowspan="2"  style="text-align: center; ">
                                       
                                    LIBRES
                                 </th>
                              </tr>

                              <tr>
                                 <th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</th>
                              </tr>
                              <tr>
                                 <th scope="col"  colspan="1" style="text-align: center;">TOTAL:</th>
                              </tr>


                              
                           </td>
                           <td v-for="(datInf, i) in ventaEnergia" :key="i" v-if="ventaEnergia.length" >
                                 <tr><th style="text-align: right;">{{datInf.no_residencial}}</th></tr>
                                 <tr><td>{{datInf.mt}}</td></tr>
                                 <tr><td>{{datInf.bt}}</td></tr>
                                 <tr><th style="text-align: right;">{{datInf.residencial_bt}}</th></tr>
                                 <tr><td>{{datInf.cero_treinta}}</td></tr>
                                 <tr><td>{{datInf.treinta_cien}}</td></tr>
                                 <tr><td>{{datInf.cien_ccincuenta}}</td></tr>
                                 <tr><td>{{datInf.ccincuenta_trecientos}}</td></tr>
                                 <tr><td>{{datInf.trecientos_quinientos}}</td></tr>
                                 <tr><td>{{datInf.mas_quinientos}}</td></tr>
                                 <tr><th style="text-align: right;">{{datInf.st_regulado}}</th></tr>
                                 <tr><th style="text-align: right;">{{datInf.st_libre}}</th></tr>
                                 <tr><th style="text-align: right;">{{datInf.total}}</th></tr>
                           </td>

                           
                        </tbody>
                     </table>
      </b-modal>

    </div>
    
     <b-collapse id="collapse-1" class="mt-2 marginCard">
       <b-card class="marginCard">
           <b-row>
            holi
           </b-row>
          
       </b-card>
     </b-collapse>

  

  </div>
    <div class="row">
      <div class="col-md-12  ml-auto mr-auto">
        <div class="card">
          <div class="card-body">
            
            <div>
               
               
            </div>
            <div>
               <h6><strong style="background-color: green; color: white; padding: 3px;">A</strong> <strong>VENTA DE ENERGIA  ( MWH)</strong></h6>
               <h7  style="color: red; padding-left: 5px;"><strong>CONSIDERANDO EL MES EMITIDO</strong></h7>

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                        <b-th style="text-align: right;"  colspan="1" rowspan="2">
                           Categoria
                        </b-th>  
                        <b-th style="text-align: center;  border-right: solid 1px;"  rowspan="2">
                           Tarifa
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>

                     <b-td  >
                        <b-tr>
                           <b-th rowspan="12" style="text-align: center; border-right: solid 1px;">         
                              REGULADOS
                           </b-th>
                        </b-tr>
                        
                        <b-tr>
                           <b-td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><0 a 30]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</b-td>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL REGULADO</b-th>
                        </b-tr>

                        <b-tr>
                           <b-th rowspan="2"  style="text-align: center; border-right: solid 1px; ">
                                 
                              LIBRES
                           </b-th>
                        </b-tr>

                        <b-tr>
                           <b-th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th scope="col"  colspan="2" style="text-align: center;">TOTAL:</b-th>
                        </b-tr>


                        
                     </b-td>

                     <b-td v-for="(datInf, i) in ventaEnergia" :key="i" v-if="ventaEnergia.length" >
                           <b-tr><b-th style="text-align: right;">{{datInf.no_residencial}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.mt}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.bt}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.residencial_bt}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.cero_treinta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.treinta_cien}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.cien_ccincuenta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.ccincuenta_trecientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.trecientos_quinientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.mas_quinientos}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_regulado}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_libre}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;" :variant="(datInf.no_residencial  == null || datInf.mt  == null || datInf.bt  == null || datInf.residencial_bt  == null || datInf.cero_treinta  == null || datInf.treinta_cien  == null || datInf.cien_ccincuenta  == null || datInf.ccincuenta_trecientos  == null || datInf.trecientos_quinientos  == null || datInf.mas_quinientos  == null || datInf.st_regulado  == null || datInf.st_libre == null ) ? 'danger' : 'success'">{{datInf.total}}</b-th></b-tr>
                           

                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>
            <div>
               <h6><strong style="background-color: green; color: white; padding: 3px;">B</strong> <strong>FACTURACION  (Miles de S/.)</strong></h6>
               <h7  style="color: red; padding-left: 5px;"><strong>CONSIDERANDO EL MES EMITIDO_______</strong></h7>
                
                      

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                        <b-th style="text-align: right;"  colspan="1" rowspan="2">
                           Categoria
                        </b-th>  
                        <b-th style="text-align: center;  border-right: solid 1px;"  rowspan="2">
                           Tarifa
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           REAL - 2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>

                     <b-td  >
                        <b-tr>
                           <b-th rowspan="12" style="text-align: center; border-right: solid 1px;">         
                              REGULADOS
                           </b-th>
                        </b-tr>
                        
                        <b-tr>
                           <b-td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><0 a 30]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</b-td>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL REGULADO</b-th>
                        </b-tr>

                        <b-tr>
                           <b-th rowspan="2"  style="text-align: center; border-right: solid 1px; ">
                                 
                              LIBRES
                           </b-th>
                        </b-tr>

                        <b-tr>
                           <b-th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th scope="col"  colspan="2" style="text-align: center;">TOTAL:</b-th>
                        </b-tr>


                        
                     </b-td>

                     <b-td v-for="(datInf, i) in facturacion" :key="i" v-if="facturacion.length"  >
                           <b-tr><b-th style="text-align: right;" >{{datInf.no_residencial}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.mt}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.bt}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.residencial_bt}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.cero_treinta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.treinta_cien}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.cien_ccincuenta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.ccincuenta_trecientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.trecientos_quinientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.mas_quinientos}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_regulado}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_libre}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;" :variant="(datInf.no_residencial  == null || datInf.mt  == null || datInf.bt  == null || datInf.residencial_bt  == null || datInf.cero_treinta  == null || datInf.treinta_cien  == null || datInf.cien_ccincuenta  == null || datInf.ccincuenta_trecientos  == null || datInf.trecientos_quinientos  == null || datInf.mas_quinientos  == null || datInf.st_regulado  == null || datInf.st_libre == null ) ? 'danger' : 'success'">{{datInf.total}}</b-th></b-tr>
                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>
            <div>
               <h6><strong style="background-color: #c6e0b4; color: white; padding: 3px;">C.1</strong> <strong>COBRANZA MES CORRIENTE   (Miles de S/.)</strong></h6>
              
                
                      

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                        <b-th style="text-align: right;"  colspan="1" rowspan="2">
                           Categoria
                        </b-th>  
                        <b-th style="text-align: center;  border-right: solid 1px;"  rowspan="2">
                           Tarifa
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           REAL - 2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>

                     <b-td  >
                        <b-tr>
                           <b-th rowspan="12" style="text-align: center; border-right: solid 1px;">         
                              REGULADOS
                           </b-th>
                        </b-tr>
                        
                        <b-tr>
                           <b-td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><0 a 30]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</b-td>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL REGULADO</b-th>
                        </b-tr>

                        <b-tr>
                           <b-th rowspan="2"  style="text-align: center; border-right: solid 1px; ">
                                 
                              LIBRES
                           </b-th>
                        </b-tr>

                        <b-tr>
                           <b-th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th scope="col"  colspan="2" style="text-align: center;">TOTAL:</b-th>
                        </b-tr>


                        
                     </b-td>

                     <b-td v-for="(datInf, i) in cobMesCorriente" :key="i" v-if="cobMesCorriente.length"  >
                           <b-tr><b-th style="text-align: right;" >{{datInf.no_residencial}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.mt}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.bt}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.residencial_bt}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.cero_treinta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.treinta_cien}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.cien_ccincuenta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.ccincuenta_trecientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.trecientos_quinientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.mas_quinientos}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_regulado}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_libre}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;" :variant="(datInf.no_residencial  == null || datInf.mt  == null || datInf.bt  == null || datInf.residencial_bt  == null || datInf.cero_treinta  == null || datInf.treinta_cien  == null || datInf.cien_ccincuenta  == null || datInf.ccincuenta_trecientos  == null || datInf.trecientos_quinientos  == null || datInf.mas_quinientos  == null || datInf.st_regulado  == null || datInf.st_libre == null ) ? 'danger' : 'success'">{{datInf.total}}</b-th></b-tr>
                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>
            <div>
               <h6><strong style="background-color: #c6e0b4; color: white; padding: 3px;">C.2</strong> <strong>COBRANZA MESES ANTERIORES  (Miles de S/.)</strong></h6>
              
                
                      

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                        <b-th style="text-align: right;"  colspan="1" rowspan="2">
                           Categoria
                        </b-th>  
                        <b-th style="text-align: center;  border-right: solid 1px;"  rowspan="2">
                           Tarifa
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           REAL 2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>

                     <b-td  >
                        <b-tr>
                           <b-th rowspan="12" style="text-align: center; border-right: solid 1px;">         
                              REGULADOS
                           </b-th>
                        </b-tr>
                        
                        <b-tr>
                           <b-td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><0 a 30]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</b-td>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL REGULADO</b-th>
                        </b-tr>

                        <b-tr>
                           <b-th rowspan="2"  style="text-align: center; border-right: solid 1px; ">
                                 
                              LIBRES
                           </b-th>
                        </b-tr>

                        <b-tr>
                           <b-th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th scope="col"  colspan="2" style="text-align: center;">TOTAL:</b-th>
                        </b-tr>


                        
                     </b-td>

                     <b-td v-for="(datInf, i) in cobMesesAnteriores" :key="i" v-if="cobMesesAnteriores.length"  >
                           <b-tr><b-th style="text-align: right;" >{{datInf.no_residencial}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.mt}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.bt}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.residencial_bt}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.cero_treinta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.treinta_cien}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.cien_ccincuenta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.ccincuenta_trecientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.trecientos_quinientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.mas_quinientos}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_regulado}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_libre}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;" :variant="(datInf.no_residencial  == null || datInf.mt  == null || datInf.bt  == null || datInf.residencial_bt  == null || datInf.cero_treinta  == null || datInf.treinta_cien  == null || datInf.cien_ccincuenta  == null || datInf.ccincuenta_trecientos  == null || datInf.trecientos_quinientos  == null || datInf.mas_quinientos  == null || datInf.st_regulado  == null || datInf.st_libre == null ) ? 'danger' : 'success'">{{datInf.total}}</b-th></b-tr>
                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>


            <div>
               <h6><strong style="background-color: green; color: white; padding: 3px;">C</strong> <strong>COBRANZA TOTAL: Cobranza del Mes + Cobranza de Meses Anteriores   (Miles de S/.)</strong></h6>
              
                
                      

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                        <b-th style="text-align: right;"  colspan="1" rowspan="2">
                           Categoria
                        </b-th>  
                        <b-th style="text-align: center;  border-right: solid 1px;"  rowspan="2">
                           Tarifa
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           REAL 2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>

                     <b-td  >
                        <b-tr>
                           <b-th rowspan="12" style="text-align: center; border-right: solid 1px;">         
                              REGULADOS
                           </b-th>
                        </b-tr>
                        
                        <b-tr>
                           <b-td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><0 a 30]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</b-td>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL REGULADO</b-th>
                        </b-tr>

                        <b-tr>
                           <b-th rowspan="2"  style="text-align: center; border-right: solid 1px; ">
                                 
                              LIBRES
                           </b-th>
                        </b-tr>

                        <b-tr>
                           <b-th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th scope="col"  colspan="2" style="text-align: center;">TOTAL:</b-th>
                        </b-tr>


                        
                     </b-td>

                     <b-td v-for="(cobTotall, i) in cobTotal" :key="i" v-if="cobTotal.length"  >
                           <b-tr><b-th style="text-align: right;" >{{cobTotall.no_residencial}}</b-th></b-tr>
                           <b-tr><b-td>{{cobTotall.mt}}</b-td></b-tr>
                           <b-tr><b-td>{{cobTotall.bt}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{cobTotall.residencial_bt}}</b-th></b-tr>
                           <b-tr><b-td>{{cobTotall.cero_treinta}}</b-td></b-tr>
                           <b-tr><b-td>{{cobTotall.treinta_cien}}</b-td></b-tr>
                           <b-tr><b-td>{{cobTotall.cien_ccincuenta}}</b-td></b-tr>
                           <b-tr><b-td>{{cobTotall.ccincuenta_trecientos}}</b-td></b-tr>
                           <b-tr><b-td>{{cobTotall.trecientos_quinientos}}</b-td></b-tr>
                           <b-tr><b-td>{{cobTotall.mas_quinientos}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{cobTotall.st_regulado}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;">{{cobTotall.st_libre}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;" :variant="(cobTotall.no_residencial  == null || cobTotall.mt  == null || cobTotall.bt  == null || cobTotall.residencial_bt  == null || cobTotall.cero_treinta  == null || cobTotall.treinta_cien  == null || cobTotall.cien_ccincuenta  == null || cobTotall.ccincuenta_trecientos  == null || cobTotall.trecientos_quinientos  == null || cobTotall.mas_quinientos  == null || cobTotall.st_regulado  == null || cobTotall.st_libre == null ) ? 'danger' : 'success'">{{cobTotall.total}}</b-th></b-tr>
                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>

            <div>
               <h6><strong style="background-color: green; color: white; padding: 3px;">D</strong> <strong>COBRANZA CORRIENTE (%): Cobranza del Mes/Facturación del Mes</strong></h6>
              
                
                      

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                        <b-th style="text-align: right;"  colspan="1" rowspan="2">
                           Categoria
                        </b-th>  
                        <b-th style="text-align: center;  border-right: solid 1px;"  rowspan="2">
                           Tarifa
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           REAL 2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>

                     <b-td  >
                        <b-tr>
                           <b-th rowspan="12" style="text-align: center; border-right: solid 1px;">         
                              REGULADOS
                           </b-th>
                        </b-tr>
                        
                        <b-tr>
                           <b-td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><0 a 30]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</b-td>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL REGULADO</b-th>
                        </b-tr>

                        <b-tr>
                           <b-th rowspan="2"  style="text-align: center; border-right: solid 1px; ">
                                 
                              LIBRES
                           </b-th>
                        </b-tr>

                        <b-tr>
                           <b-th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th scope="col"  colspan="2" style="text-align: center;">TOTAL:</b-th>
                        </b-tr>


                        
                     </b-td>

                     <b-td v-for="(cobCorrientee, i) in cobCorriente" :key="i" v-if="cobCorriente.length"  >
                           <b-tr><b-th style="text-align: right;" >{{cobCorrientee.no_residencial}}</b-th></b-tr>
                           <b-tr><b-td>{{cobCorrientee.mt}}</b-td></b-tr>
                           <b-tr><b-td>{{cobCorrientee.bt}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{cobCorrientee.residencial_bt}}</b-th></b-tr>
                           <b-tr><b-td>{{cobCorrientee.cero_treinta}}</b-td></b-tr>
                           <b-tr><b-td>{{cobCorrientee.treinta_cien}}</b-td></b-tr>
                           <b-tr><b-td>{{cobCorrientee.cien_ccincuenta}}</b-td></b-tr>
                           <b-tr><b-td>{{cobCorrientee.ccincuenta_trecientos}}</b-td></b-tr>
                           <b-tr><b-td>{{cobCorrientee.trecientos_quinientos}}</b-td></b-tr>
                           <b-tr><b-td>{{cobCorrientee.mas_quinientos}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{cobCorrientee.st_regulado}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;">{{cobCorrientee.st_libre}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;" :variant="(cobCorrientee.no_residencial  == null || cobCorrientee.mt  == null || cobCorrientee.bt  == null || cobCorrientee.residencial_bt  == null || cobCorrientee.cero_treinta  == null || cobCorrientee.treinta_cien  == null || cobCorrientee.cien_ccincuenta  == null || cobCorrientee.ccincuenta_trecientos  == null || cobCorrientee.trecientos_quinientos  == null || cobCorrientee.mas_quinientos  == null || cobCorrientee.st_regulado  == null || cobCorrientee.st_libre == null ) ? 'danger' : 'success'">{{cobCorrientee.total}}</b-th></b-tr>
                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>


            <div>
               <h6><strong style="background-color: green; color: white; padding: 3px;">E</strong> <strong>COBRABILIDAD (%): Cobranza Total/Facturación del Mes</strong></h6>
              
                
                      

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                        <b-th style="text-align: right;"  colspan="1" rowspan="2">
                           Categoria
                        </b-th>  
                        <b-th style="text-align: center;  border-right: solid 1px;"  rowspan="2">
                           Tarifa
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           REAL 2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>

                     <b-td  >
                        <b-tr>
                           <b-th rowspan="13" style="text-align: center; border-right: solid 1px;">         
                              REGULADOS
                           </b-th>
                        </b-tr>
                        
                        <b-tr>
                           <b-td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><0 a 30]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</b-td>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL BT</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL MT</b-th>
                        </b-tr>

                        <b-tr>
                           <b-th rowspan="2"  style="text-align: center; border-right: solid 1px; ">
                                 
                              LIBRES
                           </b-th>
                        </b-tr>

                        <b-tr>
                           <b-th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th scope="col"  colspan="2" style="text-align: center;">TOTAL:</b-th>
                        </b-tr>


                        
                     </b-td>

                     <b-td v-for="(cobrabilidadd, i) in cobrabilidad" :key="i" v-if="cobrabilidad.length"  >
                           <b-tr><b-th style="text-align: right;" >{{cobrabilidadd.no_residencial}}</b-th></b-tr>
                           <b-tr><b-td>{{cobrabilidadd.mt}}</b-td></b-tr>
                           <b-tr><b-td>{{cobrabilidadd.bt}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{cobrabilidadd.residencial_bt}}</b-th></b-tr>
                           <b-tr><b-td>{{cobrabilidadd.cero_treinta}}</b-td></b-tr>
                           <b-tr><b-td>{{cobrabilidadd.treinta_cien}}</b-td></b-tr>
                           <b-tr><b-td>{{cobrabilidadd.cien_ccincuenta}}</b-td></b-tr>
                           <b-tr><b-td>{{cobrabilidadd.ccincuenta_trecientos}}</b-td></b-tr>
                           <b-tr><b-td>{{cobrabilidadd.trecientos_quinientos}}</b-td></b-tr>
                           <b-tr><b-td>{{cobrabilidadd.mas_quinientos}}</b-td></b-tr>

                           

                           <b-tr><b-th style="text-align: right;">{{cobrabilidadd.st_bt}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;">{{cobrabilidadd.st_mt}}</b-th></b-tr>

                           <b-tr><b-th style="text-align: right;">{{cobrabilidadd.st_libre}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;" :variant="(cobrabilidadd.no_residencial  == null || cobrabilidadd.mt  == null || cobrabilidadd.bt  == null || cobrabilidadd.residencial_bt  == null || cobrabilidadd.cero_treinta  == null || cobrabilidadd.treinta_cien  == null || cobrabilidadd.cien_ccincuenta  == null || cobrabilidadd.ccincuenta_trecientos  == null || cobrabilidadd.trecientos_quinientos  == null || cobrabilidadd.mas_quinientos  == null || cobrabilidadd.st_regulado  == null || cobrabilidadd.st_libre == null ) ? 'danger' : 'success'">{{cobrabilidadd.total}}</b-th></b-tr>
                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>


            <div>
               <h6><strong style="background-color: green; color: white; padding: 3px;">F</strong> <strong>INDICE DE MOROSIDAD  (%)</strong></h6>
              
                
                      

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                         
                        <b-th style="text-align: center;  border-right: solid 1px;  white-space: nowrap;"  rowspan="2" colspan="3">
                           INDICE DE MOROSIDAD       
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           REAL 2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>
                     <b-td>
                     
                        
                        <b-tr>
                           <b-th   style="text-align: center;"  >%</b-th>
                        </b-tr>


                        
                     </b-td>
                     <b-td>
                     </b-td>

                     <b-td v-for="(porcentajee, i) in porcentaje" :key="i" v-if="porcentaje.length"  >
                           
                           <b-tr><b-th style="text-align: right;" :variant="(porcentajee.no_residencial  == null || porcentajee.mt  == null || porcentajee.bt  == null || porcentajee.residencial_bt  == null || porcentajee.cero_treinta  == null || porcentajee.treinta_cien  == null || porcentajee.cien_ccincuenta  == null || porcentajee.ccincuenta_trecientos  == null || porcentajee.trecientos_quinientos  == null || porcentajee.mas_quinientos  == null || porcentajee.st_regulado  == null || porcentajee.st_libre == null ) ? 'danger' : 'success'">{{porcentajee.porcentaje}}</b-th></b-tr>
                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>
            <div>
               <h6><strong style="background-color: green; color: white; padding: 3px;">G</strong> <strong>CANTIDAD  DE CLIENTES</strong></h6>
              
                
                      

               <b-table-simple hover  class=" table-responsive  resumenTabla  ">
                   
                  <b-thead >
                     <b-tr style="background-color: rgb(180 198 231);">  
                        <b-th style="text-align: right;"  colspan="1" rowspan="2">
                           Categoria
                        </b-th>  
                        <b-th style="text-align: center;  border-right: solid 1px;"  rowspan="2">
                           Tarifa
                        </b-th>  
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12">
                           2021
                        </b-th> 
                        <b-th style="text-align: center; border-right: solid 1px;"  colspan="12"  variant="danger">
                           REAL 2022
                        </b-th> 
                     </b-tr>
                     <b-tr style="background-color: rgb(180 198 231);">
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-21
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ene-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Feb-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Mar-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Abr-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           May-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jun-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Jul-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Ago-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Set-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Oct-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Nov-22
                        </b-th>
                        <b-th style="text-align: center; border-right: solid 1px;" >
                           Dic-22
                        </b-th>
                     </b-tr>
                  </b-thead>
                  <b-tbody>
                  </b-tbody>
                  <b-tfoot>
                     <b-td>
                     </b-td>

                     <b-td  >
                        <b-tr>
                           <b-th rowspan="12" style="text-align: center; border-right: solid 1px;">         
                              REGULADOS
                           </b-th>
                        </b-tr>
                        
                        <b-tr>
                           <b-td scope="col"  style="text-decoration: underline; text-align: left; white-space: nowrap;">NO RESIDENCIAL</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">MT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">BT</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-decoration: underline; text-align: left; white-space: nowrap;">RESIDENCIAL (BT)</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><0 a 30]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important;" ><30 a 100]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><100 a 150]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><150 a 300]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; "><300 a 500]</b-td>
                        </b-tr>
                        <b-tr>
                           <b-td scope="col" style="text-align: left; padding-left: 10px !important; ">>500</b-td>
                        </b-tr>
                        <b-tr>
                           <b-th  scope="col" style="white-space: nowrap;">SUB TOTAL REGULADO</b-th>
                        </b-tr>

                        <b-tr>
                           <b-th rowspan="2"  style="text-align: center; border-right: solid 1px; ">
                                 
                              LIBRES
                           </b-th>
                        </b-tr>

                        <b-tr>
                           <b-th scope="col" style=" white-space: nowrap;">SUB TOTAL LIBRE</b-th>
                        </b-tr>
                        <b-tr>
                           <b-th scope="col"  colspan="2" style="text-align: center;">TOTAL:</b-th>
                        </b-tr>


                        
                     </b-td>

                     <b-td v-for="(datInf, i) in cobMesesAnteriores" :key="i" v-if="cobMesesAnteriores.length"  >
                           <b-tr><b-th style="text-align: right;" >{{datInf.no_residencial}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.mt}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.bt}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.residencial_bt}}</b-th></b-tr>
                           <b-tr><b-td>{{datInf.cero_treinta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.treinta_cien}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.cien_ccincuenta}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.ccincuenta_trecientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.trecientos_quinientos}}</b-td></b-tr>
                           <b-tr><b-td>{{datInf.mas_quinientos}}</b-td></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_regulado}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;">{{datInf.st_libre}}</b-th></b-tr>
                           <b-tr><b-th style="text-align: right;" :variant="(datInf.no_residencial  == null || datInf.mt  == null || datInf.bt  == null || datInf.residencial_bt  == null || datInf.cero_treinta  == null || datInf.treinta_cien  == null || datInf.cien_ccincuenta  == null || datInf.ccincuenta_trecientos  == null || datInf.trecientos_quinientos  == null || datInf.mas_quinientos  == null || datInf.st_regulado  == null || datInf.st_libre == null ) ? 'danger' : 'success'">{{datInf.total}}</b-th></b-tr>
                     </b-td>

                  </b-tfoot>
               </b-table-simple>
            </div>

          </div>
        </div>
      </div>
    </div>
  

                        
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
      modalShow:false,
      ventaEnergia:[],
      facturacion:[],
      cobMesCorriente:[],
      cobMesesAnteriores:[],
      cobTotal:[],
      cobCorriente:[],
      cobrabilidad:[],
      porcentaje:[],
      


       
    }
  },


  methods : {

   
      
    
      async getInformacionReportes() {

         //const res = await this.callApi('get', `app/getInformacionReportes`, deleteItem)
         const res = await this.callApi('get', `app/getInformacionReportes`)
         if (res.status==200) {
                     console.log('respuesta----__--:', res.data)
                    this.ventaEnergia= res.data.ve
                    this.facturacion= res.data.f
                    this.cobMesCorriente= res.data.cmc
                    this.cobMesesAnteriores= res.data.cma
                    this.cobTotal= res.data.ct
                    this.cobCorriente= res.data.cc
                    this.cobrabilidad= res.data.c
                    this.porcentaje= res.data.im

          } else {
             
             this.$swal('Ocurrio algun problema','Actualice la pagina','warning')
            
            }

          

         /*axios.get('app/getInformacionReportes',{
              params: {
                //idReporte: this.datoReportes.id,
                //periodoId: this.filtro.periodo[0],

              }
           }).then(function(res){

                 

                      console.log('con________________sultas',res.status)
                 if (res.status==200) {

                     this.ventaEnergia= res.data

                   } else {
                      
                      this.$swal('Ocurrio algun problema','Actualice la pagina','warning')
                     
                   }

                 
             }.bind(this));*/
             

      },


    




  },

  watch:{
         
  /* "$route.params":{
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
   }*/
},
computed:{


},


    
  async created(){
    try {

      //this.getInformacionReportes();
      
      
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