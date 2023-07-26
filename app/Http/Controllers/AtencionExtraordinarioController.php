<?php


namespace App\Http\Controllers;


use App\Imports\AtencionExtraordinario\AtencionExtraordinarioImport;

use App\Models\AtencionExtraordinario;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

//use Storage;
use Image;

use App\Http\Controllers\Controller;


class AtencionExtraordinarioController extends Controller
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

    

    public function importAtencionExtraordinario(Request $request)
    {
        //dd("dios");
         //dd($request);
        //Excel::import(new AtencionExtraordinarioImport, $request->file('file'));
        //Excel::import(new AtencionExtraordinarioImport,request()->file('file'));
       //return back()->with('success', 'Users imported successfully');

        Excel::import(new AtencionExtraordinarioImport, $request->file('file')->store('temp'));
        return back();
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
            //    \Storage::disk('public')->put($ruta,  \File::get($request->file2));
              //  \Storage::disk('public')->put($ruta,  \File::get($frimita));
                 Storage::disk('public')->put($ruta, base64_decode($image));
                //--$image_resize->save(public_path('storage/imagenes/' . $file_name));

         

    
                $fileUpload->fechaAtencion = time().'_'.$request->file2->getClientOriginalName();
                $fileUpload->fechaAsignacion = '/storage/'.$file_name;
                $fileUpload->save();
    
                return response()->json(['success'=>'File uploaded successfully.']);

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
     * @param  \App\Models\AtencionExtraordinario  $atencionExtraordinario
     * @return \Illuminate\Http\Response
     */
    public function show(AtencionExtraordinario $atencionExtraordinario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AtencionExtraordinario  $atencionExtraordinario
     * @return \Illuminate\Http\Response
     */
    public function edit(AtencionExtraordinario $atencionExtraordinario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AtencionExtraordinario  $atencionExtraordinario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AtencionExtraordinario $atencionExtraordinario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AtencionExtraordinario  $atencionExtraordinario
     * @return \Illuminate\Http\Response
     */
    public function destroy(AtencionExtraordinario $atencionExtraordinario)
    {
        //
    }
}
