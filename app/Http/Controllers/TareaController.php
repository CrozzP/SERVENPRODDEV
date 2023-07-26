<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\EmpresaColaborador;
use App\Models\TareaReporteColaborador;

use Illuminate\Http\Request;


use App\Models\TareaReporte;
use App\Models\TareaPeriodo;
use App\Models\Periodo;
use App\Models\Solicitud;
use App\Models\Colaborador;
use App\Models\Reporte;
use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
Use Mail;

use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;



class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //$tareas = Tarea::orderBy('created_at','desc')->get();
        $user = Auth::user();
        $roles ='administrador';
       
        //$i = 0;
        //    foreach ($user as $u) {
        //       $xd = $user->id;
        //    }
        //dd($user->roles);
        $users = new User;
        $users->id = $user->id;
        $users->email = $user->email;
        $users->fullName = $user->fullName;

        if ($user->has_role($roles) == true) {
        $tareas= Tarea::orderBy('created_at','desc')->where('estado','=',1)->Paginate(10);
        $users->roleAd = 1;

        }else{
        $tareas= Tarea::orderBy('created_at','desc')->where('user_id','=',$user->id)->where('estado','=',1)->Paginate(10);
        $users->roleAd = 0;

        }
        

        //$orientaciones = Orientacion::with('desOrientacion')->where('id','1')->orderBy('created_at','desc')->get();
        //return $tareas;
        return ['tareas' => $tareas, 'users' => $users];
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
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarea  $tarea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        //
    }

    public function tareaReporte(Request $request)
    {
       // dd($request);
         //$tareas = Tarea::orderBy('created_at','desc')->get();
        //dd('disito');
        //dd($request->idReporte);

      /*  $tareareporte = DB::select('SELECT * FROM repositorio.tareareporte
            
            WHERE  estado = 1 and tarea_id = ? ', [$request->idReporte]);*/

  /*      $tareareporte = DB::table('repositorio.tareareporte')
                     ->select('id','tarea_id','reporte_id')
                     ->where('estado', '=', 1)
                     ->where('tarea_id', '=', $request->idReporte)
                     ->get();
*/
        $tareareporte = DB::table('repositorio.tareareporte as tr')
            ->join('repositorio.reportes as r', 'r.id', '=', 'tr.reporte_id')
            ->select('tr.id','tr.tarea_id','tr.reporte_id','r.nombre','r.descripcion','tr.estadoasignado')
            ->where('tr.estado', '=', 1)
            ->where('tr.periodo_id', '=', $request->periodoId)
            //->where('tr.estadoasignado', '=', 0)
            ->where('tr.tarea_id', '=', $request->idReporte)
            ->get();

        return $tareareporte;

    }

    public function tareasReportesAsignadosFiltro(Request $request)
    {
        //dd($request);
       // $comment->created_at->diffForHumans();
       // dd()

               


        $user = Auth::user();
        $roles ='administrador';
        $userColaborador = $user->colaborador;
        //filtrar mediante la empresacolaborador_id

        //$empresacolaborador = DB::table('elputest.empresacolaborador as trc')
        $empresacolaborador = EmpresaColaborador::where('colaborador_id','=',$user->colaborador->id)->where('estado','=',1)->first();

        $fecha_hoy = Carbon::now();

       // $tipoTarea = (empty($request->tipoTarea)) ? '%' : $request->tipoTarea ;
       // $tareasEstado = (empty($request->tareasEstado)) ? '%' : $request->tareasEstado ;
       // $colaborador = (empty($request->colaborador)) ? '%' : $request->colaborador ;

        $tipoTarea = ($request->tipoTareaAll == 'true') ? "%" : $request->tipoTarea ;
        $tareasEstado = ($request->tareasEstadoAll == 'true') ? "%" : $request->tareasEstado ;
        $colaborador = ($request->colaboradorAll == 'true') ? "%" : $request->colaborador ;
        $periodoId = ($request->periodoIdAll == 'true') ? "%" : $request->periodoId ;

//dd($tipoTarea, $tareasEstado, $colaborador);
        if ($user->has_role($roles) == true) {



        $tareasReportesAsignados = DB::table('repositorio.tareareportecolaborador as trc')
            ->join('repositorio.tareareporte as tr', 'trc.tareareporte_id', '=', 'tr.id')
            ->join('repositorio.tareas as t', 't.id', '=', 'tr.tarea_id')
            ->join('repositorio.reportes as r', 'r.id', '=', 'tr.reporte_id')
            ->join('elputest.empresacolaborador as ec', 'ec.id', '=', 'trc.empresacolaborador_id')
            ->join('elputest.colaboradores as c', 'c.id', '=', 'ec.colaborador_id')
            ->join('repositorio.periodo as p', 'p.id', '=', 'tr.periodo_id')
            ->join('repositorio.estadoregistro as er', 'er.id', '=', 'trc.estador')

            ->select('trc.id as trc_id', 'trc.empresacolaborador_id as trc_empresacolaborador', 'trc.tareareporte_id as trc_tareareporte', 'trc.estado as trc_estado', 'trc.estador as trc_estador', 'trc.fechalimite as trc_fechalimite', 'trc.fechaatencion as trc_fechaatencion', 'trc.fechaatencionh as trc_fechaatencionh','trc.user_id as trc_user_id', 'tr.tarea_id as tr_tarea', 'tr.reporte_id as tr_reporte', 'tr.estadoasignado as tr_estadoasignado', 'tr.estado as tr_estado', 't.nombre as t_nombre', 't.descripcion as t_descripcion', 't.estado as t_estado','t.totalasignado as t_totalasignado','t.totalatendido as t_totalatendido', 'r.nombre as r_nombre', 'r.tipo as r_tipo', 'r.tipoinformacion_id as r_tipoinformacion_id','r.estado as r_estado', 'r.oficina_id as r_oficina', 'r.descripcion as r_descripcion','tr.periodo_id as tr_periodo_id','p.nombre as p_nombre','ec.id as ec_id', 'ec.colaborador_id as ec_colaborador_id','trc.fechaasignacionh as trc_fechaasignacionh','trc.fechaasignacion as trc_fechaasignacion', 'er.nombre as er_nombre','c.user_id as c_user_id')

            ->where('trc.estado', '>', 0)
            //->where('trc.user_id', '=', $user->id)
            //->where('c.user_id', '=', $user->id)
            ->where('t.id', 'like', $tipoTarea)
            ->where('trc.estado', 'like', $tareasEstado)
            ->where('c.id', 'like', $colaborador)
            ->where('p.id', 'like', $periodoId)


            //->orWhere('ec.colaborador_id','=',$empresacolaborador->id)
            ->orWhere(function($query) use ($empresacolaborador,$user,$tipoTarea,$tareasEstado,$colaborador,$periodoId)  {
                //$query->where('trc.empresacolaborador_id','=',$empresacolaborador->id)
                     $query->where('trc.estado', '>', 0)
                     ->where('t.id', 'like', $tipoTarea)
                     ->where('trc.estado', 'like', $tareasEstado)
                     ->where('c.id', 'like', $colaborador)
                     ->where('c.estado', '=', 1)
                     ->where('p.id', 'like', $periodoId);
            })
            ->where('c.estado', '=', 1)
            ->orderBy('trc.id','desc')
            //->orderByRaw('trc.id DESC')


            ->Paginate(8);
        }else{

            $tareasReportesAsignados = DB::table('repositorio.tareareportecolaborador as trc')
            ->join('repositorio.tareareporte as tr', 'trc.tareareporte_id', '=', 'tr.id')
            ->join('repositorio.tareas as t', 't.id', '=', 'tr.tarea_id')
            ->join('repositorio.reportes as r', 'r.id', '=', 'tr.reporte_id')
            ->join('elputest.empresacolaborador as ec', 'ec.id', '=', 'trc.empresacolaborador_id')
            ->join('elputest.colaboradores as c', 'c.id', '=', 'ec.colaborador_id')
            ->join('repositorio.periodo as p', 'p.id', '=', 'tr.periodo_id')
            ->join('repositorio.estadoregistro as er', 'er.id', '=', 'trc.estador')

            ->select('trc.id as trc_id', 'trc.empresacolaborador_id as trc_empresacolaborador', 'trc.tareareporte_id as trc_tareareporte', 'trc.estado as trc_estado', 'trc.estador as trc_estador', 'trc.fechalimite as trc_fechalimite', 'trc.fechaatencion as trc_fechaatencion', 'trc.fechaatencionh as trc_fechaatencionh','trc.user_id as trc_user_id', 'tr.tarea_id as tr_tarea', 'tr.reporte_id as tr_reporte', 'tr.estadoasignado as tr_estadoasignado', 'tr.estado as tr_estado', 't.nombre as t_nombre', 't.descripcion as t_descripcion', 't.estado as t_estado','t.totalasignado as t_totalasignado','t.totalatendido as t_totalatendido', 'r.nombre as r_nombre', 'r.tipo as r_tipo', 'r.tipoinformacion_id as r_tipoinformacion_id', 'r.estado as r_estado', 'r.oficina_id as r_oficina', 'r.descripcion as r_descripcion','tr.periodo_id as tr_periodo_id','p.nombre as p_nombre','ec.id as ec_id', 'ec.colaborador_id as ec_colaborador_id','trc.fechaasignacionh as trc_fechaasignacionh','trc.fechaasignacion as trc_fechaasignacion', 'er.nombre as er_nombre','c.user_id as c_user_id')

            ->where('trc.estado', '>', 0)
            ->where('trc.user_id', '=', $user->id)
            //->where('c.user_id', '=', $user->id)
            ->where('t.id', 'like', $tipoTarea)
            ->where('trc.estado', 'like', $tareasEstado)
            ->where('c.id', 'like', $colaborador)
            ->where('p.id', 'like', $periodoId)


            //->orWhere('ec.colaborador_id','=',$empresacolaborador->id)
            ->orWhere(function($query) use ($empresacolaborador,$user,$tipoTarea,$tareasEstado,$colaborador,$periodoId)  {
                $query->where('trc.empresacolaborador_id','=',$empresacolaborador->id)
                     ->where('trc.estado', '>', 0)
                    // ->where('trc.user_id', '=', $user->id)
                     //->where('c.user_id', '=', $user->id)
                     ->where('t.id', 'like', $tipoTarea)
                     ->where('trc.estado', 'like', $tareasEstado)
                     ->where('c.id', 'like', $colaborador)
                     ->where('c.estado', '=', 1)
                     ->where('p.id', 'like', $periodoId);
            })
            ->where('c.estado', '=', 1)
            ->orderBy('trc.id','desc')
            //->orderByRaw('trc.id DESC')

            ->Paginate(8);

        }

            $i = 0;
            foreach ($tareasReportesAsignados as $tra) {
               // code...
               //dd($tareasReportesAsignados[$i]->trc_id); 
               $xd[$i]=$tareasReportesAsignados[$i]->trc_id;
               $solicitud[$i] = Solicitud::where('tareareportecolaborador_id','=',$tareasReportesAsignados[$i]->trc_id)->where('estado','=',1)->first();

               if (!empty($solicitud[$i])) {
                  // code...
                  $tareasReportesAsignados[$i]->s_id = $solicitud[$i]->id;
                  $tareasReportesAsignados[$i]->s_fechasolicitadah = $solicitud[$i]->fechasolicitadah;
                  $tareasReportesAsignados[$i]->s_fechasolicitada = $solicitud[$i]->fechasolicitada;
                  $tareasReportesAsignados[$i]->s_fechaasignadah_old = $solicitud[$i]->fechaasignadah_old;
                  $tareasReportesAsignados[$i]->s_fechaasignada_old = $solicitud[$i]->fechaasignada_old;
                  $tareasReportesAsignados[$i]->s_fechaasignadah_new = $solicitud[$i]->fechaasignadah_new;
                  $tareasReportesAsignados[$i]->s_fechaasignada_new = $solicitud[$i]->fechaasignada_new;
                  $tareasReportesAsignados[$i]->s_fundamento = $solicitud[$i]->fundamento;
              // dd($solicitud[$i]->id);
               }else{
                  $tareasReportesAsignados[$i]->s_id = null;
                  $tareasReportesAsignados[$i]->s_fechasolicitadah = null;
                  $tareasReportesAsignados[$i]->s_fechasolicitada = null;
                  $tareasReportesAsignados[$i]->s_fechaasignadah_old = null;
                  $tareasReportesAsignados[$i]->s_fechaasignada_old = null;
                  $tareasReportesAsignados[$i]->s_fechaasignadah_new = null;
                  $tareasReportesAsignados[$i]->s_fechaasignada_new = null;
                  $tareasReportesAsignados[$i]->s_fundamento = null;
               }

                $i++;
            }

  
        $fechahoy = $fecha_hoy->format('Y-m-d');

        $fechamañana = $fecha_hoy->addDay(1)->format('Y-m-d');
        $fechapasmañana = $fecha_hoy->addDay(1)->format('Y-m-d');

        return ['tareasReportesAsignados'=>$tareasReportesAsignados,
                'fecha_hoy'=>$fechahoy,
                'fechas'=>[
                'fechahoy' => $fechahoy,
                'fechamañana' => $fechamañana,
                'fechapasmañana' => $fechapasmañana,
                ],
                
            ];
    }
    

   public function getMailNotificacion(Request $request)
    {
      //dd($request);
      if ($request->estado_trc == 1) {
         $mensajeNotificacion='Es urgente que atienda el reporte ';
         $fechaatencion_trc= '0000-00-00';
         $fechaatencionh_trc = '00:00:00 --';
         $fechavalidacion_trc= '0000-00-00';
         $fechavalidacionh_trc = '00:00:00 --';

      } elseif ($request->estado_trc == 2) {
          $mensajeNotificacion='Falta validar su reporte';

          $fechaatencion= $request->fechaatencion_trc;
          $fechaatencionh = strtotime($fechaatencion);
          $fechaatencionh_trc = date('H:i:s A', $fechaatencionh);
          $fechaatencion_trc = date('Y-m-d', $fechaatencionh);

         $fechavalidacion_trc= '0000-00-00';
         $fechavalidacionh_trc = '00:00:00 --';
          
      } elseif ($request->estado_trc == 3) {
          $mensajeNotificacion='Su reporte esta completo';

          $fechaatencion= $request->fechaatencion_trc;
          $fechaatencionh = strtotime($fechaatencion);
          $fechaatencionh_trc = date('H:i:s A', $fechaatencionh);
          $fechaatencion_trc = date('Y-m-d', $fechaatencionh);
          
          $fechavalidacion= $request->fechavalidacion_trc;
          $fechavalidacionh = strtotime($fechavalidacion);
          $fechavalidacionh_trc = date('H:i:s A', $fechavalidacionh);
          $fechavalidacion_trc = date('Y-m-d', $fechavalidacionh);
      }
      


      $sss= $request->fechacreacion_trc;
      $fechacreacionh_trc = strtotime($sss);

      $datosR = [
         'empresacolabordaor_id' => $request->empresacolabordaor_id,
         'estado_trc'=>$request->estado_trc,
         'tareareporte_id'=>$request->tareareporte_id,
         'tarea_id'=>$request->tarea_id,
         'descripcion_r'=>$request->descripcion_r,
         'nombre_r'=>$request->nombre_r,
         'reporte_id'=>$request->reporte_id,
         'nombre_t'=>$request->nombre_t,
         'descripcion_t'=>$request->descripcion_t,
         'fechalimite'=>$request->fechalimite,
         'fechacreacion_trc'=>date('Y-m-d',$fechacreacionh_trc),
         'fechacreacionh_trc'=>date('H:i:s A', $fechacreacionh_trc),
         'fechavalidacion_trc'=>$fechavalidacion_trc,
         'fechavalidacionh_trc'=>$fechavalidacionh_trc,
         'fechaatencion_trc'=>$fechaatencion_trc,
         'fechaatencionh_trc'=>$fechaatencionh_trc,
         'URL'=>$request->URL,

      ];
      //dd($request->fechacreacion_trc);
      

      //dd($s,date('Y-m-d H:i:s A', $datse));
      //dd(now()->format('H:i:s A'));

      //$horaFormateada = now()->isoFormat('H:mm:ss A');

      //dd($request->request['parameters']);
        
        //$user = Auth::user();
        //$users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

         $colaborador = EmpresaColaborador::with('colaborador.usuario')->where('id','=',$request->empresacolabordaor_id)->first();
         //dd($colaborador);
         //return $colaborador;
         
         //dd($colaborador->colaborador->usuario->email );
         $correoSend = $colaborador->colaborador->usuario->email;

         $date = date('Y-m-d');

        $date = Carbon::now();

        $data = array('colaborador' => $colaborador, 'date' => $date, 'datosR' => $datosR,'mensajeNotificacion' =>$mensajeNotificacion);
        return $data;
       // $data = array('extraordinarios' => $extraordinarios, 'date' => $date);
        $template_path = ('Correo.getMailNotificacion');

         return Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$correoSend) {
               
               // $message->to($data['correoApto'])->subject('Reporte del dia '.date('Y-m-d').'');
                //$message->to($correoApto )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
                $message->to('rer@electropuno.com.pe' )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° ');
               // $message->to('malelementocrozz@gmail.com' )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° ');
                //$message->to('malelementocrozz@gmail.com' )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.-WPEAPP-SRVN');

                  // return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
            });




