<?php

namespace App\Http\Controllers;

use App\Models\SuministroRerAtencion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;


use Carbon\Carbon;

class SuministroRerAtencionController extends Controller
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
    public function store(Request $request, SuministroRerAtencion $suministroRerAtencion)
    {
        //dd($request);
        $user = Auth::user();

/////////////////////////////////

        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

         
        $sedeIds = $users->sedes;

        $io = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$io]=$sedeId->id;
            $sedeNombre[$io]=$sedeId->nombre;
       
            $io++;
        }
        //$userSede
//dd($userSede[0]);


        //////////////////////////////


        $fecha_registro = Carbon::now();
        
        



        $suministroRerAtencion = new SuministroRerAtencion();

        $suministroRerAtencion->suministrorer_id=$request->suministrorer_id;
        $suministroRerAtencion->comprobante_id=$request->comprobante_id;

        //$suministroRerAtencion->persona_id=$request->obsTipoExtraordinario_id;

        $suministroRerAtencion->user_id=$user->id;
        $suministroRerAtencion->sede_id=$userSede[0];
       // $suministroRerAtencion->sede_id='2';
        $suministroRerAtencion->fechaRegistro=$fecha_registro;

       // dd($suministroRerAtencion);
        $suministroRerAtencion->save();
        return $suministroRerAtencion;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuministroRerAtencion  $suministroRerAtencion
     * @return \Illuminate\Http\Response
     */
    public function show(SuministroRerAtencion $suministroRerAtencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuministroRerAtencion  $suministroRerAtencion
     * @return \Illuminate\Http\Response
     */
    public function edit(SuministroRerAtencion $suministroRerAtencion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuministroRerAtencion  $suministroRerAtencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuministroRerAtencion $suministroRerAtencion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuministroRerAtencion  $suministroRerAtencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuministroRerAtencion $suministroRerAtencion)
    {
        //
    }
}
