<?php

namespace App\Http\Controllers;

use App\Models\Extraordinario;
use App\Models\Suministro;
use App\Models\TipoExtraordinario;
use App\Models\ObsTipoExtraordinario;
use App\Persona;
use App\User;
use App\Models\PersonaExtraordinario;
use App\Models\EstadoExtraordinario;
use App\Models\Correo;
use App\Models\Sede;
use App\Models\AtencionDerivarRegistro;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Builder;

//use App\Exports\ExtraordinariesExport;
//use App\Exports\ExtraordinaryExport;
use App\Exports\ExtraordinariosExport;
use App\Http\Requests\Extraordinario\StoreRequest;
use App\Http\Requests\Extraordinario\UpdateRequest;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

use Redirect;
use PDF;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

//
//use Dompdf\Dompdf;
//use Dompdf\Options;


use Illuminate\Http\Request;
Use Mail;

class ExtraordinarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Extraordinario $extraordinario, Request $request)
    {
       

        $user = Auth::user();
        $roles ='administrador';
       // return $user;

        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();
        //dd($users->roles);

         $sedeIds = $users->sedes;

        $i = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$i]=$sedeId->id;
       
            $i++;
        }       

        if ($user->has_role($roles) == true) {
            $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.relacion','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user, $userSede)  {
                        //$query->where('sede_id','=', $user->sede_id);
                        //$query->whereIn('sede_id', $userSede);
                        //$query->whereIn('sede_id', [2,3]);
                    })->orderBy('created_at','DESC')->Paginate(10);

        }else{
           $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','personaExtraordinario.relacion','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user, $userSede)  {
                        //$query->where('sede_id','=', $user->sede_id);
                        $query->whereIn('sede_id', $userSede);
                        //$query->whereIn('sede_id', [2,3]);
                    })->orderBy('created_at','DESC')->Paginate(10);

        }

        

       /* $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })->orderBy('created_at','DESC')->Paginate(10);*/


        return $extraordinarios;
        //return view('theme.backoffice.extraordinary.index',compact('extraordinary'));
    }


    public function serviceExtraordinario(Extraordinario $extraordinario, Request $request)
    {
      // dd('diomio');

        $user = Auth::user();
       // dd($user->id);
       // return $user;

        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

        $sedeIds = $users->sedes;

       // dd($sedeIds);
      //  return $sedeIds;
        //return $sedeIds[0]->id;


        $i = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$i]=$sedeId->id;
       
            $i++;
        }

  
        $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user, $userSede)  {
                        //$query->where('sede_id','=', $user->sede_id);
                        $query->where('estado','>=', '2');
                        $query->where('estadot','=', '1');
                        $query->whereIn('sede_id', $userSede);
                        //$query->whereIn('sede_id', [2,3]);
                    })->orderBy('created_at','DESC')->Paginate(20);

       /* $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })->orderBy('created_at','DESC')->Paginate(10);*/


        return $extraordinarios;
        //return view('theme.backoffice.extraordinary.index',compact('extraordinary'));
    }


    public function serviceExtraordinarioMasivo(Extraordinario $extraordinario, Request $request)
    {
       //dd('diomio');
        //dd($request->tipoBusqueda);
        //dd($request);
        $tipoBusqueda= $request->tipoBusqueda;
       switch ($tipoBusqueda) {
           case '1':
               // code...
            $tipoBusqueda=[1];
               break;
        case '2':
               // code...
            $tipoBusqueda=[2];
               break;
        case '3':
            $tipoBusqueda=([1,2]);
               break;
           default:
               // code...
            $tipoBusqueda=([1,2]);
               break;
       }
//dd($tipoBusqueda);
 
        //dd($tipoBusqueda);
        $user = Auth::user();
       // dd($user->id);
       // return $user;

        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

        $sedeIds = $users->sedes;

       // dd($sedeIds);
      //  return $sedeIds;
        //return $sedeIds[0]->id;


        $i = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$i]=$sedeId->id;
       
            $i++;
        }

  
        $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user, $userSede)  {
                        //$query->where('sede_id','=', $user->sede_id);
                        $query->where('estado', 2);
                        $query->where('estadot', 1);
                        $query->whereIn('sede_id', $userSede);
                        //$query->whereIn('sede_id', [2,3]);
                    })
                    ->whereHas('obsTipoExtraordinario', function($query) use ($tipoBusqueda)  {
                       // $query->where('tipoExtraordinario_id','=', $tipoBusqueda);
                        $query->whereIn('tipoExtraordinario_id', $tipoBusqueda);
                        //$query->where('tipoExtraordinario_id', 1);
                        
                        //$query->whereIn('sede_id', [2,3]);
                    })
                    ->orderBy('created_at','DESC')->Paginate(10);

       /* $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })->orderBy('created_at','DESC')->Paginate(10);*/


        return $extraordinarios;
        //return view('theme.backoffice.extraordinary.index',compact('extraordinary'));
    }

   


   


    public function extraordinarioBuscar(Request $request)
    {
       // dd("dentro del conrtoller-search");
       //dd($request);

        $user = Auth::user();

        $tipoBusqueda = $request->tipoSearch;
      

        switch ($tipoBusqueda) {
            case 'Documento':
               
/*
                $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('personaExtraordinario.persona', function($query) use ($request)  {
                        $query->where('dni','=', $request->search);
                    })->Paginate(10);
                */
                    

                $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','personaExtraordinario.relacion','estadoExtraordinario')
                   /* ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })*/
                    ->whereHas('personaExtraordinario.persona', function($query) use ($request)  {
                        $query->where('dni','=', $request->search);
                    })
                    
                    ->Paginate(10);



            break;
            case 'Nombres':
                

                $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','personaExtraordinario.relacion','estadoExtraordinario')
                    /*->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })*/
                    ->whereHas('personaExtraordinario.persona', function($query) use ($request)  {
                        $query->where('nombres', 'like', '%'.$request->search.'%');
                    })
                    ->Paginate(10);

            break;

            case 'CodigoRutaSuministro':
              

                $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','personaExtraordinario.relacion','estadoExtraordinario')
                    /*->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })*/
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where('CodigoRutaSuministro', '=', $request->search);
                    })->Paginate(10);

            break;
            case 'CodigoSuministro':
              /*  $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where([
                    ['suministro_id', '=', $request->search],
                ])->Paginate(10);
*/
                $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','personaExtraordinario.relacion','estadoExtraordinario')
                    /*->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })*/
                    ->where([
                    ['suministro_id', '=', $request->search],
                ])->Paginate(10);

            break;
            
            default:
                

                $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','personaExtraordinario.relacion','estadoExtraordinario')
                    /*->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })*/
                    ->whereHas('personaExtraordinario.persona', function($query) use ($request)  {
                        $query->where('dni','=', $request->search);
                    })->Paginate(10);
                break;
        }

     
        return $extraordinarios;
      
    }



    public function buscar(Extraordinario $extraordinario, Request $request)
    {
       
         $extraordinario=Extraordinario::name($request->get('nombre'))->filtro($request->get('filtro'))->filtro2($request->get('filtro2'))->filtro3($request->get('filtro3'))->orderBy('created_at', 'desc')->paginate(10);
         if($request->ajax()){
            
            return response()->json(view('theme.backoffice.extraordinary.extraordinaryajax',compact('extraordinary'))->render());
        }
         
        //return view('extraordinario.index',compact('extraordinario'));

        return view('theme.backoffice.extraordinary.buscar',compact('extraordinary'));
    }

   




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $typeExtraordinaries=TypeExtraordinary::pluck('description','id');
      
            return view('theme.backoffice.extraordinary.create',compact('typeExtraordinaries'));
    

         
    }

        public function createe($id, Extraordinario $extraordinario, ObsTypeExtraordinary $obsTypeExtraordinary)
    {


        // $extraordinario = Extraordinario::find($id);
         //$tipoextraordinario=TipoExtraordinario::pluck('descripcion','id');
         //return view('extraordinario.createe',compact('extraordinario','tipoextraordinario'));
$extraordinario = Extraordinario::find($id);
$typeExtraordinaries=TypeExtraordinary::pluck('description','id');
        return view('theme.backoffice.extraordinary.createe',[
            'extraordinary' => $extraordinary,
            'obsTypeExtraordinary' => $obsTypeExtraordinary,
            'typeExtraordinaries' => $typeExtraordinaries,

         ]);

       //  $extraordinary = Extraordinary::find($id);
      //  $typeExtraordinaries=TypeExtraordinary::pluck('description','id');
       // return view('theme.backoffice.extraordinary.createe',compact('extraordinary','typeExtraordinaries'));

    }


    public function getobstipoex(Request $request,$id)
    {
        
        if($request->ajax()){
            $obsTypeExtraordinary=ObsTypeExtraordinary::Obstypeextraordinary($id);
            return response()->json($obsTypeExtraordinary);
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_old(StoreRequest $request,Extraordinario $extraordinario)
    {
       // dd($request);
///$role = $role->store($request);
      $extraordinario=  Extraordinario::create($request->all());
    alert('Exito','Solicitud registrado con exito','success');
        
        //Extraordinario::create($request->all());
      /* Session::flash('message','solicitante Creado Correctaente');
        return Redirect::to('/extraordinario');*/
       // return redirect()->route('backoffice.extraordinary.show', $request->id);
       
        //return redirect()->action('ExtraordinaryController@show', [$request->id]);

        return redirect()->route('backoffice.extraordinary.show',$extraordinario);
        
        //return redirect()->route('backoffice.permission.show',$permission);
        
    
    }

    public function store(StoreRequest $request,Extraordinario $extraordinario){
    //public function store (Request $request,Extraordinario $extraordinario){
        //dd('holis',$request);
      //  dd(date('Y-m-d')+15);
       /* $date = date("d-m-Y"+1);
        $mod_date = strtotime($date."+ 2 days");
        dd($date);*/
        //dd($request);


        $fecha_inicio = Carbon::now();
        $fecha_inicioR = Carbon::now();

        $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+  1 day"));

      
        //dd($fecha_final);

        $user = Auth::user();

        $personas = Persona::where('dni', $request->personaDni)->first();
        $persona_idR= $personas->id;

        //dd($user->id);
       // $extraordinarioB = Extraordinario::where('suministro_id', $request->suministroCodigoSuministro)->first();

        $extraordinarioB = Extraordinario::where([
                    ['suministro_id', '=', $request->suministroCodigoSuministro],
                    ['created_at', '=',$fecha_inicio ]
                ])->first();

        if (!empty($extraordinarioB->id)) {
           return response(array(
                'message' => 'Existe un registro dentro de las 24 horas.',
             ), 233);
        }else{

            $estraordinario = new Extraordinario();

            $estraordinario->suministro_id=$request->suministroCodigoSuministro;
            $estraordinario->obsTipoExtraordinario_id=$request->obsTipoExtraordinario_id;
            $estraordinario->users_id=$user->id;
            $estraordinario->save();
            $extraordinarioR_id = $estraordinario->id;

            if (empty($extraordinarioR_id)) {
               // code...
               return response(array(
                'message' => 'Ocurrio algun problema, presione F5 e intentelo nuevamente.',
               ), 233);
            }else{

               $personaExtraordinario = new PersonaExtraordinario();
               $personaExtraordinario->extraordinario_id = $extraordinarioR_id;
               $personaExtraordinario->persona_id=$persona_idR;
               $personaExtraordinario->relacion_id = $request->relacion;
               //$personaExtraordinario->user_id=$user->id;
               $personaExtraordinario->save();


               $estadoExtraordinario = new EstadoExtraordinario();
               $estadoExtraordinario->extraordinario_id = $extraordinarioR_id;
               $estadoExtraordinario->fechaInicio = $fecha_inicio;
               $estadoExtraordinario->fechaFinal = $fecha_final;
              // $estadoExtraordinario->fechaAtencion = 
               $estadoExtraordinario->referencia = $request->referencia;
              // $estadoExtraordinario->tecnico = 
               $estadoExtraordinario->estado = "1";
               $estadoExtraordinario->estadot = "1";
               $estadoExtraordinario->tipo = "1";
               $estadoExtraordinario->fechaRegistro = $fecha_inicio;
               $estadoExtraordinario->sede_id = $request->idProvincia;
               $estadoExtraordinario->save();


              //$extraordinario = $extraordinario->store($request);
              //return $estraordinario;
              return [
                     'extraordinario' => $estraordinario,
                     'estadoExtraordinario' => $estadoExtraordinario];

            }



        }


      

    }

    public function storeEstadoExtraordinario(Request $request){
       // dd('revisar',$request);

        $user = Auth::user();
        $fecha_inicio = Carbon::now();

        $fecha_final = date("Y-m-d",strtotime($fecha_inicio."+  1 day"));


            if ($request->estado < 5) {
              $estadoExtraordinario = EstadoExtraordinario::find($request->id);
                  $estadoExtraordinario->estadot = 0;
                  $estadoExtraordinario->save();

              $estadoExtraordinario = new EstadoExtraordinario();
                  $estadoExtraordinario->extraordinario_id = $request->extraordinario_id;
                  $estadoExtraordinario->fechaInicio = $fecha_inicio;
                  $estadoExtraordinario->fechaFinal = $fecha_final;
                 // $estadoExtraordinario->fechaAtencion = 
                  $estadoExtraordinario->referencia = $request->referencia;
                 // $estadoExtraordinario->tecnico = 
                  $estadoExtraordinario->estado = $request->estado;
                  $estadoExtraordinario->estadot = '1';
                  $estadoExtraordinario->tipo = "2";

                  $estadoExtraordinario->fechaRegistro = $fecha_inicio;
                  $estadoExtraordinario->sede_id = $request->idProvincia;
                  $estadoExtraordinario->save();
               // code...
               //registrar reiterativo
               return $estadoExtraordinario;
            } else {
               // code...
               //mostrar error
               return response(array(
                'message' => 'No se permite crear el reiterativo',
             ), 233);
            }
            


        /*if ($request->estado == 1) {
            $estadoExtraordinario = new EstadoExtraordinario();
            $estadoExtraordinario->extraordinario_id = $request->extraordinario_id;
            $estadoExtraordinario->fechaInicio = $fecha_inicio;
            $estadoExtraordinario->fechaFinal = $fecha_final;
           // $estadoExtraordinario->fechaAtencion = 
            $estadoExtraordinario->referencia = $request->referencia;
           // $estadoExtraordinario->tecnico = 
            $estadoExtraordinario->estado = "1";
            $estadoExtraordinario->tipo = "2";

            $estadoExtraordinario->fechaRegistro = $fecha_inicio;
            $estadoExtraordinario->sede_id = $request->idProvincia;
            $estadoExtraordinario->save();
        } else {
            //return ['status' => 'error', 'code'=>400,'mensaje'=>'No se permite Crear un reiterativo'];
            //return response()->json(array('status' => 'error', 'code'=>400, 'message'=>'No se permite Crear un reiterativo'));
            return response(array(
                'message' => 'No se permite crear el reiterativo',
             ), 400);

        }*/

        


    }

      public function getExtraordinarioR(Request $request)
    {
        //dd($request);

        $fecha_inicio = Carbon::now();
       // dd($fecha_inicio->format("Y-m-d H:m:s"));
        //$fecha_inicio = date("d-m-Y");

       // $suministros = Extraordinario::where('suministro_id', $request->CodigoSuministro)->first();
        //dd($fecha_inicio);

//->orderBy('created_at', 'desc')

        /*$extraordinario = Extraordinario::where([
                    ['suministro_id', '=', $request->CodigoSuministro],
                    //['created_at', '=', $fecha_inicio ]
                ])->orderBy('created_at', 'desc')->first();
         */

         $extraordinario = Extraordinario::with('estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($request)  {
                        //$query->where('sede_id','=', $user->sede_id);
                       // $query->where('estado','>', 4);
                        $query->where('estadot','=', 1);
                        //$query->whereIn('sede_id', $userSede);
                        //$query->whereIn('sede_id', [2,3]);
                    })->where('suministro_id','=',$request->CodigoSuministro)->first();
         //dd('respuesta:   ',$extraordinario->estadoExtraordinario);

        //dd($extraordinario);
       //dd('resta',$fecha_inicio->diffForHumans($extraordinario->created_at));
        //dd('Hoy: ',$fecha_inicio->toDateTimeString(),'Inicio: ', $extraordinario->created_at->toDateTimeString());
       //$xd =$fecha_inicio->toDateTimeString();
       //$xdd = $extraordinario->created_at->toDateTimeString();
       //dd($xd->diffInDays($xdd));
        $hoy = $fecha_inicio->format('Y-m-d H:m:s');
        $ayer = $fecha_inicio->subDay(1)->format('Y-m-d H:m:s');
        //$fCreate = $extraordinario->estadoExtraordinario->created_at->format('Y-m-d H:m:s');

        $fCreate = (!empty($extraordinario)) ? $extraordinario->estadoExtraordinario->created_at->format('Y-m-d H:m:s') : '' ;
       // dd('hoy :',$hoy,'ayer :',$ayer);


        if (empty($extraordinario)) {
         //dd('3');
           return ['estado' => 3];
        }else if (($extraordinario->estadoExtraordinario->estado < 5) and ($ayer < $fCreate)) {
           // code...
         //no reiterativo
         //dd('1',$extraordinario->created_at);
         //return 1;

         return ['estado' => 1,'ayer'=>$ayer,'created'=>$fCreate,'estadoBd'=>$extraordinario->estadoExtraordinario->estado];
        }else if (($extraordinario->estadoExtraordinario->estado < 5) and ($ayer > $fCreate)) {
           // code...
         //reiterativo
         //dd('2',$extraordinario->created_at);
         //return 2;
         return ['estado' => 2,'datoRespuesta' => $extraordinario,'ayer'=>$ayer,'created'=>$fCreate,'estadoBd'=>$extraordinario->estadoExtraordinario->estado];
        }else if ($extraordinario->estadoExtraordinario->estado == 10) {
         //dd('otros',$extraordinario->created_at,$ayer < $extraordinario->created_at);
         //return 3;
            return ['estado' => 3];
         }else{
            return ['estado' => 0];

         }
        /*else{
           if ($ayer < $extraordinario->created_at) {
              // code...
               //dd('dentro de las 24 horasr',$extraordinario->created_at->format('Y-m-d H:m:s'));
               return 1;
           } else{
               //reiterativo
            /*$estadoExtraordinario = EstadoExtraordinario::where('extraordinario_id','=',$extraordinario->id)->where('estado','=',1,)->where('','','');
            $estadoExtraordinario = EstadoExtraordinario::where([
                   // ['correosede.sede_id', '=', $user->sede_id],
                    ['correos.estado', '=', '1'],
                    ['correos.estado', '=', '1'],
                    ['correos.estado', '=', '1'],
                ])
               return 2;
               //dd('mayor a las 24 horas',$extraordinario->created_at->format('Y-m-d H:m:s'));
           }*/
      //  }

    /*   $calculo = $fecha_inicio->diffForHumans($extraordinario->created_at);
        if ($calculo <= 15) {
           // code...
         dd('menos a 16',$calculo);
            //dd('menos a 24',$fecha_inicio->diffForHumans($extraordinario->created_at));
        }else{
         dd('mayor',$calculo);
            //dd('mayor a 24',$fecha_inicio->greaterThan($extraordinario->created_at));
        }*/

        /*if (empty($extraordinario)) {
           // dd("no existe suministro");
            //return ['extraordinarioR' => 3];
            return 3;
        }else {
            $fecha = $extraordinario->created_at;
           // dd("fecha_hoy", $fecha_inicio ,"fecha registro",$fecha->format("Y-m-d"));

            if ($fecha->format("Y-m-d")==$fecha_inicio) {
          //  dd("fechas iguales");
                //return $extraordinario->suministro_id;
                //return ($xd);
                //return ['extraordinarioR' => 1];
                return 1;
            }else{
                //return ['extraordinarioR' => 2];
                return 2;
                //dd("las fechas no son iguales");

            }
        }*/

        
//dd($extraordinario);
       // $personas = Persona::where('dni', $request->dniPersona)->get();
   
        //return response()->json($data);
       // return $extraordinario;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    

    public function show(Extraordinario $extraordinario, ObsTypeExtraordinary $obsTypeExtraordinary )
    {

       /// $extraordinary = Extraordinary::find($id);
       ///  $typeExtraordinary=TypeExtraordinary::pluck('description','id');
         return view('theme.backoffice.extraordinary.show',[
            'extraordinary' => $extraordinario,
            'obsTypeExtraordinary' => $obsTypeExtraordinary,

         ]);

        /// return view('theme.backoffice.extraordinary.show',compact('extraordinary','typeExtraordinary'));


       //return view('theme.backoffice.extraordinary.show');
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
   public function update(UpdateRequest $request, $id)
   // public function update(Request $request, $id)
    {
        //dd($request);
        $user = Auth::user();

        $estadoExtraordinario = EstadoExtraordinario::find($request->estadoExtraordinario_id);
        $estadoExtraordinario->referencia = $request->referencia;
        $estadoExtraordinario->sede_id = $request->sede_id;
        $estadoExtraordinario->save();


        $extraordinario = Extraordinario::find($request->id);
        $extraordinario->obsTipoExtraordinario_id = $request->obsTipoExtraordinario_id;
        $extraordinario->users_id = $user->id;
        $extraordinario->save();

        return $estadoExtraordinario;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Extraordinario $extraordinarios, $id)
    {
       // dd($id);
       // $this->authorize('delete', $user);
        $extraordinarios = Extraordinario::find($id);
        
        $extraordinarios->delete();
        return $extraordinarios;
       // $correos->delete();
        //alert('Exito','Usuario eliminado','success');
        //return redirect()->route('backoffice.user.index');
       // return $correos;
    }

    


    



    public function getexcel(Request $request, Extraordinario $extraordinario)
    {
          
       //$extraordinary=Extraordinary::all();
//dd($extraordinary);
      //  $extraordinario=Extraordinario::name($request->get('nombre'))->filtro($request->get('filtro'))->filtro2($request->get('filtro2'))->filtro3($request->get('filtro3'))->orderBy('created_at', 'desc')->paginate(6);
     //   $extraordinario=Extraordinario::dateini($request->get('dateini'))->orderBy('created_at', 'desc')->paginate(100);
       /* $extraordinary=Extraordinary::typeExtraordinaries($request->get('tipoex'))->esta($request->get('estado'))->dateini($request->get('dateini'))->datefin($request->get('datefin'))->orderBy('created_at', 'desc')->paginate(10000);
        Excel::create('laravel Excel2', function($excel) use ($extraordinary) {

            $excel->sheet('hoja laravel', function($sheet) use ($extraordinary) {
            $sheet->loadView('theme.backoffice.extraordinary.excel')->with('extraordinary', $extraordinary);
            });
        })->export('xlsx');*/
        //Excel::raw($yourExport, Excel::XLSX)
      //  dd($request);
       // $extraordinary=Extraordinary::typeExtraordinaries($request->get('tipoex'))->esta($request->get('estado'))->dateini($request->get('dateini'))->datefin($request->get('datefin'))->orderBy('created_at', 'desc')->paginate(10000);
        
    //   return Excel::download(new ExtraordinaryExport, 'extraordinaries.xlsx');
       // return (new $extraordinary)->download('extraordinaries.xlsx');

//return (new ExtraordinaryExport($request))->download('extraordinary.xlsx');
return Excel::download(new ExtraordinaryExport($request), 'users.xlsx');

//dd($extraordinary);
       
    }

    public function pdf($id)
    {
       
//dd($id);
        $extraordinario = Extraordinario::find($id);
        $estadoExtraordinario = EstadoExtraordinario::find($request->id);
        //esto es para la fecha actual--> en compac declaramos date
        $date = date('Y-m-d');


        $date = Carbon::now();
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

       
        $pdf = PDF::loadView('theme.backoffice.extraordinary.pdf', compact('extraordinary','date','fecha_actual'))->setPaper('a4','landscape');
        //Descargar
        return $pdf->download('extraordinario.pdf');
        //Visualizar
        //return $pdf->stream('landscape');
        //return $pdf->stream('invoice');
    }

   /* public function createPDF() {
      $pdf = app('dompdf.wrapper');
    $pdf->loadHTML('<h1>Styde.net</h1>');

    return $pdf->download('mi-archivo.pdf');


    }*/

    public function createPDF(Request $request,$id)
    {
        //dd($request);
        //dd($request);
        //$obsTipoExtraordinario_id= $id;

       // $extraordinarios = Extraordinario::find($id);
       // $extraordinarios = DB::table('extraordinarios')->where('id', '=', $id)->with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->get();

        $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','=',$id)->first();

         $date = date('Y-m-d');


        $date = Carbon::now();
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

       

        //$pdf = PDF::loadView('myPDF', compact('extraordinarios','date','fecha_actual'))->setPaper('a5','landscape');
        $pdf = PDF::loadView('myPDF', compact('extraordinarios','date','fecha_actual'))->setPaper('a5','portrait');
        //Descargar
        //return $pdf->download('extraordinario.pdf');
        //Visualizar
        //return $pdf->download('extraordinario.pdf');
        return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
        //return $pdf->stream('extraordinario.pdf');

        
    }

    public function pdftest(Request $request)
    {
       //dd('holis',$request);
       // dd($request);
        //$obsTipoExtraordinario_id= $id;

       // $extraordinarios = Extraordinario::find($id);
       // $extraordinarios = DB::table('extraordinarios')->where('id', '=', $id)->with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->get();

       // $extraordinarios = Extraordinario::where('votes', '>', 100)->take(10)->get();

        $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','<',100)->take(100)->get();

        //$extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','=',$id)->first();
        //dd($extraordinarios);
         $date = date('Y-m-d');


        $date = Carbon::now();
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

       

        //$pdf = PDF::loadView('myPDF', compact('extraordinarios','date','fecha_actual'))->setPaper('a5','landscape');
        $pdf = PDF::loadView('pdftest', compact('extraordinarios','date','fecha_actual'))->setPaper('A4','portrait');
        //Descargar
        //return $pdf->download('extraordinario.pdf');
        //Visualizar
        return $pdf->download('extraordinario.pdf');
        //return $pdf->download('Reporte_Seot_100000.pdf');
        //return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
        //return $pdf->stream('Reporte_Seot_100000.pdf');

        
    }


    public function getMailExtraordinario(Request $request)
    {
        //dd($request->tipoExtraordinario_id);
      //dd($request);


        //$correos = Correo::with('empresa',)->where('estado','=',1)->get();

        $user = Auth::user();
       // dd($user->id);
       // return $user;

        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();
        $user_email = $users->email;

        $sedeIds = $users->sedes;

       // dd($sedeIds);
      //  return $sedeIds;
        //return $sedeIds[0]->id;

            $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','=',$request->tipoExtraordinario_id)->first();
           // dd($extraordinarios->suministro->IdProvincia);
            $sedeSuministro = $extraordinarios->suministro->IdProvincia;

            //dd($extraordinarios);
      //return $sedeSuministro;

        $io = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$io]=$sedeId->id;
       
            $io++;
        }
       // dd($userSede);


        

            $correos = DB::table('correos')
                ->select('correos.correo', 'correosede.sede_id')

                ->join('correosede', 'correosede.correo_id', '=', 'correos.id')
               // ->whereIn('correosede.sede_id', $userSede)
                ->whereIn('correosede.sede_id', [$sedeSuministro])
               // ->whereIn('correosede.sede_id', ['2102'])

                ->where([
                   // ['correosede.sede_id', '=', $user->sede_id],
                    ['correos.estado', '=', '1'],
                ])
                
                ->get();

        //dd($userSede,$correos);

         //return  $correos;

       // dd('getMailExtraordinario',$correos);
        $i = 0;
        foreach ($correos as $correo) {
            
            //dd($correo->correo);
           // echo $correo->correo;
            $correoApto[$i]=$correo->correo;
            //return $xd;
            $i++;
        }


         //return  $correoApto;

    

        $date = date('Y-m-d');

         //return $extraordinarios;
        $date = Carbon::now();

        $data = array('extraordinarios' => $extraordinarios, 'date' => $date, 'user_email' => $user_email);

         if ($request->estadoReiterativo == 1) {

         $template_path = ('email_extraordinario');
            // NORMAL   
              Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$correoApto) {
                     
               // $message->to($data['correoApto'])->subject('Reporte del dia '.date('Y-m-d').'');
               // $message->to($correoApto )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
               
                $message->to('malelementocrozz@gmail.com' )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
                //$message → cc('email@example.com', 'Mr. Example');
               // $message->cc($data['user_email'], 'Copia - Verificacion');
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                  // return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
               });


              //ACTUALIZAR EL ESTADO

         /*     $estadoExtraordinario = EstadoExtraordinario::find($request->tipoExtraordinario_id);
                  $estadoExtraordinario->estadot = 0;
                  $estadoExtraordinario->save();
      */
                  $estadoExtraordinario = EstadoExtraordinario::where('extraordinario_id', $request->tipoExtraordinario_id)
                          ->where('estadot', '1')
                          ->update(['estado' => 2]);

              //return "El correo ha sido enviado";
               //return Redirect::back()->withMessage('diosito al fin se evio el correo.')->withClass('success');
               //return Redirect::back();

              //return redirect();
               return $estadoExtraordinario;

         } else{

         $template_path = ('email_extraordinarioR');
            // reiterativo
            Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$correoApto) {
                     
               // $message->to($data['correoApto'])->subject('Reporte del dia '.date('Y-m-d').'');
               // $message->to($correoApto )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
               
                $message->to('malelementocrozz@gmail.com' )->subject('REITERATIVO - Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
                //$message → cc('email@example.com', 'Mr. Example');
                $message->cc($data['user_email'], 'Copia - Verificacion');
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                  // return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
            });

         }

    }

   public function getMailReporteExtraordinario(Request $request){
      //dd('dios',$request);
      $user = Auth::user();

      $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

         $user_email = $users->email;
         $emailReporte = $request->email;

      $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','=',$request->extraordinario_id)->first();

         $date = date('Y-m-d');


        $date = Carbon::now();
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

        $data = array('extraordinarios' => $extraordinarios, 'date' => $date, 'user_email' => $user_email, 'emailReporte' => $emailReporte);

//dd($data);
  $pdf = PDF::loadView('myPDF', compact('extraordinarios','date','fecha_actual'))->setPaper('a5','portrait');

        $template_path = ('Reportes.email_reporte');
        //return $pdf->stream('extraordinario.pdf');

         Mail::send(['html'=> $template_path ], $data, function($message) use ($data, $datetime, $date, $pdf) {
               
                //$message->to($data['correoApto'])->subject('Reporte del dia '.date('Y-m-d').'');

                //$message->to($correoApto )->subject('Reporte del dia '.date('Y-m-d').'  De la Sede: '.$sedeNombres.'');
                //$message->to('malelementocrozz@gmail.com')->subject('Reporte del dia '.date('Y-m-d'));
                $message->to($data['emailReporte'])->subject('Reporte del dia '.date('Y-m-d'));

                //$message->cc($data['user_email'], 'Copia - Verificacion');
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');
                $message->attachData($pdf->output(),'reporte.pdf');
               
            });



   }

   public function getMailExtraordinarioFiltro(Request $request){
        //dd($request);


      $user = Auth::user();
       // dd($user->id);
       // return $user;

        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

         $user_email = $users->email;
         
        $sedeIds = $users->sedes;

       // dd($sedeIds);
      //  return $sedeIds;
        //return $sedeIds[0]->id;

        $io = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$io]=$sedeId->id;
            $sedeNombre[$io]=$sedeId->nombre;
       
            $io++;
        }

        $sedeNombres = implode('-',$sedeNombre);
       // dd($userSede,$sedeNombres);

        //dd($user->sede_id);


            $correos = DB::table('correos')
                ->select('correos.correo', 'correosede.sede_id')

                ->join('correosede', 'correosede.correo_id', '=', 'correos.id')
                ->whereIn('correosede.sede_id', $userSede)
               // ->whereIn('correosede.sede_id', $request->sedes)

                ->where([
                   // ['correosede.sede_id', '=', $user->sede_id],
                    ['correos.estado', '=', '1'],
                ])
                
                ->get();

