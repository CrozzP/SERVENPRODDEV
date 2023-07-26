<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Sede;
use Illuminate\Support\Facades\Auth;



class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $sedes = Sede::where('estado','=',"1")->get();

       // $sedes = DB::select('SELECT id as value, nombre as text FROM sedes
            
         //   WHERE  estado = 1');

       // $sedes = Sede::where('estado', $request->personaDni)->first();

        $sedes = Sede::all();
        //$empresas Correo::orderBy('id','desc')->get();
        return $sedes;
    }

    public function getSedeEmpresa(Request $request)
    {
       // dd($request);
      //  $sedes = Sede::where('estado','=',"1")->get();

        $empresas = DB::select('SELECT id as value, nombreEmpresa as text FROM empresa
            
            WHERE  estado = 1');

       // $sedes = Sede::where('estado', $request->personaDni)->first();

       // $sedes = Sede::all();
        //$empresas Correo::orderBy('id','desc')->get();
        return $empresas;
    }

    
    public function sedeEmpresas(Request $request,Sede $sede)
    {
        //dd($request);

       // $user->permissions()->sync($request->permissions);
        


        $sede->empresa()->sync($request->pruebaxd);
        
        return $sede;


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


       public function empresaSede(Request $request)
    {
      // dd($request);
      //  $sedes = Sede::where('estado','=',"1")->get();
         $sedeEmpresas = DB::select('SELECT se.sede_id as value,s.nombre as text from sedes s 
            INNER JOIN sedeempresa se on s.id = se.sede_id
            WHERE  se.empresa_id = ?', [$request->idempresa]);



       //$sedeEmpresa = DB::select('SELECT se.sede_id as value, s.nombre as text FROM elputest.sedeempresa se
       //    INNER JOIN sedes s on s.id = se.sede_id
       //    WHERE  se.empresa_id = ?', [$request->idempresa]);


        $i = 0;
        foreach ($sedeEmpresas as $sedeEmpresa) {
            
            //dd($correo->correo);
           // echo $correo->correo;
            $sedeEmpresaAp[$i]=$sedeEmpresa->value;
            //return $xd;
            $i++;
        }

        if (empty($sedeEmpresas)) {
             return ["datossede" =>$sedeEmpresas,
                "Seleccion" => []];
        } else{
             return ["datossede" =>$sedeEmpresas,
                "Seleccion" => $sedeEmpresaAp];
        }

       // $sedes = Sede::where('estado', $request->personaDni)->first();

       // $sedes = Sede::all();
        //$empresas Correo::orderBy('id','desc')->get();
       // return $sedeEmpresas;
    }

 


    public function getSedeFiltro(Request $request)
    {
       //dd($request);
        $sedes = Sede::where('estado','=',"1")->get();

     //   $sedes = DB::select('SELECT id as value, nombre as text FROM sedes
            
           // WHERE  estado = 1');

      //  $sedes = Sede::where('estado', '1')->first();

       // $sedes = Sede::all();
        //$empresas Correo::orderBy('id','desc')->get();
        return $sedes;
    }

    public function getSedes(Request $request)
    {
       //dd($request);
        

        $sedes = DB::select('SELECT id as value, nombre as text from sedes WHERE  estado = 1');
       /* $sedes = Sede::where('estado','=',"1")->get();

        $io = 0;
        foreach ($sedes as $sede) {

            $userSede[$io]=$sede->nombre;
            $userSedeId[$io]=$sede->id;
       
            $io++;
        }
        return [$userSede, $userSedeId];*/
        return $sedes;


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
    public function store(Sede $sedes,Request $request)
    {
        //dd($request);

        $sedes->nombre=$request->nombre;
        //$sede->empresa_id=$request->obsTipoExtraordinario_id;
        $sedes->estado='0';
        $sedes->save();

        return $sede;

    }

    public function sedeHabilitar(Request $request){

        //dd($request);

        $sede = Sede::find($request->id);
        //$sede->id = $request->id;
       /* $sede->cargo = $request->cargo;
        $sede->sede = $request->sede;
        $sede->sedeNombre = $request->sedeNombre;
        
        $sede->empresa_id = $request->empresa_id;*/
        $sede->estado = $request->estado;
        

        $sede->save();
        return $sede;
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
        

//dd($request);
       

        $sedes = Sede::find($request->id);

        $sedes->nombre = $request->nombre;

        $sedes->save();
        return $sedes;



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sede $sedes, $id)
    {
        //
        //dd($id);

          $sedes = Sede::find($id);
        
        $sedes->delete();
        return $sedes;

    }

   


}
