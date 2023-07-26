<?php

namespace App\Http\Controllers;

use App\Models\TipoAtencion;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TipoAtencionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoAtencion = TipoAtencion::all();
        return $tipoAtencion;
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
        dd($request);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function show(Atencion $atencion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function edit(Atencion $atencion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atencion $atencion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Atencion  $atencion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atencion $atencion)
    {
        //
    }
}
