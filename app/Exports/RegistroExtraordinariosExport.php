<?php

namespace App\Exports;
use App\Models\Extraordinario;



use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class RegistroExtraordinariosExport implements FromView
{

    /**
    * @return \Illuminate\Support\Collection
    */
    private $extraordinarios=null;

    public function __construct( $extraordinarios)
    {
        $this->extraordinarios = $extraordinarios;
        $extraordinarios=$this->extraordinarios;

        return $this;
    }

 

    public function view(): View
    {

       $extraordinarios= $this->extraordinarios;
       //dd('vista export',$extraordinarios);
        
        return view('Excel.reporteExtraordinarioAtencion', [
            'extraordinarios' => $extraordinarios,
        ]);
        
      
    }

}
