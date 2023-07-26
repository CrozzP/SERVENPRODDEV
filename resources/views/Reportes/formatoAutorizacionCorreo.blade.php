

        <style>
            /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 2cm 2.45cm 2cm 2.45cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 1.5cm;
                margin-left: 1.5cm;
                margin-right: 1.5cm;
                margin-bottom: 1.5cm;
                //background-color: red !important;
                //background-image: "./assets/img/electropuno.png" !important;


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

            .titulo{ 
                margin-top: -6px;
                padding: .1em;
                text-align: center;
                padding-top: -6px;
            }
            .titulo h3{
                color: black;
              font-weight: normal;

              font-size: 0.9em;
              margin-bottom: 1px;
              
            }
            .titulo h4{
              color: black;
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

<title>Formulario Asignacion Correo</title>

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
                <h4>Formulario correo - SerVen-Modulos</h4>
            
            </div>
        </header>

        <footer>
            <div class="pie">
                
                
            </div>
            <div>
                
                <p class="pie"><b>Formulario emitido el :</b><span style="text-transform: uppercase!important;">{{$date}}</span></p>
                
            </div>

        </footer>

        <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
        

        <main>
            <div class="titulo">
                <h3 style="text-decoration: underline; font-weight: bold;">FORMULARIO DE AUTORIZACION DE USO DE DATOS PARA</h3>
                <h3 style="text-decoration: underline; font-weight: bold;">LA EMISION DE RECIBOS, NOTIFICACIONES Y AVISOS MEDIANTE CORREO ELECTRONICO</h3>
            </div>
      
        <div>

            
<br>
          <p class="text-justify">
            Por medio del presente:
          </p>
          <p class="text-justify">
            Yo, <b>{{$data['CSnombreSuministroR']}}</b>, identificado con DNI Nº: <b>{{$data['CSpersonaDni']}}</b>, con domicio en <b>{{$data['DireccionPredio']}}</b> responsable como {{$data['CSRelacion']}} , con la firma del presente documento AUTORIZO de manera voluntaria, previa, explicita, informada e inequívoca a la Empresa de Distribucion Eléctrica <b>Electro Puno S.A.A.</b> para tratar la siguiente información:
          </p>



            <table style="width: 100%; border-collapse: collapse !important; border-radius: 0 !important; padding: 10px !important;">
               <tr >
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;"><b>TITULAR</b></td>
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;">{{$data['NombreSuministro']}}</td>
               </tr>
               <tr >
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;"><b>SUMINISTRO</b></td>
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;">{{$data['CodigoSuministro']}}</td>
               </tr>
               <tr >
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;"><b>CODIGO RUTA</b></td>
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;">{{$data['CodigoRutaSuministro']}}</td>
               </tr>
               <tr >
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;"><b>DIRECCION</b></td>
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;">{{$data['DireccionPredio']}}</td>
               </tr>
               <tr >
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;"><b>CORREO ELECTRONICO</b></td>
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;"><b>{{$data['CScorreo']}}</b></td>
               </tr>
               <tr >
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;"><b>CELULAR</b> </td>
                  <td style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important;">{{$data['CScelular']}}</td>
               </tr>
                
                
            </table> 

          <p class="text-justify">
             Reconozco el derecho que me asiste para actualizar, rectificar, conocer y suprimir mis datos que servirán para las comunicaciones de interés del usuario, emisión de recibos al correo indicado, LO QUE NO CANCELA LA EMISION DE LOS RECIBOS DE MANERA FISICA, notificaciones de reclamos, comunicados, avisos y otros documentos para su conocimiento.
             El tratamiento de datos personales se rige para estos efectos, por la POLÍTICA DE PROTECCIÓN DE DATOS PERSONALES de la empresa Electro Puno S.A.A. en cumplimiento de la normatividad legal vigente.

          </p>
          <p class="text-justify">
             Para constancia de lo anterior, se firma en <b>{{$data['CSSede']}}</b> el <b>{{$date->isoFormat('dddd')}}, {{$date->format('d')}}</b> de <b>{{$date->isoFormat('MMMM')}}</b> de <b>{{$date->format('Y')}}</b>.
          </p>

          <br>
          <br>


            <table style="width: 100%; border-collapse: collapse !important; border-radius: 0 !important; padding: 10px !important;">
               <tr>
                  <td colspan="4"  style="color: white !important;">vacio</td>
                  <td rowspan="6" style="border: 1px solid black !important; font-size: 0.8em !important; margin-left: 0.5em !important; color: white !important;"> vacio</td>
               </tr>
               <tr>

                  <td colspan="4" style="color: white !important;">vacio</td>
                  
               </tr>
               <tr >
                  <td  colspan="2" >Firma: </td>
                  <td >....................................................................</td>
                  <td></td>
               </tr>
               <tr >
                  <td colspan="2" >Nombre: </td>
                     <td><b>{{$data['CSnombreSuministroR']}}</td>
                     <td></td>
               </tr>
               <tr >
                  <td colspan="2">DNI: </td>
                  <td><b>{{$data['CSpersonaDni']}}</b></td>
                  <td></td>
               </tr>
               <tr >
                  <td colspan="2">Relacion: </td>
                  <td><b> {{$data['CSRelacion']}}</b></td>
                  <td></td>
               </tr>
               <tr >
                 <td colspan="4" ></td>
                  <td colspan="1" style="text-align: center !important;">Huella</td>

                
               </tr>


                
                
            </table>

     
           
        </div>

        

   

        </main>



    </body>
</html>



