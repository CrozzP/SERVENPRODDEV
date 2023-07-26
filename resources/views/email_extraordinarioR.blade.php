
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Reporte Reiterativo</title>
</head>
<body>
  <div>
    
     <!--img src="{{ $message->embed(public_path() . '/assets/img/logo2.png') }}" alt="" /-->


   
  </div>
   <h2>FORMATO DE REGISTRO REITERATIVO - REPORTE SERVICIO DE REPARACIONES Y RECONEXIONES</h2>
    <p>Hola! Se ha reportado un nuevo caso de <h5>{{$extraordinarios->obsTipoExtraordinario->tipoExtraordinario->nombreTipoExt}}</h5> a las {{$date}}</p>
    <p>

      <li>Tipo Registro: {{$extraordinarios->obsTipoExtraordinario->tipoExtraordinario->nombreTipoExt}}</li>
      <li>Descripcion: {{$extraordinarios->obsTipoExtraordinario->descripcion}}</li>
      <li>Referencia: {{$extraordinarios->estadoExtraordinario->referencia}}</li>
    </p>
    <p>Estos son los datos del usuario que ha realizado la solicitud:</p>
    <ul>
        <li>Nombre: {{$extraordinarios->personaExtraordinario->persona->nombre}}</li>
        <li>Teléfono: {{$extraordinarios->personaExtraordinario->persona->telefono}}</li>
        <li>DNI: {{$extraordinarios->personaExtraordinario->persona->dni}}</li>
        <li>Direccion: {{$extraordinarios->personaExtraordinario->persona->direccion}}</li>
    </ul>
    <p>Estos son los datos del suministro:</p>
    <ul>
        <li>Codigo Suministro: {{$extraordinarios->suministro->CodigoSuministro}} </li>
        <li>Nombre: {{$extraordinarios->suministro->NombreSuministro}} </li>
        <li>Codigo Ruta Suministro: {{$extraordinarios->suministro->CodigoRutaSuministro}}</li>
        <li>DNI: {{$extraordinarios->suministro->Documento}}</li>
        <li>Direccion: {{$extraordinarios->suministro->DireccionPredio}}</li>
        <li>Serie Medidor: {{$extraordinarios->suministro->SerieMedidor}}</li>
        <li>Zona Administrativa: {{$extraordinarios->suministro->NombreZonaAdministrativa}}</li>
        <li>Tipo Sistemas: {{$extraordinarios->suministro->NombreTipoSistema}}</li>
        

        

        <li>Departamento: {{$extraordinarios->suministro->NombreDepartamento}}</li>
        <li>Provincia: {{$extraordinarios->suministro->NombreProvincia}}</li>
        <li>Distrito: {{$extraordinarios->suministro->NombreDistrito}}</li>

    </ul>
    <p>Y esta es la posición reportada:</p>
    <ul>
        <li>Latitud: {{$extraordinarios->suministro->Latitud}}</li>
        <li>Longitud: {{$extraordinarios->suministro->Longitud}}</li>
        <li>
               <a href="https://maps.google.com/?q={{$extraordinarios->suministro->Latitud}},{{$extraordinarios->suministro->Longitud}}&z=18" >
                Ver en Google Maps
            </a>
        </li>
        <li>
               <a href="https://maps.google.com/?q={{$extraordinarios->suministro->Latitud}},{{$extraordinarios->suministro->Longitud}}&z=18&t=k" class="btn btn-warning">
                Ver en Google Maps
            </a>
        </li>
    </ul>


<h3 style="background-color:#f51e1e;color:white; text-align: center; ">Electro Puno S.A.A. - Formato Horizontal</h3>
<table>
  <tr style="background-color:#ffc2c2;color:black; text-align: center; ">
    <th> # </th>
    <th>Fecha y Hora</th>
    <th>Orden de Trabajo</th>
    <th>Zona Administrativa</th>
    <th>Suministro</th>
    <th>Ruta</th>
    <th>Coordenadas</th>
    <th>Direccion</th>
    <th>Nombre del Titular</th>
    <th>Nombre del Solicitante</th>
    <th>Celular</th>
    <th>Observacion y/o Referencia</th>
    <th>Serie Medidor</th>
    <th>Tipo Sistemasr</th>
    <th>Ubicacion satelital</th>
    <th>Ubicacion relieve</th>
  </tr>



    <tr>
      <td style=" border-bottom: 1.2px solid #f92121">1</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->created_at}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->obsTipoExtraordinario->tipoExtraordinario->nombreTipoExt}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->suministro->NombreZonaAdministrativa}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->suministro->CodigoSuministro}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->suministro->CodigoRutaSuministro}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->suministro->Longitud}}, {{$extraordinarios->suministro->Latitud}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->suministro->DireccionPredio}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->suministro->NombreSuministro}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->personaExtraordinario->persona->nombre}} {{$extraordinarios->personaExtraordinario->persona->apellPat}} {{$extraordinarios->personaExtraordinario->persona->apellMat}}</td>
          
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->personaExtraordinario->persona->telefono}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->estadoExtraordinario->referencia}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->suministro->SerieMedidor}}</td>
          <td style=" border-bottom: 1.2px solid #f92121">{{$extraordinarios->suministro->NombreTipoSistema}}</td>

          
          <td style=" border-bottom: 1.2px solid #f92121">
            <a href="https://maps.google.com/?q={{$extraordinarios->suministro->Latitud}},{{$extraordinarios->suministro->Longitud}}&z=18" >
              Ubicacion GPS
                  </a>
          </td>
          <td style=" border-bottom: 1.2px solid #f92121">
            

                  <a href="https://maps.google.com/?q={{$extraordinarios->suministro->Latitud}},{{$extraordinarios->suministro->Longitud}}&z=18&t=k" class="btn btn-warning">
                      Ubicacion GPS
                  </a>

                </td>
    </tr>


 
</table>

</body>
</html>
