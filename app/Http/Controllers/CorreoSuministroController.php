<?php

namespace App\Http\Controllers;

use App\Models\CorreoSuministro;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
Use Mail;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Response;

use App\Models\Sede;
use App\Persona;
use App\Models\Relacion;

use Maatwebsite\Excel\Facades\Excel;

use App\Exports\CorreoSuministroExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;


use PDF;




class CorreoSuministroController extends Controller
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
     * @param  \App\Models\CorreoSuministro  $correoSuministro
     * @return \Illuminate\Http\Response
     */
    public function show(CorreoSuministro $correoSuministro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CorreoSuministro  $correoSuministro
     * @return \Illuminate\Http\Response
     */
    public function edit(CorreoSuministro $correoSuministro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CorreoSuministro  $correoSuministro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CorreoSuministro $correoSuministro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CorreoSuministro  $correoSuministro
     * @return \Illuminate\Http\Response
     */
    public function destroy(CorreoSuministro $correoSuministro)
    {
        //
    }

    public function regCorreoSuministro(Request $request){
      //dd('preubas:', $request);

      
      $user = Auth::user();
      $randomCorreo = Str::random(25);
      $fecha_registro = Carbon::now();

      $hoy = $fecha_registro->format('Y-m-d H:m:s');
      $date = date('Y-m-d');


        $date = Carbon::now();

      //dd('diomio',$request);

      $correoSuministroR = CorreoSuministro::where('suministro_id',$request->CScodigoSuministro)->where('estadoConfirmacion','=',0)->where('estado','=',1)->first();
      if (!empty($correoSuministroR)) {
         $correoSuministroR->estado = 0;
         $correoSuministroR->save();
      }


      $correoSuministro = new CorreoSuministro();

      $correoSuministro->correo = $request->CSemail;
      $correoSuministro->celular = $request->CScelular;
      $correoSuministro->estado = 1;
      $correoSuministro->suministro_id = $request->CScodigoSuministro;
      $correoSuministro->user_id = $user->id;
      $correoSuministro->fechaRegistro = $hoy;
      $correoSuministro->estadoConfirmacion = 0;
      $correoSuministro->codigoConfirmacion = $randomCorreo;
      $correoSuministro->persona_id = $request->CSpersona_id;
      $correoSuministro->relacion_id = $request->idRelacion;
      $correoSuministro->save();

      $correoSum = $request->CSemail;
      $user_email = $user->email;

      $data = array(
         'correoSuministro' => $correoSuministro, 
         'fecha_registro' => $fecha_registro, 
         'correoSum' => $correoSum,
         'user_email' => $user_email,
         'CScodigoSuministro' => $request->CScodigoSuministro,
         'CSnombreSuministro' => $request->CSnombreSuministro,
         'CSdireccionPredio' => $request->CSdireccionPredio,
         'CScodigoRutaSuministro' => $request->CScodigoRutaSuministro,
         'CSpersona_id' => $request->CSpersona_id,
         'CSnombreSuministroR' => $request->CSnombreSuministroR,
         //'idRelacion' => $request->idRelacion,
         'idRelacion' => 'Titular',
          'date' => $date

      );


      $template_path = ('Reportes.confirmar_correoSuministro');
            // NORMAL   
              Mail::send(['html'=> $template_path ], $data, function($message) use ($data, $date) {
                     
               // $message->to($data['correoApto'])->subject('Reporte del dia '.date('Y-m-d').'');

               // $message->to($data['correoSum'] )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
               
                $message->to($data['correoSum']  )->subject('Confirmar correo, fecha - '.date('Y-m-d').$data['correoSuministro']->suministro_id);
                //$message->to('malelementocrozz@gmail.com' )->subject('Confirmar correo, fecha - '.date('Y-m-d').$data['correoSuministro']->suministro_id);
                //$message → cc('email@example.com', 'Mr. Example');
                //$message->cc($data['user_email'], 'Copia - Verificacion');
                $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

               });


      return $correoSuministro;

    }

    public function confCorreoSuministro($code){
      //dd('Dentro de la confirmacion',$code);


      $fecha_confirmacion = Carbon::now();

      $hoy = $fecha_confirmacion->format('Y-m-d H:m:s');

      
      $correoSuministro = CorreoSuministro::where('codigoConfirmacion',$code)->where('estadoConfirmacion','=',0)->where('estado','=',1)->first();

      if (empty($correoSuministro)) return view('Correo.correoSuministro_existe');

      $correoSuministro->estadoConfirmacion = 1;
      $correoSuministro->codigoConfirmacion = null;
      $correoSuministro->fechaConfirmacion = $hoy;
      $correoSuministro->save();
 

      return view('Correo.validadCorreoSuministro', $correoSuministro);


    }

   public function getCorreoSuministro(Request $request){

      $correoSuministro = CorreoSuministro::with('person')->where('suministro_id',$request->codigoSuministro_id)->where('estado','=',1)->first();
      //dd($request, $correoSuministro);


      return $correoSuministro;

   }
   public function editCorreoSuministro(Request $request){
      //dd('xddd', $request);
      
      $user = Auth::user();

      $personas = Persona::where('id', $request->Pid)->first();
      //dd($personas);
      //$persona->dni = $request->personaDni;
      $personas->nombre = $request->Pnombre;
      $personas->apellPat = $request->PapellPat;
      $personas->apellMat = $request->PapellMat;
      $personas->sexo = $request->Psexo;
      $personas->telefono = $request->regCelular;
      //$persona->direccion = $request->personaDireccion;
      $personas->nombres = $request->Pnombre.' '.$request->PapellPat.' '.$request->PapellMat;
      $personas->tipoDocumento_id = $request->PtipoDocumento_id;
      $personas->user_id = $user->id;
      $personas->save();
      
      $correoSuministro = CorreoSuministro::where('id',$request->regId)->where('estado','=',1)->first();

      //////////
      //dd($request, $correoSuministro);
      
      $correoSuministro->estado = 0;

      
      $randomCorreo = Str::random(25);
      $fecha_registro = Carbon::now();

      $hoy = $fecha_registro->format('Y-m-d H:m:s');
      $date = date('Y-m-d');

      $date = Carbon::now();


      if ($correoSuministro->isDirty('estado')) {

         $correoSuministro->save();
         //dd('modificado');

         $correoSuministroNew = new CorreoSuministro();

         $correoSuministroNew->correo = $request->regCorreo;
         $correoSuministroNew->celular = $request->regCelular;
         $correoSuministroNew->estado = 1;
         $correoSuministroNew->suministro_id = $correoSuministro->suministro_id;
         $correoSuministroNew->user_id = $user->id;
         $correoSuministroNew->fechaRegistro = $hoy;
         $correoSuministroNew->estadoConfirmacion = 0;
         $correoSuministroNew->codigoConfirmacion = $randomCorreo;
         $correoSuministroNew->persona_id = $request->Pid;
         $correoSuministroNew->save();



         $correoSum = $correoSuministroNew->correo;
         $user_email = $user->email;

         $data = array(
            'correoSuministro' => $correoSuministroNew, 
            'fecha_registro' => $fecha_registro, 
            'correoSum' => $correoSum,
            'user_email' => $user_email,
            'CScodigoSuministro' => $request->CScodigoSuministro,
            'CSnombreSuministro' => $request->CSnombreSuministro,
            'CSdireccionPredio' => $request->CSdireccionPredio,
            'CScodigoRutaSuministro' => $request->CScodigoRutaSuministro,
             'date' => $date

         );


      $template_path = ('Reportes.confirmar_correoSuministro');
      // NORMAL   
        Mail::send(['html'=> $template_path ], $data, function($message) use ($data, $date) {
               
         // $message->to($data['correoApto'])->subject('Reporte del dia '.date('Y-m-d').'');

         // $message->to($data['correoSum'] )->subject('Reporte del dia '.date('Y-m-d').'...con registro N° '.$data['extraordinarios']->id);
         
          $message->to($data['correoSum']  )->subject('Actualizar correo, fecha - '.date('Y-m-d').$data['correoSuministro']->suministro_id);
          //$message->to('malelementocrozz@gmail.com' )->subject('Confirmar correo, fecha - '.date('Y-m-d').$data['correoSuministro']->suministro_id);
          //$message → cc('email@example.com', 'Mr. Example');
          //$message->cc($data['user_email'], 'Copia - Verificacion');
          $message->from('electropunoseot@gmail.com','Electro Puno S.A.A.');

         });

         return $correoSuministroNew;


      }else{
         //dd('no s emodifico');
         return response(array(
                'message' => 'Existe algun problema,contactare con soporte ',
             ), 233);
      }





    }

   public function formatPdf(Request $request){

     // dd('para imprimir formato pdf', $request);

      $date = date('Y-m-d');


        $date = Carbon::now()->locale('es');
        //dd($date->monthName);

        //$date=$date('America/La_Paz');
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

         $sedes= Sede::where('id','=',$request->IdProvincia)->first();
         $relacion= Relacion::where('id','=',$request->idRelacion)->first();
         //dd('sedes',$sedes);


        $data = array(
         'NombreSuministro' => $request->NombreSuministro,
         'CodigoSuministro' => $request->CodigoSuministro,
         'CodigoRutaSuministro' => $request->CodigoRutaSuministro,
         'Documento' => $request->Documento,
         'DireccionPredio' => $request->DireccionPredio,
         'NombreDepartamento' => $request->NombreDepartamento,
         'NombreProvincia' => $request->NombreProvincia,
         'NombreDistrito' => $request->NombreDistrito,
         'CScelular' => $request->CScelular,
         'CScorreo' => $request->CScorreo,
         //'CSSede' => $request->CSSede,
         'CSSede' => $sedes->nombre,
         'CSRelacion' => $relacion->nombre,
         'CSpersonaDni' => $request->CSpersonaDni,
         'CSnombreSuministroR' => $request->CSnombreSuministroR,

         );

        //$libro = (object)$data;
        //$libroo = json_encode($data);

        //dd($data, $libro, $libroo);


       

        //$pdf = PDF::loadView('myPDF', compact('extraordinarios','date','fecha_actual'))->setPaper('a5','landscape');
        $pdf = PDF::loadView('Reportes.formatoAutorizacionCorreo',
             compact(
               'date',
               'fecha_actual',
               'datetime',
               'data',
            ))->setPaper('A4','portrait');

        //Descargar
        //return $pdf->download('extraordinario.pdf');
        //Visualizar
        return $pdf->download('formatoAutorizacionCorreo.pdf');

   }

   public function cargarAutorizacion(Request $request){

      //dd('diomio', $request->registroid);
      $fecha_actual = Carbon::now();
      $user = Auth::user();


      if ($request->registroid == 'undefined') {
         // code...
         
         return response(array(
                'message' => 'Registre el correo (Verificar correo).',
             ), 442);

      }else{
         //dd('no coincide');
         $correoSuministro = CorreoSuministro::where('id','=',$request->registroid)->first();

         if ($request->file('archivo') && $request->registroestadoarchivo == 0) {
            // code...
            if (Storage::disk('public')->exists('/documentos/autorizacionCorreo/'.$correoSuministro->archivo)) {
                  //dd('se elimiara el archivo');
                  Storage::disk('public')->delete('/documentos/autorizacionCorreo/'.$correoSuministro->archivo);
              }
              //guarda el nuevo archivo
              $nameArchivo = 'AC-'.time().Str::random(20).'.'.$request->archivo->getClientOriginalName();
              $extencionArchivo = '.'.$request->archivo->getClientOriginalExtension();
              $rutaArchivo = '/documentos/autorizacionCorreo/'.$nameArchivo;
              Storage::disk('public')->put($rutaArchivo,  \File::get($request->archivo));

                    
               $correoSuministro->archivo = $nameArchivo;
               $correoSuministro->estadoarchivo = 1;
               $correoSuministro->fecha_cargaarchivo = $fecha_actual;
               $correoSuministro->carga_user_id = $user->id;

               $correoSuministro->save();

               return $correoSuministro;

            //dd('tiene archivos');

         } else{

            //dd('no tiene archivo we');

            
            return response(array(
                'message' => 'La carga de la autorizacion es obligatorio',
             ), 442);

         }




      }



   }

   public function getValidarManual(Request $request){

     // dd("el valor es",$request->registroestadoConfirmacion,"request" ,$request);

      $fecha_actual = Carbon::now();
      $user = Auth::user();

      $correoSuministro = CorreoSuministro::where('id','=',$request->registroid)->first();
      
      $correoSuministro->estadoConfirmacion = $request->registroestadoConfirmacion;
      $correoSuministro->fecha_validmanu = $fecha_actual;
      $correoSuministro->validmanu_user_id = $user->id;
      $correoSuministro->validacionManual = 1;

      $correoSuministro->save();

      return $correoSuministro;

   }


   public function correoSuministroBuscar(Request $request){

      //dd("el valor es",$request);
     
      //$user = Auth::user();


      $fechaHoy = Carbon::now();
    $tipo = $request->tipoBusqueda == null  ? '1' :'2' ;
    //dd('dios',$tipo);

      
   // 

      //dd("el valor es",$request,'fechas',$fechaHoy);

      if (($request->tipoBusqueda == null) || ($request->busquedaEspecifica == 'false')) {
         // code...
         if($request->allSelected == 'true') {
         // todas las sedes
         
             if ($request->fechaBusqueda == 'true') {
            // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                  ->whereDate('created_at','>=',$request->fechaInicio)
                  ->whereDate('created_at', '<=',$request->fechaFinal)
                  ->Paginate(10);
               } else{

                  $correoSuministro = CorreoSuministro::with('suministro','person')
                  ->whereDate('created_at',$fechaHoy)
                  ->Paginate(10);

               }
            
         }else{
            //dd('dentro de else');
            //sedes seleccionadas
            if ($request->fechaBusqueda == 'true') {
               // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                    })
                    ->whereDate('created_at','>=',$request->fechaInicio)
                    ->whereDate('created_at', '<=', $request->fechaFinal)
                    ->Paginate(10);
               } else{
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                    })
                    ->whereDate('created_at',$fechaHoy)
                    ->Paginate(10);

                  }

         }

      }elseif (($request->tipoBusqueda == 'NombreSuministro') && ($request->busquedaEspecifica == 'true')) {
         // code...
         if($request->allSelected == 'true') {
         // todas las sedes
         
             if ($request->fechaBusqueda == 'true') {
            // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where('NombreSuministro','like','%'.$request->datoBusqueda.'%');
                    })
                  ->whereDate('created_at','>=',$request->fechaInicio)
                  ->whereDate('created_at', '<=',$request->fechaFinal)
                  ->Paginate(10);
               } else{

                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where('NombreSuministro','like','%'.$request->datoBusqueda.'%');
                    })
                  ->whereDate('created_at',$fechaHoy)
                  ->Paginate(10);

               }
            
         }else{
            //dd('dentro de else');
            //sedes seleccionadas
            if ($request->fechaBusqueda == 'true') {
               // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                        $query->where('NombreSuministro','like','%'.$request->datoBusqueda.'%');
                    })
                    ->whereDate('created_at','>=',$request->fechaInicio)
                    ->whereDate('created_at', '<=', $request->fechaFinal)
                    ->Paginate(10);
               } else{
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                        $query->where('NombreSuministro','like','%'.$request->datoBusqueda.'%');
                    })
                    ->whereDate('created_at',$fechaHoy)
                    ->Paginate(10);

                  }

         }
      }else{
         if($request->allSelected == 'true') {
         // todas las sedes
         
             if ($request->fechaBusqueda == 'true') {
            // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where($request->tipoBusqueda,'=', $request->datoBusqueda);
                    })
                  ->whereDate('created_at','>=',$request->fechaInicio)
                  ->whereDate('created_at', '<=',$request->fechaFinal)
                  ->Paginate(10);
               } else{

                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where($request->tipoBusqueda,'=', $request->datoBusqueda);
                    })
                  ->whereDate('created_at',$fechaHoy)
                  ->Paginate(10);

               }
            
         }else{
            //dd('dentro de else');
            //sedes seleccionadas
            if ($request->fechaBusqueda == 'true') {
               // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                        $query->where($request->tipoBusqueda,'=', $request->datoBusqueda);
                    })
                    ->whereDate('created_at','>=',$request->fechaInicio)
                    ->whereDate('created_at', '<=', $request->fechaFinal)
                    ->Paginate(10);
               } else{
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                        $query->where($request->tipoBusqueda,'=', $request->datoBusqueda);
                    })
                    ->whereDate('created_at',$fechaHoy)
                    ->Paginate(10);

                  }

         }

      }

   
