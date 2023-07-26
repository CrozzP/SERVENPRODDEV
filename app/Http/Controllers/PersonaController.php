<?php

namespace App\Http\Controllers;

use App\Persona;

use App\Models\PersonaExtraordinario;
use App\Models\EstadoExtraordinario;

use Illuminate\Http\Request;
use App\Http\Requests\Persona\StoreRequest;
use App\Http\Requests\Persona\StoreSolRequest;
use App\Http\Requests\Persona\UpdateRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;



class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $departamentos = DB::select('select * from departamentos');
        //$provincias = DB::select('select * from provincias');
       // $distritos = DB::select('select * from distritos');
       // $personas= Persona::orderBy('created_at','desc')->get();
        $personas= Persona::orderBy('created_at','desc')->Paginate(10);

       /* $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })->orderBy('created_at','DESC')->Paginate(10);*/


        return $personas;

       /* return [
            'persona' => Persona::all(),
           // 'departamento' => $departamentos,
          //  'provincia' => $provincias,
          //  'distrito' => $distritos,
            
        ];*/
    }



    public function getDepartamento()
    {
        
        $departamento = DB::select('select * from departamentos');
   
        //return response()->json($data);
        //return response()->json($data);
       return $departamento;
        /*return [
            
            'departamento' => $departamento,
            
            
        ];*/
    }

    public function getProvincia(Request $request)
    {
        //dd($request);
        //$users = DB::select('select * from users where active = ?', [1]);
        //$results = DB::select('select * from users where id = :id', ['id' => 1]);
        //dd($request);
        $provincia = DB::select('select * from provincias where departamento_id = ?', [$request->departamento_id]);

       // $data = State::where('departamento_id', $request->departamento_id)->get();
   
        //return response()->json($data);
        return $provincia;
    }

    public function getDistrito(Request $request)
    {
        $distrito = DB::select('select * from distritos where provincia_id = ?', [$request->provincia_id]);
        //$data = State::where('provincia_id', $request->provincia_id)->get();
   
        //return response()->json($data);
        return $distrito;

    }

    public function getPersonaID(Request $request)
    {
        //return "diomio";
        //dd($request);
       // $users = DB::select('select * from users where active = ?', [1]);
        //$results = DB::select('select * from users where id = :id', ['id' => 1]);
        //dd($request);
       // $provincia = DB::select('select * from provincias where departamento_id = ?', [$request->departamento_id]);
       // $personas = DB::select('select * from personas where dni = ?', [$request->dniPersona])->get();

        //$data = State::where('departamento_id', $request->departamento_id)->get();
        $personas = Persona::where('dni', $request->dniPersona)->first();
       // $personas = Persona::where('dni', $request->dniPersona)->get();
   
        //return response()->json($data);
        return $personas;
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
    //public function store(StoreRequest $request, Persona $persona)
    public function store(StoreSolRequest $request, Persona $persona)
   // public function store(Request $request, Persona $persona)
    {

      //dd($request);

      $user = Auth::user();

      $personas = Persona::where('dni', $request->personaDni)->first();
      //dd($personas);

      if(empty($personas->id)){

         $personas = new Persona;
         $personas->dni = $request->personaDni;
         $personas->nombre = $request->personaNombre;
         $personas->apellPat = $request->personaApellPat;
         $personas->apellMat = $request->personaApellMat;
         $personas->sexo = $request->personaSexo;
         $personas->telefono = $request->personaTelefono;
         $personas->direccion = $request->personaDireccion;
         $personas->nombres = $request->personaNombre.' '.$request->personaApellPat.' '.$request->personaApellMat;
         $personas->tipoDocumento_id = $request->tipoDocumento;
         $personas->user_id = $user->id;
         $personas->save();

      }else{

          
         //$persona->dni = $request->personaDni;
         $personas->nombre = $request->personaNombre;
         $personas->apellPat = $request->personaApellPat;
         $personas->apellMat = $request->personaApellMat;
         $personas->sexo = $request->personaSexo;
         $personas->telefono = $request->personaTelefono;
         //$persona->direccion = $request->personaDireccion;
         $personas->nombres = $request->personaNombre.' '.$request->personaApellPat.' '.$request->personaApellMat;
         $personas->tipoDocumento_id = $request->tipoDocumento;
         $personas->user_id = $user->id;
         $personas->save();
      }
      return $personas;


/*
        if (empty($request->personaDni)) {
            //buscar a la persona con dni por defecto
            //los datos seran default
            $personas = Persona::where('dni', '10000008')->first();
                $persona = Persona::find($personas->id);
                //$persona->sexo = $request->personaSexo;
                //$persona->telefono = $request->personaTelefono;
                //$persona->save();
                return $persona;

        } else {
            //realizar la busqueda del dni y registrar
            $personas = Persona::where('dni', $request->personaDni)->first();

            if (empty($personas->id)) {

                $persona = new Persona();
                $persona->dni = $request->personaDni;
                $persona->nombre = $request->personaNombre;
                $persona->apellPat = $request->personaApellPat;
                $persona->apellMat = $request->personaApellMat;
                $persona->sexo = $request->personaSexo;
                $persona->telefono = $request->personaTelefono;
                $persona->direccion = $request->personaDireccion;
                $persona->nombres = $request->personaNombre.' '.$request->personaApellPat.' '.$request->personaApellMat;

                //$persona->fechaNacimiento = $request->;
                //$persona->email = $request->;

                $persona->save();


            }else if($personas->dni=='10000008'){

               
                return $persona;
  
            }else{
                $persona = Persona::find($personas->id);
                $persona->sexo = $request->personaSexo;
                $persona->telefono = $request->personaTelefono;
                $persona->save();
            }

        }


        return $persona;
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
   // public function update(Request $request,$id)
    {
        //dd($request->vistaEditPersona);
        /*
        $persona = Persona::find($request->id);
        $persona = Persona::find($request->persona_id);*/
       // $persona = Persona::where('dni','=',$request->dni)->first();

         if(!empty($request->persona_id)){ $personaiID = $request->persona_id;}
         if(!empty($request->id)){$personaiID = $request->id;}
            //dd('datos',$personaiID  );

        if ($request->vistaEditPersona == 0) {
           //no editar
            return response(array(
                'message' => 'No se actualizaron los datos del solicitante',
             ), 233);
        }else{
            //editar
            //$persona = Persona::find($request->persona_id);
            //$persona = Persona::find($personaiID);
            $persona = Persona::where('id','=',$personaiID)->first();
            
            $persona->nombre = $request->nombre;
            $persona->apellPat = $request->apellPat;
            $persona->apellMat = $request->apellMat;
            $persona->sexo = $request->sexo;
            $persona->telefono = $request->telefonop;
            $persona->nombres = $request->nombre.' '.$request->apellPat.' '.$request->apellMat;
            
            $persona->save();
            return $persona;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //dd('eliminado');
        $persona->delete();
        
        return $persona;
    }


     public function buscarPersonaExtraordinario(Persona $persona,PersonaExtraordinario $personaExtraordinario, Request $request)
    {
        //dd($persona);
          //return Persona::orderBy('created_at','desc')->get();

         // $buscarPersonas = PersonaExtraordinario::with('extraordinario')->get();
          $buscarPersonas = Persona::with('personaExtraordinario.extraordinario','personaExtraordinario.estadoExtraordinario','personaExtraordinario.extraordinario.obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.extraordinario.estadoExtraordinario')
          ->where('id',$persona->id)
          ->get();
          

         /* $buscarPersonas = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })->orderBy('created_at','DESC')->Paginate(10);*/

//dd($buscarPersonas);
        return $buscarPersonas;
    }



    public function personaBuscar(Request $request)
    {
       // dd("dentro del conrtoller-search");
      // dd($request);

       // $user = Auth::user();

        $tipoBusqueda = $request->tipoSearch;
      

        switch ($tipoBusqueda) {
            case 'Documento':
               
/*
                $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('personaExtraordinario.persona', function($query) use ($request)  {
                        $query->where('dni','=', $request->search);
                    })->Paginate(10);
                */
                
                //$personas= Persona::orderBy('created_at','desc')->Paginate(10);
                $personas= Persona::where('dni',$request->search)->orderBy('created_at','desc')->Paginate(10);

               /* $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })
                    ->whereHas('personaExtraordinario.persona', function($query) use ($request)  {
                        $query->where('dni','=', $request->search);
                    })
                    
                    ->Paginate(10);*/



            break;
            case 'Nombres':
                

                $personas= Persona::where('nombres', 'like', '%'.$request->search.'%')->orderBy('created_at','desc')->Paginate(10);
               // $query->where('nombres', 'like', '%'.$request->search.'%');

            break;

            
            
            default:
                

                $personas= Persona::where('dni',$request->search)->orderBy('created_at','desc')->Paginate(10);
                break;
        }

     
        return $personas;
      
    }



    public function gettProvincia()
    {
        //
      //dd('dentro de_____');
      //$provincia = Provincia::where('estado','=','1')->get();
      //return $provincia;
    }

}
