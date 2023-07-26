<?php

namespace App\Http\Controllers;

use App\Models\AtencionDerivarRegistro;
use App\Models\EstadoExtraordinario;

use Illuminate\Http\Request;

use Carbon\Carbon;
use PDF;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Intervention\Image\ImageManagerStatic as Image;


class AtencionDerivarRegistroController extends Controller
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
    public function registrarAtencionDR(Request $request)
    {
        //dd($request);
        //dd($request->file1);
        //dd($request->file1->getClientOriginalName());
        $fecha_hoy = Carbon::now();

        $archivoPost1=$request->archivoPost1;
        $archivoPre1=$request->archivoPre1;
        $medidor=$request->medidor;
        $usuarioImagen=$request->usuarioImagen;

        $firmaUsuario = $request->firmaUsuario;
        $firmaTecnico = $request->firmaTecnico;

      // $bAtencionDerivarRegistro = AtencionDerivarRegistro::where('derivarregistro_id',5)->where('estadot','1')->first();
       //$bAtencionDerivarRegistro = AtencionDerivarRegistro::where('derivarregistro_id',$request->derivarRegistro_id)->where('estadot','1')->first();
        //dd($bAtencionDerivarRegistro);


        
$bAtencionDerivarRegistro = AtencionDerivarRegistro::where('derivarregistro_id',$request->derivarRegistro_id)->where('estadot',1)->first();
$atencionDerivarRegistro = new AtencionDerivarRegistro();
if (!empty($bAtencionDerivarRegistro)) {
    // ACTUALIZA LA INFORMAICON

    if ($request->file('archivoPre1')) {
       if (Storage::disk('public')->exists('/atencion/preReparaciones/'.$bAtencionDerivarRegistro->archivoPre1)) {
            //dd('se elimiara el archivo');
            Storage::disk('public')->delete('/atencion/preReparaciones/'.$bAtencionDerivarRegistro->archivoPre1);
        }
        //guarda el nuevo archivo
        $nameArchivoPre1= 'P1-'.time().Str::random(20).'.'.$archivoPre1->getClientOriginalName();
        $rutaArchivoPre1 = '/atencion/preReparaciones/'.$nameArchivoPre1;
        //$fileName = collect(explode('/', $rutaArchivoPre1))->last();
        $imagePre1 = Image::make($archivoPre1);
        $imagePre1->resize(1280, null, function ($constraint) {
           $constraint->aspectRatio();
           $constraint->upsize();
         });
        Storage::disk('public')->put($rutaArchivoPre1, (string) $imagePre1->encode('jpg', 50));

    } else{
        $nameArchivoPre1 =$bAtencionDerivarRegistro->archivoPre1;
    }
    if ($request->file('archivoPost1')) {
       if (Storage::disk('public')->exists('/atencion/reparaciones/'.$bAtencionDerivarRegistro->archivoPost1)) {
            //dd('se elimiara el archivo');
            Storage::disk('public')->delete('/atencion/reparaciones/'.$bAtencionDerivarRegistro->archivoPost1);
        }
        //guarda el nuevo archivo
        $nameArchivoPost1= 'P1-'.time().Str::random(20).'.'.$archivoPost1->getClientOriginalName();
        $rutaArchivoPost1 = '/atencion/reparaciones/'.$nameArchivoPost1;
        //$fileName = collect(explode('/', $rutaArchivoPost1))->last();
        $imagePost1 = Image::make($archivoPost1);
        $imagePost1->resize(1280, null, function ($constraint) {
           $constraint->aspectRatio();
           $constraint->upsize();
         });
        Storage::disk('public')->put($rutaArchivoPost1, (string) $imagePost1->encode('jpg', 50));

    } else{
        $nameArchivoPost1 =$bAtencionDerivarRegistro->archivoPost1;
    }

    if ($request->file('medidor')) {
       if (Storage::disk('public')->exists('/atencion/medidor/'.$bAtencionDerivarRegistro->medidor)) {
            //dd('se elimiara el archivo');
            Storage::disk('public')->delete('/atencion/medidor/'.$bAtencionDerivarRegistro->medidor);
        }
        //guarda el nuevo archivo
        $nameMedidor= 'P1-'.time().Str::random(20).'.'.$medidor->getClientOriginalName();
        $rutaMedidor = '/atencion/medidor/'.$nameMedidor;
        //$fileName = collect(explode('/', $rutaMedidor))->last();
        $imagePost1 = Image::make($medidor);
        $imagePost1->resize(1280, null, function ($constraint) {
           $constraint->aspectRatio();
           $constraint->upsize();
         });
        Storage::disk('public')->put($rutaMedidor, (string) $imagePost1->encode('jpg', 50));

    } else{
        $nameMedidor =$bAtencionDerivarRegistro->medidor;
    }

    if ($request->file('usuarioImagen')) {
       if (Storage::disk('public')->exists('/atencion/usuarios/'.$bAtencionDerivarRegistro->usuarioImagen)) {
            //dd('se elimiara el archivo');
            Storage::disk('public')->delete('/atencion/usuarios/'.$bAtencionDerivarRegistro->usuarioImagen);
        }
        //guarda el nuevo archivo
        $nameUsuarioImagen= 'P1-'.time().Str::random(20).'.'.$usuarioImagen->getClientOriginalName();
        $rutaUsuarioImagen = '/atencion/usuarios/'.$nameUsuarioImagen;
        //$fileName = collect(explode('/', $rutaUsuarioImagen))->last();
        $imageUsuarioImagen = Image::make($usuarioImagen);
        $imageUsuarioImagen->resize(1280, null, function ($constraint) {
           $constraint->aspectRatio();
           $constraint->upsize();
         });
        Storage::disk('public')->put($rutaUsuarioImagen, (string) $imageUsuarioImagen->encode('jpg', 50));

    } else{
        $nameUsuarioImagen =$bAtencionDerivarRegistro->usuarioImagen;
    }

    if (!empty($firmaTecnico)) {
       if (Storage::disk('public')->exists('/atencion/firmas/tecnicos/'.$bAtencionDerivarRegistro->firmaTecnico)) {
            //dd('se elimiara el archivo');
            Storage::disk('public')->delete('/atencion/firmas/tecnicos/'.$bAtencionDerivarRegistro->firmaTecnico);
        }
        //guarda el nuevo archivo
        $extensiont = explode('/', explode(':', substr($firmaTecnico, 0, strpos($firmaTecnico, ';')))[1])[1];   // .jpg .png .pdf
        $replacet = substr($firmaTecnico, 0, strpos($firmaTecnico, ',')+1); 

        $imaget = str_replace($replacet, '', $firmaTecnico); 
        $imaget = str_replace('', '+', $imaget); 
        $nameFirmaTecnico = 'FT-'.time().Str::random(20).'.'.$extensiont;

        $rutat = '/atencion/firmas/tecnicos/'.$nameFirmaTecnico;
        Storage::disk('public')->put($rutat, base64_decode($imaget));
    } else{
        $nameFirmaTecnico =$bAtencionDerivarRegistro->firmaTecnico;
    }

    if (!empty($firmaUsuario)) {
       if (Storage::disk('public')->exists('/atencion/firmas/usuarios/'.$bAtencionDerivarRegistro->firmaUsuario)) {
            //dd('se elimiara el archivo');
            Storage::disk('public')->delete('/atencion/firmas/usuarios/'.$bAtencionDerivarRegistro->firmaUsuario);
        }
        //guarda el nuevo archivo
        $extensionu = explode('/', explode(':', substr($firmaUsuario, 0, strpos($firmaUsuario, ';')))[1])[1];   // .jpg .png .pdf
        $replaceu = substr($firmaUsuario, 0, strpos($firmaUsuario, ',')+1); 

        $imageu = str_replace($replaceu, '', $firmaUsuario); 
        $imageu = str_replace('', '+', $imageu); 
        $nameFirmaUsuario = 'FU-'.time().Str::random(20).'.'.$extensionu;

        $rutau = '/atencion/firmas/usuarios/'.$nameFirmaUsuario;
        Storage::disk('public')->put($rutau, base64_decode($imageu));

    } else{
        $nameFirmaUsuario =$bAtencionDerivarRegistro->firmaUsuario;
    }


    $bAtencionDerivarRegistro->derivarregistro_id=$request->derivarRegistro_id;
    //$atencionDerivarRegistro->archivoPre1=
    //$atencionDerivarRegistro->archivoPre2=
    $bAtencionDerivarRegistro->archivoPost1=$nameArchivoPost1;
    $bAtencionDerivarRegistro->archivoPre1=$nameArchivoPre1;
    //$atencionDerivarRegistro->archivoPost2=
    $bAtencionDerivarRegistro->medidor=$nameMedidor;
    $bAtencionDerivarRegistro->usuarioImagen=$nameUsuarioImagen;
    $bAtencionDerivarRegistro->observacion=$request->observacion;
    $bAtencionDerivarRegistro->estado=1;
    $bAtencionDerivarRegistro->estadot=1;
    $bAtencionDerivarRegistro->latitudAtencion=$request->latitud;
    $bAtencionDerivarRegistro->longitudAtencion=$request->longitud;
    $bAtencionDerivarRegistro->firmaUsuario=$nameFirmaUsuario;
    $bAtencionDerivarRegistro->firmaTecnico=$nameFirmaTecnico;

    $bAtencionDerivarRegistro->save();

    $estadoExtraordinario = EstadoExtraordinario::find($request->estadoExtraordinario_id);
            

            $estadoExtraordinario->fechaAtencion = $fecha_hoy;

            $estadoExtraordinario->estado = 5;

            $estadoExtraordinario->save();



    return $atencionDerivarRegistro;

} else{
    // CREA TODO NUEVO

     if ($request->file('archivoPre1')) {
            
            
        $nameArchivoPre1= 'P1-'.time().Str::random(20).'.'.$archivoPre1->getClientOriginalName();
        $rutaArchivoPre1 = '/atencion/preReparaciones/'.$nameArchivoPre1;
        //$fileName = collect(explode('/', $rutaArchivoPre1))->last();
        $imagePre1 = Image::make($archivoPre1);
        $imagePre1->resize(1280, null, function ($constraint) {
           $constraint->aspectRatio();
           $constraint->upsize();
         });
        Storage::disk('public')->put($rutaArchivoPre1, (string) $imagePre1->encode('jpg', 50));

    } else{
        $nameArchivoPre1 =null;
    }
     if ($request->file('archivoPost1')) {
            
           $nameArchivoPost1= 'P1-'.time().Str::random(20).'.'.$archivoPost1->getClientOriginalName();
           $rutaArchivoPost1 = '/atencion/reparaciones/'.$nameArchivoPost1;
           //$fileName = collect(explode('/', $rutaArchivoPost1))->last();
           $imagePost1 = Image::make($archivoPost1);
           $imagePost1->resize(1280, null, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
            });
           Storage::disk('public')->put($rutaArchivoPost1, (string) $imagePost1->encode('jpg', 50));
    } else{
        $nameArchivoPost1 =null;
    }

        if ($request->file('medidor')) {
            
           $nameMedidor= 'P1-'.time().Str::random(20).'.'.$medidor->getClientOriginalName();
           $rutaMedidor = '/atencion/medidor/'.$nameMedidor;
           //$fileName = collect(explode('/', $rutaMedidor))->last();
           $imagePost1 = Image::make($medidor);
           $imagePost1->resize(1280, null, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
            });
           Storage::disk('public')->put($rutaMedidor, (string) $imagePost1->encode('jpg', 50));
        } else{
            $nameMedidor =null;
        }

        if ($request->file('usuarioImagen')) {
            
           $nameUsuarioImagen= 'P1-'.time().Str::random(20).'.'.$usuarioImagen->getClientOriginalName();
           $rutaUsuarioImagen = '/atencion/usuarios/'.$nameUsuarioImagen;
           //$fileName = collect(explode('/', $rutaUsuarioImagen))->last();
           $imageUsuarioImagen = Image::make($usuarioImagen);
           $imageUsuarioImagen->resize(1280, null, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
            });
           Storage::disk('public')->put($rutaUsuarioImagen, (string) $imageUsuarioImagen->encode('jpg', 50));
        } else{
            $nameUsuarioImagen =null;
        }

        if (!empty($firmaTecnico)) {
           
            $extensiont = explode('/', explode(':', substr($firmaTecnico, 0, strpos($firmaTecnico, ';')))[1])[1];   // .jpg .png .pdf
            $replacet = substr($firmaTecnico, 0, strpos($firmaTecnico, ',')+1); 

            $imaget = str_replace($replacet, '', $firmaTecnico); 
            $imaget = str_replace('', '+', $imaget); 
            $nameFirmaTecnico = 'FT-'.time().Str::random(20).'.'.$extensiont;

            $rutat = '/atencion/firmas/tecnicos/'.$nameFirmaTecnico;
            Storage::disk('public')->put($rutat, base64_decode($imaget));

        } else{
            $nameFirmaTecnico =null;
        }

        if (!empty($firmaUsuario)) {

            $extensionu = explode('/', explode(':', substr($firmaUsuario, 0, strpos($firmaUsuario, ';')))[1])[1];   // .jpg .png .pdf
            $replaceu = substr($firmaUsuario, 0, strpos($firmaUsuario, ',')+1); 

            $imageu = str_replace($replaceu, '', $firmaUsuario); 
            $imageu = str_replace('', '+', $imageu); 
            $nameFirmaUsuario = 'FU-'.time().Str::random(20).'.'.$extensionu;

            $rutau = '/atencion/firmas/usuarios/'.$nameFirmaUsuario;
            Storage::disk('public')->put($rutau, base64_decode($imageu));

        } else{
            
            $nameFirmaUsuario =null;
        }

        $atencionDerivarRegistro->derivarregistro_id=$request->derivarRegistro_id;
        //$atencionDerivarRegistro->archivoPre1=
        //$atencionDerivarRegistro->archivoPre2=
        $atencionDerivarRegistro->archivoPost1=$nameArchivoPost1;
        $atencionDerivarRegistro->archivoPre1=$nameArchivoPre1;
        //$atencionDerivarRegistro->archivoPost2=
        $atencionDerivarRegistro->medidor=$nameMedidor;
        $atencionDerivarRegistro->usuarioImagen=$nameUsuarioImagen;
        $atencionDerivarRegistro->observacion=$request->observacion;
        $atencionDerivarRegistro->estado=1;
        $atencionDerivarRegistro->estadot=1;
        $atencionDerivarRegistro->latitudAtencion=$request->latitud;
        $atencionDerivarRegistro->longitudAtencion=$request->longitud;
        $atencionDerivarRegistro->firmaUsuario=$nameFirmaUsuario;
        $atencionDerivarRegistro->firmaTecnico=$nameFirmaTecnico;

        $atencionDerivarRegistro->save();
            //actualizar estadoExtraordinario
    //dd($atencionDerivarRegistro);
