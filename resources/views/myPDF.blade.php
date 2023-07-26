<html>
    <head>
        <style>
            /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 1.5cm;
                margin-left: 1cm;
                margin-right: 1cm;
                margin-bottom: 1.5cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }

            table {
              border-collapse: collapse;
              border-radius: 1em;
              overflow: hidden;
            }

            th {
              padding: .1em;
              background: #ddd;
              font-size: 14px;
             
             

            }
            td {
                padding: .1em;
                border: none;
            //  border-bottom: 2px solid #ddd; 
              font-size: 14px;
            }
            .linea{
                border-bottom: 2px solid #ddd;
            }

            .espacio{ 
                padding: .1em;
                border-bottom: 2px solid #ddd; 
                text-align: center;
                padding-top: 0px;
                margin-top: -9px;
                font-size: .85em;
            }
            .CodSol{ 
                margin-top: 10px;
                padding: .1em;
               // border-bottom: 2px solid #ddd; 
                text-align: center;
                padding-top: -10px;
            }
            .CodSol h3{
                color: #443963;
              font-weight: normal;

              font-size: 1em;
            margin-top: 0px;
              margin-bottom: 1px;
              
            }
            .CodSol h4{
              color: #4f4866;
              font-weight: normal;
              font-size: 0.8em;
              margin-top: 0px;
              margin-bottom: 0px;
            }

            .encabezados{ 
                margin-top: -10px;
                padding: .1em;
                border-bottom: 2px solid #ddd; 
                text-align: center;
                padding-top: -10px;
            }
            .encabezados h3{
                color: #443963;
              font-weight: normal;

              font-size: 1em;
            margin-top: -15px;
              margin-bottom: 1px;
              
            }
            .encabezados h4{
              color: #4f4866;
              font-weight: normal;
              font-size: 0.8em;
              margin-top: 0px;
              margin-bottom: 0px;
            }

            .pie{
                   
               
            margin-top: -1px;

              border-bottom: 2px solid #ddd; 
            text-align: center;
              
              font-size: 11px;
            }

            .imgHeader{
                margin-left: 1cm;
                margin-right: 0cm;
                margin-top: .2cm;
                 width: 140px; 
                 height: 25px;

            }
            .imgHeader2{
                margin-left: 1cm;
                margin-right: 1cm;
                margin-top: .2cm;
                 width: 150px; 
                 height: 35px;

            }
            b{
                padding-top:  -10px;
            }
        span{
          font-size: 11px;
        }

        </style>
    </head>
    <body>
        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
        <header>
            
            
            <table style="width: 100%; ">
                <tr >
                    <td>
                        <img src="./assets/img/electropuno.png" class="imgHeader" />
                    </td>
                    
                    <td style="text-align: right;">
                       <div class="CodSol">
                          <h4>Codigo Solicitud: </h4>
                          <h3>{{$extraordinarios->id}}</h3>
                      </div>
                    </td>
                </tr>
            </table>

              <div class="encabezados">
                <h3>Electro Puno S.A.A.</h3>
                <h4>Servicio Ventanilla - Modulos</h4>
            </div>
            
        </header>

        <footer>
            <div class="espacio">
                
                <p>Realice sus pagos en los Centros Autorizados.</p>
            </div>
            <div>
                
                <p class="pie"><b>Reporte emitido el :</b><span style="text-transform: uppercase!important;">{{$date}}</span></p>
                
            </div>

        </footer>

        <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
        <main>

          <div class="espacio">
                
                <h3>Ficha de Reporte de Servicio Reparacion - Reconexion
                </h3>
            </div>
          

            <div>

                <div class="espacio">
                    <h3>Datos del Suministro</h3>
                </div>

        


                <table style="width: 100%">
                    
                    <tr>
                        <td colspan="2"><b>Nombres : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->suministro->NombreSuministro}}</span></td>
                        <td colspan="1"><b>Suministro : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->suministro->CodigoSuministro}}</span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>DNI : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->suministro->Documento}}</span></td>
                        <td colspan="1"><b>Ruta : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->suministro->CodigoRutaSuministro}}</span></td>
                    </tr>
                    <tr>
                      
                        <td colspan="3"><b>Direccion : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->suministro->DireccionPredio}}</span></td>
                    </tr>

                        
                    <tr>
                        <td colspan="2"><b>Tipo Sistema : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->suministro->NombreTipoSistema}}</span></td>
                        <td colspan="1"><b>Serie Medidor : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->suministro->SerieMedidor}}</span></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Coordenadas : </b><span style="text-transform: uppercase!important;"> {{$extraordinarios->suministro->Latitud}},  {{$extraordinarios->suministro->Longitud}}</span></td>
                      
                        
                        
                    </tr>

                    
                    

                    
                </table>

                <div class="espacio">
                    <h3>Datos del Solicitante</h3>
                </div>
                <table style="width: 100%">
                    
                    
                    <tr>
                      
                        <td colspan="3"><b>Nombres : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->personaExtraordinario->persona->nombre}} {{$extraordinarios->personaExtraordinario->persona->apellPat}} {{$extraordinarios->personaExtraordinario->persona->apellMat}}</span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>DNI : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->personaExtraordinario->persona->dni}}</span></td>
                        <td colspan="1"><b>celular : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->personaExtraordinario->persona->telefono}}</span></td>
                    </tr>
                    <tr>
                        <td colspan="3"><b>Direccion : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->personaExtraordinario->persona->direccion}}</span></td>
                        
                        
                    </tr>
                </table>

                <div class="espacio">
                    <h3>Detalles de la Solicitud</h3>
                </div>
                <table style="width: 100%">

                    <tr>
                        <td colspan="2"><b>Servicio : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->obsTipoExtraordinario->tipoExtraordinario->nombreTipoExt}}</span></td>
                        <td colspan="1"><b>Codigo de Solicitud : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->id}}</span></td>
                    </tr>
                      
                    <tr>
                      @if ($extraordinarios->estadoExtraordinario->tipo==1)
                            <td colspan="2"><b>Tipo de Solicitud : </b><span style="text-transform: uppercase!important;">Normal</span></td>
                        @endif
                        @if ($extraordinarios->estadoExtraordinario->tipo >= 2)
                            <td colspan="2"><b>Tipo de Solicitud : </b><span style="text-transform: uppercase!important;">Reiterativo</span></td>
                        @endif
                      

                        <td colspan="1"><b>Fecha Inicio : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->estadoExtraordinario->fechaInicio}}</span></td>
                        
                    </tr>

                    <tr>
                      <td  colspan="2">
                        
                      </td>
                      
                        
                        <td colspan="1"><b>Fecha Fin : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->estadoExtraordinario->fechaFinal}}</span></td>
                    </tr>

                    <tr>
                        <td colspan="3"><b>Descripcion : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->obsTipoExtraordinario->descripcion}}</span></td>

                    </tr>
                    <tr>
                      
                        <td colspan="3"><b>Referencia : </b><span style="text-transform: uppercase!important;">{{$extraordinarios->estadoExtraordinario->referencia}}</span></td>
                       
                        


                        

                        
                        
                    </tr>

                </table>

               
            </div>
            
            

            

       

            

       
        </main>
    </body>
</html>

