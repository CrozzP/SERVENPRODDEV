<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3 style="background-color:#1e63f5;color:white; text-align: center; ">Electro Puno S.A.A.</h3>
<table>
  <tr style="background-color:#3ca7ff;color:black; text-align: center; ">
    <th> # </th>
    <th>Fecha y Hora</th>
    <th>Zona Administrativa</th>
    <th>Serie Medidor</th>
    <th>Ruta</th>
    <th>Coordenadas</th>
    <th>Direccion</th>
    <th>Orden de Trabajo</th>
    <th>Nombre del Titular</th>
    <th>Celular</th>
    <th>Codigo de registro</th>

    <th>Suministro</th>
    <th>Nombre del Solicitante</th>
    <th>Observacion y/o Referencia</th>
    <th>Tipo Sistemas</th>
    <th>Ubicacion satelital</th>
    <th>Ubicacion relieve</th>
  </tr>

  @foreach($extraordinarios as $datsum )
    <tr>
      <td style=" border-bottom: 1.2px solid #1967e1">{{$loop->iteration}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->created_at}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->NombreZonaAdministrativa}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->SerieMedidor}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->CodigoRutaSuministro}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->Longitud}}, {{$datsum->Latitud}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->DireccionPredio}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->nombreTipoExt}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->NombreSuministro}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->telefono}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->id}}</td>

          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->CodigoSuministro}}</td>
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->nombre}} {{$datsum->apellPat}} {{$datsum->apellMat}}</td>
          
          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->referencia}}</td>

          <td style=" border-bottom: 1.2px solid #1967e1">{{$datsum->NombreTipoSistema}}</td>

          
          <td style=" border-bottom: 1.2px solid #1967e1">
            <a href="https://maps.google.com/?q={{$datsum->Latitud}},{{$datsum->Longitud}}&z=18" >
              Ubicacion GPS
                  </a>
          </td>
          <td style=" border-bottom: 1.2px solid #1967e1">
            

                  <a href="https://maps.google.com/?q={{$datsum->Latitud}},{{$datsum->Longitud}}&z=18&t=k" class="btn btn-warning">
                      Ubicacion GPS
                  </a>

                </td>
    </tr>
  @endforeach

 
</table>

</body>
</html>
		