<?php

namespace App\Http\Controllers;

use App\Models\Orientacion;
use Illuminate\Http\Request;

class OrientacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$orientaciones = Orientacion::orderBy('created_at','desc')->get();
        $orientaciones = Orientacion::with('desOrientacion')->orderBy('created_at','desc')->get();
        //$orientaciones = Orientacion::with('desOrientacion')->where('id','1')->orderBy('created_at','desc')->get();
        return $orientaciones;

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
     * @param  \App\Models\Orientacion  $orientacion
     * @return \Illuminate\Http\Response
     */
    public function show(Orientacion $orientacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Orientacion  $orientacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Orientacion $orientacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Orientacion  $orientacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orientacion $orientacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Orientacion  $orientacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orientacion $orientacion)
    {
        //
    }
}