/*
      if($request->allSelected == 'true') {
         // todas las sedes
         
          if ($request->fechaBusqueda == 'true') {
         // Entre 2 fechas
               $correoSuministro = CorreoSuministro::with('suministro','person')
                 ->whereHas('suministro', function($query) use ($request)  {
                     $query->where($request->tipoBusqueda, $request->datoBusqueda);
                 })
               ->whereDate('created_at','>=',$request->fechaInicio)
               ->whereDate('created_at', '<=',$request->fechaFinal)
               ->get();
            } else{

               $correoSuministro = CorreoSuministro::with('suministro','person')
               ->whereDate('created_at',$fechaHoy)->get();

            }
         
      }else{
         //dd('dentro de else');
         //sedes seleccionadas
         if ($request->fechaBusqueda == 'true') {
            // Entre 2 fechas
               $correoSuministro = CorreoSuministro::with('suministro','person')
                 ->whereHas('suministro', function($query) use ($request)  {
                     $query->whereIn('IdProvincia', $request->sedes);
                 })
                 ->whereDate('created_at','>=',$request->fechaInicio)
                 ->whereDate('created_at', '<=', $request->fechaFinal)
                 ->get();
            } else{
               $correoSuministro = CorreoSuministro::with('suministro','person')
                 ->whereHas('suministro', function($query) use ($request)  {
                     $query->whereIn('IdProvincia', $request->sedes);
                 })
                 ->whereDate('created_at',$fechaHoy)
                 ->get();

               }

      }
      */

     // 2101  puno


     // dd('fecha hoy', $correoSuministro);
      return $correoSuministro;


   }

   public function getCorreoSuministroExport(Request $request){

     // dd("el valor es",$request);
     
      //$user = Auth::user();


      $fechaHoy = Carbon::now();
    $tipo = $request->tipoBusqueda == null  ? '1' :'2' ;
    //dd('dios',$tipo);

      
   // 

      //dd("el valor es",$request,'fechas',$fechaHoy);

      if (($request->tipoBusqueda == null) || ($request->busquedaEspecifica == 'false')) {
         // code...
         if($request->allSelected == 'true') {
         // todas las sedes
         
             if ($request->fechaBusqueda == 'true') {
            // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                  ->whereDate('created_at','>=',$request->fechaInicio)
                  ->whereDate('created_at', '<=',$request->fechaFinal)
                  ->Paginate(10);
               } else{

                  $correoSuministro = CorreoSuministro::with('suministro','person')
                  ->whereDate('created_at',$fechaHoy)
                  ->Paginate(10);

               }
            
         }else{
            //dd('dentro de else');
            //sedes seleccionadas
            if ($request->fechaBusqueda == 'true') {
               // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                    })
                    ->whereDate('created_at','>=',$request->fechaInicio)
                    ->whereDate('created_at', '<=', $request->fechaFinal)
                    ->Paginate(10);
               } else{
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                    })
                    ->whereDate('created_at',$fechaHoy)
                    ->Paginate(10);

                  }

         }

      }elseif (($request->tipoBusqueda == 'NombreSuministro') && ($request->busquedaEspecifica == 'true')) {
         // code...
         if($request->allSelected == 'true') {
         // todas las sedes
         
             if ($request->fechaBusqueda == 'true') {
            // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where('NombreSuministro','like','%'.$request->datoBusqueda.'%');
                    })
                  ->whereDate('created_at','>=',$request->fechaInicio)
                  ->whereDate('created_at', '<=',$request->fechaFinal)
                  ->Paginate(10);
               } else{

                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where('NombreSuministro','like','%'.$request->datoBusqueda.'%');
                    })
                  ->whereDate('created_at',$fechaHoy)
                  ->Paginate(10);

               }
            
         }else{
            //dd('dentro de else');
            //sedes seleccionadas
            if ($request->fechaBusqueda == 'true') {
               // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                        $query->where('NombreSuministro','like','%'.$request->datoBusqueda.'%');
                    })
                    ->whereDate('created_at','>=',$request->fechaInicio)
                    ->whereDate('created_at', '<=', $request->fechaFinal)
                    ->Paginate(10);
               } else{
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                        $query->where('NombreSuministro','like','%'.$request->datoBusqueda.'%');
                    })
                    ->whereDate('created_at',$fechaHoy)
                    ->Paginate(10);

                  }

         }
      }else{
         if($request->allSelected == 'true') {
         // todas las sedes
         
             if ($request->fechaBusqueda == 'true') {
            // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where($request->tipoBusqueda,'=', $request->datoBusqueda);
                    })
                  ->whereDate('created_at','>=',$request->fechaInicio)
                  ->whereDate('created_at', '<=',$request->fechaFinal)
                  ->Paginate(10);
               } else{

                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->where($request->tipoBusqueda,'=', $request->datoBusqueda);
                    })
                  ->whereDate('created_at',$fechaHoy)
                  ->Paginate(10);

               }
            
         }else{
            //dd('dentro de else');
            //sedes seleccionadas
            if ($request->fechaBusqueda == 'true') {
               // Entre 2 fechas
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                        $query->where($request->tipoBusqueda,'=', $request->datoBusqueda);
                    })
                    ->whereDate('created_at','>=',$request->fechaInicio)
                    ->whereDate('created_at', '<=', $request->fechaFinal)
                    ->Paginate(10);
               } else{
                  $correoSuministro = CorreoSuministro::with('suministro','person')
                    ->whereHas('suministro', function($query) use ($request)  {
                        $query->whereIn('IdProvincia', $request->sedes);
                        $query->where($request->tipoBusqueda,'=', $request->datoBusqueda);
                    })
                    ->whereDate('created_at',$fechaHoy)
                    ->Paginate(10);

                  }

         }

      }
      //dd('datos',$correoSuministro);

      return Excel::download(new CorreoSuministroExport($correoSuministro), 'correoSuministro-collection.xlsx');


   }

   public function getGrafico(Request $request){
      //dd('____',$request->allSelected);


      //$sedes = Sede::where('estado','=','1')->get();

      $sedes = Sede::where('estado','=','1')->pluck('nombre');
     // $sedes = Sede::where('estado','=','1')->pluck('nombre','id');
     // $sedes = Sede::select('id','nombre')->where('estado','=','1')->get();
     // $usersOrderedByEmail = $query->reorder('email', 'desc')->get();
     

     

     //$barras= DB::Select('SELECT
     //   s.NombreProvincia as x,
     //   count(s.IdProvincia) as y
     //   from 
     //   elpu3.correosuministro as cs 
     //   inner join elpu3.suministros as s  on cs.suministro_id=s.CodigoSuministro
     //   group by s.NombreProvincia')->orderBy('desc','s.NombreProvincia');

      $barras = DB::table('correosuministro as cs')
                   ->join('suministros as s', 'cs.suministro_id', '=', 's.CodigoSuministro')
                   ->select('s.NombreProvincia as x', DB::raw('count(s.IdProvincia) as y'))
                   
                   ->groupBy('s.NombreProvincia')->get();

$i=0;
$key=0;
$ii=0;

foreach ($barras as $value) {
               // code...
               $sede[$key] = $value->x;
               $pie[$key] = $value->y;
               //$dos[$key]= $value->x == $sedes[$i] ?  'si':'no';
               
               $key++;

            }
      foreach ($sedes as $valuee) {
         // code...
         //$uno[$i] = $value;
        // $dos[$key]= $value->x == $sedes ?  'si':'no';
         //dd('1 for', $valuee);
         $cero[$i] = $valuee;

           if ($cero[$i] == $sede) {
              // code...
           // dd('dios');
           }

            $i++;

      }

       

           /* if ($cero[$i] == $uno) {
                  // code...
                  //$dos[$i]= 'igualk';
                  $dos[$i]= $unoo[$key];
               }else{
                  $dos[$i]= 'no es igual';

               }*/

              // dd('2 for',$uno);

$diferencia = array_diff($cero, $sede);

 
 foreach ($diferencia AS $thisFile) {
      
         $datex[$ii] = $thisFile;

array_push($sede, $thisFile);
          
            $ii++;

      }


//dd($diferencia,$datex);
//dd('agrgados',$uno);
      
//dd('diferencia',$diferencia);
     // dd('sede',$sedes,$barras,$cero,$uno,$diferencia);



/*if ($uno == $sedes) {
   // code...
   dd('igual');
}else{

   dd('no iguakl');
}*/


      //dd('dentro del getGrafico', $barras);
      return [
         'sedes'=> $sede,
         'barras'=> $barras,
         'pie'=> $pie
      ];

      //SEDES TOTAL  listo
      //SUMA DE CANTIDAD DE DATOS ACTUALIZADOS SEGUN SEDES
      //SE DEBERIA DE CONNSIDERAR LIMITES DE FECHAS BEETWEN
      //CONSIDERAR REPORTES MENSUALES
      //CONSIDERAR FECHAS DIARIAS




   }



}
