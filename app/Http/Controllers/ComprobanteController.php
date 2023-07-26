<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comprobante;
use App\Models\SuministroRer;
use PDF;
use Carbon\Carbon;


class ComprobanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function buscarComprobante(Request $request)
    {
        //dd($request);
        $buscarComprobantes = Comprobante::where('Suministro_id',$request->persona_id)
          ->orderBy('PERIODOCOMERCIAL','DESC')
          ->get();
          

         /* $buscarPersonas = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })->orderBy('created_at','DESC')->Paginate(10);*/

//dd($buscarPersonas);
        return $buscarComprobantes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

     public function createPDFRER(Request $request,$id)
    {
        //dd($request);
        //dd($request);
        //$obsTipoExtraordinario_id= $id;

       // $extraordinarios = Extraordinario::find($id);
       // $extraordinarios = DB::table('extraordinarios')->where('id', '=', $id)->with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->get();

      //  $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','=',$id)->first();

             $comprobanteDeudas = Comprobante::where('Suministro_id',$id)
             ->where('estadoPago',0)
          ->orderBy('PERIODOCOMERCIAL','DESC')
          ->get();
          $suma = Comprobante::where('Suministro_id',$id)->where('estadoPago', 0)->sum('MONTOTOTAL');
          $suministroRer = SuministroRer::where('Id',$id)->first();

          //dd($suministroRer);
          

         /* $buscarPersonas = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })->orderBy('created_at','DESC')->Paginate(10);*/

       // $extraordinarios = 'hola';

         $date = date('Y-m-d');


        $date = Carbon::now();
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

       

        //$pdf = PDF::loadView('myPDF', compact('extraordinarios','date','fecha_actual'))->setPaper('a5','landscape');
        $pdf = PDF::loadView('rerpdf', compact('comprobanteDeudas','suma','suministroRer','date','fecha_actual'))->setPaper('a4','portrait');
        //Descargar
        //return $pdf->download('extraordinario.pdf');
        //Visualizar
        //return $pdf->download('extraordinario.pdf');
       // return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
       // return $pdf->download('Reporte_SerVen_RER_100000.pdf');
       // return $pdf->stream('Reporte_SerVen_RER_100000'.$suministroRer->CodigoUsuario.'00.pdf');
        return $pdf->download('Reporte_SerVen_RER_100000'.$suministroRer->CodigoUsuario.'00.pdf');
        //return $pdf->stream('extraordinario.pdf');

        
    }

    public function reportePDFRER(Request $request){

      //dd('dentro del request',$request);

      
      $suministrosRer = SuministroRer::with('comprobante')
            ->whereHas('comprobante', function($query) use ($request)  {
               $query->where('estadoPago','=', '0');
               $query->where('CCPP','=', $request->ccpp_id);
                        //$query->whereIn('sede_id', $userSede);
                        //$query->whereIn('sede_id', [2,3]);
               })
            ->where('Distrito','=',$request->distrito_id)
            //->where('CentroPoblado','=',$request->ccpp_id)
            ->get();


         // dd('suministrosRER',$suministrosRer);

         $date = date('Y-m-d');


        $date = Carbon::now();
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

          //return $suministrosRer;
       

        $pdf = PDF::loadView('reporteRERpdf', compact('suministrosRer','date','fecha_actual'))->setPaper('a4','portrait');
        
        return $pdf->download('Reporte_SerVen_RER_100000'.$date.'00.pdf');
          




    }



}
