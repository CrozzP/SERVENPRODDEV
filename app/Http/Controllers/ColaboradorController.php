<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;


use Illuminate\Http\Request;

class ColaboradorController extends Controller
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


    public function listColaborador()
    {
        //

        $colaboradores= Colaborador::where('estado','=','1')->orderBy('created_at','desc')->get();
        //$orientaciones = Orientacion::with('desOrientacion')->where('id','1')->orderBy('created_at','desc')->get();
        return $colaboradores;
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
     * @param  \App\Models\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function show(Colaborador $colaborador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function edit(Colaborador $colaborador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Colaborador $colaborador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Colaborador  $colaborador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Colaborador $colaborador)
    {
        //
    }
}
