<?php

namespace App\Http\Controllers;

use App\Models\TestImport;
use Illuminate\Http\Request;

//use App\Exports\MoviesExport; 
use App\Imports\TestImportIn;
use App\Imports\ActualizaCarga;

use App\Imports\EstadoExtraordinarioImport;

use Maatwebsite\Excel\Facades\Excel;


class TestImportController extends Controller
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
     * @param  \App\Models\TestImport  $testImport
     * @return \Illuminate\Http\Response
     */
    public function show(TestImport $testImport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TestImport  $testImport
     * @return \Illuminate\Http\Response
     */
    public function edit(TestImport $testImport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TestImport  $testImport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TestImport $testImport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TestImport  $testImport
     * @return \Illuminate\Http\Response
     */
    public function destroy(TestImport $testImport)
    {
        //
    }

    public function import(Request $request)
    {
        if(request()->hasFile('file')) {
            Excel::import(new TestImportIn, request()->file('file')->store('temp'));
        }
        return redirect()->back();
    }


    public function importInsertUpdate(Request $request)
    {
      //dd('dentro del controlador',$request->archivoPost1);
           Excel::import(new ActualizaCarga,$request->archivoPost1->store('temp'));
        /*if(request()->hasFile($request->archivoPost1)) {
            Excel::import(new ActualizaCarga, request()->file($request->archivoPost1)->store('temp'));
        }*/
        return redirect()->back();
    }



    public function cargarArchivoExcel(Request $request)
    {
     //dd('dentro del controlador');
      //dd('dentro del controlador',$request->archivoPost1);
         Excel::import(new EstadoExtraordinarioImport,$request->archivoPost1->store('temp'));
         //Excel::import(new ActualizaCargaEE,$request->archivoPost1->store('temp'));

         


        /*if(request()->hasFile($request->archivoPost1)) {
            Excel::import(new ActualizaCarga, request()->file($request->archivoPost1)->store('temp'));
        }*/
        //return $gg;
        //dd($this->Excel);
        //return back();
        //return $xd;
        //return redirect()->back();
    }


}
