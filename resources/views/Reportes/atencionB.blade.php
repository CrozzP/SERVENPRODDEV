
        <style>
            /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 1cm 0.8cm 0.5cm 1cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 1.5cm;
                margin-left: 1.5cm;
                margin-right: 1.5cm;
                margin-bottom: 1.5cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                
                position: fixed;
                top: -0.8cm;
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
                height: 1cm;
            }

            table {
              border-collapse: collapse;
              //border-radius: 0.5em;
              overflow: hidden;
              //border: 1px solid purple;
              margin-bottom: 5px;

                border-radius: 0.7em 0.7em 0 0;
            }
            table, th, td {
              //border: 0 0 1px 1px solid black;
            }

            tr th{

                text-align: center;
                font-size: 14px;
            }
          

            th {
              padding: .1em;
              background: #ddd;
              font-size: 12px;

              //border: 1px solid black;
                //border-radius: 20px;

            }
            td {
                padding: .1em;
                //border: none;
                border-collapse: collapse;
            //  border-bottom: 2px solid #ddd; 
              font-size: 12px;
             // border: 0 0 1px 1px solid black;
            }
            main{
                padding-top: 40px;
              
            }
            .linea{
                border-bottom: 2px solid #ddd;
            }

            .pie{ 
                padding: .1em;
                border-bottom: 2px solid #ddd; 
                text-align: center;
                padding-top: 0px;
                margin-top: -9px;
                font-size: .80em;
            }

            .subtitulo{ 
                //padding: .1em;
                //border: 2px solid #ddd; 
                //border-top: 2px solid #ddd; 
                text-align: center;
                padding-top: -2px;
                padding-bottom: -25px;
                margin-top: -1px;
                margin-bottom: -5px;
                font-size: .80em;
                background-color: red;
            }

            .espacio{ 
                //padding: .1em;
                //border: 2px solid #ddd; 
                //border-top: 2px solid #ddd; 
                text-align: center;
                padding-top: -2px;
                padding-bottom: -25px;
                margin-top: -1px;
                margin-bottom: -5px;
                font-size: .80em;
                background-color: red;
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

                font-size: 0.8em;
                margin-top: 0px;
                margin-bottom: 1px;
              
            }
            .CodSol h4{
              color: #4f4866;
              font-weight: normal;
              font-size: 0.6em;
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

              font-size: 0.8em;
            margin-top: -15px;
              margin-bottom: 1px;
              
            }
            .encabezados h4{
              color: #4f4866;
              font-weight: normal;
              font-size: 0.6em;
              margin-top: 0px;
              margin-bottom: 0px;
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
                margin-top: .1cm;
                 width: 150px; 
                 height: 45px;

            }
            .firma{
                width: 100%; 
                 height: 50px;
                 border: 1px solid;
                 text-align: center;
            }
            .foto{
                width: 100%; 
                 height: 200px;
                 border: 3px solid;
                 text-align: center;
                 position: relative;
                 border-color: white;
               
            }
            .imgatencion{
                position: absolute;
                text-align: center;
                display: block;
                width: 50%; 
                height: 100%;
            }

/* Create two equal columns that floats next to each other */

        </style>
<!DOCTYPE html>
<html>
    <head>




<link href="assets/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/css/prueba.css" rel="stylesheet">

