<?php

namespace App\Http\Controllers;

use App\Models\CentroPoblado;
use Illuminate\Http\Request;

class CentroPobladoController extends Controller
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
     * @param  \App\Models\CentroPoblado  $centroPoblado
     * @return \Illuminate\Http\Response
     */
    public function show(CentroPoblado $centroPoblado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CentroPoblado  $centroPoblado
     * @return \Illuminate\Http\Response
     */
    public function edit(CentroPoblado $centroPoblado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CentroPoblado  $centroPoblado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CentroPoblado $centroPoblado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CentroPoblado  $centroPoblado
     * @return \Illuminate\Http\Response
     */
    public function destroy(CentroPoblado $centroPoblado)
    {
        //
    }


    public function getCentroPoblado(Request $request)
    {
        //

      //dd('dentro de_____',$request->provincia_id);
      $centrosPoblados = Centropoblado::where('nombredistrito','=',$request->distrito_id)->where('estado','=','1')->get();
      return $centrosPoblados;
    }
}
