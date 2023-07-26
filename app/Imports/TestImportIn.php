<?php

namespace App\Imports;

use App\Models\TestImport;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class TestImportIn implements OnEachRow, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

     public function onRow(Row $row)
    {
      //dd($row['id']);
       $xd=TestImport::updateOrCreate(
            [
                'id' => $row['id']
            ],
            [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'tipo' => $row['tipo'],
                'estado' => $row['estado']
            ]
        );
       //return $xd;
       //dd('respuesta____',$xd);
       
    }
}
