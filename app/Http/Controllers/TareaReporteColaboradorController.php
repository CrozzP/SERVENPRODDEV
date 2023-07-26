<?php

namespace App\Http\Controllers;

use App\Models\TareaReporteColaborador;
use App\Models\TareaReporte;
use App\Models\Tarea;
use App\Models\TareaPeriodo;
use App\Models\Derivados;
use App\Models\Documento;
use App\Models\Solicitud;

use App\Http\Requests\TareaReporteColaborador\AsigTarRepColRequest;
use App\Http\Requests\TareaReporteColaborador\DerTarRepColUpdateRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;



class TareaReporteColaboradorController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TareaReporteColaborador  $tareaReporteColaborador
     * @return \Illuminate\Http\Response
     */
    public function show(TareaReporteColaborador $tareaReporteColaborador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TareaReporteColaborador  $tareaReporteColaborador
     * @return \Illuminate\Http\Response
     */
    public function edit(TareaReporteColaborador $tareaReporteColaborador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TareaReporteColaborador  $tareaReporteColaborador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TareaReporteColaborador $tareaReporteColaborador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TareaReporteColaborador  $tareaReporteColaborador
     * @return \Illuminate\Http\Response
     */
    public function destroy(TareaReporteColaborador $tareaReporteColaborador)
    {
        //
    }


    public function EliminarRepAsig(TareaReporteColaborador $tareaReporteColaborador,Request $request,$id, TareaReporte $tareaReporte)
    {

//dd($request);

    



      $tareaReporteColaborador = TareaReporteColaborador::where('id', $id)->where('estado','>',0)->first();
        //dd($tareaReporteColaborador);
        //$tareaReporteColaborador->delete();

        if ($tareaReporteColaborador == NULL) {
            return ['TRC'=>[],
                    'TR'=> [],
                    'rep'=>[]
                ];
            // code...
            //dd('no se encontraron datos');
        }else {
          //  dd('datos encontrados');
         
         //$derivados = Derivados::where('','=','')->first();
            $documentos = Documento::where('tareareportecolaborador_id','=',$tareaReporteColaborador->id)->first();
            //VERIFICAR SI TIENE ALGUN DOCUMENTO
               if (!empty($documentos)) {
                  // code...
                  //retornar mensaje
                  return Response::json([
                        'Existe un documento cargado a la Tarea Asignada'
                    ], 409);
               }else{

               

               
               //$tareaReporteColaborador->delete();
               $tareaReporteColaborador->estado = 0;
               $tareaReporteColaborador->save();
               //dd('se elimini? : ',$tareaReporteColaborador->isClean());

               //if ($tareaReporteColaborador->isClean() == true) {
               if ($tareaReporteColaborador->wasChanged() == true) {

                   $tareaReporte = TareaReporte::find($request->tareareporteId);
                   $tareaReporte->estadoasignado = 0;
                   $tareaReporte->save();

                   $tarea = Tarea::find($request->tarea_Id);
                   $tarea->totalasignado = $tarea->totalasignado - 1;
                   $tarea->save();

                 
                  $tareaPeriodo =TareaPeriodo::where('periodo_id','=',$tareaReporteColaborador->periodo_id)->where('tarea_id','=',$request->tarea_Id)->orderBy('estado','desc')->first();
                  if ($tareaPeriodo !== null && $tareaPeriodo->estado == 1) {
                        $tareaPeriodo->update(['totalasignado' => $tareaPeriodo->totalasignado-1]);
                         if ($tareaPeriodo->totalasignado == 0) {
                            // code...
                           $tareaPeriodo->estado = 0;
                           $tareaPeriodo->save();
                         }
                   } else if($tareaPeriodo !== null && $tareaPeriodo->estado == 0){
                        $tareaPeriodo->update(['totalasignado' => 0]);
                   } else{
                           $tareaPeriodo = TareaPeriodo::create([
                                 'tarea_id' => $request->tarea_Id,
                                 'periodo_id' => $tareaReporteColaborador->periodo_id,
                                 'estado' => 0,
                                 'totalasignado' => 0,
                               ]);
                   }


                           


                    $tareareporte = DB::table('repositorio.tareareporte as tr')
                       ->join('repositorio.reportes as r', 'r.id', '=', 'tr.reporte_id')
                       ->select('tr.id','tr.tarea_id','tr.reporte_id','r.nombre','r.descripcion','tr.estadoasignado')
                       ->where('tr.estado', '=', 1)
                       ->where('tr.estadoasignado', '=', 0)
                       ->where('tr.id', '=', $request->tareareporteId)
                       ->first();
               }else {
                   return ['TRC'=>[],
                       'TR'=> [],
                       'rep'=>['xd']
                   ];
               }


               return ['trcr'=>$tareaReporteColaborador,'trr'=> $tareaReporte, 'rep'=>$tareareporte, 't'=> $tarea];
            }
        }


    }

  


    public function asignarTarRepCol(AsigTarRepColRequest $request, TareaReporteColaborador $tareaReporteColaborador,TareaReporte $tareaReporte)
    {

       $user = Auth::user();
        //dd($user);
       // return $user;

        


        //

       // dd('holitas');
      // dd($request);
       // "colaborador_id" => "2"
       //"tareaReporte_id" => "2"
       //"tarea_id" => "2"
       //"fechalimite" => "2022-03-31"

       // crear el registro 

        
           // $tareaReporteColaborador = $request->validated($request->all());
//$tareaReporteColaborador = $request->validate([
//         'tareareporte_id' => 'email',
//    ]);
//         

        //actualizar el estado-asignado 
         $fecha = Carbon::now();
       // $fecha_inicioR = Carbon::now();

      //  $fecha_hoy = date("Y-m-d",strtotime($fecha_inicio."+  1 day"));
      //  $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+  1 day"));

        if ($request->colaborador_id != 'undefined' && $request->tareaReporte_id != 'undefined') {
//dd('dentro del if',$request);
            $tareaReporteColaborador->empresacolaborador_id=$request->colaborador_id;
            $tareaReporteColaborador->tareareporte_id=$request->tareaReporte_id;
            $tareaReporteColaborador->estado='1';
            $tareaReporteColaborador->estador='2';
            $tareaReporteColaborador->dericont='1';
            $tareaReporteColaborador->fechalimite=$request->fechalimite;
            $tareaReporteColaborador->fechaasignacionh=$fecha;
            $tareaReporteColaborador->fechaasignacion=$fecha->format('Y-m-d');
            $tareaReporteColaborador->periodo_id=$request->periodoId;
            $tareaReporteColaborador->user_id=$user->id;
            //return $tareaReporteColaborador;
            $tareaReporteColaborador->save();

             if ($tareaReporteColaborador->isDirty() == false) {
                // code...

                    $tareaReporte = TareaReporte::find($request->tareaReporte_id);
                    $tareaReporte->estadoasignado = '1';

                    $tareaReporte->save();

                    //dd('registro guardado? : ',$tareaReporte->isDirty() );
         
                        // code...
                        $tarea =Tarea::find($request->tarea_id);
                        $tarea->totalasignado = $tarea->totalasignado + 1;
                        $tarea->save();

                        $tareaPeriodo =TareaPeriodo::where('periodo_id','=',$request->periodoId)->where('tarea_id','=',$request->tarea_id)->where('estado','=','1')->first();

                        if ($tareaPeriodo !== null) {
                            $tareaPeriodo->update(['totalasignado' => $tareaPeriodo->totalasignado+1]);
                        } else {
                            $tareaPeriodo = TareaPeriodo::create([
                              'tarea_id' => $request->tarea_id,
                              'periodo_id' => $request->periodoId,
                              'estado' => 1,
                              'totalasignado' => 1,
                            ]);
                        }



              
            }else{
                return response()->json(['message' => 'Ocurrio algun problema al asignar Colaborador - Reporte'], 266);
            }


            return ['trc'=>$tareaReporteColaborador, 'tr'=>$tareaReporte, 't'=>$tarea, 'tp'=>$tareaPeriodo];
        } 
      //  dd('fuera del if',$request);
        //return $tareaReporteColaborador;
        //return Response::json($tareaReporteColaborador, 201);
        return response()->json(['message' => 'Seleccione Colaborador y Reporte'], 266);

    }
    public function ResultadoRepAsig(Request $request){
    //  dd($request);
       // dd('dentro del buscador',$request, $request->tareaId);

       // $listRegAsig= TareaReporteColaborador::with('tareaReporte.tareas')->where('estado','1')->where('tareareporte_id',$request->tareaId)->orderBy('created_at','desc')->Paginate(10);
        //$orientaciones = Orientacion::with('desOrientacion')->where('id','1')->orderBy('created_at','desc')->get();
   

        $listRegAsig = TareaReporteColaborador::with('tareaReporte.tareas','tareaReporte.reportes','colaborador')
                    ->whereHas('tareaReporte.tareas', function($query) use ($request)  {
                        //$query->where('sede_id','=', $user->sede_id);
                        $query->where('id', $request->tareaId);
                        //$query->whereIn('sede_id', [2,3]);
                    })
                    ->where('estado','>','0')
                    ->where('periodo_id',$request->periodoId)
                    ->orderBy('created_at','DESC')->Paginate(5);
        
       // $tareaPeriodo =TareaPeriodo::where('periodo_id','=',$request->periodoId)->where('tarea_id','=',$request->tarea_id)->where('estado','=','1')->first();


        return $listRegAsig;

    }

    public function derivarRegistro(DerTarRepColUpdateRequest $request){

     // dd('dentreo de Request $request',$request);
      $user = Auth::user();
      $fecha = Carbon::now();

    
     


      //1-> BUSCAR Y ACTUALIZA TRC_ID OLD ------ O ACTUALIZAR

      $old_trc = TareaReporteColaborador::find($request->trc_id);
      //$old_trc = TareaReporteColaborador::where('id','='$request->trc_id)->where('estador','=',)->get();
      $old_trc->estado='0';
     // $old_trc->estador= +1;
      $old_trc->save();
     // dd($old_trc);

      //dd('registro guardado? : ',$old_trc->wasChanged() );
    //  $old_trc = TareaReporteColaborador::destroy($request->trc_id);
      if ($old_trc->wasChanged() == true) {

         if ($old_trc->estador > 3 ) {
            // code...
            $solicitud_old = Solicitud::where('tareareportecolaborador_id','=',$old_trc->id)->first();
            $solicitud_old->estado = 0;
            $solicitud_old->save();
         }

      //2-> CREAR TRC NEW

         $tareaReporteColaborador = new TareaReporteColaborador;
         $tareaReporteColaborador->empresacolaborador_id=$request->colaborador_id;
         $tareaReporteColaborador->tareareporte_id=$request->trc_tareareporte_id;
         $tareaReporteColaborador->estado='1';
         $tareaReporteColaborador->estador='3';
         $tareaReporteColaborador->dericont=$old_trc->dericont+1;
         $tareaReporteColaborador->fechalimite=$request->trc_fechalimite;
         $tareaReporteColaborador->fechaasignacionh=$fecha;
         $tareaReporteColaborador->fechaasignacion=$fecha->format('Y-m-d');
         $tareaReporteColaborador->periodo_id=$request->trc_periodo_id;
         $tareaReporteColaborador->user_id=$user->id;
         $tareaReporteColaborador->save();


      //3-> CREAR DERIVADOS CON TRC_OLD, TRC_NEW

         $derivados = new Derivados;
         $derivados->tareareportecolaborador_id_old = $old_trc->id;
         $derivados->tareareportecolaborador_id_new  = $tareaReporteColaborador->id;
         $derivados->user_id = $user->id;
         $derivados->fechaderivar = $fecha->format('Y-m-d');
         $derivados->fechaderivarh = $fecha;
         $derivados->estado = 1;
         $derivados->motivo_id = $request->motivo_id;
         $derivados->save();

      //4-> RETORNA TRCN_NEW PARA 
         return ['derivados'=>$derivados,'trc'=>$tareaReporteColaborador,'old_trc' => $old_trc];

      } else{
           //$nameArchivo =$documentos->archivo;
           //dd('else');
           return Response::json([
               'El estado actual entra en conflicto con lo que espera la solicitud'
           ], 409);
       }


    }
   public function solicitarAmpliacion(Request $request){
//dd($request);
      $user = Auth::user();
      //$fecha = Carbon::now();

      //dd('dentro de Request $request',$request->trc_id);
      //dd($request);

      //1-> ACTUALIZAR TRC - CAMPO ESTADOR

      //$old_trc = TareaReporteColaborador::find($request->trc_id);
      $old_trc = TareaReporteColaborador::where('id','=',$request->trc_id)->where('estado','=','1')->whereIn('estador',[2,3,7,13,5,8,9,11,14,15])->first();

     // $old_trc->estador= +1;

      //2-> REGISTRAR SOLICITUD
      /*
1 DESHABILITADO

2  4  REPORTE NORMAL
3  6  REPORTE DERIVADO
7  10 AMPLIACION DERIVADO
13 12 AMPLIACION DERIVADO REITERATIVO

5  11 AMPLIACION ACEPTADA
8  11 AMPLIACION DENEGADA
9  11 AMPLIACION DERIVADO DENEGADO
11 11 AMPLIACION REITERATIVO
14 11 AMPLIACION REITERATIVO DENEGADO
15 11 AMPLIACION DERIVADO REITERATIVO DENEGADO



4  2 AMPLIACION SOLICITADA
6  3 AMPLIACION DERIVADO SOLICITADA
10 11 AMPLIACION REITERATIVO SOLICITADA
12 13 SOLICITAR AMPLIACION DERIVADO REITERATIVO
    */

      if (!empty($old_trc)) {

         //$estador = ($old_trc->estador == '2') ? '4' : '6' ;

         switch ($old_trc->estador) {
            case '2':
               $estador = 4;
               break;
            case '3':
               $estador = 6;
               break;
            case '7':
               $estador = 10;
               break;
            case '13':
               $estador = 12;
               break;
            case '5':
               $estador = 10;
               break;
            case '8':
               $estador = 10;
               break;
            case '9':
               $estador = 12;
               break;
            case '11':
               $estador = 10;
               break;
            case '14':
               $estador = 10;
               break;
            case '15':
               $estador = 12;
               break;
            
            default:
               $estador = $old_trc->estado;
               break;
         }
         
            //dd($old_trc->estador,$estador);

         $old_trc->estador = $estador;
         $old_trc->solcont = $old_trc->solcont +1;
         $old_trc->save();

         if ($old_trc->wasChanged() == true) {

            $solicitudes = new Solicitud;
            $solicitudes->estado  = 1;    // 0: desactivado / 1:activado
            $solicitudes->estadosolicitud = 1; // 1: solicitado / 2: aceptado / 3:denegado
            $solicitudes->user_id  = $user->id;
            $solicitudes->solcont  = $old_trc->solcont;
            $solicitudes->tareareportecolaborador_id  = $request->trc_id;
            $solicitudes->fechasolicitada = $request->fechasolicitada;
            $solicitudes->fechasolicitadah = $request->fechasolicitada.' '.$request->fechasolicitadah;
            $solicitudes->fundamento = $request->fundamento;
            //$solicitudes->tiposolicitud_id  = $request->tiposolicitud_id;
            $solicitudes->fechaasignada_old = $old_trc->fechaasignacion;
            $solicitudes->fechaasignadah_old = $old_trc->fechaasignacionh;
            $solicitudes->save();

         }else{
            return Response::json([
                  'El reporte ya fue solicitado'
              ], 410);

         }

      }else{
         return Response::json([
               'Existe una solicitud pendiente, o el reporte no puede ser ampliado'
           ], 409);
      }

      //3-> RETORNAR TRC
      return ['trc_old'=>$old_trc,'solicitudes'=>$solicitudes] ;

   }


    public function solicitaCancelarAmpliacion(Request $request)
    {
      //dd('cancelar solicitud', $request);

      //1->BUSCAR TCR Y ACTUALIZAR CAMPO ESTADOR-1
      $trc = TareaReporteColaborador::where('id','=',$request->trc_id)->where('estado','=','1')->whereIn('estador',[4,6,10,12])->first();


      if (!empty($trc)) {

         switch ($trc->estador) {
            case '4':
               $estador = 2;
               break;
            case '6':
               $estador = 3;
               break;
            case '10':
               $estador = 11;
               break;
            case '12':
               $estador = 13;
               break;
            
            default:
               $estador = $trc->estado;
               break;
         }

         $trc->estador = $estador;
         $trc->solcont = $trc->solcont -1;
         $trc->save();

         if ($trc->wasChanged() == true) {

            //$solicitudes = new Solicitud;
            $solicitudes = Solicitud::where('tareareportecolaborador_id','=',$trc->id)->where('estado','=','1')->first();

            $solicitudes->estado  = 0;    // 0: desactivado / 1:activado
            //$solicitudes->estadosolicitud = 1; // 1: solicitado / 2: aceptado / 3:denegado
            $solicitudes->save();

         }else{
            return Response::json([
                  'La solicitud no puede ser cancelada, contacte con su superior'
              ], 410);

         }


      }else{
            return Response::json([
                  'La solicitud no puede ser cancelada'
              ], 409);

         }
      //3-> RETORNAR TRC
      return ['trc_old'=>$trc,'solicitudes'=>$solicitudes] ;
      
    }



}
