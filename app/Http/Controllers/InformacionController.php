<?php

namespace App\Http\Controllers;

use App\Models\Informacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class InformacionController extends Controller
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function regInformacion(Request $request)
    {
        //
      //dd($request->porcentaje);
     // dd($request->datos['dt_r_tipoinformacion']);

      //dd('prueba correcta',$request->datos['dt_r_tipoinformacion']);
      $user = Auth::user();

      if (($request->datos['dt_r_tipoinformacion'] == 2) || ($request->datos['dt_r_tipoinformacion'] == 3) || ($request->datos['dt_r_tipoinformacion'] == 4) || ($request->datos['dt_r_tipoinformacion'] == 5)) {
         //dd('dentro');
         // code...
         $informacion = new Informacion;
         $informacion->mt  = $request->mt;
         $informacion->bt  = $request->bt;
         $informacion->no_residencial  = $request->no_residencial;
         $informacion->cero_treinta  = $request->cero_treinta;
         $informacion->treinta_cien  = $request->treinta_cien;
         $informacion->cien_ccincuenta  = $request->cien_ccincuenta;
         $informacion->ccincuenta_trecientos  = $request->ccincuenta_trecientos;
         $informacion->trecientos_quinientos  = $request->trecientos_quinientos;
         $informacion->mas_quinientos  = $request->mas_quinientos;
         $informacion->residencial_bt  = $request->residencial_bt;
         $informacion->st_regulado  = $request->st_regulado;
         $informacion->st_libre  = $request->st_libre;
         $informacion->total  = $request->total;

         $informacion->tareareporte_id  = $request->datos['dt_trc_tareareporte'];
         $informacion->periodo_id  = $request->datos['dt_tr_periodo_id'];
         $informacion->user_id  = $user->id;
         $informacion->tipoinformacion_id  = $request->datos['dt_r_tipoinformacion'];

         $informacion->estado  = 1;


         //$informacion->porcentaje  = $request->porcentaje;
         $informacion->save();

      }else if($request->datos['dt_r_tipoinformacion'] == 11){
         //dd('holis');
         $informacion = new Informacion;
         $informacion->porcentaje  = $request->porcentaje;

         $informacion->tareareporte_id  = $request->datos['dt_trc_tareareporte'];
         $informacion->periodo_id  = $request->datos['dt_tr_periodo_id'];
         $informacion->user_id  = $user->id;
         $informacion->tipoinformacion_id  = $request->datos['dt_r_tipoinformacion'];

         $informacion->save();
      }

      return $informacion;


    }


    public function store(Request $request)
    {
        //
    }

    public function getInformacionReportes(Request $request)
    {
        //
      //dd('dentrito');
     // $informacion = Informacion::where('estado','=',1)->where('periodo_id','=','1')->get();
     $dos = new Informacion;
     //$tres = new Informacion;
      //$informacion = Informacion::where('estado','=',1)->where('tipoinformacion_id','=','3')->orderBy('periodo_id','asc')->get();
      $informacion = Informacion::where('estado','=',1)->orderBy('periodo_id','asc')->get();
      //dd(last($informacion));
      //dd(count($informacion));
      //dd($informacion);
      $i = 0;
               $ivf=0;
               $if=0;
               $icmc=0;
               $icma=0;
               $iim=0;
         foreach ($informacion as $tra) {
            //dd($informacion[$i]);
            if ($informacion[$i]->tipoinformacion_id == 2) {
               $ve[$ivf] = $informacion[$i];
               $ivf++;
            }elseif($informacion[$i]->tipoinformacion_id == 3){
               $f[$if] = $informacion[$i];
               $if++;
            }elseif($informacion[$i]->tipoinformacion_id == 4){
               $cmc[$icmc] = $informacion[$i];
               $icmc++;
            }elseif($informacion[$i]->tipoinformacion_id == 5){
               $cma[$icma] = $informacion[$i];
               $icma++;
            }elseif($informacion[$i]->tipoinformacion_id == 11){
               $im[$iim] = $informacion[$i];
               $iim++;
            }
            //$dos[$i]=$xd;

            $i++;
         }
         //dd('i->',$i,'ivf->',$ivf,'if->',$if,'icmc->',$icmc,'icma->',$icma);
         //C->COBRANZA TOTAL: Cobranza del Mes + Cobranza de Meses Anteriores   (Miles de S/.)
         //D->COBRANZA CORRIENTE (%): Cobranza del Mes/Facturación del Mes
         //E->COBRABILIDAD (%): Cobranza Total/Facturación del Mes
         //G-1->FALTA ANALISIS

         //C
         $ict = ($icmc < $cma) ? $icmc : $cma;
         //D
         $icc = ($if < $cmc) ? $if : $cmc;
         //E
         $ic = ($if < $ict) ? $if : $ict;
         //G-1



         //realizar for para cada operacion

         //C
         for ($iict=0; $iict < $ict; $iict++) { 
            $ct_mt[$iict] = $cma[$iict]->mt + $cmc[$iict]->mt;
            $ct_bt[$iict] = $cma[$iict]->bt + $cmc[$iict]->bt;
            $ct_no_residencial[$iict] = $cma[$iict]->no_residencial + $cmc[$iict]->no_residencial;
            $ct_cero_treinta[$iict] = $cma[$iict]->cero_treinta + $cmc[$iict]->cero_treinta;
            $ct_treinta_cien[$iict] = $cma[$iict]->treinta_cien + $cmc[$iict]->treinta_cien;
            $ct_cien_ccincuenta[$iict] = $cma[$iict]->cien_ccincuenta + $cmc[$iict]->cien_ccincuenta;
            $ct_ccincuenta_trecientos[$iict] = $cma[$iict]->ccincuenta_trecientos + $cmc[$iict]->ccincuenta_trecientos;
            $ct_trecientos_quinientos[$iict] = $cma[$iict]->trecientos_quinientos + $cmc[$iict]->trecientos_quinientos;
            $ct_mas_quinientos[$iict] = $cma[$iict]->mas_quinientos + $cmc[$iict]->mas_quinientos;
            $ct_residencial_bt[$iict] = $cma[$iict]->residencial_bt + $cmc[$iict]->residencial_bt;
            $ct_st_regulado[$iict] = $cma[$iict]->st_regulado + $cmc[$iict]->st_regulado;
            $ct_st_libre[$iict] = $cma[$iict]->st_libre + $cmc[$iict]->st_libre;
            $ct_total[$iict] = $cma[$iict]->total + $cmc[$iict]->total;

            $ct[$iict] = [
               'mt'=>$ct_mt[$iict],
               'bt'=>$ct_bt[$iict],
               'no_residencial'=>$ct_no_residencial[$iict],
               'cero_treinta'=>$ct_cero_treinta[$iict],
               'treinta_cien'=>$ct_treinta_cien[$iict],
               'cien_ccincuenta'=>$ct_cien_ccincuenta[$iict],
               'ccincuenta_trecientos'=>$ct_ccincuenta_trecientos[$iict],
               'trecientos_quinientos'=>$ct_trecientos_quinientos[$iict],
               'mas_quinientos'=>$ct_mas_quinientos[$iict],
               'residencial_bt'=>$ct_residencial_bt[$iict],
               'st_regulado'=>$ct_st_regulado[$iict],
               'st_libre'=>$ct_st_libre[$iict],
               'total'=>$ct_total[$iict],
               'st_libre'=>$ct_st_libre[$iict],
            ];


            //$dos[$iict]->mt = $mt;
         }

         //D
         for ($iicc=0; $iicc < $icc; $iicc++) {
          
            $cc_mt[$iicc] = ($f[$iicc]->mt != 0) ? (($cmc[$iicc]->mt / $f[$iicc]->mt)*100).'%' : ('');
            $cc_bt[$iicc] = ($f[$iicc]->bt != 0) ? (($cmc[$iicc]->bt / $f[$iicc]->bt)*100).'%' : ('');
            $cc_no_residencial[$iicc] = ($f[$iicc]->no_residencial != 0) ? (($cmc[$iicc]->no_residencial / $f[$iicc]->no_residencial)*100).'%' : ('');
            $cc_cero_treinta[$iicc] = ($f[$iicc]->cero_treinta != 0) ? (($cmc[$iicc]->cero_treinta / $f[$iicc]->cero_treinta)*100).'%' : ('');
            $cc_treinta_cien[$iicc] = ($f[$iicc]->treinta_cien != 0) ? (($cmc[$iicc]->treinta_cien / $f[$iicc]->treinta_cien)*100).'%' : ('');
            $cc_cien_ccincuenta[$iicc] = ($f[$iicc]->cien_ccincuenta != 0) ? (($cmc[$iicc]->cien_ccincuenta / $f[$iicc]->cien_ccincuenta)*100).'%' : ('');
            $cc_ccincuenta_trecientos[$iicc] = ($f[$iicc]->ccincuenta_trecientos != 0) ? (($cmc[$iicc]->ccincuenta_trecientos / $f[$iicc]->ccincuenta_trecientos)*100).'%' : ('');
            $cc_trecientos_quinientos[$iicc] = ($f[$iicc]->trecientos_quinientos != 0) ? (($cmc[$iicc]->trecientos_quinientos / $f[$iicc]->trecientos_quinientos)*100).'%' : ('');
            $cc_mas_quinientos[$iicc] = ($f[$iicc]->mas_quinientos != 0) ? (($cmc[$iicc]->mas_quinientos / $f[$iicc]->mas_quinientos)*100).'%' : ('');
            $cc_residencial_bt[$iicc] = ($f[$iicc]->residencial_bt != 0) ? (($cmc[$iicc]->residencial_bt / $f[$iicc]->residencial_bt)*100).'%' : ('');
            $cc_st_regulado[$iicc] = ($f[$iicc]->st_regulado != 0) ? (($cmc[$iicc]->st_regulado / $f[$iicc]->st_regulado)*100).'%' : ('');
            $cc_st_libre[$iicc] = ($f[$iicc]->st_libre != 0) ? (($cmc[$iicc]->st_libre / $f[$iicc]->st_libre)*100).'%' : ('');
            $cc_total[$iicc] = ($f[$iicc]->total != 0) ? (($cmc[$iicc]->total / $f[$iicc]->total)*100).'%' : ('');

            $cc[$iicc] = [
               'mt'=>$cc_mt[$iicc],
               'bt'=>$cc_bt[$iicc],
               'no_residencial'=>$cc_no_residencial[$iicc],
               'cero_treinta'=>$cc_cero_treinta[$iicc],
               'treinta_cien'=>$cc_treinta_cien[$iicc],
               'cien_ccincuenta'=>$cc_cien_ccincuenta[$iicc],
               'ccincuenta_trecientos'=>$cc_ccincuenta_trecientos[$iicc],
               'trecientos_quinientos'=>$cc_trecientos_quinientos[$iicc],
               'mas_quinientos'=>$cc_mas_quinientos[$iicc],
               'residencial_bt'=>$cc_residencial_bt[$iicc],
               'st_regulado'=>$cc_st_regulado[$iicc],
               'st_libre'=>$cc_st_libre[$iicc],
               'total'=>$cc_total[$iicc],
               'st_libre'=>$cc_st_libre[$iicc],
            ];


            //$dato = ($f[$iicc]->st_libre != 0) ? $f[$iicc]->st_libre : $cmc;

            //if ($f[$iicc]->st_libre) {
            //   // code...
            //}
         } 
         //E
         //dd($ct[0]['mt']);
         for ($iic=0; $iic < $ic; $iic++) {
            ///  ct/f

            $c_mt[$iic] = ($f[$iic]->mt != 0) ? (($ct[$iic]['mt'] / $f[$iic]->mt)*100).'%' : ('');


            $c_mt[$iic] = ($f[$iic]->mt != 0) ? (($ct[$iic]['mt'] / $f[$iic]->mt)*100).'%' : ('');
            $c_bt[$iic] = ($f[$iic]->bt != 0) ? (($ct[$iic]['bt'] / $f[$iic]->bt)*100).'%' : ('');
            $c_no_residencial[$iic] = ($f[$iic]->no_residencial != 0) ? (($ct[$iic]['no_residencial'] / $f[$iic]->no_residencial)*100).'%' : ('');
            $c_cero_treinta[$iic] = ($f[$iic]->cero_treinta != 0) ? (($ct[$iic]['cero_treinta'] / $f[$iic]->cero_treinta)*100).'%' : ('');
            $c_treinta_cien[$iic] = ($f[$iic]->treinta_cien != 0) ? (($ct[$iic]['treinta_cien'] / $f[$iic]->treinta_cien)*100).'%' : ('');
            $c_cien_ccincuenta[$iic] = ($f[$iic]->cien_ccincuenta != 0) ? (($ct[$iic]['cien_ccincuenta'] / $f[$iic]->cien_ccincuenta)*100).'%' : ('');
            $c_ccincuenta_trecientos[$iic] = ($f[$iic]->ccincuenta_trecientos != 0) ? (($ct[$iic]['ccincuenta_trecientos'] / $f[$iic]->ccincuenta_trecientos)*100).'%' : ('');
            $c_trecientos_quinientos[$iic] = ($f[$iic]->trecientos_quinientos != 0) ? (($ct[$iic]['trecientos_quinientos'] / $f[$iic]->trecientos_quinientos)*100).'%' : ('');
            $c_mas_quinientos[$iic] = ($f[$iic]->mas_quinientos != 0) ? (($ct[$iic]['mas_quinientos'] / $f[$iic]->mas_quinientos)*100).'%' : ('');
            $c_residencial_bt[$iic] = ($f[$iic]->residencial_bt != 0) ? (($ct[$iic]['residencial_bt'] / $f[$iic]->residencial_bt)*100).'%' : ('');

            $c_st_regulado[$iic] = ($f[$iic]->st_regulado != 0) ? (($ct[$iic]['st_regulado'] / $f[$iic]->st_regulado)*100).'%' : ('');
            $c_st_libre[$iic] = ($f[$iic]->st_libre != 0) ? (($ct[$iic]['st_libre'] / $f[$iic]->st_libre)*100).'%' : ('');
            $c_total[$iic] = ($f[$iic]->total != 0) ? (($ct[$iic]['total'] / $f[$iic]->total)*100).'%' : ('');
            
               //  (ct_residencial_bt + ct_bt)/(f_bt + f_residencial_bt)
            $c_st_bt[$iic] = ($f[$iic]->total != 0) ? ((($ct[$iic]['residencial_bt'] + $ct[$iic]['bt']) / ($f[$iic]->bt + $f[$iic]->residencial_bt))*100).'%' : ('');

            $c[$iic] = [
               'mt'=>$c_mt[$iic],
               'bt'=>$c_bt[$iic],
               'no_residencial'=>$c_no_residencial[$iic],
               'cero_treinta'=>$c_cero_treinta[$iic],
               'treinta_cien'=>$c_treinta_cien[$iic],
               'cien_ccincuenta'=>$c_cien_ccincuenta[$iic],
               'ccincuenta_trecientos'=>$c_ccincuenta_trecientos[$iic],
               'trecientos_quinientos'=>$c_trecientos_quinientos[$iic],
               'mas_quinientos'=>$c_mas_quinientos[$iic],
               'residencial_bt'=>$c_residencial_bt[$iic],

               'st_bt'=>$c_st_bt[$iic],
               'st_mt'=>$c_mt[$iic],

               'st_libre'=>$c_st_libre[$iic],
               'total'=>$c_total[$iic],
            ];
         }
            //dd($c_mt);
            //dd($ct);
            //dd($st_libre, $mt, $bt);



           

         /*for ($ii=0; $ii < 17; $ii++) { 
            // code...
           //dd();
            if ($icma < $cmc) {
               $dos->cms = $cmc[$ii]->st_libre;
            }elseif($icma > $cmc){
               $dos->cms = $cma[$ii]->st_libre;
            }else{
               $dos->cms = $cma[$ii]->st_libre + $cmc[$ii]->st_libre;
            }

         }*/

        // dd($dos->cms);

         //dd($ve[0]->bt + $f[0]->bt);
         //dd($xxd, $xxdd);

      //return $informacion;
         //dd(['ve' => $ve, 'f' => $f, 'cmc' =>$cmc, 'cma' =>$cma, 'ct' =>$ct]);
      return ['ve' => $ve, 'f' => $f, 'cmc' =>$cmc, 'cma' =>$cma, 'ct' =>$ct, 'cc' =>$cc, 'c' =>$c, 'im' =>$im];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function show(Informacion $informacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Informacion $informacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Informacion $informacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informacion $informacion)
    {
        //
    }
}
