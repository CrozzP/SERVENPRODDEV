

<table  >
  <tr>
    <th colspan="17" style="background: #125c9a; color: white; font-weight: bold; font-size: 14px; text-align: center;border: 2px solid white;">
      Electro Puno S.A.A.
    </th>
  </tr>
  <tr>
    <th colspan="17" style="background: #125c9a; color: white; font-weight: bold; font-size: 14px; text-align: center;border: 2px solid white;">
      Reporte Diario - SerVen - Modulos
    </th>
  </tr>
  <tr>
    <th colspan="14"  style="background: #125c9a; color: white; font-weight: bold; font-size: 14px; text-align: center;border: 2px solid white;">
      
    </th>
    <th colspan="3"  style="background: #125c9a; color: white; font-weight: bold; font-size: 11px; text-align: center;border: 2px solid white;">
      {{date('Y-m-d  H:i:s')}}
    </th>
  </tr>
  <tr >
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">#</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Fecha y Hora</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Zona Administrativa</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Serie del Medidor</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Ruta</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Longitud</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Latitud </th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Direccion</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Tipo Registro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Nombre del Titular</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Celular</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Codigo de registro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Suministro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Nombre del Solicitante</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Observacion y/o Referencia</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Descripcion del Registro </th>



    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Tipo del Sistema</th>
  </tr>
  @foreach($extraordinarios as $datsum )
  <tr >

      <td colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">{{$loop->iteration}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->created_at}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->NombreZonaAdministrativa}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->SerieMedidor}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->CodigoRutaSuministro}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->Longitud}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->Latitud}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->DireccionPredio}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->nombreTipoExt}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->NombreSuministro}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->telefono}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->id}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->CodigoSuministro}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->nombres}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->referencia}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->descripcion}}</td>




      <td colspan="1" style="border: 1px solid black; ">{{$datsum->NombreTipoSistema}}</td> 



      
  </tr>
  @endforeach
  
</table>

