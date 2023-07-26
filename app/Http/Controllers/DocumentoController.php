<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;


use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

use App\Models\TareaReporteColaborador;
use App\Models\Tarea;
use App\Models\TareaPeriodo;



class DocumentoController extends Controller
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
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Documento $documento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        //
    }

    public function regDocumento(Request $request, Documento $documento)
    {
       // dd('dentro de Request $request',$request);
            $fecha_hoy = Carbon::now();

            
         
            $documentos = Documento::where('tareareportecolaborador_id',$request->tareareportecolaborador_id)->where('estado',1)->first();
            if (!empty($documentos)) {

                if ($request->file('archivo')) {
                   if (Storage::disk('public')->exists('/repositorio/atendido/'.$documentos->archivo)) {
                        //dd('se elimiara el archivo');
                        Storage::disk('public')->delete('/repositorio/atendido/'.$documentos->archivo);
                    }
                    //guarda el nuevo archivo
                    $nameArchivo = 'A1-'.time().Str::random(20).'.'.$request->archivo->getClientOriginalName();
                    $extencionArchivo = '.'.$request->archivo->getClientOriginalExtension();
                    $rutaArchivo = '/repositorio/atendido/'.$nameArchivo;
                    Storage::disk('public')->put($rutaArchivo,  \File::get($request->archivo));

                    


                } else{
                    //$nameArchivo =$documentos->archivo;
                    //dd('else');
                    return Response::json([
                        'El archivo es obligatorio'
                    ], 442);
                }

                   // $documentos->tareareportecolaborador_id=$request->tareareportecolaborador_id;
                    $documentos->archivo=$nameArchivo;
                    $documentos->estadoarchivo=0;
                    $documentos->estado=1;
                    $documentos->nombre='T'.$request->dt_tr_tarea.'_R'.$request->dt_tr_reporte.'_'.$request->dt_tr_periodonombre.''.$extencionArchivo;
                    $documentos->save();
                    $documentos->extencion = pathinfo($documentos->archivo, PATHINFO_EXTENSION);

                    $tareareportecolaborador = TareaReporteColaborador::find($request->tareareportecolaborador_id);
                    $tareareportecolaborador->estado = '2';
                    $tareareportecolaborador->fechaatencion = $fecha_hoy;
                    $tareareportecolaborador->fechaatencionh = $fecha_hoy;
                    $tareareportecolaborador->save();

                   // $tarea= Tarea::find($request->dt_tr_tarea);
                   // $tarea->totalatendido = $tarea->totalatendido + 1;
                   // $tarea->save();

                   // return $documentos;
                    return [
                        'documentos' => $documentos,
                        'tareareportecolaborador' => $tareareportecolaborador,
                    ];

            } else{
                $nameArchivo = 'A1-'.time().Str::random(20).'.'.$request->archivo->getClientOriginalName();
                $extencionArchivo = '.'.$request->archivo->getClientOriginalExtension();
                $rutaArchivo = '/repositorio/atendido/'.$nameArchivo;
                Storage::disk('public')->put($rutaArchivo,  \File::get($request->archivo));
               //dd($nameArchivoPre1,$rutaArchivo);
                $documento = new Documento();
                $documento->tareareportecolaborador_id=$request->tareareportecolaborador_id;
                $documento->archivo=$nameArchivo;
                $documento->estadoarchivo=0;
                $documento->estado=1;
                $documento->nombre='T'.$request->dt_tr_tarea.'_R'.$request->dt_tr_reporte.'_'.$request->dt_tr_periodonombre.''.$extencionArchivo;
                $documento->save();
                $documento->extencion = pathinfo($documento->archivo, PATHINFO_EXTENSION);

                $tareareportecolaborador = TareaReporteColaborador::find($request->tareareportecolaborador_id);
                $tareareportecolaborador->estado = '2';
                $tareareportecolaborador->fechaatencion = $fecha_hoy;
                $tareareportecolaborador->fechaatencionh = $fecha_hoy;
                $tareareportecolaborador->save();

               // $tarea= Tarea::find($request->dt_tr_tarea);
               // $tarea->totalatendido = $tarea->totalatendido + 1;
               // $tarea->save();

                // return $documentos;
                    return [
                        'documentos' => $documento,
                        'tareareportecolaborador' => $tareareportecolaborador,
                    ];
            }

/*
$tarea =Tarea::find($request->tarea_id);
                        $tarea->totalasignado = $tarea->totalasignado + 1;
                        $tarea->save();
*/
    }



    public function documentoReporte(Request $request)
    {
        //
        //dd('dentro de  la solicitud',$request);
        $user = Auth::user();
        $roles ='administrador';
       
        //$i = 0;
        //    foreach ($user as $u) {
        //       $xd = $user->id;
        //    }
        //dd($user->roles);
        $users = new User;
        $users->id = $user->id;
        $users->email = $user->email;
        $users->fullName = $user->fullName;

        if ($user->has_role($roles) == true) {
         $users->roleAd = 1;
        }else{
         $users->roleAd = 0;
        }


        $documento = Documento::where('tareareportecolaborador_id','=',$request->trc_id)->where('estado','=',1)->orderBy('id','desc')->first();
        //$documento->otro = getExtention('some-funny.image.jpg');

        if (!empty($documento)) {
            // code...
        $documento->extencion = pathinfo($documento->archivo, PATHINFO_EXTENSION);
       // $documento->doc = Storage::download('file.jpg');
      ///  $documento->doc = Storage::disk('public')->download('/repositorio/atendido/'.$documento->archivo);
        //(Storage::disk('public')->exists('/repositorio/atendido/'.$documentos->archivo))
        //Storage::disk('public')->download('/repositorio/atendido/'.$documento->archivo)


        //return $documento;
        return ['documento' =>$documento, 'users' => $users];
        } else{
            $documento = [];
            return ['documento' =>$documento, 'users' => $users];
            //return [];
        }
        //dd($documento);

    }


    public function getHabilitar(Request $request)
    {
      //dd($request);

        $fecha_hoy = Carbon::now();


        $documento = Documento::where('tareareportecolaborador_id','=',$request->trc_id)->where('estado','=',1)->first();
        $documento->estadoarchivo = $request->estadoarchivo;
        $documento->save();

        if($request->estadoarchivo == 0 and $documento->wasChanged() == true){
            //restar

            $tareareportecolaborador = TareaReporteColaborador::find($request->trc_id);
            $tareareportecolaborador->fechavalidacion = NULL;
            $tareareportecolaborador->fechavalidacionh = NULL;
            $tareareportecolaborador->estado = $tareareportecolaborador->estado - 1;
            $tareareportecolaborador->save();

            $tarea= Tarea::find($request->t_id);
            $tarea->totalatendido = $tarea->totalatendido - 1;
            $tarea->save();

            $tareaperiodo= TareaPeriodo::where('tarea_id','=',$request->t_id)->where('periodo_id','=',$request->tr_periodoId)->first();
            $tareaperiodo->totalatendido = $tareaperiodo->totalatendido - 1;
            $tareaperiodo->save();
            $ejecutado = 0;

            return response()->json(
                ['message' => 'Archivo invalidado',
                'documento' => $documento ,
                'tareareportecolaborador' => $tareareportecolaborador ,
                'tarea' => $tarea ,
                'tareaperiodo' => $tareaperiodo,
               'ejecutado' => $ejecutado,
            ], 200);
        }

        if($request->estadoarchivo == 1 and $documento->wasChanged() == true){
            //sumar

            $tareareportecolaborador = TareaReporteColaborador::find($request->trc_id);
            $tareareportecolaborador->fechavalidacion = $fecha_hoy;
            $tareareportecolaborador->fechavalidacionh = $fecha_hoy;
            $tareareportecolaborador->estado = $tareareportecolaborador->estado + 1;
            $tareareportecolaborador->save();

            $tarea= Tarea::find($request->t_id);
            $tarea->totalatendido = $tarea->totalatendido + 1;
            $tarea->save();

            $tareaperiodo= TareaPeriodo::where('tarea_id','=',$request->t_id)->where('periodo_id','=',$request->tr_periodoId)->first();
            $tareaperiodo->totalatendido = $tareaperiodo->totalatendido + 1;
            $tareaperiodo->save();

            if ($tareaperiodo->totalasignado == $tareaperiodo->totalatendido) {
               // code...
               $ejecutado = 1;
            }else {
               $ejecutado = 0;
            }

           return response()->json(
               ['message' => 'Archivo validado',
               'documento' => $documento ,
               'tareareportecolaborador' => $tareareportecolaborador ,
               'tarea' => $tarea ,
               'tareaperiodo' => $tareaperiodo,
               'ejecutado' => $ejecutado,
           ], 201);

        }

      //return [
      //        'documento' => $documento ,
      //        'tareareportecolaborador' => $tareareportecolaborador ,
      //        'tarea' => $tarea ,
      //        ];

        //return response()->json(['message' => 'Ocurrio algun problema al asignar Colaborador - Reporte'], 200);
       


    }

    public function descargarArchivo(Request $request, $id)
    {
       
        $documento = Documento::findorfail($id);
       // $documento = Documento::findorfail

        //$file=public_path().'/storage/repositorio/atendido/A1-1649258786YgliW7wfUH8hnjENaMcC.ViewReport (1).pdf';
        $file=public_path().'/storage/repositorio/atendido/'.$documento->archivo;
        $headers = [
            'Content-Type' => 'multipart/pdf',
        ];


        return response()->download($file, $documento->nombre, $headers);


    }


    public function eliminarArchivo(Request $request, $id)
    {
        //dd('dentro de eliminar archivo :',$id,$request);

            //$fecha_hoy = Carbon::now();
            //$tareareportecolaborador->fechavalidacion = $fecha_hoy;
            //$tareareportecolaborador->fechavalidacionh = $fecha_hoy;

        $documento = Documento::where('id',$id)->where('estado',1)->first();

            
          //  $documento =Documento::destroy($request->id);
          //  return $documento;
                
                   if (Storage::disk('public')->exists('/repositorio/atendido/'.$documento->archivo)) {
                        $documento->delete();
                        Storage::disk('public')->delete('/repositorio/atendido/'.$documento->archivo);

                        $tareareportecolaborador = TareaReporteColaborador::find($documento->tareareportecolaborador_id);
                        $tareareportecolaborador->fechaatencion = NULL;
                        $tareareportecolaborador->fechaatencionh = NULL;
                        $tareareportecolaborador->estado = $tareareportecolaborador->estado - 1;
                        $tareareportecolaborador->save();

                       // $tarea= Tarea::find($request->tarea_id);
                       // $tarea->totalatendido = $tarea->totalatendido - 1;
                       // $tarea->save();


                  
               
                   }else{

                        $documento->delete();

                        $tareareportecolaborador = TareaReporteColaborador::find($documento->tareareportecolaborador_id);
                        $tareareportecolaborador->fechaatencion = NULL;
                        $tareareportecolaborador->fechaatencionh = NULL;
                        $tareareportecolaborador->estado = $tareareportecolaborador->estado - 1;
                        $tareareportecolaborador->save();

                      //  $tarea= Tarea::find($request->tarea_id);
                      //  $tarea->totalatendido = $tarea->totalatendido - 1;
                      //  $tarea->save();

                   }
           return $documento;

    }



    
}
