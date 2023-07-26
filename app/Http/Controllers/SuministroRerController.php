<?php

namespace App\Http\Controllers;

use App\Models\SuministroRer;



use Illuminate\Http\Request;

class SuministroRerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SuministroRer::orderBy('Suministro','desc')->take(3)->get();
    }


    public function suministrorerBuscar(Request $request)
    {
       
        $tipoBusqueda = $request->tipoSearch;
      //dd($tipoBusqueda);

        
      



        switch ($tipoBusqueda) {
            case 'dni':
                $suministros = SuministroRer::where([
                    ['dni', '=', $request->search],
                ])->Paginate(15);
                //return $suministros;
            break;

         // $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
         //         ->whereHas('estadoExtraordinario', function($query) use ($user)  {
         //             $query->where('sede_id','=', $user->sede_id);
         //         })->orderBy('created_at','DESC')->Paginate(10);


            case 'Nombres':
                $suministros = SuministroRer::where([
                    ['Nombres', 'like', '%'.$request->search.'%'],
                ])->with('comprobante')->Paginate(15);
            break;
            case 'CodigoUsuario':
                $suministros = SuministroRer::where([
                    ['CodigoUsuario', '=', $request->search],
                ])->Paginate(15);
            break;
            
            default:
                $suministros = SuministroRer::where([
                    ['dni', '=', $request->search],
                ])->Paginate(15);
                break;
        }

    
        return $suministros;
       
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
     * @param  \App\SuministroRer  $suministroRer
     * @return \Illuminate\Http\Response
     */
    public function show(SuministroRer $suministroRer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SuministroRer  $suministroRer
     * @return \Illuminate\Http\Response
     */
    public function edit(SuministroRer $suministroRer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SuministroRer  $suministroRer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SuministroRer $suministroRer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SuministroRer  $suministroRer
     * @return \Illuminate\Http\Response
     */
    public function destroy(SuministroRer $suministroRer)
    {
        //
    }
}
