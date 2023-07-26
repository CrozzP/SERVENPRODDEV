<?php

namespace App\Http\Controllers;

use App\Models\Organo;
use Illuminate\Http\Request;

class OrganoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $organos = Organo::where('estado','=',1)->orderBy('id','desc')->get();

      return $organos;
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
     * @param  \App\Models\Organo  $organo
     * @return \Illuminate\Http\Response
     */
    public function show(Organo $organo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organo  $organo
     * @return \Illuminate\Http\Response
     */
    public function edit(Organo $organo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organo  $organo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organo $organo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organo  $organo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organo $organo)
    {
        //
    }
}