/*

            $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','=',$request->tipoExtraordinario_id)->first();
           

        

*/
        

        
      
    }


    public function getMailReporte(Request $request){
     // dd('diomioff');
     // dd($request->URL);
      //$prueba= $request->tarea_reportes;
      $prueba= $request;
      $date = Carbon::now();
      $url = $request->URL;
     
   //dd($request);
   $col = $request->tarea_reportes;
   //dd($col);
   $i=0;
   foreach ($col as $colaboradores) {
      // code...
      //$xd = $col->tarea_reporte_colaboradores;
      $xd[$i] = $colaboradores['tarea_reporte_colaboradores']['colaborador']['user_id'];
      $i++;
   }
   $ii=0;
   $usersCorreos = User::whereIn('id',$xd)->distinct()->get();
   //dd($usersCorreos['attributes']);
   foreach ($usersCorreos as $usersCorreo) {
      // code...
      //$xd = $col->tarea_reporte_colaboradores;
      $email[$ii] = $usersCorreo->email;
      $ii++;
   }
   //dd($email);
   //dd($xd);
      //$empresas = TareaReporteColaborador::with('colaborador')->orderBy('created_at', 'desc')->get();
      
      //dd($empresas);
     
      //$data = array('prueba' => $prueba);
      $data = array( 'prueba' => $prueba,'url' => $url, 'date' => $date);

       //return view('Correo.getMailReporte')->with('empresas', $empresas, 'mi_objeto',$mi_objeto);
     //  return view('Correo.getMailReporte')->with('data' ,$data);


        $template_path = ('Correo.getMailReporte');

        //dd('diomio', $data);

        Mail::send(['html'=> $template_path ], $data, function($message) use ($data, $email) {
        //Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$email) {
               
                $message->to('malelementocrozz@gmail.com' )->subject('Notificacion Consolidado - '.$data['prueba']['nombre'].' - '.$data['prueba']['nombrePeriodo']);
               // $message->to($email )->subject('Notificacion Consolidado - '.$data['prueba']['nombre'].' - '.$data['prueba']['nombrePeriodo']);
                //$message->to('rer@electropuno.com.pe' )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
              
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                 
            });

     
     
    }





    public function tareasReportesAsignados(Request $request)
    {
       // dd($request);
       // $comment->created_at->diffForHumans();
       // dd()

        $user = Auth::user();
        $roles ='administrador';
       // dd($user);
        //dd($user->colaborador);
        $userColaborador = $user->colaborador;
        //filtrar mediante la empresacolaborador_id

        //$empresacolaborador = DB::table('elputest.empresacolaborador as trc')
        $empresacolaborador = EmpresaColaborador::where('colaborador_id','=',$user->colaborador->id)->first();

        $fecha_hoy = Carbon::now();

        if ($user->has_role($roles) == true) {

           $tareasReportesAsignados = DB::table('repositorio.tareareportecolaborador as trc')
               ->join('repositorio.tareareporte as tr', 'trc.tareareporte_id', '=', 'tr.id')
               ->join('repositorio.tareas as t', 't.id', '=', 'tr.tarea_id')
               ->join('repositorio.reportes as r', 'r.id', '=', 'tr.reporte_id')
               ->join('elputest.empresacolaborador as ec', 'ec.id', '=', 'trc.empresacolaborador_id')
               ->join('elputest.colaboradores as c', 'c.id', '=', 'ec.colaborador_id')
               ->join('repositorio.periodo as p', 'p.id', '=', 'tr.periodo_id')
               ->join('repositorio.estadoregistro as er', 'er.id', '=', 'trc.estador')
             
               ->select('trc.id as trc_id', 'trc.empresacolaborador_id as trc_empresacolaborador', 'trc.tareareporte_id as trc_tareareporte', 'trc.estado as trc_estado', 'trc.estador as trc_estador', 'trc.fechalimite as trc_fechalimite', 'trc.fechaatencion as trc_fechaatencion', 'trc.fechaatencionh as trc_fechaatencionh','trc.user_id as trc_user_id', 'tr.tarea_id as tr_tarea', 'tr.reporte_id as tr_reporte', 'tr.estadoasignado as tr_estadoasignado', 'tr.estado as tr_estado', 't.nombre as t_nombre', 't.descripcion as t_descripcion', 't.estado as t_estado','t.totalasignado as t_totalasignado','t.totalatendido as t_totalatendido', 'r.nombre as r_nombre', 'r.tipo as r_tipo', 'r.tipoinformacion_id as r_tipoinformacion_id', 'r.estado as r_estado', 'r.oficina_id as r_oficina', 'r.descripcion as r_descripcion','tr.periodo_id as tr_periodo_id','p.nombre as p_nombre','ec.id as ec_id', 'ec.colaborador_id as ec_colaborador_id','trc.fechaasignacionh as trc_fechaasignacionh','trc.fechaasignacion as trc_fechaasignacion', 'er.nombre as er_nombre','c.user_id as c_user_id')
               ->where('trc.estado', '>', 0)
               //->where('trc.user_id', '=', $user->id)
               ->orWhere(function($query) use ($empresacolaborador)  {
                   //$query->where('ec.colaborador_id','=',$empresacolaborador->id)
                  // $query->where('trc.empresacolaborador_id','=',$empresacolaborador->id)
                         $query->where('trc.estado', '>', 0)
                        ->where('c.estado', '=', 1);
               })
               ->where('c.estado', '=', 1)
               ->orderBy('trc.id','desc')


               ->Paginate(8);
           // dd($tareasReportesAsignados);
        }else{

            $tareasReportesAsignados = DB::table('repositorio.tareareportecolaborador as trc')
               ->join('repositorio.tareareporte as tr', 'trc.tareareporte_id', '=', 'tr.id')
               ->join('repositorio.tareas as t', 't.id', '=', 'tr.tarea_id')
               ->join('repositorio.reportes as r', 'r.id', '=', 'tr.reporte_id')
               ->join('elputest.empresacolaborador as ec', 'ec.id', '=', 'trc.empresacolaborador_id')
               ->join('elputest.colaboradores as c', 'c.id', '=', 'ec.colaborador_id')
               ->join('repositorio.periodo as p', 'p.id', '=', 'tr.periodo_id')
               ->join('repositorio.estadoregistro as er', 'er.id', '=', 'trc.estador')
              
                ->select('trc.id as trc_id', 'trc.empresacolaborador_id as trc_empresacolaborador', 'trc.tareareporte_id as trc_tareareporte', 'trc.estado as trc_estado', 'trc.estador as trc_estador', 'trc.fechalimite as trc_fechalimite', 'trc.fechaatencion as trc_fechaatencion', 'trc.fechaatencionh as trc_fechaatencionh','trc.user_id as trc_user_id', 'tr.tarea_id as tr_tarea', 'tr.reporte_id as tr_reporte', 'tr.estadoasignado as tr_estadoasignado', 'tr.estado as tr_estado', 't.nombre as t_nombre', 't.descripcion as t_descripcion', 't.estado as t_estado','t.totalasignado as t_totalasignado','t.totalatendido as t_totalatendido', 'r.nombre as r_nombre', 'r.tipo as r_tipo', 'r.tipoinformacion_id as r_tipoinformacion_id', 'r.estado as r_estado', 'r.oficina_id as r_oficina', 'r.descripcion as r_descripcion','tr.periodo_id as tr_periodo_id','p.nombre as p_nombre','ec.id as ec_id', 'ec.colaborador_id as ec_colaborador_id','trc.fechaasignacionh as trc_fechaasignacionh','trc.fechaasignacion as trc_fechaasignacion', 'er.nombre as er_nombre','c.user_id as c_user_id')
               ->where('trc.estado', '>', 0)
               ->where('trc.user_id', '=', $user->id)
               //->orWhere('ec.colaborador_id','=',$empresacolaborador->id)
               ->orWhere(function($query) use ($empresacolaborador)  {
                   //$query->where('ec.colaborador_id','=',$empresacolaborador->id)
                   $query->where('trc.empresacolaborador_id','=',$empresacolaborador->id)
                         ->where('trc.estado', '>', 0)
                        ->where('c.estado', '=', 1);
               })
               ->where('c.estado', '=', 1)
               ->orderBy('trc.id','desc')


               ->Paginate(8);

        }

            $i = 0;
            foreach ($tareasReportesAsignados as $tra) {
               // code...
               //dd($tareasReportesAsignados[$i]->trc_id); 
               $xd[$i]=$tareasReportesAsignados[$i]->trc_id;
               $solicitud[$i] = Solicitud::where('tareareportecolaborador_id','=',$tareasReportesAsignados[$i]->trc_id)->where('estado','=',1)->first();

               if (!empty($solicitud[$i])) {
                  // code...
                  $tareasReportesAsignados[$i]->s_id = $solicitud[$i]->id;
                  $tareasReportesAsignados[$i]->s_fechasolicitadah = $solicitud[$i]->fechasolicitadah;
                  $tareasReportesAsignados[$i]->s_fechasolicitada = $solicitud[$i]->fechasolicitada;
                  $tareasReportesAsignados[$i]->s_fechaasignadah_old = $solicitud[$i]->fechaasignadah_old;
                  $tareasReportesAsignados[$i]->s_fechaasignada_old = $solicitud[$i]->fechaasignada_old;
                  $tareasReportesAsignados[$i]->s_fechaasignadah_new = $solicitud[$i]->fechaasignadah_new;
                  $tareasReportesAsignados[$i]->s_fechaasignada_new = $solicitud[$i]->fechaasignada_new;
                  $tareasReportesAsignados[$i]->s_fundamento = $solicitud[$i]->fundamento;
              // dd($solicitud[$i]->id);
               }else{
                  $tareasReportesAsignados[$i]->s_id = null;
                  $tareasReportesAsignados[$i]->s_fechasolicitadah = null;
                  $tareasReportesAsignados[$i]->s_fechasolicitada = null;
                  $tareasReportesAsignados[$i]->s_fechaasignadah_old = null;
                  $tareasReportesAsignados[$i]->s_fechaasignada_old = null;
                  $tareasReportesAsignados[$i]->s_fechaasignadah_new = null;
                  $tareasReportesAsignados[$i]->s_fechaasignada_new = null;
                  $tareasReportesAsignados[$i]->s_fundamento = null;
               }

                $i++;
            }
                //dd($xd,$solicitud,$tareasReportesAsignados);
              //  dd($tareasReportesAsignados);
     
        
        $fechahoy = $fecha_hoy->format('Y-m-d');

        $fechamañana = $fecha_hoy->addDay(1)->format('Y-m-d');
        $fechapasmañana = $fecha_hoy->addDay(1)->format('Y-m-d');
       // dd($fechahoy, $fechamañana,$fechapasmañana );
        //dd($tareasReportesAsignados);

//dd($tareasReportesAsignados);
       // return $user;

       // $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();
       // $sedeIds = $users->sedes;

         //$tareas = Tarea::orderBy('created_at','desc')->get();
        
        //$tareas= Tarea::orderBy('created_at','desc')->Paginate(10);
        //$orientaciones = Orientacion::with('desOrientacion')->where('id','1')->orderBy('created_at','desc')->get();
        //return $tareasReportesAsignados;
        return ['tareasReportesAsignados'=>$tareasReportesAsignados,
                'fecha_hoy'=>$fechahoy,
                'fechas'=>[
                'fechahoy' => $fechahoy,
                'fechamañana' => $fechamañana,
                'fechapasmañana' => $fechapasmañana,
                ],
                'userColaborador' => $userColaborador,
                
            ];
    }

     public function estadoTareas(Request $request)
    {
      //dd($request);
        
      $user = Auth::user();
      $roles ='administrador';
      $userColaborador = $user->colaborador;
      $periodos = Periodo::where('id','=',$request->periodoId)->first();

      if ($user->has_role($roles) == true) {

         $tareas = DB::table('repositorio.tareas as t')
           ->join('repositorio.tareaperiodo as tp', 'tp.tarea_id', '=', 't.id')
           ->select('t.*','tp.totalasignado as tp_totalasignado', 'tp.totalatendido as tp_totalatendido')
           ->where('tp.periodo_id','=',$request->periodoId)
           ->where('tp.estado','=',1)
           ->where('t.estado','=',1)
           //->where('t.user_id','=',$user->id)
           ->orderBy('t.created_at','desc')
           //->get();
           ->Paginate(4);

      } else{

         $tareas = DB::table('repositorio.tareas as t')
           ->join('repositorio.tareaperiodo as tp', 'tp.tarea_id', '=', 't.id')
           ->select('t.*','tp.totalasignado as tp_totalasignado', 'tp.totalatendido as tp_totalatendido')
           ->where('tp.periodo_id','=',$request->periodoId)
           ->where('tp.estado','=',1)
           ->where('t.estado','=',1)
           ->where('t.user_id','=',$user->id)
           ->orderBy('t.created_at','desc')
           //->get();
           ->Paginate(4);

      }




   $i = 0;
     //foreach ($correos as $correo) {
     foreach ($tareas as $tarea) {
         
         $tareaReporte[$i] = TareaReporte::with('reportes','tareaReporteColaboradores.documentos','tareaReporteColaboradores.colaborador')->where('estadoasignado','=','1')->where('periodo_id','=',$request->periodoId)->where('tarea_id','=',$tareas[$i]->id)->get();
        $tareas[$i]->tarea_reportes = $tareaReporte[$i];
      $tareas[$i]->nombrePeriodo = $periodos->nombre;
        //$tareas[$i]->xd = $tareareportecolaborador[$i];
         $i++;
     }


        return $tareas;



       // return $correoApto;
    }

    public function regTarea(Request $request){
      //dd('listo para crear una tarea', $request->nombre,$request);

      //$estador = ($request->estador == null) ? 0 : $request->estador ;
      //dd($request->estador);
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

      $tareas = new Tarea;
      $tareas->nombre = $request->nombre;
      $tareas->descripcion = $request->descripcion;
      $tareas->estador = $estador;
      $tareas->user_id = $users->id;
      $tareas->save();

      return $tareas;
    }

   public function editRegTarea(Request $request, $id){
      //dd('dentro de la funcion:', $tareas, $id, $request);
      //dd($request->params['descripcion']);

      $tareas = Tarea::find($id);
      $tareas->descripcion = $request->params['descripcion'];
      $tareas->nombre = $request->params['nombre'];
      $tareas->estador = $request->params['estador'];
      $tareas->save();

      return $tareas;
   }


   public function deleteTareas(Request $request, $id){
      //dd('dentro de la funcion:', $id, $request);

      $tareaPeriodo = TareaPeriodo::where('tarea_id','=',$id)->where('estado','=',1)->first();
      $tareaReporte = TareaReporte::where('tarea_id','=',$id)->where('estado','=',1)->first();

      if (!empty($tareaPeriodo || $tareaReporte)) {
         // code...
         //dd('con datos');
         return Response::json([
                  'Tiene un reporte Asignado y habilitado!'
              ], 409);
      }else{
         //dd('limpio');
         $tareas = Tarea::find($id);
         $tareas->delete();

         return $tareas;
      }
//dd('prueba',empty($tareaPeriodo),empty($tareaReporte),$tareaPeriodo,$tareaReporte);
      //dd($tareaPeriodo,$tareaReporte);
      
      ////$tareas = Tarea::destroy($id);
      
   }

   public function getNotification(Request $request){
      //dd('datos 3:',$request,'datos:',$request->trc,'datos2:',$request->trc['empresacolaborador_id']);
//dd('prueba',$request);
      //$c = Colaborador::find()

      $t = $request->t;
      $tp = $request->tp;
      $tr = $request->tr;
      $trc = $request->trc;
      $url = $request->URL;

     // $coll=(object)collect($trc)->reject(function($item){
     //     // do something
     // })->all();


      //dd('t',$t,'tp',$tp,'tr',$tr,'trc',$trc,'coll',$coll);

      $c = Colaborador::with('usuario')->where('id','=',$trc['empresacolaborador_id'])->where('estado', 1)->first();
      $r = Reporte::where('id','=',$tr['reporte_id'])->first();
      $email= $c->usuario->email;
      //return $email;

      $date = Carbon::now();

        $data = array('t' => $t,'tp' => $tp,'tr' => $tr,'trc' => $trc,'r' => $r,'c' => $c, 'url' => $url, 'date' => $date);
        $template_path = ('Correo.getNotification');

        

        Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$email) {
               
               // $message->to($data['correoApto'])->subject('Reporte del dia '.date('Y-m-d').'');
               // $message->to($correoApto )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
                $message->to('malelementocrozz@gmail.com' )->subject('Notificacion - Reporte Asignado N° '.$data['trc']['id'].' - '.date('Y-m-d'));
                //$message->to($email )->subject('Notificacion del dia '.date('Y-m-d').'...con registro N° ');
                //$message->to('rer@electropuno.com.pe' )->subject('Notificacion del dia '.date('Y-m-d').'...con registro N° ');
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                  // return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
            });


   }


   public function getSolicitudNotification(Request $request){
      //dd('datos 3:',$request,'datos:',$request->trc,'datos2:',$request->trc['empresacolaborador_id']);
      //dd('prueba',$request);
      //$c = Colaborador::find()

      //$t = $request->t;
      //$tp = $request->tp;

      $solicitudes = $request->solicitudes;
      $trc_old = $request->trc_old;
      $url = $request->URL;

     // $coll=(object)collect($trc)->reject(function($item){
     //     // do something
     // })->all();


      //dd('t',$t,'tp',$tp,'tr',$tr,'trc',$trc,'coll',$coll);

      $c = Colaborador::with('usuario')->where('id','=',$trc_old['empresacolaborador_id'])->where('estado', 1)->first();
      $email= $c->usuario->email;

      //$r = Reporte::where('id','=',$tr['reporte_id'])->first();
      $tr = TareaReporte::with('tareas','reportes')->where('id','=',$trc_old['tareareporte_id'])->first();
      $p = Periodo::where('id','=',$trc_old['periodo_id'])->first();
      //dd($trc_old['periodo_id']);
      //dd('p',$p);

      $date = Carbon::now();

        $data = array('tr' => $tr,'trc_old' => $trc_old,'c' => $c,'solicitudes' => $solicitudes,'p' => $p, 'url' => $url, 'date' => $date);

        //dd('diomio', $data);
        $template_path = ('Correo.getSolicitudNotification');

        Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$email) {
               
                //$message->to($email )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
                $message->to('malelementocrozz@gmail.com' )->subject('Solicitud de Ampliacion- Solicitud N° '.$data['solicitudes']['id'].' - '.date('Y-m-d'));
                //$message->to('rer@electropuno.com.pe' )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
              
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                 
            });


   }


   public function getCancelarSolicitudNotification(Request $request){
      //dd('datos 3:',$request,'datos:',$request->trc,'datos2:',$request->trc['empresacolaborador_id']);
      //dd('prueba',$request);
      //$c = Colaborador::find()

      //$t = $request->t;
      //$tp = $request->tp;

      $solicitudes = $request->solicitudes;
      $trc_old = $request->trc_old;
      $url = $request->URL;

     // $coll=(object)collect($trc)->reject(function($item){
     //     // do something
     // })->all();


      //dd('t',$t,'tp',$tp,'tr',$tr,'trc',$trc,'coll',$coll);

      $c = Colaborador::with('usuario')->where('id','=',$trc_old['empresacolaborador_id'])->where('estado', 1)->first();
      $email= $c->usuario->email;

      //$r = Reporte::where('id','=',$tr['reporte_id'])->first();
      $tr = TareaReporte::with('tareas','reportes')->where('id','=',$trc_old['tareareporte_id'])->first();
      $p = Periodo::where('id','=',$trc_old['periodo_id'])->first();
      //dd($trc_old['periodo_id']);
      //dd('p',$p);

      $date = Carbon::now();

        $data = array('tr' => $tr,'trc_old' => $trc_old,'c' => $c,'solicitudes' => $solicitudes,'p' => $p, 'url' => $url, 'date' => $date);

        //dd('diomio', $data);
        $template_path = ('Correo.getCancelarSolicitudNotification');

        Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$email) {
               
                //$message->to($email )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
                $message->to('malelementocrozz@gmail.com' )->subject('Cancelado - Solicitud de Ampliacion - Solicitud N° '.$data['solicitudes']['id'].' - '.date('Y-m-d'));
                //$message->to('rer@electropuno.com.pe' )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
              
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                 
            });


   }


   public function getDerivarNotification(Request $request){
      //dd('datos 3:',$request,'datos:',$request->trc,'datos2:',$request->trc['empresacolaborador_id']);
      //dd('prueba',$request);
      //$c = Colaborador::find()

      //$t = $request->t;
      //$tp = $request->tp;

      $trc = $request->trc;
      $old_trc = $request->old_trc;
      $derivados = $request->derivados;
      $url = $request->URL;

     // $coll=(object)collect($trc)->reject(function($item){
     //     // do something
     // })->all();


      //dd('t',$t,'tp',$tp,'tr',$tr,'trc',$trc,'coll',$coll);

      $c = Colaborador::with('usuario')->where('id','=',$trc['empresacolaborador_id'])->where('estado', 1)->first();
      $ca = Colaborador::with('usuario')->where('id','=',$old_trc['empresacolaborador_id'])->where('estado', 1)->first();
      $email= $c->usuario->email;

      //$r = Reporte::where('id','=',$tr['reporte_id'])->first();
      $tr = TareaReporte::with('tareas','reportes')->where('id','=',$trc['tareareporte_id'])->first();
      $p = Periodo::where('id','=',$trc['periodo_id'])->first();
      $usuarioA = User::with('colaborador')->where('id','=',$old_trc['user_id'])->first();
      $usuarioD = User::with('colaborador')->where('id','=',$derivados['user_id'])->first();
      //dd($trc_old['periodo_id']);
      //dd('p',$p);

      $date = Carbon::now();

      $data = array('trc' => $trc,'old_trc' => $old_trc,'c' => $c,'derivados' => $derivados,'p' => $p,'tr' => $tr, 'url' => $url,'usuarioA' => $usuarioA,'ca' => $ca,'usuarioD' => $usuarioD, 'date' => $date);

        //dd('diomio', $data);
        $template_path = ('Correo.getDerivarNotification');

        Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$email) {
               
                //$message->to($email )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
                $message->to('malelementocrozz@gmail.com' )->subject('Derivado - Reporte Asignado N° '.$data['trc']['id'].' - '.date('Y-m-d'));
                //$message->to('rer@electropuno.com.pe' )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
              
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                 
            });


   }

   public function getMailEjecutado(Request $request){
      //dd('prueba',$request);

      $message = $request->message;
      $d = $request->documento;
      $t = $request->tarea;
      //$trc = $request->tareareportecolaborador;
      $tp = $request->tareaperiodo;

      $url = $request->URL;

      $c = Colaborador::with('usuario')->where('id','=',$t['user_id'])->where('estado', 1)->first();
      $email= $c->usuario->email;

      //$r = Reporte::where('id','=',$tr['reporte_id'])->first();
      //$tr = TareaReporte::with('tareas','reportes')->where('id','=',$trc['tareareporte_id'])->first();
      $tr = TareaReporte::with('reportes','tareaReporteColaboradores')->where('tarea_id','=',$tp['tarea_id'])->where('periodo_id','=',$tp['periodo_id'])->where('estado','>',0)->get();
      $p = Periodo::where('id','=',$tp['periodo_id'])->first();
      //$usuarioA = User::with('colaborador')->where('id','=',$old_trc['user_id'])->first();
      //$usuarioD = User::with('colaborador')->where('id','=',$derivados['user_id'])->first();
      //dd($trc_old['periodo_id']);
      //dd($tr);

      


      $date = Carbon::now();

      $data = array('tr' => $tr,'p' => $p,'c' => $c,'t' => $t,'message' => $message, 'url' => $url, 'date' => $date);
      //dd($data);

        //dd('diomio', $data);
        $template_path = ('Correo.getMailEjecutado');

        Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$email) {
               
                //$message->to($email )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
                $message->to('malelementocrozz@gmail.com' )->subject('Tarea Finalizada '.$data['t']['nombre']);
                //$message->to('rer@electropuno.com.pe' )->subject('Solicitud Ampliacion - Solicitud N° '.''.$solicitudes['id'].''.date('Y-m-d'));
              
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                 
            });


   }

     


}
