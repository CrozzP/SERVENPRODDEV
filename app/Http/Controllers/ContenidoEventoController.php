<?php

namespace App\Http\Controllers;

use App\Models\ContenidoEvento;
use Illuminate\Http\Request;

class ContenidoEventoController extends Controller
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
     * @param  \App\Models\ContenidoEvento  $contenidoEvento
     * @return \Illuminate\Http\Response
     */
    public function show(ContenidoEvento $contenidoEvento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContenidoEvento  $contenidoEvento
     * @return \Illuminate\Http\Response
     */
    public function edit(ContenidoEvento $contenidoEvento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContenidoEvento  $contenidoEvento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContenidoEvento $contenidoEvento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContenidoEvento  $contenidoEvento
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContenidoEvento $contenidoEvento)
    {
        //
    }

    public function descargarContenido(Request $request, $id){
     // dd('prueb<s', $request->id);

       $contenidoevento = ContenidoEvento::findorfail($id);

        //$documento = Documento::findorfail($id);

        //$file=public_path().'/storage/repositorio/atendido/A1-1649258786YgliW7wfUH8hnjENaMcC.ViewReport (1).pdf';
        //$file=public_path().'/storage/repositorio/atendido/'.$documento->archivo;

       

       switch ($contenidoevento->tipocontenido_id) {
          case '1':
             // code...
               $file=public_path().'/storage/aprende/pdf/'.$contenidoevento->archivo;
             break;
         case '2':
            // code...
         $file=public_path().'/storage/aprende/word/'.$contenidoevento->archivo;
            break;
         case '3':
               // code...
         $file=public_path().'/storage/aprende/excel/'.$contenidoevento->archivo;
            break;
         case '4':
               // code...
            $file=public_path().'/storage/aprende/powerpoint/'.$contenidoevento->archivo;
               break;
         case '5':
               // code...
            $file=public_path().'/storage/aprende/csv/'.$contenidoevento->archivo;
               break;
          
          default:
             // code...
             break;
       }
       // dd('respuesta',$file);
        $headers = [
            'Content-Type' => 'multipart/pdf',
        ];
        $diomio = $contenidoevento->archivo;


        return response()->download($file, $diomio, $headers);


    }



}