//dd($userSede,$sedeNombre,$correos);
          
       // dd('getMailExtraordinarioFiltro',$correos);

    //   $correos = DB::select('SELECT cs.sede_id as value, s.nombre as text FROM correosede cs
    //        INNER JOIN sedes s on s.id = cs.sede_id
    //        WHERE  cs.correo_id = ?', [$request->idcorreo]);


        //dd($correo->correo);
        $i = 0;
        foreach ($correos as $correo) {
            
            //dd($correo->correo);
           // echo $correo->correo;
            $correoApto[$i]=$correo->correo;
            //return $xd;
            $i++;
        }
         
//dd($correoApto);
       
        $date = date('Y-m-d');
        $date = Carbon::now();

        $busqueda=$request->tipoExtraordinario_id;

        if ($busqueda == 1) {
            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id', 'suministros.CodigoSuministro','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro', 'personas.nombres', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud','obsTipoExtraordinario.descripcion', 'suministros.NombreZonaAdministrativa','suministros.SerieMedidor','suministros.NombreTipoSistema')

            ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
            //->whereIn('estadoExtraordinarios.sede_id',$userSede)
            ->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)

            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 1],
                ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio],
                ['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            
            ->get();
        }else if ($busqueda == 2) {
            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id', 'suministros.CodigoSuministro','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro', 'personas.nombres', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud', 'obsTipoExtraordinario.descripcion', 'suministros.NombreZonaAdministrativa','suministros.SerieMedidor','suministros.NombreTipoSistema')

            ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
            //->whereIn('estadoExtraordinarios.sede_id',$userSede)
            ->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)

            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 2],
                ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio],
                ['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            
            ->get();
        }else {

            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id', 'suministros.CodigoSuministro','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro', 'personas.nombres', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud', 'obsTipoExtraordinario.descripcion', 'suministros.NombreZonaAdministrativa','suministros.SerieMedidor','suministros.NombreTipoSistema')

            ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
            //->whereIn('estadoExtraordinarios.sede_id',$userSede)
            ->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)
            ->whereIn('obsTipoExtraordinario.tipoExtraordinario_id', [1,2])

            ->where([
                //['obsTipoExtraordinario.tipoExtraordinario_id', '=', $request->tipoExtraordinario_id],
                ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio],
                ['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            
            ->get();
        }
        //dd($extraordinarios);
       // return $extraordinarios;

       /* $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro', 'personas.nombres', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud')

            ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')

            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', $request->tipoExtraordinario_id],
                ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio],
                ['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            
            ->get();*/
            //dd($extraordinarios);

            $data = array('extraordinarios' => $extraordinarios, 'date' => $date, 'user_email' => $user_email);
            $template_path = ('email_extraordinarioDia');

            //$excel = Excel::download(new ExtraordinariosExport($extraordinarios,$date), 'extraordinarios-collection.xlsx')->getFile();
            //$excel = Excel::download(new ExtraordinariosExport($extraordinarios,$date), 'extraordinarios-collection.xlsx', \Maatwebsite\Excel\Excel::XLS);
            $excel = Excel::download(new ExtraordinariosExport($extraordinarios,$date),'extraordinarios-collection.xlsx')->getFile();
            //$excel = Excel::export(new ExtraordinariosExport($extraordinarios,$date), 'extraordinarios-collection.xlsx');

            Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$correoApto, $sedeNombres, $excel) {
               
                //$message->to($data['correoApto'])->subject('Reporte del dia '.date('Y-m-d').'');

                //$message->to($correoApto )->subject('Reporte del dia '.date('Y-m-d').'  De la Sede: '.$sedeNombres.'');
                $message->to('malelementocrozz@gmail.com')->subject('Reporte del dia '.date('Y-m-d').'  De la Sede: '.$sedeNombres.'');

                //$message->cc($data['user_email'], 'Copia - Verificacion');
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                $message->attach($excel, ['as' => 'extraordinarios-collection.xlsx']);
               //$message->attach(
               //        Excel::download(
               //            new ExtraordinariosExport($extraordinarios,$date),
               //            'extraordinarios-collection.xlsx'
               //        )->getFile(), ['as' => 'extraordinarios-collection.xlsx']);

                  // return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
            });

