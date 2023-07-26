<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;


class EventoController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }

    public function getEvento(Request $request){
      //dd('dentro');
      
      $eventos = Evento::with('contenidoEvento.tipoContenido')->where('oficina_id','=',$request->oficina_id)->where('estado','=','1')->orderBy('id','desc')->get();
      //$colaboradores= Colaborador::where('estado','=','1')->orderBy('created_at','desc')->get();
      return $eventos;

    }

    public function regEvento(Request $request){
     // dd('dentro',$request->nombre);
      
     // $eventos = Evento::with('contenidoEvento.tipoContenido')->where('oficina_id','=',$request->oficina_id)->where('estado','=','1')->get();
      $users = Auth::user();

      $eventos = New Evento();
      $eventos->nombre = $request->nombre;
      $eventos->descripcion = $request->descripcion;
      $eventos->estadoevento = 1;
      $eventos->estado = 1;
      $eventos->oficina_id = $request->oficina_id;
      $eventos->user_id = $users->id;
      $eventos->save();

      Return $eventos;


    }

}
