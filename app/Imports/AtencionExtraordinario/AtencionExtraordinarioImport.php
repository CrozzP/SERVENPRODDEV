<?php

namespace App\Imports\AtencionExtraordinario;

use App\Models\AtencionExtraordinario;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithUpserts;


class AtencionExtraordinarioImport implements ToModel

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)

    {
      /*  return new AtencionExtraordinario([
            //
            'id'                => $row[0],
            'fechaAtencion'     => $row[1],
            'fechaAsignacion'   => $row[2],
            'observacion'       => $row[3],
            'estado'            => $row[4],
            'masinfo'           => $row[5],



        ]);*/
       
        $xxd = AtencionExtraordinario::updateOrCreate([
'id'                => $row[0],
        ],[
            //
            'id'                => $row[0],
            'fechaAtencion'     => $row[1],
            'fechaAsignacion'   => $row[2],
            'observacion'       => $row[3],
            'estado'            => $row[4],
            'masinfo'           => $row[5],



        ]);
        return $xxd;


    

    }
    public function uniqueBy()
    {
        return 'id';
    }

    

    
}
