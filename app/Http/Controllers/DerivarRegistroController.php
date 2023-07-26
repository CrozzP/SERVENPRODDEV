<?php

namespace App\Http\Controllers;

use App\Models\DerivarRegistro;
use App\Models\EstadoExtraordinario;



use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;

class DerivarRegistroController extends Controller
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
    public function tecnicoRegistro(Request $request)
    {
        //dd('holita');
        //$derivarRegistro = DerivarRegistro::with('colaborador')->orderBy('created_at','DESC')->where('estado',1)->get();
        //$derivarRegistro = DerivarRegistro::with('empresaColaborador')->orderBy('created_at','DESC')->where('estado',1)->first();
        //$derivarRegistro = DerivarRegistro::with('empresaColaborador.colaborador')->orderBy('created_at','DESC')->where('estado',1)->paginate(15);

        $user = Auth::user();

        //$estadoExtraordinario = EstadoExtraordinario::where('estado','>=','3')->where('estadot','1')->where('tecnico',$user->id)->paginate(15);
       /*$estadoExtraordinario = EstadoExtraordinario::with('extraordinario.suministro','extraordinario.personaExtraordinario.persona','extraordinario.usuario','extraordinario.obsTipoExtraordinario.tipoExtraordinario')->where('estado','>=','3')->where('estadot','1')->where('tecnico',$user->id)->paginate(15);
        */
        //$estadoExtraordinario = EstadoExtraordinario::where('estado','>=','3')->where('estadot','1')->where('tecnico',2)->paginate(15);

        $derivarRegistro = DerivarRegistro::with('empresaColaborador.colaborador','estadoExtraordinario.extraordinario.suministro','estadoExtraordinario.extraordinario.personaExtraordinario.persona','estadoExtraordinario.extraordinario.usuario','estadoExtraordinario.extraordinario.obsTipoExtraordinario.tipoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user) {
                        //$query->where('sede_id','=', $user->sede_id);
                       // $query->whereIn('user_id', '1');
                        //$query->where('user_id','=', 1);
                        $query->where('estadot','1');
                        $query->where('tecnico', $user->id);
                        //$query->where('estado','>=','3');
                        //$query->whereIn('sede_id', [2,3]);
                    })->orderBy('created_at','DESC')->where('estado','1')->Paginate(20);

        return $derivarRegistro;

        //return $estadoExtraordinario;


        /*$extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user, $userSede)  {
                        //$query->where('sede_id','=', $user->sede_id);
                        $query->whereIn('sede_id', $userSede);
                        //$query->whereIn('sede_id', [2,3]);
                    })->orderBy('created_at','DESC')->Paginate(20);*/



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
    public function store(Request $request)
    {
        //
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
    public function aceptarExtraordinario(Request $request, $id)
    {
        //dd($request);
         $fecha_Aceptado = Carbon::now();

         $estadoExtraordinario = EstadoExtraordinario::find($id);
         $estadoExtraordinario->fechaAceptadoT = $fecha_Aceptado;
         $estadoExtraordinario->estado = 4;

         $estadoExtraordinario->save();

        
         return $estadoExtraordinario;

        //dd('holitas');
    }





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