/*************/

            /*$pdf = PDF::loadView('emails.myTestMail', $data);
            $excel = Excel::download(new ExtraordinariosExport($extraordinarios,$date), 'extraordinarios-collection.xlsx');
            $excel = Excel::export(new ExtraordinariosExport($extraordinarios,$date), 'extraordinarios-collection.xlsx');

            Mail::send('emails.myTestMail', $data, function($message)use($data, $pdf) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), "text.pdf")
            ->attachData($excel, 'extraordinarios-collection.xlsx');;
            });*/




        


   }



    

    public function getExcelExtraordinario(Request $request)
    {
        //dd($request);

        //dd($user->sede_id);
        $user = Auth::user();

        $date = date('Y-m-d');
        $date = Carbon::now();


       // dd($user->id);
       // return $user;

        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

        $sedeIds = $users->sedes;

       // dd($sedeIds);
      //  return $sedeIds;
        //return $sedeIds[0]->id;


        $io = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$io]=$sedeId->id;
           // $sedeNombre[$io]=$sedeId->nombre;
       
            $io++;
        }



        $busqueda=$request->tipoExtraordinario_id;

        if ($busqueda == 1) {
            //dd('hola desde 1');
            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro','suministros.CodigoSuministro', 'personas.nombres', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud','obsTipoExtraordinario.descripcion', 'suministros.NombreZonaAdministrativa','suministros.SerieMedidor','suministros.NombreTipoSistema')
            ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 1]
                ])
            ->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)

           /* ->where([
               // ['estadoExtraordinarios.sede_id', '=', $user->sede_id]
                ['estadoExtraordinarios.sede_id', '=', $userSede]
                ])*/
            ->whereBetween('estadoExtraordinarios.fechaInicio', [$request->FechaInicio, $request->FechaFinal])
            ->orderBy('extraordinarios.id','desc')
            ->get();
            
        } else if($busqueda == 2){
            //dd('hola desde 2');
            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro', 'personas.nombres','suministros.CodigoSuministro', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud','obsTipoExtraordinario.descripcion', 'suministros.NombreZonaAdministrativa','suministros.SerieMedidor','suministros.NombreTipoSistema')
            ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 2]
                ])
            ->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)
           /* ->where([
               // ['estadoExtraordinarios.sede_id', '=', $user->sede_id]
                ['estadoExtraordinarios.sede_id', '=', $userSede]
                ])*/
            ->whereBetween('estadoExtraordinarios.fechaInicio', [$request->FechaInicio, $request->FechaFinal])
            ->orderBy('extraordinarios.id','desc')
            ->get();

        }else {
//dd('hola desde 3');

        $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro','suministros.CodigoSuministro', 'personas.nombres', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud','obsTipoExtraordinario.descripcion', 'suministros.NombreZonaAdministrativa','suministros.SerieMedidor','suministros.NombreTipoSistema')
            //->select('*')
            //->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            //->rightJoin('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')


              ->join('estadoExtraordinarios', function ($join) {
                  $join->on('extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
                       ->where('estadoExtraordinarios.estadot', '=', '1');
              })


            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')


           /* ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', $request->tipoExtraordinario_id]
                ])
            */


            ->whereIn('obsTipoExtraordinario.tipoExtraordinario_id', [1,2])
            //->where('extraordinarios.id','=','4573')
            
           // ->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)


           /* ->where([
               // ['estadoExtraordinarios.sede_id', '=', $user->sede_id]
                ['estadoExtraordinarios.sede_id', '=', $userSede]
                ])*/

            ->whereBetween('estadoExtraordinarios.fechaInicio', [$request->FechaInicio, $request->FechaFinal])
            ->orderBy('extraordinarios.id','desc')
            ->get();
        }



