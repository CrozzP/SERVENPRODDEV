<?php

namespace App\Http\Controllers;

use App\Models\EmpresaColaborador;
use App\Models\DerivarRegistro;
use App\User;
use App\Models\EstadoExtraordinario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;

class EmpresaColaboradorController extends Controller
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

    public function empresaColaboradores()
    {
        //

       // $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();
        $colaboradores = EmpresaColaborador::with('colaborador')->orderBy('created_at','DESC')->where('estado',1)->get();
        return $colaboradores;
    }

    public function empColaborador(Request $request)
    {
        //
//dd('holitas');
       // $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();
        $colaboradores = EmpresaColaborador::with('colaborador')->orderBy('created_at','DESC')->where('estado',1)->get();
        return $colaboradores;
    }

   
  


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
    public function store(Request $request,DerivarRegistro $derivarRegistro,EstadoExtraordinario $estadoExtraordinario)
    {
        //
        $fecha_derivacionhh = Carbon::now();
        $fecha_derivacion2 = Carbon::now();
      //  $fecha_derivacion = $hoy->toDateString();
        //$fecha_derivacionh = Carbon::now();

        $fecha_derivacion = $fecha_derivacion2->format('Y-m-d');

        //dd($request,$request->empresacolaborador_id,$request->estadoextraordinario_id);
        //dd($request);
       
       // dd($fecha_derivacionh, $fecha_derivacion);

        $user = Auth::user();
        //dd($user->id);
        
       // $derivarRegistro->obsTipoExtraordinario_id=$request->obsTipoExtraordinario_id;


        // $derivarRegistro->otros()->sync($request->estadoextraordinario_id,$request->obsTipoExtraordinario_id);
         //$sede->empresa()->sync($request->pruebaxd);
         $sedeIds = $request->estadoextraordinario_id;

        
$array = explode ( ',', $sedeIds);
//dd($array);

         
      // $sedeIds = $users->sedes;

       // dd($sedeIds);
      //  return $sedeIds;
        //return $sedeIds[0]->id;
//$question = Question::where('created_at', '<',Carbon::parse('-24 hours'));


        $i = 0;
        foreach ($array as $sedeId) {
            $userSede[$i]=$sedeId;

           // $derivarRegistro = DerivarRegistro::where('estadoextraordinario_id', $sedeId)->('')->first();


            /*$derivarRegistro = new DerivarRegistro();

            $derivarRegistro->user_id=$user->id;
            $derivarRegistro->empresacolaborador_id=$request->empresacolaborador_id;
            //$derivarRegistro->estadoextraordinario_id=$request->estadoextraordinario_id;
            $derivarRegistro->estado=1;
           $derivarRegistro->estadoextraordinario_id=$sedeId;
           $derivarRegistro->fechaderivacion=$fecha_derivacion;
           $derivarRegistro->fechaderivacionh=$fecha_derivacionh;

           $derivarRegistro->save();*/

           $derivarRegistro = DerivarRegistro::firstOrCreate(
                ['fechaderivacion' => $fecha_derivacion, 'estadoextraordinario_id' => $sedeId, ],
                ['user_id' => $user->id,
                 'empresacolaborador_id' => $request->empresacolaborador_id,
                 'estado' => 1,
                 'fechahora' => $fecha_derivacionhh,
                 'estadoextraordinario_id' => $sedeId
                ]
            );
          // dd($derivarRegistro);


        $extraordinarioR_id = $derivarRegistro->estadoextraordinario_id;

      //  $estadoExtraordinario = EstadoExtraordinario::find($extraordinarioR_id);
       // $estadoExtraordinario->estado = 2;

      //  $estadoExtraordinario->save();

        $estadoExtraordinario = EstadoExtraordinario::where('id', $extraordinarioR_id)
                                ->where('estado',2)
                                ->where('estadot',1)
                                 
                                  ->update(['estado' => 3,
                                    'tecnico'=> $request->empresacolaborador_id],);



       //actualizar datos de   ESTADO EXTRAORDINARIO-

            $i++;
           
        }

//dd($extraordinarioR_id);

       
        
        return $derivarRegistro;

    }


      public function serviceExtraordinarioAsignar(Request $request,DerivarRegistro $derivarRegistro,EstadoExtraordinario $estadoExtraordinario)
    {
        //dd($request);
        $user = Auth::user();
       // dd($user->id);
       // return $user;

        $fecha_derivacionhh = Carbon::now();
        $fecha_derivacion2 = Carbon::now();
      //  $fecha_derivacion = $hoy->toDateString();
        //$fecha_derivacionh = Carbon::now();

        $fecha_derivacion = $fecha_derivacion2->format('Y-m-d');


        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

        $sedeIds = $users->sedes;


        $derivarRegistro = DerivarRegistro::firstOrCreate(
                ['fechaderivacion' => $fecha_derivacion, 'estadoextraordinario_id' => $request->estadoextraordinario_id, ],
                ['user_id' => $user->id,
                 'empresacolaborador_id' => $request->colaborador,
                 'estado' => 1,
                 'fechahora' => $fecha_derivacionhh,
                 'estadoextraordinario_id' => $request->estadoextraordinario_id
                ]
            );

        $extraordinarioR_id = $derivarRegistro->estadoextraordinario_id;

        //TECNICO = COLABORADOR, CON FINES DE COMODIDAD PARA LAS BUSQUEDAS

        $estadoExtraordinario = EstadoExtraordinario::where('id', $extraordinarioR_id)
                                ->where('estado',2)
                                ->where('estadot',1)
                                ->update(['estado' => 3, 'tecnico' => $request->colaborador]);


        return $derivarRegistro;


    }


     public function serviceEditExtraordinarioAsignar(Request $request,DerivarRegistro $derivarRegistro,EstadoExtraordinario $estadoExtraordinario)
    {
        //dd($request);
       // $request->colaborador
       // $request->estadoextraordinario_id
       // $request->tipoExtraordinario_id

        $user = Auth::user();
       // dd($user->id);
       // return $user;

        $fecha_derivacionhh = Carbon::now();
        $fecha_derivacion2 = Carbon::now();
      //  $fecha_derivacion = $hoy->toDateString();
        //$fecha_derivacionh = Carbon::now();

        $fecha_derivacion = $fecha_derivacion2->format('Y-m-d');


        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

        $sedeIds = $users->sedes;

        //BUSCAR DERIVARREGISTRO

       // $derivarRegistro = DerivarRegistro::where('estadoextraordinario_id',$request->estadoextraordinario_id)->orderBy('created_at','DESC')->first();



       /* $derivarRegistro = DerivarRegistro::where('estadoextraordinario_id', $request->estadoextraordinario_id)
                                ->where('empresacolaborador_id','!=', $request->colaborador)
                                ->where('estado',1)
                                ->orderBy('created_at','DESC')->first()
                                ->update(['estado' => 0]);

         //dd($derivarRegistro );
         


        if ($derivarRegistro== true) {
            // code...
            $derivarRegistro = new DerivarRegistro();

            $derivarRegistro->user_id=$user->id;
            $derivarRegistro->empresacolaborador_id=$request->colaborador;
            $derivarRegistro->estadoextraordinario_id=$request->estadoextraordinario_id;
            $derivarRegistro->fechaderivacion=$fecha_derivacion;
            $derivarRegistro->fechahora=$fecha_derivacionhh;

            $derivarRegistro->estado=1;
            $derivarRegistro->save();

            return $derivarRegistro;

        }else{
            return 'false';

        }*/


        $derivarRegistro = DerivarRegistro::where('estadoextraordinario_id', $request->estadoextraordinario_id)
                                ->where('empresacolaborador_id','!=', $request->colaborador)
                                ->where('estado',1)
                                ->orderBy('created_at','DESC')->first();
        //dd( $derivarRegistro );
 
        if ($derivarRegistro !== null) {
        $derivarRegistro_id=$derivarRegistro->id;

            $derivarRegistro = DerivarRegistro::find($derivarRegistro_id);
            $derivarRegistro->estado = 0;
            $derivarRegistro->save();

            $derivarRegistroN = new DerivarRegistro();

            $derivarRegistroN->user_id=$user->id;
            $derivarRegistroN->empresacolaborador_id=$request->colaborador;
            $derivarRegistroN->estadoextraordinario_id=$request->estadoextraordinario_id;
            $derivarRegistroN->fechaderivacion=$fecha_derivacion;
            $derivarRegistroN->fechahora=$fecha_derivacionhh;

            $derivarRegistroN->estado=1;
            $derivarRegistroN->save();

            $derivarRegistroN_ee_id = $derivarRegistroN->estadoextraordinario_id;

//dd($derivarRegistroN_id);
            //ACTUALIZAR TECNICO-FINALIDAD DE BUSQUEDAS Y FILTROS
            $estadoExtraordinario = EstadoExtraordinario::where('id','=', $derivarRegistroN_ee_id)
                                //->where('estado',2)
                                //->where('estadot',1)
                                //->update(['estado' => 3, 'tecnico' => $request->colaborador]);
                                ->update(['tecnico' => $request->colaborador]);


            return $derivarRegistroN;

        } else {
           // return Response::json('hola', 201);
            return response()->json(['message'=>'No se puede asignar al mismo Tecnico, seleccione otro Tecnico.'], 400);
           // $response->failed();
           
             //return 'false';
        }




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
}
