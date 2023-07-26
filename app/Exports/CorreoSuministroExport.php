<?php

namespace App\Exports;

use App\Models\CorreoSuministro;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;



class CorreoSuministroExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $correoSuministro=null;

    public function __construct( $correoSuministro)
    {
        $this->correoSuministro = $correoSuministro;
        $correoSuministro=$this->correoSuministro;

        return $this;
    }


   /* public function collection()
    {
        return CorreoSuministro::all();
    }*/

    public function view(): View
    {

       $correoSuministro= $this->correoSuministro;
       //dd('vista export',$correoSuministro);
        
        return view('Excel.excelCorreoSuministro', [
            'correoSuministro' => $correoSuministro,
        ]);
        
      
    }
}
