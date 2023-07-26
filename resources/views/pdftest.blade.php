
        <style>
            /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 1cm 0.5cm;
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
            main{
               
              
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
           
           
            
        </header>

        <footer>
          

        </footer>

        <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
        

        <main>
            
        


    <div style="clear:both; position:relative; ">
        @foreach ($extraordinarios as $user)

        @if (($loop->index) % 2 == 0)
            <div style="position:absolute; left:0em;  width: 49.5%; ">
                <div style="  " class="divcard">

                <p>par </p>
                    LEFT COLUMN {{ $user->id }}
                    
                    <p class="datos">This is iteration  <span> {{ $loop->index+1 }} </span></p>

                    <p>My mother has <span style="color:blue;font-weight:bold">blue</span> eyes and my father has <span style="color:darkolivegreen;font-weight:bold">dark green</span> eyes.</p>
                </div>
            </div>

        @else
            <div style="margin-left:50%; width: 49.5%;">
                <div style=" " class="divcard">
                <p>impar </p>
                    RIGHT COLUMN {{ $user->id }}
                    <p>This is iteration  {{ $loop->index+1 }}</p>
                </div>
            </div>
        @endif

        @if (($loop->index+1) % 6 == 0)
            <div class="page-break"></div>
        @endif


        @endforeach

          </div>


        </main>



    </body>
</html>



