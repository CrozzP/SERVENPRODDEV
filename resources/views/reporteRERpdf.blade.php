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
                padding-top: -10px;
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

              font-size: 1.2em;
            margin-top: -25px;
              margin-bottom: 1px;
              
            }
            .encabezados h4{
              color: #4f4866;
              font-weight: normal;
              font-size: 1.1em;
              margin-top: -11px;
              margin-bottom: 1px;
            }

            .pie{
                   
               
            margin-top: -1px;

              border-bottom: 2px solid #ddd; 
            text-align: center;
              
              font-size: 11px;
            }

            .imgHeader{
                margin-left: 1cm;
                margin-right: 1cm;
                margin-top: .2cm;
                 width: 150px; 
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

        </style>
    </head>
@foreach($suministrosRer as $suministroRer )
    

    <body>
        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
        <header>
            
            
            <table style="width: 100%; ">
                <tr >
                    <td>
                        <img src="./assets/img/electropuno.png" class="imgHeader" />
                    </td>
                    <td>
                        
                    </td>
                    <td style="text-align: right;">
                        <img src="./assets/img/rer.jpg" class="imgHeader2" />
                    </td>
                </tr>
            </table>

              <div class="encabezados">
                <h3>Electro Puno S.A.A.</h3>
                <h4>Sistemas Fotovoltaicos RER Autonomos</h4>
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
          

            <div>

                <div class="espacio">
                    <h3>Titular y/o Representante</h3>
                </div>

                <table style="width: 100%">
                    
                    <tr>
                        <td colspan="2"><b>Nombres : </b><span style="text-transform: uppercase!important;">{{$suministroRer->Nombres}}</span></td>
                        <td colspan="1"><b>Suministro : </b><span style="text-transform: uppercase!important;">{{$suministroRer->CodigoUsuario}}</span></td>
                    </tr>
                    <tr>
                        <td colspan="1"><b>DNI : </b><span style="text-transform: uppercase!important;">{{$suministroRer->dni}}</span></td>
                        <td colspan="1"><b>Sexo : </b><span style="text-transform: uppercase!important;">{{$suministroRer->Sexo}}</span></td>
                        <td colspan="1"><b>Fecha Nacimiento : </b><span style="text-transform: uppercase!important;">{{$suministroRer->FechaNacimiento}}</span></td>
                        
                        
                    </tr>

                    <tr>
                        <td colspan="1"><b>Nombre Representante : </b><span style="text-transform: uppercase!important;">{{$suministroRer->ApellidoPaternoRepresentante}},{{$suministroRer->ApellidoMaternoRepresentante}},{{$suministroRer->NombreRepresentante}}</span></td>
                        <td colspan="1"><b>Tipo Representante : </b><span style="text-transform: uppercase!important;">{{$suministroRer->NombreTipoRepresentante}}</span></td>
                        <td colspan="1"><b>DNI Representante : </b><span style="text-transform: uppercase!important;">{{$suministroRer->dniRepresentante}}</span></td>
                    </tr>
                     
                </table>


                <div class="espacio">
                    <h3>Localidad</h3>
                </div>
                <table style="width: 100%">
                    
                    <tr>
                        <td colspan="1"><b>Departamento : </b><span style="text-transform: uppercase!important;">{{$suministroRer->Departamento}}</span></td>
                        <td colspan="1"><b>Provincia : </b><span style="text-transform: uppercase!important;">{{$suministroRer->Provincia}}</span></td>
                        <td colspan="1"><b>Distrito : </b><span style="text-transform: uppercase!important;">{{$suministroRer->Distrito}}</span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Centro Poblado : </b><span style="text-transform: uppercase!important;">{{$suministroRer->CentroPoblado}}</span></td>
                        <td colspan="1"><b>Coordenadas : </b><span style="text-transform: uppercase!important;">{{$suministroRer->LatitudWG}},{{$suministroRer->LongitudWG}}</span></td>
                        
                    </tr>
                </table>

                <div class="espacio">
                    <h3>Instalacion</h3>
                </div>
                <table style="width: 100%">

                    <tr>
                        <td colspan="1"><b>Fecha Instalacion : </b><span style="text-transform: uppercase!important;">{{$suministroRer->FechaInstalacion}}</span></td>
                        @if ($suministroRer->CodigoTipoInstalacion == 1)
                            <td colspan="1"><b>Tipo Instalacion : </b><span style="text-transform: uppercase!important;">RER 1</span></td>
                        @endif
                        @if ($suministroRer->CodigoTipoInstalacion == 2)
                            <td colspan="1"><b>Tipo Instalacion : </b><span style="text-transform: uppercase!important;">RER 2</span></td>
                        @endif
                        @if ($suministroRer->CodigoTipoInstalacion == 3)
                            <td colspan="1"><b>Tipo Instalacion : </b><span style="text-transform: uppercase!important;">RER 3</span></td>
                        @endif

                        @if ($suministroRer->Funcionando == true)
                            <td colspan="1"><b>Operativo : </b><span style="text-transform: uppercase!important;">SI</span></td>
                        @endif

                        @if ($suministroRer->Funcionando == false)
                            <td colspan="1"><b>Operativo : </b><span style="text-transform: uppercase!important;">NO</span></td>
                        @endif

                        
                        <td colspan="1"><b>Calificacion : </b><span style="text-transform: uppercase!important;">{{$suministroRer->Calificacion}}</span></td>
                    </tr>

                </table>

            </div>
            

            <div class="espacio">
                
                <h3>Reporte de Deuda</h3>
            </div>

            <div>

                <table  style="width: 100%">
                  <tr style="background-color:#3ca7ff;color:black; text-align: center; ">
                    <th> # </th>
                    <th>Periodo</th>
                    <th>Fecha Facturacion</th>
                    <th>Fecha Vencimiento</th>
                    <th>Numero Recibo</th>
                    <th>Monto</th>
                  </tr>
                  @php
                   $suma=0;
               @endphp

                @foreach($suministroRer->comprobante as $comprobanteDeuda )

                    <tr>
                        <th >{{$loop->iteration}}</th>
                        <td class="linea">{{$comprobanteDeuda->PERIODOCOMERCIAL}}</td>
                        <td class="linea">{{$comprobanteDeuda->FECHADEEMISIONDECOMPROBANTE}}</td>
                        <td class="linea">{{$comprobanteDeuda->FECHADEVENCIMIENTO}}</td>
                        <td class="linea">{{$comprobanteDeuda->NumeroComprobante }}</td>
                        <td class="linea">{{$comprobanteDeuda->MONTOTOTAL}}</td>
                        @php
                           $suma+=$comprobanteDeuda->MONTOTOTAL;
                        @endphp
                          
                    </tr>


                @endforeach
                <tr>
                    <th colspan="5">Total a Pagar</th>

                    <th colspan="1">S/. {{$suma}}</th>
                   
                </tr>
                </table>
            </div>
            
            

            

       
        </main>
    </body>

@endforeach
</html>