<title>Reportes...</title>

    </head>


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
                        <!--img src="./assets/img/rer.jpg" class="imgHeader2" /-->
                    </td>
                </tr>
            </table>

              <div class="encabezados">
                <h3>Electro Puno S.A.A.</h3>
                <h4>Reporte de Atencion - SerVen-Modulos</h4>
            </div>
            
        </header>

        <footer>
            <div class="pie">
                
                
            </div>
            <div>
                
                <p class="pie"><b>Reporte emitido el :</b><span style="text-transform: uppercase!important;">{{$date}}</span></p>
                
            </div>

        </footer>

        <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
        

        <main>
      
        <div>


            <table style="width: 100%">
                
                <tr>
                    <td colspan="3"><b>Codigo del Reporte : </b><span style="text-transform: uppercase!important;">COD-{{ $reporte->estado_extraordinario['extraordinario_id']}}-ELPU</span></td>

                    <td colspan="2"><b>Fecha de Reporte : </b><span style="text-transform: uppercase!important;">{{$date}}</span></td>
                </tr>
                
            </table>

            

            <table style="width: 100%">
                <tr>
                    <th colspan="4"><b>Datos del Suministro</b></th>

                </tr>
                
                <tr>
                    <td colspan="2"><b>Titular : </b><span style="text-transform: uppercase!important;">{{ $reporte->suministro['NombreSuministro'] }}</span></td>
                    <td colspan="2"><b>Direccion : </b><span style="text-transform: uppercase!important;">{{ $reporte->suministro['DireccionPredio'] }}</span></td>
                </tr>
                <tr>
                    <td colspan="1"><b>DNI : </b><span style="text-transform: uppercase!important;">{{ $reporte->suministro['Documento'] }}</span></td>
                    <td colspan="1"><b>Suministro : </b><span style="text-transform: uppercase!important;">{{ $reporte->suministro['CodigoSuministro'] }}</span></td>
                    <td colspan="2"><b>Ruta : </b><span style="text-transform: uppercase!important;">{{ $reporte->suministro['CodigoRutaSuministro'] }}</span></td>
                    
                    
                </tr>
                <tr>
                    <td colspan="1"><b>Departamento : </b><span style="text-transform: uppercase!important;">{{ $reporte->suministro['NombreDepartamento'] }}</span></td>
                    <td colspan="1"><b>Provincia : </b><span style="text-transform: uppercase!important;">{{ $reporte->suministro['NombreProvincia'] }}</span></td>
                    <td colspan="2"><b>Distrito : </b><span style="text-transform: uppercase!important;">{{ $reporte->suministro['NombreDistrito'] }}</span></td>
                </tr>

                
                

                
            </table>
            

            

            <table style="width: 100%">
                <tr>
                    <th colspan="2"><b>Datos del Solicitante</b></th>

                </tr>
                
                <tr>
                    <td colspan="1"><b>Apellidos y Nombres : </b><span style="text-transform: uppercase!important;">{{ $reporte->persona_extraordinario['persona']['nombres'] }}</span></td>
                    <td colspan="1"><b>DNI : </b><span style="text-transform: uppercase!important;">{{ $reporte->persona_extraordinario['persona']['dni'] }}</span></td>
                </tr>
                <tr>
                    
                    <td colspan="1"><b>Celular : </b><span style="text-transform: uppercase!important;">{{ $reporte->persona_extraordinario['persona']['telefono'] }}</span></td>
                    <td colspan="1"><b>Parentesto : </b><span style="text-transform: uppercase!important;">{{ $reporte->persona_extraordinario['persona']['email'] }}</span></td>
                </tr>

            </table>

            

            <table style="width: 100%">
                <tr>
                    <th colspan="3"><b>Datos del Registro</b></th>

                </tr>
                
                <tr>
                    <td colspan="1"><b>Tipo de Registro : </b><span style="text-transform: uppercase!important;">{{ $reporte->obs_tipo_extraordinario['tipo_extraordinario']['nombreTipoExt'] }}</span></td>
                    <td colspan="1"><b>Estado : </b><span style="text-transform: uppercase!important;">{{ $reporte->obs_tipo_extraordinario['tipo_extraordinario']['estado'] }}</span></td>
                    <td colspan="1"><b>Fecha de Registro : </b><span style="text-transform: uppercase!important;">{{ $reporte->estado_extraordinario['fechaRegistro'] }}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><b>Descripcion : </b><span style="text-transform: uppercase!important;">{{ $reporte->obs_tipo_extraordinario['descripcion'] }}</span></td>
                    <td colspan="1"><b>Referencia : </b><span style="text-transform: uppercase!important;">{{ $reporte->estado_extraordinario['referencia'] }}</span></td>
                    
                </tr>

            </table>

           

            <table style="width: 100%">
                <tr>
                    <th colspan="2"><b>Atencion del Reporte</b></th>

                </tr>
                
                <tr>
                    
                    <td rowspan="3"><b>Descripcion de Atencio : </b><span style="text-transform: uppercase!important;">{{ $atencionDerivarRegistro->observacion }}</span></td>
                    <td colspan="1"><b>Estado : </b><span style="text-transform: uppercase!important;">{{ $atencionDerivarRegistro->estado }}</span></td>
                </tr>
                <tr>
                    
                    <td colspan="1"><b>Fecha de Atencion : </b><span style="text-transform: uppercase!important;">{{ $atencionDerivarRegistro->created_at }}</span></td>
                    
                </tr>
                <tr>
                    <td colspan="1"><b>Fecha derivado : </b><span style="text-transform: uppercase!important;">{{ $reporte->fechahora }}</span></td>
                    
                </tr>

            </table>

            

            <table style="width: 100%">
                <tr>
                    <th colspan="4"><b>Imagenes de Atencion</b></th>

                </tr>
                <tr>
                    <td colspan="2"><b>Medidor </b></td>
                    <td colspan="2"><b>Usuario / Fachada </b></td>
                    
                </tr>
                
                <tr>
                    
                    <td colspan="2" ><div class="foto"> <img src="./storage/atencion/medidor/{{ $atencionDerivarRegistro->medidor }}" class="imgatencion" />
                        </div>
                    </td>
                    <td colspan="2" ><div class="foto"> <img src="./storage/atencion/usuarios/{{ $atencionDerivarRegistro->usuarioImagen }}" class="imgatencion" />
                     </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>Pre-Atencion </b></td>
                    <td colspan="2"><b>Post-Atencion </b></td>
                    
                </tr>
                
                <tr>
                    
                    <td colspan="2" ><div class="foto"> <img src="./storage/atencion/preReparaciones/{{ $atencionDerivarRegistro->archivoPre1 }}" class="imgatencion" /></div></td>
                    <td colspan="2" ><div class="foto"> <img src="./storage/atencion/reparaciones/{{ $atencionDerivarRegistro->archivoPost1 }}" class="imgatencion" /></div></td>
                </tr>

            </table>



            <table style="width: 100%">
                <tr>
                    <td colspan="2"><b>Firma del Tecnico </b></td>
                    <td colspan="2"><b>Firma del Usuario </b></td>
                    
                </tr>
                
                <tr>
                    
                    <td colspan="2" ><div class="firma"> <img src="./storage/atencion/firmas/tecnicos/{{ $atencionDerivarRegistro->firmaTecnico }}" class="imgHeader2" /></div></td>
                    <td colspan="2" ><div class="firma"> <img src="./storage/atencion/firmas/usuarios/{{ $atencionDerivarRegistro->firmaUsuario }}" class="imgHeader2" /></div></td>
                </tr>
                
                <tr>
                    
                    <td colspan="2"><b>Apellidos y Nombres : </b><span style="text-transform: uppercase!important;">{{ $atencionDerivarRegistro->derivarRegistro->empresaColaborador->colaborador->nombres }}</span></td>
                    <td colspan="2"><b>Apellidos y Nombres : </b><span style="text-transform: uppercase!important;">{{ $reporte->persona_extraordinario['persona']['nombres'] }}</span></td>
                </tr>
                
                <tr>
                    
                    <td colspan="2"><b>DNI : </b><span style="text-transform: uppercase!important;">{{ $atencionDerivarRegistro->derivarRegistro->empresaColaborador->colaborador->dniColaborador }}</span></td>
                    <td colspan="2"><b>DNI : </b><span style="text-transform: uppercase!important;">{{ $reporte->persona_extraordinario['persona']['dni'] }}</span></td>
                </tr>

            </table>
           

           
        </div>

        

   

        </main>



    </body>
</html>



