<?php

namespace App\Http\Controllers;

use App\Models\UnidadOrganica;
use Illuminate\Http\Request;

class UnidadOrganicaController extends Controller
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
     * @param  \App\Models\UnidadOrganica  $unidadOrganica
     * @return \Illuminate\Http\Response
     */
    public function show(UnidadOrganica $unidadOrganica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnidadOrganica  $unidadOrganica
     * @return \Illuminate\Http\Response
     */
    public function edit(UnidadOrganica $unidadOrganica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnidadOrganica  $unidadOrganica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnidadOrganica $unidadOrganica)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnidadOrganica  $unidadOrganica
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnidadOrganica $unidadOrganica)
    {
        //
    }

    public function getUnidadesOrganicas(Request $request){
      //dd('dentro del getUnidadesOrganicas');

      $unidadesOrganicas = UnidadOrganica::where('organo_id','=',$request->organo_id)->where('estado','=',1)->orderBy('id','asc')->get();
      return $unidadesOrganicas;

    }
}
