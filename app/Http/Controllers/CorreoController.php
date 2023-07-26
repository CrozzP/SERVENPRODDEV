<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Correo;
use App\User;
use App\Http\Requests\Correo\StoreRequest;
use App\Http\Requests\Correo\UpdateRequest;
use App\Http\Requests\Correo\UpdateHRequest;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Auth;

class CorreoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $correos = Correo::all();
       // $correos Correo::orderBy('created_at','desc')->get();
        //$correos = Correo::with('empresa')->get();
        $correos = Correo::with('empresa')->orderBy('created_at','desc')->get();
        //return Correo::orderBy('created_at','desc')->get();
        return $correos;
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
    public function store(StoreRequest $request)
    {
        //dd($request);

         $correos = new Correo();
            $correos->correo = $request->correo;
            $correos->estado = 0;
            $correos->correoNombre = $request->correoNombre;
            $correos->cargo = $request->cargo;
            $correos->empresa_id = $request->empresa_id;

            //$persona->fechaNacimiento = $request->;
            //$persona->email = $request->;

            $correos->save();

            return $correos;
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
    public function update(UpdateRequest $request, $id)
    {
        //dd($request);
        $correo = Correo::find($request->id);
        //$correo->id = $request->id;
        $correo->cargo = $request->cargo;
        $correo->correo = $request->correo;
        $correo->correoNombre = $request->correoNombre;
        
        $correo->empresa_id = $request->empresa_id;
        //$correo->estado = $request->estado;
        

        $correo->save();
        return $correo;
    }

    public function correoHabilitar(UpdateHRequest $request)
    {
        //dd($request);
        $correo = Correo::find($request->id);
        //$correo->id = $request->id;
       /* $correo->cargo = $request->cargo;
        $correo->correo = $request->correo;
        $correo->correoNombre = $request->correoNombre;
        
        $correo->empresa_id = $request->empresa_id;*/
        $correo->estado = $request->estado;
        

        $correo->save();
        return $correo;
    }

    public function sedesCorreo(Request $request)
    {
        
        //dd($request->idcorreo);
    // $sedesCorreo = DB::select('select * from tipoExtraordinario');

       $sedesCorreos = DB::select('SELECT cs.sede_id as value, s.nombre as text FROM correosede cs
            INNER JOIN sedes s on s.id = cs.sede_id
            WHERE  cs.correo_id = ?', [$request->idcorreo]);


        $i = 0;
        foreach ($sedesCorreos as $sedesCorreo) {
            
            //dd($correo->correo);
           // echo $correo->correo;
            $sedesCorreoAp[$i]=$sedesCorreo->value;
            //return $xd;
            $i++;
        }

        if (empty($sedesCorreos)) {
             return ["datosCorreo" =>$sedesCorreos,
                "Seleccion" => []];
        } else{
             return ["datosCorreo" =>$sedesCorreos,
                "Seleccion" => $sedesCorreoAp];
        }

        /* $sedesCorreos = DB::table('correosede')
            ->select('correosede.sede_id','sedes.nombre')

            ->join('sedes', 'correosede.sede_id', '=', 'sedes.id')

            ->where([
                ['correosede.correo_id', '=', $request->idcorreo],
            ])
            
            ->get();*/

          //  dd($sedesCorreos,$sedesCorreoAp);

       // $obsTipoExtraordinario = DB::select('select * from obsTipoExtraordinario where tipoExtraordinario_id = ?', [$request->tipoExtraordinario_id]);

        //return $sedesCorreos;
       
    }

    public function correoSedes(Request $request,Correo $correo)
    {
        //dd($request->pruebaxd);

       // $user->permissions()->sync($request->permissions);
        


        $correo->sede()->sync($request->pruebaxd);
        
        return $correo;


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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Correo $correos, $id)
    {
       // $this->authorize('delete', $user);
        $correos = Correo::find($id);
        
        $correos->delete();
        return $correos;
       // $correos->delete();
        //alert('Exito','Usuario eliminado','success');
        //return redirect()->route('backoffice.user.index');
       // return $correos;
    }
}
