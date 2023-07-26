<?php

namespace App\Http\Controllers;

use App\Models\Atencion;
use Illuminate\Http\Request;

use App\Models\Extraordinario;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $atencion = Atencion::all();
        return $atencion;
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
       // dd($request);
        
        $user = Auth::user();
        $fecha_registro = Carbon::now();

        $atencion = new Atencion();

        $atencion->user_id = $user->id;
        $atencion->tipoAtencion_id = $request->tipoAtencion_id;
        $atencion->fechaRegistro = $fecha_registro;
        $atencion->dni = $request->dni;
        $atencion->observacion = $request->observacion;
        $atencion->save();

        return $atencion;

    }

    public function Chartjs(){
        $user = Auth::user();
        //dd(date('l'));
        $date = Carbon::now();
        //$fecha_inicio = Carbon::now();
        $fecha_inicio = '2022-12-31';
        $fecha_final = date("Y-m-d",strtotime($fecha_inicio."-  10 day"));
        //$fecha_final = Carbon::now()->subDays(9);
        //$fecha_inicio = Carbon::now();

       /* $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();
  
        $students = User::select("*")
                        ->whereBetween('created_at', [$startDate, $endDate])
                        ->get();*/
        //dd($fecha_registro);

        $resultadosSem = DB::table('extraordinarios')
        //->select('count(extraordinarios.users_id) as conteo')
        ->select(DB::raw('count(extraordinarios.users_id) as conteo, tipoextraordinario.nombreTipoExt'))
        //->select(DB::raw('tipoextraordinario.nombreTipoExt,count(extraordinarios.users_id) as conteo'))
        ->join('tipoextraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'tipoextraordinario.id')
        ->groupBy('tipoextraordinario.nombreTipoExt')
        //->where('extraordinarios.users_id',$user->id)
        ->where('extraordinarios.users_id',5)
        ->whereBetween('extraordinarios.created_at', [$fecha_final, $fecha_inicio])
        //->whereBetween('created_at', [$startDate, $endDate])
      //  ->whereDate('extraordinarios.created_at', Carbon::today())
        ->get();  
       // dd($resultadosSem);
        $iii = 0;
        // dd($months);
      
        foreach ($resultadosSem as $resultadoSem) {
    
            $resultadosBS[$iii]=$resultadoSem->conteo;
            $resultadosUsuarioS[$iii]=$resultadoSem->nombreTipoExt;
       
            $iii++;
        }

        //dd('pruebas', $resultadosSem);



        $usuarios = DB::table('extraordinarios')
            ->select('users.name')

            ->join('users', 'extraordinarios.users_id', '=', 'users.id')
            ->distinct()
            //->where('extraordinarios.created_at','=',$fecha_registro)
           // ->whereDate('extraordinarios.created_at', Carbon::today())
            //->where('users.id',$user->id)
            
            ->get();

         $i = 0;
        // dd($months);
        foreach ($usuarios as $usuario) {
 
            $usuariosB[$i]=$usuario->name;
            //return $xd;
            $i++;
        }

/*select t.nombreTipoExt,count(e.users_id) as conteo 
from extraordinarios e

inner join tipoextraordinario t
on e.obsTipoExtraordinario_id=t.id

where e.users_id=1 
group by e.users_id,t.nombreTipoExt;*/

        $resultados2 = DB::table('extraordinarios')
        //->select('count(extraordinarios.users_id) as conteo')
        ->select(DB::raw('count(extraordinarios.users_id) as conteo, tipoextraordinario.nombreTipoExt'))
        //->select(DB::raw('tipoextraordinario.nombreTipoExt,count(extraordinarios.users_id) as conteo'))
        ->join('tipoextraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'tipoextraordinario.id')
        ->groupBy('tipoextraordinario.nombreTipoExt')
        ->where('extraordinarios.users_id',$user->id)
      //  ->whereDate('extraordinarios.created_at', Carbon::today())
        ->get();        
        //cantidad de registros

        $resultados = DB::table('extraordinarios')
        //->select('count(extraordinarios.users_id) as conteo')
        ->select(DB::raw('count(extraordinarios.users_id) as conteo, tipoextraordinario.nombreTipoExt'))
        //->select(DB::raw('tipoextraordinario.nombreTipoExt,count(extraordinarios.users_id) as conteo'))
        ->join('tipoextraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'tipoextraordinario.id')
        ->groupBy('tipoextraordinario.nombreTipoExt')
        //->where('extraordinarios.users_id',$user->id)
        //->whereRaw('extraordinarios.created_at', '=', $date->month)
        //->whereDate('extraordinarios.created_at', '=', Carbon::now()->month)
        ->whereMonth('extraordinarios.created_at', '=', Carbon::now()->month)
      //  ->whereDate('extraordinarios.created_at', Carbon::today())
        ->get();  

        $resultados3 = DB::table('extraordinarios')
        ->select(DB::raw('extraordinarios.created_at'))

        ->whereMonth('extraordinarios.created_at', '=', Carbon::now()->month)
        ->distinct()
        ->get(); 
/*
SELECT MONTH( created_at ) AS mes,
STATUS , COUNT( * ) AS total
FROM  `pedidos`
GROUP BY mes, status*/

        $resultados4 = DB::table('extraordinarios')
        //->select(DB::raw('extraordinarios.created_at'))
        ->selectRaw('date(created_at) day, users_id')
        
        ->whereMonth('created_at', '=', Carbon::now()->month)
        ->distinct()
        ->groupBy('users_id','day')
        ->get();  
       // User::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();

        $gg = 0;
        foreach ($resultados4 as $ff) {
    
            $yuy[$gg]=$ff->day;
       
            $gg++;
        }


/*
$diomio = DB::table('extraordinarios')
        ->select(DB::raw('users.id, DATE(extraordinarios.created_at) as fechareg'))
        //->selectRaw('u.id, DATE(e.created_at) as fechareg')

        ->rightJoin('users', 'extraordinarios.users_id', '=', 'users.id')
        
        ->whereMonth('created_at', '=', Carbon::now()->month)
        //->distinct()
        ->groupBy('users.id','fechareg')
        ->get(); */

        $diomio2 = DB::select('select u.id, DATE(e.created_at) as fechareg, count(e.id) as cantidad from extraordinarios e right join users u on e.users_id=u.id where u.id=4

group by u.id,fechareg');

        $diomio = DB::select('SELECT 
     users_id as usuario, DATE(created_at) as fechareg,count(users_id) as cantidad
FROM
    extraordinarios
WHERE users_id in (4)
    
GROUP BY 
    usuario ,fechareg
');
         $diomio3 = DB::select('SELECT 
     users_id as usuario, DATE(created_at) as fechareg,count(users_id) as cantidad
FROM
    extraordinarios
WHERE users_id in (4)
    
GROUP BY 
    usuario ,fechareg
');
$sdd = 0;
foreach ($diomio3 as $resultado) {
    
        
                $cantidadff[$sdd]=$resultado->cantidad;
                $cantidadff[$sdd]=$resultado->cantidad;
                $fechaff[$sdd]=$resultado->fechareg;
         
                     $unio2[$sdd]=['x'=>$fechaff[$sdd],'y'=>$cantidadff[$sdd]];
                     $sdd++;

                 }
         $sd = 0;
        foreach ($diomio as $resultado) {
    
           // $usuariof[$sd]=$resultado->id;
            //$fechaf[$sd]=$resultado->fechareg;
            //$cantidadf[$sd]=$resultado->cantidad;
            
                $cantidadf[$sd]=$resultado->cantidad;
                $cantidad[$sd]=$resultado->cantidad;
                $fechaf[$sd]=$resultado->fechareg;
                
//$unio;
               /* if (!empty($resultado->usuario)) {
                    //$unio=['label'=>$resultado->usuario,'data'=>$cantidad];
                    $unio[$sd]=['x'=>$fechaf[$sd],'y'=>$cantidad[$sd]];
                } */

                    // $unio2[$sd]=['x'=>$fechaf[$sd],'y'=>$cantidad[$sd]];
                if (!empty($resultado->usuario)) {
                    //$unio=['label'=>$resultado->usuario,'data'=>$cantidad];
                     $unio3[$sd]=['x'=>$fechaf[$sd],'y'=>$cantidad[$sd]];
                     $unio=['x'=>$fechaf[$sd],'y'=>$cantidad[$sd]];
                        $us[$resultado->usuario][]=$unio;

                        $usur[]=$resultado->usuario;
                }

              /*  switch ($resultado->usuario) {
                    case '1':

                        $unio=['x'=>$fechaf[$sd],'y'=>$cantidad[$sd]];
                        $us[$sd]=$unio;
                        break;

                    case '2':
                        $unio=['x'=>$fechaf[$sd],'y'=>$cantidad[$sd]];
                        $us[$sd]=$unio;
                        break;
                    case '4':
                        $unio=['x'=>$fechaf[$sd],'y'=>$cantidad[$sd]];
                        $us[$sd]=$unio;
                        break;
                    
                    default:
                        $unio=['x'=>$fechaf[$sd],'y'=>$cantidad[$sd]];
                        $us[$sd]=$unio;
                        break;
                }*/
                
            
            $sd++;
       
        }
        

       // $puedeser=(['label'=>json_encode($fechaf),'data'=>json_encode($unio)]);
        $puedeser=['label'=>$usur,'data'=>$unio3];
       // dd($puedeser);
//dd($us);
//dd(json_encode($unio),json_encode($fechaf));
//dd(['labels'=>json_encode($fechaf),'datasets'=>json_encode($unio)]);

//dd($diomio);
//dd($resultados2);
//dd($date->monthName);
//dd($date->dayName);
        //dd($resultados);

        $ii = 0;
        foreach ($resultados as $resultado) {
    
            $resultadosB[$ii]=$resultado->conteo;
            $resultadosUsuario[$ii]=$resultado->nombreTipoExt;
       
            $ii++;
        }

        if (empty($resultadosUsuario)) {
            return ['month' => [$user->name], 'data' => ['0'], 'datac' => ['0']];
        } else{

            return ['month' => $usuariosB, 'data' => $resultadosB, 'datac' => $resultadosUsuario, 'dataS' => $resultadosBS, 'datacS' => $resultadosUsuarioS, 'dias'=> $yuy,'fechaf'=>$fechaf,'usuariof'=>'4','cantidadf'=>$cantidadf,'puedeser'=>$puedeser,'unio'=>$unio2,'us'=>$us];
        }


      }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function show(Atencion $atencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function edit(Atencion $atencion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atencion $atencion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atencion $atencion)
    {
        //
    }
}
