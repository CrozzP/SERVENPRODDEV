<?php

namespace App\Exports;
use App\Models\Extraordinario;

//use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

//class ExtraordinariosExport implements FromCollection
class ExtraordinariosExport implements FromView
{
/*
	use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ExtraordinariosExport implements FromQuery
{*/
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

   /*public function collection()
    {    dd('desde export ',$this->extraordinarios);
    	//dd($this->extraordinarios);
        //return Extraordinario::all();
        //return $this->exco;
    	// $extraordinary=Extraordinary::typeExtraordinaries($this->request->get('tipoex'))->esta($this->request->get('estado'))->dateini($this->request->get('dateini'))->datefin($this->request->get('datefin'))->orderBy('created_at', 'desc')->paginate(10000);
    	$extraordinarios = Extraordinario::extraordinarioexcel($this->exco)->get();
    	//dd('excel',$extraordinarios);
        return $extraordinarios;
         
    }*/

    public function view(): View
    {

    	 $extraordinarios= $this->extraordinarios;
    	 //dd('vista export',$extraordinarios);
        
        return view('excelExtraordinario', [
            'extraordinarios' => $extraordinarios,
        ]);
        
       // return Extraordinary::typeExtraordinaries($this->request->get('tipoex'))->esta($this->request->get('estado'))->dateini($this->request->get('dateini'))->datefin($this->request->get('datefin'))->orderBy('created_at', 'desc')->paginate(10000);
    }
/*
    public function query()
    {
    	//dd($this->exco);
    	$dates=$this->exco;
    	//dd('xd', $dates);
        return Extraordinario::query()->where('obsTipoExtraordinario_id', $dates);
    }*/
}
