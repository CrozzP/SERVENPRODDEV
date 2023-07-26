<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use Illuminate\Http\Request;

use App\Models\TareaReporte;
use App\Models\TareaPeriodo;
use App\Models\Tarea;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
    //dd($user->permissions);
    $roles ='administrador';
   
       // dd($user()->roles->has_any_role($roles));
       
       // dd($user->has_role($roles));
       if ($user->has_role($roles) == true) {

        $reportes= Reporte::orderBy('id','desc')->Paginate(10);
       }else{
         
        $reportes= Reporte::orderBy('id','desc')->where('user_id','=',$user->id)->Paginate(10);
       }

        //$orientaciones = Orientacion::with('desOrientacion')->where('id','1')->orderBy('created_at','desc')->get();
       /* $reporte= DB::table('repositorio.reportes as r')
        ->select('r.*')

        ->join('repositorio.tareareporte as tr', 'tr.reporte_id', '=', 'r.id')
        ->join('repositorio.tareareportecolaborador as trc', 'tr.id', '=', 'trc.tareareporte_id')
        ->orderBy('r.id','desc')
        //->where('','=','')
        ->Paginate(10);*/

       

        return $reportes;
        //return $reporte;
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
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }

   
    public function tareasReporte(Request $request)
    {
        
//dd($request);
//      $sedesCorreos = DB::select('SELECT cs.sede_id as value, s.nombre as text FROM correosede cs
//           INNER JOIN sedes s on s.id = cs.sede_id
//           WHERE  cs.correo_id = ?', [$request->idcorreo]);

      //$tareasReportes = DB::select('SELECT tr.tarea_id as value, t.nombre as text FROM repositorio.tareareporte tr
      //     INNER JOIN repositorio.tareas t on t.id = tr.tarea_id
      //     WHERE  tr.reporte_id = ?', [$request->idReporte]);

        $tareasReportes = DB::table('repositorio.tareareporte as tr')
            ->join('repositorio.tareas as t', 't.id', '=', 'tr.tarea_id')
           
            
       ->select('tr.tarea_id as value', 't.nombre as text')
           
            ->where('tr.reporte_id', '=', [$request->idReporte])
            ->where('tr.periodo_id', '=', $request->periodoId)
            
            ->get();


        //return $tareasReportes;

            switch ($tareasReportes) {
               case ($tareasReportes != null):
                  // code...
                     $i = 0;
                    foreach ($tareasReportes as $tareasReporte) {
                        
                        //dd($correo->correo);
                       // echo $correo->correo;
                        $tareasReporteIds[$i]=$tareasReporte->value;
                        
                        //return $xd;
                        $i++;
                    }
                    $tareasReporte = $tareasReportes;

                     if (!empty($tareasReporteIds)) {
                        // code...
                     $tareasReporteId = $tareasReporteIds;

                     }else{

                     $tareasReporteId = [];
                     }
                  break;
               case ($tareasReportes == null):
                  // code...
               $tareasReporte = [];
               $tareasReporteId = [];
                  break;
               
               default:
                  // code...
               $tareasReporte = [];
               $tareasReporteId = [];
                  break;
            }

      /*  $i = 0;
        foreach ($tareasReportes as $tareasReporte) {
            
            //dd($correo->correo);
           // echo $correo->correo;
            $tareasReporteIds[$i]=$tareasReporte->value;
            
            //return $xd;
            $i++;
        }


        if ($tareasReportes != null) {
            $tareasReporte = $tareasReportes;
            $tareasReporteId = $tareasReporteIds;
            //return ["datosReporte" =>$tareasReportes,
            //   "Seleccion" => $tareasReporteId];
        } else{
            $tareasReporte = [];
            $tareasReporteId = [];
             

        }
        */
         return ["datosReporte" =>$tareasReporte,
                "Seleccion" => $tareasReporteId];

       
    }

     public function getReporteTarea(Request $request)
    {
        //dd($request);
      //  $sedes = Sede::where('estado','=',"1")->get();

       // $sedes = DB::select('SELECT id as value, nombre as text FROM sedes
       //     
       //     WHERE  estado = 1'); 
        $tareas = DB::select('SELECT id as value, nombre as text FROM repositorio.tareas
            
            WHERE  estado = 1');

       // $sedes = Sede::where('estado', $request->personaDni)->first();

       // $sedes = Sede::all();
        //$empresas Correo::orderBy('id','desc')->get();
        return $tareas;
    }

    
    public function tareaReportes(Request $request,Reporte $reporte)
    {
        //dd($request->tareas_id);
     // dd($reporte->id);
     // $estadoasignado = '15';
      //dd($request);

     // $tareas = Tarea::orderBy('created_at','desc')->get();
     // $tareas = Tarea::orderBy('created_at','desc')->toArray(); 
      $tareas = Tarea::orderBy('created_at','desc')->pluck('id')->toArray();
//dd($tareas);
    //  $ii = 0;
    //    foreach ($tareas as $tarea) {
    //        $tareaId[$ii]=$tarea->id;
    //     $ii++;
    //    }

        $result2 = array_intersect($tareas, $request->tareas_id);
        $results = array_diff($tareas, $request->tareas_id);

          $tareaReporteD = TareaReporte::whereIn('tarea_id',$results)->where('reporte_id','=',$reporte->id)->where('periodo_id','=',$request->periodoId)->pluck('id')->toArray();
        //  dd($tareaReporteD);
        if (!empty($tareaReporteD)) {
           // code...
          $tareaReporteD=TareaReporte::destroy($tareaReporteD);
        }
       // return $tareaReporteD;

       // dd('tarea total:',$tareaId,'tarea reporte:', $request->tareas_id);
      //  dd('tarea total:',$tareas,'tarea reporte:', $request->tareas_id,'Interseccion:',$result2,'Diferencia:',$results,'para eliminar',$tareaReporteD);

      //dd($reporte, $request);
      

       // $user->permissions()->sync($request->permissions);
        
//dd($request, $reporte);

       // $correo->sede()->sync($request->pruebaxd);
    //    $reporte->tarea()->sync($request->tareas_id, $estadoasignado);
        //$reporte->tarea()->estado='1';
        //dd($reporte);

      
       $i = 0;
        foreach ($request->tareas_id as $tareasR) {
            
            //dd($correo->correo);
           // echo $correo->correo;
            $tareasReporteId[$i]=$tareasR;
/*
           $tareaReporte[$i] = TareaReporte::where('tarea_id','=',$tareasReporteId[$i])->where('reporte_id','=',$reporte->id)->where('periodo_id','=',15)->first();

           if ($tareaReporte[$i] != NULL) {
              // code...
            $tareaReporte[$i]->delete();
           } else{
            $tareaReporte[$i] = new TareaReporte();
            $tareaReporte[$i]->tarea_id = $tareasReporteId[$i];
            $tareaReporte[$i]->reporte_id = $reporte->id;
            $tareaReporte[$i]->periodo_id = 15;
            $tareaReporte[$i]->tarea_id = 1;
            $tareaReporte[$i]->save();

           }
 */

         $retVal[$i] = TareaReporte::updateOrCreate(
             ['tarea_id' =>  $tareasReporteId[$i], 'reporte_id' =>  $reporte->id,'periodo_id' => $request->periodoId],
             ['estado' => 1]
         );

           
            //return $xd;
            $i++;
        }
        //return $tareasReporteId;
        $tareaReporte = (empty($retVal)) ? [] : $retVal ;
          


      //  $iii = 0;
      //  foreach ($results as $result) {
      //     $tareaReporteD[$iii]->delete();

      //  }

        return $tareaReporte;


       // $correo = Correo::find($request->id);
        //$correo->id = $request->id;
       /* $correo->cargo = $request->cargo;
        $correo->correo = $request->correo;
        $correo->correoNombre = $request->correoNombre;
        
        $correo->empresa_id = $request->empresa_id;*/
       // $correo->estado = $request->estado;
        

       // $correo->save();
       // return $correo;
    }

    public function regReporte(Request $request){

      //dd('dentro del regReporte',$request);

      switch ($request->estador) {
         case null:
            // code...
         $estador = 0;
            break;
         case 'true':
            // code...
         $estador = 1;
            break;
         case 'false':
            // code...
         $estador = 0;
            break;
         
         default:
            // code...
         $estador = 0;
            break;
      }
      //dd($estador);

      $users = Auth::user();


      $reportes = new reporte();
      $reportes->nombre = $request->nombre;
      $reportes->descripcion = $request->descripcion;
      $reportes->estador = $estador;
      $reportes->estado = 1;
      $reportes->oficina_id = 1;
      $reportes->tipo = $request->tipo;
      $reportes->user_id = $users->id;
      $reportes->tipoinformacion_id = $request->tipoinformacion;
      $reportes->save();
      return $reportes;

   }

   public function editRegReporte(Request $request, $id){
      //dd('dentro de la funcion:', $id, $request);
      //dd($request->params['descripcion']);

      $reportes = Reporte::find($id);
      $reportes->descripcion = $request->descripcion;
      $reportes->nombre = $request->nombre;
      $reportes->estador = $request->estador;
      $reportes->tipo = $request->tipo;
      $reportes->tipoinformacion_id = $request->tipoinformacion;
      $reportes->save();

      return $reportes;
   }





   public function deleteReporte(Request $request, $id){
      //dd('dentro de la funcion:', $id, $request);

     // $tareaPeriodo = TareaPeriodo::where('reporte_id','=',$id)->where('estado','=',1)->first();
      $tareaReporte = TareaReporte::where('reporte_id','=',$id)->where('estado','=',1)->first();

      if (!empty($tareaReporte)) {
         // code...
         //dd('con datos');
         return Response::json([
                  'Tiene un reporte Asignado a una Tarea y habilitado!!'
              ], 409);
      }else{
         //dd('limpio');
         $reportes = Reporte::find($id);
         $reportes->delete();

         return $reportes;
      }
//dd('prueba',empty($tareaPeriodo),empty($tareaReporte),$tareaPeriodo,$tareaReporte);
      //dd($tareaPeriodo,$tareaReporte);
      
      ////$tareas = Tarea::destroy($id);
      
   }

}
