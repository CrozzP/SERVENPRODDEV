<?php

namespace App\Imports;

use App\Models\TestImport;
use App\Models\TestImportt;

use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

/*
use Maatwebsite\Excel\Concerns\ToModel;



class ActualizaCarga implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $ddd=TestImport::updateOrCreate(
            [
                'id' => $row['id']
            ],
            [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'tipo' => $row['tipo'],
                'estado' => $row['estado'],
               
               "fechaAtencion" =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechaatencion']+$row['horaatencion'])->format('Y-m-d H:i:s')

                //'fechaAtencion' => $this->transformDate($row['fechaatencion'], $row['horaatencion'])

            ]
        );

        
        //$rr=$ddd->id;
        //dd('sssss',$ddd);
        return $ddd;


    }
}
*/

class ActualizaCarga implements OnEachRow, WithHeadingRow
{
   public function transformDate($fecha, $hora)
       {
         //dd($fecha);
        // dd($fecha, $hora, \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha+$hora)->format('Y-m-d H:i:s'));
           return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($fecha+$hora)->format('Y-m-d H:i:s');
       }
    public function onRow(Row $row)
    {
      //dd('datos importados',$row['fechaatencion'],$row['horaatencion'],\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechaatencion']+$row['horaatencion'])->format('Y-m-d H:i:s'));
      //dd('datos importados',$row['fechaatencion']);

      /*$testImport = TestImport::where('id', $row['id'])->first();
      //dd('______',$testImport);
 
      //if ($testImport !== null) {
      if (!empty($testImport) ) {
         //dd('SIN datos',$testImport);
          $testImport->update([

                'nombre' => $row['nombre'],
                'tipo' => $row['tipo'],
                'estado' => $row['estado'],
               
               "fechaAtencion" =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechaatencion']+$row['horaatencion'])->format('Y-m-d H:i:s')
            ]);

      } else {
         //dd('con datos',$testImport);
          $testImport = TestImport::create([
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'tipo' => $row['tipo'],
            'estado' => $row['estado'],
               
            "fechaAtencion" =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechaatencion']+$row['horaatencion'])->format('Y-m-d H:i:s')
          ]);
      }*/


      

        $testImport=TestImport::updateOrCreate(
            [
                'id' => $row['id']
            ],
            [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'tipo' => $row['tipo'],
                'estado' => $row['estado'],
               
               "fechaAtencion" =>  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fechaatencion']+$row['horaatencion'])->format('Y-m-d H:i:s')

                //'fechaAtencion' => $this->transformDate($row['fechaatencion'], $row['horaatencion'])

            ]
        );

        $rr=$testImport->id;
        $ddd=TestImportt::updateOrCreate(
            [
                'testimport_id' => $rr
            ],
            [
                'testimport_id' => $rr,
                'estado' => $row['otroestado'],
                'descripcion' => $row['observacion']
                
               

            ]
        );

        
        //dd('sssss',$ddd);
        return $testImport;

    }
}
