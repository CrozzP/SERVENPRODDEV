<?php

namespace App\Imports;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


use App\Models\EstadoExtraordinario;
use App\Models\DerivarRegistro;
use App\Models\AtencionDerivarRegistro;

use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;



class EstadoExtraordinarioImport implements OnEachRow, WithHeadingRow
{
   

    public function onRow(Row $row)
    {
      //dd('con fe nomas',$row);

      $user = Auth::user();

      $fechaactual = Carbon::now();
      //$hoy = $fecha_inicio->format('Y-m-d H:m:s');
      $fechaderivacion = $fechaactual->format('Y-m-d');


        


      $derivarR = DerivarRegistro::updateOrCreate(
                     [

                        'estadoextraordinario_id' => $row['estadoextraordinarioid'],
                        'estado' => '1',
                     ],
                     [
                        
                        'user_id' => $user->id,
                        'estadoextraordinario_id' => $row['estadoextraordinarioid'],
                        'empresacolaborador_id' => $row['codigocolaborador'],
                        'fechaderivacion' => $fechaderivacion,
                        'fechahora' => $fechaactual,
                        'estado' => '1',
                     ]

                    );
      $derivarregistro_id = $derivarR->id;

      AtencionDerivarRegistro::updateOrCreate(
         [
            'derivarregistro_id' => $derivarregistro_id,
            'estado' => '1',
         ],
         [
            'derivarregistro_id' => $derivarregistro_id,
            'observacion' => $row['observacion'],
            'estadot' => '1',
            'estado' => '1',
         ]

      );

     /* EstadoExtraordinario::updateOrCreate(
            [
                'id' => $row['id']
            ],
            [
                'id' => $row['id'],
                'fechaAtencion' => $row['fechaAtencion'],
                'tecnico' => $row['tecnico'],
                'estadot' => $row['estadot'],
                'estadot' => $row['estadot'],
                'tipo' => $row['tipo']
                //'estado' => $row['estado']
            ]
        );*/
      $estadoExtraordinario = EstadoExtraordinario::where('id','=',$row['estadoextraordinarioid'])
                           ->where('estadot','=','1')
                           ->update([
                              'fechaAtencion' => $fechaactual,
                              'estado' => $row['estado'],
                              'fechaDerivado' => $fechaactual,
                              'fechaAceptadoT' => $fechaactual,
                              'tecnico' => $row['codigocolaborador'],
                              'atencion_excel' => '1',

                           ]);


      return $estadoExtraordinario;



    }
}

//1->LISTO-> Agregar campos a estadoextraordinario  atencion excel y atencion appweb
//2->LISTO-> Actualizar y/o crear registro en la tabla derivarregistro, con referencia estadoextraordinario_id, empresacolaborador_id-DNI y el usuario creador.(el que importa)
//3->LISTO-> Crear y/o actualizar el registro en la tabla atencionderivarregistro, segun derivarregistro_id. indicar la observacion del tecnico.

//4->LISTO-> En la tabla estadoatencionextraordinario, actualizar el campo estado atencion por atendido, actualizar el campo atencion excel por 1, fecha de carga.
//5-> 