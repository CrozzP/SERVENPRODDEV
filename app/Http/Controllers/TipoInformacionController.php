<?php

namespace App\Http\Controllers;

use App\Models\TipoInformacion;
use Illuminate\Http\Request;

class TipoInformacionController extends Controller
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
    public function getTipoInformacion(Request $request)
    {
        //
      //dd('dentro de la prueba');
      $tipoInformacion = TipoInformacion::where('estado','=','1')->orderBy('id','desc')->get();
      return $tipoInformacion;

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoInformacion  $tipoInformacion
     * @return \Illuminate\Http\Response
     */
    public function show(TipoInformacion $tipoInformacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoInformacion  $tipoInformacion
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoInformacion $tipoInformacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoInformacion  $tipoInformacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoInformacion $tipoInformacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoInformacion  $tipoInformacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoInformacion $tipoInformacion)
    {
        //
    }
}
