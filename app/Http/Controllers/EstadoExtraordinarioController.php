<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\EstadoExtraordinarioImport;
use App\Exports\RegistroExtraordinariosExport;

use App\Models\EstadoExtraordinario;
use App\Models\Extraordinario;
use App\User;

use Redirect;
use PDF;
use Carbon\Carbon;


Use Mail;






class EstadoExtraordinarioController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function cargarArchivoExcel(Request $request)
    {
        //
      //dd('dentro del controlador',$request->archivoPost1);

      //Excel::import(new EstadoExtraordinarioImport,$request->archivoPost1->store('temp'));
      $importar = new EstadoExtraordinarioImport;
      Excel::import($importar, $request->archivoPost1->store('temp'));
      //dd('el resultado es:',$importar->estadoExtraordinario);
      //return $importar;
      return redirect()->back();

    }


    public function getExcelRegistroAtencion(Request $request)
    {
        //
      //dd('dentro del controlador',$request);
      $user = Auth::user();

        $date = date('Y-m-d');
        $date = Carbon::now();


       // dd($user->id);
       // return $user;

       /* $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

        $sedeIds = $users->sedes;*/

       // dd($sedeIds);
      //  return $sedeIds;
        //return $sedeIds[0]->id;


        /*$io = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$io]=$sedeId->id;
           // $sedeNombre[$io]=$sedeId->nombre;
       
            $io++;
        }*/



        $busqueda=$request->tipoExtraordinario_id;

        if ($busqueda == 1) {
            //dd('hola desde 1');
            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id as extraordinario_id','estadoExtraordinarios.id as estadoExtraordinario_id','tipoExtraordinario.nombreTipoExt as tipoRegistro','estadoExtraordinarios.created_at as fechaRegistro','suministros.CodigoRutaSuministro as rutaSuministro', 'suministros.NombreSuministro as nombreSuministro','suministros.CodigoSuministro as codigoSuministro', 'personas.nombres as nombresSolicitante', 'personas.nombre as nombreSolicitante', 'personas.apellPat as apellPatSolicitant', 'personas.apellMat as apellMatSolicitante', 'suministros.DireccionPredio as direccionSuministro', 'personas.telefono as telefonoSolicitante', 'estadoExtraordinarios.referencia as referenciaRegistro', 'suministros.Longitud as longitudSuministro', 'suministros.Latitud as latitudSuministro','obsTipoExtraordinario.descripcion as descripcionRegistro', 'suministros.NombreZonaAdministrativa as zonaAdministrativa','suministros.SerieMedidor as serieMedidor','suministros.NombreTipoSistema as tipoSistema','estadoExtraordinarios.estado as estadoRegistro')
            //->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 1]
                ])
            //->where('estadoExtraordinarios.estadot','=',1)
            ->join('estadoExtraordinarios', function ($join) {
                  $join->on('extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
                       ->where('estadoExtraordinarios.estado', '<>', '5')
                       ->where('estadoExtraordinarios.estadot', '=', '1');
              })
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)

           /* ->where([
               // ['estadoExtraordinarios.sede_id', '=', $user->sede_id]
                ['estadoExtraordinarios.sede_id', '=', $userSede]
                ])*/
            ->whereBetween('estadoExtraordinarios.fechaInicio', [$request->FechaInicio, $request->FechaFinal])
            ->orderBy('extraordinarios.id','desc')
            ->get();
            
        } else if($busqueda == 2){
            //dd('hola desde 2');
            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id as extraordinario_id','estadoExtraordinarios.id as estadoExtraordinario_id','tipoExtraordinario.nombreTipoExt as tipoRegistro','estadoExtraordinarios.created_at as fechaRegistro','suministros.CodigoRutaSuministro as rutaSuministro', 'suministros.NombreSuministro as nombreSuministro','suministros.CodigoSuministro as codigoSuministro', 'personas.nombres as nombresSolicitante', 'personas.nombre as nombreSolicitante', 'personas.apellPat as apellPatSolicitant', 'personas.apellMat as apellMatSolicitante', 'suministros.DireccionPredio as direccionSuministro', 'personas.telefono as telefonoSolicitante', 'estadoExtraordinarios.referencia as referenciaRegistro', 'suministros.Longitud as longitudSuministro', 'suministros.Latitud as latitudSuministro','obsTipoExtraordinario.descripcion as descripcionRegistro', 'suministros.NombreZonaAdministrativa as zonaAdministrativa','suministros.SerieMedidor as serieMedidor','suministros.NombreTipoSistema as tipoSistema','estadoExtraordinarios.estado as estadoRegistro')
            //->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 2]
                ])
            //->where('estadoExtraordinarios.estadot','=',1)
            ->join('estadoExtraordinarios', function ($join) {
                  $join->on('extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
                       ->where('estadoExtraordinarios.estado', '<>', '5')
                       ->where('estadoExtraordinarios.estadot', '=', '1');
              })
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)
           /* ->where([
               // ['estadoExtraordinarios.sede_id', '=', $user->sede_id]
                ['estadoExtraordinarios.sede_id', '=', $userSede]
                ])*/
            ->whereBetween('estadoExtraordinarios.fechaInicio', [$request->FechaInicio, $request->FechaFinal])
            ->orderBy('extraordinarios.id','desc')
            ->get();

        }else {
//dd('hola desde 3');

        $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id as extraordinario_id','estadoExtraordinarios.id as estadoExtraordinario_id','tipoExtraordinario.nombreTipoExt as tipoRegistro','estadoExtraordinarios.created_at as fechaRegistro','suministros.CodigoRutaSuministro as rutaSuministro', 'suministros.NombreSuministro as nombreSuministro','suministros.CodigoSuministro as codigoSuministro', 'personas.nombres as nombresSolicitante', 'personas.nombre as nombreSolicitante', 'personas.apellPat as apellPatSolicitant', 'personas.apellMat as apellMatSolicitante', 'suministros.DireccionPredio as direccionSuministro', 'personas.telefono as telefonoSolicitante', 'estadoExtraordinarios.referencia as referenciaRegistro', 'suministros.Longitud as longitudSuministro', 'suministros.Latitud as latitudSuministro','obsTipoExtraordinario.descripcion as descripcionRegistro', 'suministros.NombreZonaAdministrativa as zonaAdministrativa','suministros.SerieMedidor as serieMedidor','suministros.NombreTipoSistema as tipoSistema','estadoExtraordinarios.estado as estadoRegistro')
            //->select('*')
            //->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            //->rightJoin('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')


              ->join('estadoExtraordinarios', function ($join) {
                  $join->on('extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
                       ->where('estadoExtraordinarios.estado', '<>', '5')
                       ->where('estadoExtraordinarios.estadot', '=', '1');
              })


            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')


           /* ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', $request->tipoExtraordinario_id]
                ])
            */


            ->whereIn('obsTipoExtraordinario.tipoExtraordinario_id', [1,2])
            //->where('extraordinarios.id','=','4573')
            
           // ->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)


           /* ->where([
               // ['estadoExtraordinarios.sede_id', '=', $user->sede_id]
                ['estadoExtraordinarios.sede_id', '=', $userSede]
                ])*/

            ->whereBetween('estadoExtraordinarios.fechaInicio', [$request->FechaInicio, $request->FechaFinal])
            ->orderBy('extraordinarios.id','desc')
            ->get();
        }


        //dd('respuesta', $extraordinarios);

       // return Excel::download(new ExtraordinariosExport($extraordinarios,$date), 'extraordinarios-collection.xlsx');
        return Excel::download(new RegistroExtraordinariosExport($extraordinarios,$date), 'registroExtraordinarios.xlsx');


    }

   public function getMailRegistroExtraordinarioFiltro( Request $request){

     // dd('dentro del get mail',$request);
      //REALIZAR MODIFICACIONES PARA LA EMISION DE CORREO EN CONJUNTO CON EL REPORTE


      $user = Auth::user();
       // dd($user->id);
       // return $user;

        $users = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id',$user->id)->first();

         $user_email = $users->email;
         
        $sedeIds = $users->sedes;

      //  dd($sedeIds);
      //  return $sedeIds;
        //return $sedeIds[0]->id;

        $io = 0;
        foreach ($sedeIds as $sedeId) {

            $userSede[$io]=$sedeId->id;
            $sedeNombre[$io]=$sedeId->nombre;
       
            $io++;
        }

        $sedeNombres = implode('-',$sedeNombre);
        //dd('_______',$userSede,$sedeNombres);

        //dd($user->sede_id);


            $correos = DB::table('correos')
                ->select('correos.correo', 'correosede.sede_id')

                ->join('correosede', 'correosede.correo_id', '=', 'correos.id')
                ->whereIn('correosede.sede_id', $userSede)
               // ->whereIn('correosede.sede_id', $request->sedes)

                ->where([
                   // ['correosede.sede_id', '=', $user->sede_id],
                    ['correos.estado', '=', '1'],
                ])
                
                ->get();




        //dd($correo->correo);
        $i = 0;
        foreach ($correos as $correo) {
            
            //dd($correo->correo);
           // echo $correo->correo;
            $correoApto[$i]=$correo->correo;
            //return $xd;
            $i++;
        }
         
      //dd($correoApto);
       
        $date = date('Y-m-d');
        $date = Carbon::now();

        $busqueda=$request->tipoExtraordinario_id;



        if ($busqueda == 1) {
            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id as extraordinario_id','estadoExtraordinarios.id as estadoExtraordinario_id','tipoExtraordinario.nombreTipoExt as tipoRegistro','estadoExtraordinarios.created_at as fechaRegistro','suministros.CodigoRutaSuministro as rutaSuministro', 'suministros.NombreSuministro as nombreSuministro','suministros.CodigoSuministro as codigoSuministro', 'personas.nombres as nombresSolicitante', 'personas.nombre as nombreSolicitante', 'personas.apellPat as apellPatSolicitant', 'personas.apellMat as apellMatSolicitante', 'suministros.DireccionPredio as direccionSuministro', 'personas.telefono as telefonoSolicitante', 'estadoExtraordinarios.referencia as referenciaRegistro', 'suministros.Longitud as longitudSuministro', 'suministros.Latitud as latitudSuministro','obsTipoExtraordinario.descripcion as descripcionRegistro', 'suministros.NombreZonaAdministrativa as zonaAdministrativa','suministros.SerieMedidor as serieMedidor','suministros.NombreTipoSistema as tipoSistema','estadoExtraordinarios.estado as estadoRegistro')

            //->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('estadoExtraordinarios', function ($join) {
                  $join->on('extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
                       ->where('estadoExtraordinarios.estado', '<>', '5')
                       ->where('estadoExtraordinarios.estadot', '=', '1');
              })
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
       
            //->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)

            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 1],
                ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio],
                ['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            ->orderBy('extraordinarios.id','desc')
            
            ->get();
        }else if ($busqueda == 2) {
            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id as extraordinario_id','estadoExtraordinarios.id as estadoExtraordinario_id','tipoExtraordinario.nombreTipoExt as tipoRegistro','estadoExtraordinarios.created_at as fechaRegistro','suministros.CodigoRutaSuministro as rutaSuministro', 'suministros.NombreSuministro as nombreSuministro','suministros.CodigoSuministro as codigoSuministro', 'personas.nombres as nombresSolicitante', 'personas.nombre as nombreSolicitante', 'personas.apellPat as apellPatSolicitant', 'personas.apellMat as apellMatSolicitante', 'suministros.DireccionPredio as direccionSuministro', 'personas.telefono as telefonoSolicitante', 'estadoExtraordinarios.referencia as referenciaRegistro', 'suministros.Longitud as longitudSuministro', 'suministros.Latitud as latitudSuministro','obsTipoExtraordinario.descripcion as descripcionRegistro', 'suministros.NombreZonaAdministrativa as zonaAdministrativa','suministros.SerieMedidor as serieMedidor','suministros.NombreTipoSistema as tipoSistema','estadoExtraordinarios.estado as estadoRegistro')

            //->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('estadoExtraordinarios', function ($join) {
                  $join->on('extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
                       ->where('estadoExtraordinarios.estado', '<>', '5')
                       ->where('estadoExtraordinarios.estadot', '=', '1');
              })
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
   
            //->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)

            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 2],
                ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio],
                ['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            ->orderBy('extraordinarios.id','desc')
            
            ->get();
        }else {

            $extraordinarios = DB::table('extraordinarios')
            ->select('extraordinarios.id as extraordinario_id','estadoExtraordinarios.id as estadoExtraordinario_id','tipoExtraordinario.nombreTipoExt as tipoRegistro','estadoExtraordinarios.created_at as fechaRegistro','suministros.CodigoRutaSuministro as rutaSuministro', 'suministros.NombreSuministro as nombreSuministro','suministros.CodigoSuministro as codigoSuministro', 'personas.nombres as nombresSolicitante', 'personas.nombre as nombreSolicitante', 'personas.apellPat as apellPatSolicitant', 'personas.apellMat as apellMatSolicitante', 'suministros.DireccionPredio as direccionSuministro', 'personas.telefono as telefonoSolicitante', 'estadoExtraordinarios.referencia as referenciaRegistro', 'suministros.Longitud as longitudSuministro', 'suministros.Latitud as latitudSuministro','obsTipoExtraordinario.descripcion as descripcionRegistro', 'suministros.NombreZonaAdministrativa as zonaAdministrativa','suministros.SerieMedidor as serieMedidor','suministros.NombreTipoSistema as tipoSistema','estadoExtraordinarios.estado as estadoRegistro')

            //->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('estadoExtraordinarios', function ($join) {
                  $join->on('extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
                       ->where('estadoExtraordinarios.estado', '<>', '5')
                       ->where('estadoExtraordinarios.estadot', '=', '1');
              })
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
      
            //->where('estadoExtraordinarios.estadot','=',1)
            ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)
            ->whereIn('obsTipoExtraordinario.tipoExtraordinario_id', [1,2])

            ->where([
          
                ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio],
                ['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            ->orderBy('extraordinarios.id','desc')
            
            ->get();
        }
       



            $data = array('extraordinarios' => $extraordinarios, 'date' => $date, 'user_email' => $user_email);
            $template_path = ('Correo.email_ResgistroExtraordinario');

            //$excel = Excel::download(new ExtraordinariosExport($extraordinarios,$date),'extraordinarios-collection.xlsx')->getFile();
            $excel = Excel::download(new RegistroExtraordinariosExport($extraordinarios,$date), 'registroExtraordinarios.xlsx')->getFile();

   

          //  Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$correoApto, $sedeNombres) {
            Mail::send(['html'=> $template_path ], $data, function($message) use ($data,$correoApto, $sedeNombres, $excel) {
               
               
                $message->to('malelementocrozz@gmail.com')->subject('Reporte del dia '.date('Y-m-d').'  De la Sede: '.$sedeNombres.'');
                //$message->to('rer@electropuno.com.pe')->subject('Reporte del dia '.date('Y-m-d').'  De la Sede: '.$sedeNombres.'');

                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

                $message->attach($excel, ['as' => 'extraordinarios-collection.xlsx']);
             
            });






   }

}
