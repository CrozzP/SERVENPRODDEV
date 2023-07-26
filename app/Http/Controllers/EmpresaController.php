<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Empresa;
use App\Models\Sede;

use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        //$empresas Correo::orderBy('id','desc')->get();
        return $empresas;
    }


    public function getSede(Request $request)
    {

        //dd($request);
       // $sedes = Sede::where('empresa_id',$request->empresa_id)->get();
        //$empresas Correo::orderBy('id','desc')->get();

        $sedes = DB::select('SELECT s.id ,s.nombre FROM sedeempresa se
        INNER JOIN sedes s on se.sede_id=s.id
        WHERE se.empresa_id=?', [$request->empresa_id]);

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
    public function store(Empresa $empresas, Request $request)
    {
        //
        //dd($request);

         $empresas->nombreEmpresa=$request->nombreEmpresa;
        //$sede->empresa_id=$request->obsTipoExtraordinario_id;
        $empresas->estado='0';
        $empresas->save();

        return $empresas;
    }

    public function empresaHabilitar(Request $request){

        //dd($request);

        $empresas = Empresa::find($request->id);
        //$sede->id = $request->id;
       /* $sede->cargo = $request->cargo;
        $sede->sede = $request->sede;
        $sede->sedeNombre = $request->sedeNombre;
        
        $sede->empresa_id = $request->empresa_id;*/
        $empresas->estado = $request->estado;
        

        $empresas->save();
        return $empresas;
    }

     public function getEmpresaSede(Request $request)
    {
       // dd($request);
      //  $sedes = Sede::where('estado','=',"1")->get();

        $sedes = DB::select('SELECT id as value, nombre as text FROM sedes
            
            WHERE  estado = 1');

       // $sedes = Sede::where('estado', $request->personaDni)->first();

       // $sedes = Sede::all();
        //$empresas Correo::orderBy('id','desc')->get();
        return $sedes;
    }

    public function empresaSedes(Request $request,Empresa $empresa)
    {
        //dd($request);

       // $user->permissions()->sync($request->permissions);
        


        $empresa->sede()->sync($request->pruebaxd);
        
        return $empresa;


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


       public function sedeEmpresa(Request $request)
    {
     // dd($request);
      //  $sedes = Sede::where('estado','=',"1")->get();
        
        // $sedeEmpresas = DB::select('SELECT se.sede_id as value,s.nombre as text from sedes s 
        //    INNER JOIN sedeempresa se on s.id = se.sede_id
        //    WHERE  se.empresa_id = ?', [$request->idempresa]);

         $sedeEmpresas = DB::select('SELECT se.empresa_id as value,e.nombreEmpresa as text from empresa e 
            INNER JOIN sedeempresa se on e.id = se.empresa_id
            WHERE  se.sede_id = ?', [$request->idsede]);
//dd($sedeEmpresas);
       //$sedesCorreos = DB::select('SELECT cs.sede_id as value, s.nombre as text FROM elputest.sedeempresa cs
       //    INNER JOIN sedes s on s.id = cs.sede_id
       //    WHERE  cs.correo_id = ?', [$request->idsede]);
//dd($sedeEmpresas);

        $i = 0;
        foreach ($sedeEmpresas as $sedeEmpresa) {
            
            //dd($correo->correo);
           // echo $correo->correo;
            $sedesCorreoAp[$i]=$sedeEmpresa->value;
            //return $xd;
            $i++;
        }

        if (empty($sedeEmpresas)) {
             return ["datosCorreo" =>$sedeEmpresas,
                "Seleccion" => []];
        } else{
             return ["datosCorreo" =>$sedeEmpresas,
                "Seleccion" => $sedesCorreoAp];
        }

       // $sedes = Sede::where('estado', $request->personaDni)->first();

       // $sedes = Sede::all();
        //$empresas Correo::orderBy('id','desc')->get();
       // return $sedes;
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

        $empresas = Empresa::find($request->id);

        $empresas->nombreEmpresa = $request->nombreEmpresa;

        $empresas->save();
        return $empresas;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresas, $id)
    {
        //

         $empresas = Empresa::find($id);
        
        $empresas->delete();
        return $empresas;
    }
}