/*
        $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro', 'personas.nombres', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud','obsTipoExtraordinario.descripcion')

            ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')


            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', $request->tipoExtraordinario_id]
               // ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio]

                //['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            ->whereBetween('estadoExtraordinarios.fechaInicio', [$request->FechaInicio, $request->FechaFinal])
          //  ->where([
          //      ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio]
          //      
          //      //['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
          //  ]);
            
            ->get();
*/
           // return $extraordinarios;
             //$exco=$extraordinarios;

      
       /*Excel::create('Laravel Excel', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
                $extraordinarios = Extraordinario::all();                
                $sheet->fromArray($extraordinarios);
               // $sheet->loadView('excelExtraordinario')->with('extraordinarios', $extraordinarios);
                $sheet->setOrientation('landscape');
            });
        })->export('xlsx');*/
        //dd($extraordinarios);

        return Excel::download(new ExtraordinariosExport($extraordinarios,$date), 'extraordinarios-collection.xlsx');

       /* Excel::create('Laravel Excel', function($excel) {
            $excel->sheet('Extraordinarios', function($sheet) {
                //$products = Product::all();
                $extraordinarios = Extraordinario::all(); 
                $sheet->fromArray($extraordinarios);
            });
        })->export('xls');*/



/*
         $extraordinary=Extraordinary::typeExtraordinaries($request->get('tipoex'))->esta($request->get('estado'))->dateini($request->get('dateini'))->datefin($request->get('datefin'))->orderBy('created_at', 'desc')->paginate(10000);

        Excel::create('laravel Excel2', function($excel) use ($extraordinary) {

            $excel->sheet('hoja laravel', function($sheet) use ($extraordinary) {
            $sheet->loadView('theme.backoffice.extraordinary.excel')->with('extraordinary', $extraordinary);
            });
        })->export('xlsx');
*/

    }

     public function getTipoExtraordinario()
    {
        
        $tipoExtraordinario = DB::select('select * from tipoExtraordinario');
   
        //return response()->json($data);
        //return response()->json($data);
       return $tipoExtraordinario;
       //return "xd";
      // dd("xd");
        /*return [
            
            'departamento' => $departamento,
            
            
        ];*/
    }

    public function getObsTipoExtraordinario(Request $request)
    {
       // dd($request);
        //$users = DB::select('select * from users where active = ?', [1]);
        //$results = DB::select('select * from users where id = :id', ['id' => 1]);
        //dd($request);
        $obsTipoExtraordinario = DB::select('select * from obsTipoExtraordinario where tipoExtraordinario_id = ?', [$request->tipoExtraordinario_id]);

       // $data = State::where('departamento_id', $request->departamento_id)->get();
   
        //return response()->json($data);
        return $obsTipoExtraordinario;

    }

    public function getTipoRegistro(Request $request)
    {
        //dd($request);
        
        $tipoExtraordinario = DB::select('select * from tipoExtraordinario where registro = ?',[$request->tipoRegistro]);
   
        //return response()->json($data);
        //return response()->json($data);
       return $tipoExtraordinario;
       //return "xd";
      // dd("xd");
        /*return [
            
            'departamento' => $departamento,
            
            
        ];*/
    }


    public function getDataSedes(Request $request)
    {
        //dd($request);
        
        //$getDataSedes = DB::select('select * from tipoExtraordinario where registro = ?',[$request->tipoRegistro]);

        //$sedes = Sedes::orderBy('id','desc')->get();
        $sedes = Sede::where('estado','=',1)->orderBy('created_at','DESC')->get();
   
 
       return $sedes;
     
    }

    

    public function reportePdfAtencionB(Request $request)
    {
      //dd('xx',$request);
     // dd($request->estado_extraordinario['id']);
        //dd($request->empresa_colaborador['colaborador']);
       // dd($request->empresa_colaborador.colaborador_id);
        $empresaColaborador=$request->empresa_colaborador;
        //$prueba=$request->empresa_colaborador['colaborador'];
        //dd($prueba['nombre']);
        $reporte=$request;

       // $atencionDerivarRegistro= AtencionDerivarRegistro::where('derivarregistro_id',$request->id)->where('estadot','1')->first();
        //$atencionDerivarRegistro= AtencionDerivarRegistro::with('derivarRegistro.empresaColaborador.colaborador')->where('derivarregistro_id',$request->id)->where('estadot','1')->first();
        $atencionDerivarRegistro= AtencionDerivarRegistro::with('derivarRegistro.empresaColaborador.colaborador')
                                 ->whereHas('derivarRegistro', function($query) use ($request)  {
                                     $query->where('estadoextraordinario_id','=', $request->estado_extraordinario['id']);
                                     //$query->whereIn('sede_id', $userSede);
                                     //$query->whereIn('sede_id', [2,3]);
                                 })->where('estadot','1')->first();
                                 //dd($atencionDerivarRegistro);
        //dd($empresaColaborador,$colaborador,$request->empresa_colaborador['colaborador']['nombre']);
       // dd($atencionDerivarRegistro->id);
       // dd($atencionDerivarRegistro->derivarRegistro->empresaColaborador->colaborador->nombres);

       // $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','<',100)->take(100)->get();

        
         $date = date('Y-m-d');


        $date = Carbon::now();
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

       

        //$pdf = PDF::loadView('myPDF', compact('extraordinarios','date','fecha_actual'))->setPaper('a5','landscape');
        $pdf = PDF::loadView('Reportes.atencionB', compact('reporte','atencionDerivarRegistro','date','fecha_actual'))->setPaper('A4','portrait');
        //Descargar
        //return $pdf->download('extraordinario.pdf');
        //Visualizar
        return $pdf->download('extraordinario.pdf');
        //return $pdf->download('Reporte_Seot_100000.pdf');
        //return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
        //return $pdf->stream('Reporte_Seot_100000.pdf');
     
    }



    public function detalleAtencion(Request $request){
     // dd('respuesta',$request);
      $atencionDerivarRegistro= AtencionDerivarRegistro::with('derivarRegistro.empresaColaborador.colaborador')
                                 ->whereHas('derivarRegistro', function($query) use ($request)  {
                                     $query->where('estadoextraordinario_id','=', $request->id);
                                     //$query->whereIn('sede_id', $userSede);
                                     //$query->whereIn('sede_id', [2,3]);
                                 })->where('estadot','1')->first();

     // dd('respuesta_2',$atencionDerivarRegistro);
      return $atencionDerivarRegistro;

    }



    public function confirmarAtencion(Request $request){
      //dd($request->id);
      //dd('holitas',$request->estado_extraordinario['id']);

      $estadoExtraordinario = EstadoExtraordinario::find($request->estado_extraordinario['id']);
                  $estadoExtraordinario->estado = 10;
                  $estadoExtraordinario->save();

         return $estadoExtraordinario;   



    }

}
