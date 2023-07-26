<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\TareaReporteColaborador;
use App\Models\EmpresaColaborador;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
Use Mail;

use Carbon\Carbon;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Response;




class SolicitudController extends Controller
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
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function show(Solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function edit(Solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solicitud  $solicitud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solicitud $solicitud)
    {
        //
    }

    public function getsolicitudes(Request $request)
    {


       $user = Auth::user();
       //dd($user->permissions);
       $roles ='administrador';
      
          // dd($user()->roles->has_any_role($roles));
          
          // dd($user->has_role($roles));
       if ($user->has_role($roles) == true) {
          // code...
         $solicitudes = Solicitud::with('tarrepcol.periodo','tarrepcol.tareaReporte.tareas','tarrepcol.tareaReporte.reportes','tarrepcol.colaborador')->orderBy('created_at','desc')->where('estado','=',1)->paginate(5);
       }else{
         $solicitudes = Solicitud::with('tarrepcol.periodo','tarrepcol.tareaReporte.tareas','tarrepcol.tareaReporte.reportes','tarrepcol.colaborador')->orderBy('created_at','desc')
               ->whereHas('tarrepcol', function($query) use ($user) {
               //->whereHas('tarrepcol', function($query) {
                                 //$query->where('sede_id','=', $user->sede_id);
                                // $query->whereIn('user_id', '1');
                                 $query->where('user_id', $user->id);
                                 //$query->whereIn('sede_id', [2,3]);
                             })
               ->where('estado','=',1)->paginate(5);

       }
      
         //dd($solicitudes);
         return $solicitudes;
    }

    public function getsolicitudesFiltro(Request $request)
    {
      //dd($request);


       $user = Auth::user();
       //dd($user->permissions);
       $roles ='administrador';

       //$tipoTarea = ($request->tipoTareaAll == 'true') ? "%" : $request->tipoTarea ;
       // $tareasEstado = ($request->tareasEstadoAll == 'true') ? "%" : $request->tareasEstado ;
       if ($request->colaboradorAll == 'true') {
          $colaborador ="%";
       } else{
         //$colaborador =$request->colaborador;
         $empresaColaborador = EmpresaColaborador::where('colaborador_id','=',$request->colaborador)->where('estado','=',1)->first();
         if (!empty($empresaColaborador)) {
            
            $colaborador = $empresaColaborador->id;
         }else{
            $colaborador = 0;
         }

       }
        //$colaborador = ($request->colaboradorAll == 'true') ? "%" : $request->colaborador ;
        $periodoId = ($request->periodoIdAll == 'true') ? "%" : $request->periodoId ;
        

        //dd($colaborador);


        /*$solicitudes = Solicitud::with('tarrepcol.periodo','tarrepcol.tareaReporte.tareas','tarrepcol.tareaReporte.reportes','tarrepcol.colaborador')->orderBy('created_at','desc')
               ->whereHas('tarrepcol', function($query) use ($user,$periodoId,$colaborador) {
                                // $query->where('user_id', $user->id);
                                 $query->where('periodo_id', 'like',$periodoId)
                                 ->where('empresacolaborador_id', 'like',$colaborador);
                             })
               ->where('estado','=',1)
               ->paginate(5);*/

               
         
         //$solicitudes = Solicitud::with('tarrepcol')->where('periodo_id', 'like',$periodoId)->where('estado','=',1)->paginate(5);
      
          // dd($user()->roles->has_any_role($roles));
          
          // dd($user->has_role($roles));

       if ($user->has_role($roles) == true) {
          // code...
         //$solicitudes = Solicitud::with('tarrepcol.periodo','tarrepcol.tareaReporte.tareas','tarrepcol.tareaReporte.reportes','tarrepcol.colaborador')->orderBy('created_at','desc')->where('estado','=',1)->paginate(5);
         $solicitudes = Solicitud::with('tarrepcol.periodo','tarrepcol.tareaReporte.tareas','tarrepcol.tareaReporte.reportes','tarrepcol.colaborador')->orderBy('created_at','desc')
               ->whereHas('tarrepcol', function($query) use ($user,$periodoId,$colaborador) {
                                // $query->where('user_id', $user->id);
                                 $query->where('periodo_id', 'like',$periodoId)
                                 ->where('empresacolaborador_id', 'like',$colaborador);
                             })
               ->where('estado','=',1)
               ->paginate(5);
       }else{
         $solicitudes = Solicitud::with('tarrepcol.periodo','tarrepcol.tareaReporte.tareas','tarrepcol.tareaReporte.reportes','tarrepcol.colaborador')->orderBy('created_at','desc')
               ->whereHas('tarrepcol', function($query) use ($user,$periodoId,$colaborador) {
                                 $query->where('user_id', $user->id);
                                 $query->where('periodo_id', 'like',$periodoId)
                                 ->where('empresacolaborador_id', 'like',$colaborador);
                             })
               ->where('estado','=',1)
               ->paginate(5);

       }
      
         //dd($solicitudes);
         return $solicitudes;
    }

    public function aceptarSolicitud(Request $request)
    {
        //

      //dd('aceptarSolicitud',$request);


      //2-> BUSCAR TRC Y ACTUALIZAR LA FECHA ASIGNADA Y ESTADOR

      //$trc = TareaReporteColaborador::find($request->s_tareareportecolaborador_id);
      $trc = TareaReporteColaborador::where('id','=',$request->s_tareareportecolaborador_id)->where('estado','=','1')->whereIn('estador',[4,6,10,12])->first();

      if (!empty($trc)) {
         
         if ($request->validar == 1) {
            $fecha = strtotime($request->s_fechasolicitadah);

            $fechaap = date('Y-m-d',$fecha );
            $fechaaph = $request->s_fechasolicitadah;
         }else{
            $fechaap = $request->fechaaprobada;
            $fechaaph = $request->fechaaprobada.' '.$request->horaaprobada;
         }
         //dd($fechaap,$fechaaph);
         $trc->fechaasignacion = $fechaap;
         $trc->fechaasignacionh = $fechaaph;
         $trc->estador = $trc->estador + 1;
         $trc->save();

         if ($trc->wasChanged() == true) {
         //1-> BUSCAR SOLICITUD Y ACTUALIZAR FECHA ASIGADA
            $solicitud = Solicitud::find($request->s_id);
            $solicitud->fechaasignada_new = $fechaap;
            $solicitud->fechaasignadah_new = $fechaaph;
            $solicitud->estadosolicitud = 2;
            $solicitud->save();
            //ENVIAR EMAIL-NOTIFICACION
            return ['trc' => $trc, 'solicitud' => $solicitud];

         }else{
            return Response::json([
                  'Verifique la solicitud'
              ], 410);

         }


      }else{
         return Response::json([
               'La solicitud no puede er aceptada'
           ], 409);
      }



    }

    public function denegarSolicitud(Request $request)
    {
        //
      //dd('denegarSolicitud',$request);
      //2-> BUSCAR TRC Y ACTUALIZAR LA FECHA ASIGNADA Y ESTADOR

      //$trc = TareaReporteColaborador::find($request->s_tareareportecolaborador_id);
      $trc = TareaReporteColaborador::where('id','=',$request->s_tareareportecolaborador_id)->where('estado','=','1')->whereIn('estador',[4,6,10,12])->first();
      if (!empty($trc)) {
         switch ($trc->estador) {
            case '4':
               $estador = 8;
               break;
            case '6':
               $estador = 9;
               break;
            case '10':
               $estador = 14;
               break;
            case '12':
               $estador = 15;
               break;
            
            default:
               $estador = $trc->estado;
               break;
         }
         $trc->estador = $estador;
         $trc->save();

         if ($trc->wasChanged() == true) {
            $solicitud = Solicitud::find($request->s_id);
            //$solicitud->fechaasignada_new = $fechaap;
            //$solicitud->fechaasignadah_new = $fechaaph;
            $solicitud->estadosolicitud = 3;
            $solicitud->save();
            //ENVIAR EMAIL-NOTIFICACION
            return ['trc' => $trc, 'solicitud' => $solicitud];
         }else{
            return Response::json([
                  'Verifique la solicitud'
              ], 410);

         }


      }else{
         return Response::json([
               'La solicitud no puede ser cancelada'
           ], 409);

      }


      //1-> BUSCAR SOLICITUD Y ACTUALIZAR FECHA ASIGADA


    }

}
