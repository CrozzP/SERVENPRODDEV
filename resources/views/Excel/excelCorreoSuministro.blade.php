

<table  >
  <tr>
    <th colspan="17" style="background: #125c9a; color: white; font-weight: bold; font-size: 14px; text-align: center;border: 2px solid white;">
      Electro Puno S.A.A.
    </th>
  </tr>
  <tr>
    <th colspan="17" style="background: #125c9a; color: white; font-weight: bold; font-size: 14px; text-align: center;border: 2px solid white;">
      Reporte Actualizacion de datos - SerVen
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
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Codigo Suministro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Codigo Ruta</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Zona Administrativa</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Direccion</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Nombre del Titular</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Correo</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Estado Correo</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Celular</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Fecha Registro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Fecha Validacion</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Usuario Registro</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Validacion Manual</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Documento Autorizacion</th>

    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Tipo Documento</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Numero Documento</th>
    <th  colspan="1" style="background: #125c9a; color: white; font-weight: bold; font-size: 12px; text-align: center; border: 1px solid white;">Nombres</th>

  </tr>

@foreach($correoSuministro as $datsum )
<tr>
   <td>{{$datsum->id}}</td>
   <td>{{$datsum->suministro_id}}</td>
   <td>{{$datsum->suministro->CodigoRutaSuministro}}</td>
   <td>{{$datsum->suministro->NombreZonaAdministrativa}}</td>
   <td>{{$datsum->suministro->DireccionPredio}}</td>
   <td>{{$datsum->suministro->NombreSuministro}}</td>
   <td>{{$datsum->correo}}</td>
   <td>{{$datsum->estadoConfirmacion}}</td>
   <td>{{$datsum->celular}}</td>
   <td>{{$datsum->fechaRegistro}}</td>
   <td>{{$datsum->fechaConfirmacion}}</td>
   <td>{{$datsum->user_id}}</td>
   <td>{{$datsum->validacionManual}}</td>
   <td>{{$datsum->estadoarchivo}}</td>
   <td>{{$datsum->person->tipoDocumento_id}}</td>
   <td>{{$datsum->person->dni}}</td>
   <td>{{$datsum->person->nombres}}</td>
</tr>
@endforeach
   
</table>




