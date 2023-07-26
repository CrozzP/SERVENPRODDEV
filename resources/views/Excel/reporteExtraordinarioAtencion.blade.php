

<table  >
 
  <tr >
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">#</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">ExtraordinarioId</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">EstadoExtraordinarioId</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">ZonaAdministrativa</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">SerieDelMedidor</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Ruta</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Longitud</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Latitud</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Direccion</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">TipoRegistro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Suministro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">NombreDelTitular</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Celular</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">NombreDelSolicitante</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Referencia</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">DescripcionDelRegistro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">FechaRegistro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">TipoDelSistema</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">EstadoRegistro</th>

    <th  colspan="1" style="background: #cd2a32; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">CodigoColaborador</th>
    <th  colspan="1" style="background: #cd2a32; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Observacion</th>
    <th  colspan="1" style="background: #cd2a32; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">estado</th>
    <th  colspan="1" style="background: #cd2a32; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">FechaAtencion</th>
    <th  colspan="1" style="background: #cd2a32; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">HoraAtencion</th>

  </tr>
  @foreach($extraordinarios as $datsum )
  <tr >

      <td colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">{{$loop->iteration}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->extraordinario_id}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->estadoExtraordinario_id}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->zonaAdministrativa}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->serieMedidor}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->rutaSuministro}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->longitudSuministro}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->latitudSuministro}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->direccionSuministro}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->tipoRegistro}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->codigoSuministro}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->nombreSuministro}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->telefonoSolicitante}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->nombresSolicitante}}</td> 
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->referenciaRegistro}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->descripcionRegistro}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->fechaRegistro}}</td>
      <td colspan="1" style="border: 1px solid black; ">{{$datsum->tipoSistema}}</td> 


      @switch($datsum->estadoRegistro)
         @case(1)
            <td colspan="1" style="border: 1px solid black; ">Registrado</td> 
         @break
         @case(2)
            <td colspan="1" style="border: 1px solid black; ">Notificado Service</td> 
         @break
         @case(3)
            <td colspan="1" style="border: 1px solid black; ">Asignado</td> 
         @break
         @case(4)
            <td colspan="1" style="border: 1px solid black; ">Aceptado</td> 
         @break
         @case(5)
            <td colspan="1" style="border: 1px solid black; ">Atendido</td> 
         @break
         @case(6)
            <td colspan="1" style="border: 1px solid black; ">Calificado</td> 
         @break

         @default
            <td colspan="1" style="border: 1px solid black; ">otros</td> 
      @endswitch
         
      <td colspan="1" style="border: 1px solid black; "></td> 
      <td colspan="1" style="border: 1px solid black; "></td> 
      <td colspan="1" style="border: 1px solid black; "></td> 
      <td colspan="1" style="border: 1px solid black; " ></td> 
      <td colspan="1" style="border: 1px solid black; " ></td> 



      
  </tr>
  @endforeach
  
</table>