$estadoExtraordinario = EstadoExtraordinario::find($request->estadoExtraordinario_id);
            

            $estadoExtraordinario->fechaAtencion = $fecha_hoy;

            $estadoExtraordinario->estado = 5;

            $estadoExtraordinario->save();



    return $atencionDerivarRegistro;

}

////////////////////////////////////////////////////////////////////////////////////
    
    
      


    }




    public function reportePdfAtencion(Request $request){
        //dd($request->empresa_colaborador['colaborador']);
       // dd($request->empresa_colaborador.colaborador_id);
        $empresaColaborador=$request->empresa_colaborador;
        $prueba=$request->empresa_colaborador['colaborador'];
        //dd($prueba['nombre']);
        $reporte=$request;

       // $atencionDerivarRegistro= AtencionDerivarRegistro::where('derivarregistro_id',$request->id)->where('estadot','1')->first();
        $atencionDerivarRegistro= AtencionDerivarRegistro::with('derivarRegistro.empresaColaborador.colaborador')->where('derivarregistro_id',$request->id)->where('estadot','1')->first();
        //dd($empresaColaborador,$colaborador,$request->empresa_colaborador['colaborador']['nombre']);
       // dd($atencionDerivarRegistro->id);
       // dd($atencionDerivarRegistro->derivarRegistro->empresaColaborador->colaborador->nombres);

       // $extraordinarios = Extraordinario::with('suministro', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')->where('id','<',100)->take(100)->get();

        
         $date = date('Y-m-d');


        $date = Carbon::now();
        $fecha_actual = Carbon::now();
        $datetime = $fecha_actual->toDateTimeString();

       

        //$pdf = PDF::loadView('myPDF', compact('extraordinarios','date','fecha_actual'))->setPaper('a5','landscape');
        $pdf = PDF::loadView('atencionPdf', compact('reporte','prueba','atencionDerivarRegistro','date','fecha_actual'))->setPaper('A4','portrait');
        //Descargar
        //return $pdf->download('extraordinario.pdf');
        //Visualizar
        return $pdf->download('extraordinario.pdf');
        //return $pdf->download('Reporte_Seot_100000.pdf');
        //return $pdf->download('Reporte_Seot_1000'.$extraordinarios->id.'00.pdf');
        //return $pdf->stream('Reporte_Seot_100000.pdf');
    }

       public function subirAtencionExtraordinario(Request $request)
    {
       // dd("dios");
       // dd($request->firma);
       // dd($request->file2);
    //   dd($request->file2->getClientOriginalName());
        // $request->file('archivo')->store('public');

    
            $fileUpload = new AtencionExtraordinarioImport;

          //--  $image_resize = Image::make($request->file2->getRealPath());

  //  $data_uri = "data:image/png;base64,iVBORw0K...";


//---------------------------------------
$image_64 = $request->firma; //your base64 encoded data

  $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

  $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

// find substring fro replace here eg: data:image/png;base64,

 $image = str_replace($replace, '', $image_64); 

 $image = str_replace(' ', '+', $image); 

 $imageName = Str::random(10).'.'.$extension;

 //Storage::disk('public')->put($imageName, base64_decode($image));



            if($request->file()) 
                
                $file_name = time().'_'.$request->file2->getClientOriginalName();
                $file_namefirma = time().'_firmatecnico.'.$extension;
                //$file_namefirma = time().'_'.$request->firma;
             //   $file_path = $request->file('file2')->storeAs('uploads', $file_name, 'public');
                //$file_path = $request->file('file2')->storeAs('uploads', $file_name, 'public');
            $ruta = '/prueba/asds/firma/'.$file_namefirma;
                //\Storage::disk('public')->put($ruta,  \File::get($request->file2));
              //  \Storage::disk('public')->put($ruta,  \File::get($frimita));
                 Storage::disk('public')->put($ruta, base64_decode($image));
                //--$image_resize->save(public_path('storage/imagenes/' . $file_name));

         

    
                $fileUpload->fechaAtencion = time().'_'.$request->file2->getClientOriginalName();
                $fileUpload->fechaAsignacion = '/storage/'.$file_name;
                $fileUpload->save();
    
                return response()->json(['success'=>'File uploaded successfully.']);

    }




    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AtencionDerivarRegistro  $atencionDerivarRegistro
     * @return \Illuminate\Http\Response
     */
    public function show(AtencionDerivarRegistro $atencionDerivarRegistro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AtencionDerivarRegistro  $atencionDerivarRegistro
     * @return \Illuminate\Http\Response
     */
    public function edit(AtencionDerivarRegistro $atencionDerivarRegistro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AtencionDerivarRegistro  $atencionDerivarRegistro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtencionDerivarRegistro $atencionDerivarRegistro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AtencionDerivarRegistro  $atencionDerivarRegistro
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtencionDerivarRegistro $atencionDerivarRegistro)
    {
        //
    }
}
