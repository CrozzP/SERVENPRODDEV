<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suministro;
use App\Models\TipoExtraordinario;
use App\Models\ObsTipoExtraordinario;
use App\Models\Persona;
use App\Http\Requests\Person\StoreRequest;

//use Session;
//use FarhanWazir\GoogleMaps\GMaps;

class SuministroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //return view('theme.backoffice.supply.index' );
        //return Suministro::orderBy('CodigoSuministro','desc')->paginate(5); 
        //return 
        //$suministro = Suministro::orderBy('CodigoSuministro','desc')->get();
       // dd('excelente'); 
        return Suministro::orderBy('CodigoSuministro','desc')->take(3)->get();
       // return Suministro::orderBy('CodigoSuministro','desc')->get();
    }

    public function suministroBuscar(Request $request)
    {
       // dd("dentro del conrtoller-search");
       // dd($request);
        $tipoBusqueda = $request->tipoSearch;
        /*dd($tipoBusqueda);
        if ($tipoBusqueda == 'Documento') {
            return "Documento buscado";
        } else {
            return "otros";
        }*/

        switch ($tipoBusqueda) {
            case 'Documento':
                $suministros = Suministro::with('correoSuministro')->where([
                    ['Documento', '=', $request->search],
                ])->Paginate(10);
                //return $suministros;


               //$suministros = Suministro::with('correoSuministro')
               //     ->whereHas('correoSuministro', function($query) {
               //         $query->where('estado','=', 1);
               //     })->where([
               //        ['Documento', '=', $request->search],
               //    ])->Paginate(10);


            break;
            case 'NombreSuministro':
                $suministros = Suministro::with('correoSuministro')->where([
                    ['NombreSuministro', 'like', '%'.$request->search.'%'],
                ])->Paginate(10);

                //$suministros = Suministro::with('correoSuministro')
                //    ->whereHas('correoSuministro', function($query) {
                //        $query->where('estado','=', 1);
                //    })->where([
                //       ['NombreSuministro', 'like', '%'.$request->search.'%'],
                //   ])->Paginate(10);

            break;
            case 'CodigoSuministro':
                $suministros = Suministro::with('correoSuministro')->where([
                    ['CodigoSuministro', '=', $request->search],
                ])->Paginate(10);

                //$suministros = Suministro::with('correoSuministro')
                //    ->whereHas('correoSuministro', function($query) {
                //        $query->where('estado','=', 1);
                //    })->where([
                //       ['CodigoSuministro', '=', $request->search],
                //   ])->Paginate(10);

            break;
            case 'CodigoRutaSuministro':
                $suministros = Suministro::with('correoSuministro')->where([
                    ['CodigoRutaSuministro', '=', $request->search],
                ])->Paginate(10);

                //$suministros = Suministro::with('correoSuministro')
                //    ->whereHas('correoSuministro', function($query) {
                //        $query->where('estado','=', 1);
                //    })->where([
                //    ['CodigoRutaSuministro', '=', $request->search],
                //])->Paginate(10);


            break;
            
            default:
                $suministros = Suministro::with('correoSuministro')->where([
                    ['Documento', '=', $request->search],
                ])->Paginate(10);

                //$suministros = Suministro::with('correoSuministro')
                //    ->whereHas('correoSuministro', function($query) {
                //        $query->where('estado','=', 1);
                //    })->where([
                //    ['Documento', '=', $request->search],
                //])->Paginate(10);


                break;
        }

      /*  $suministros = Suministro::where([
                    [$request->tipoSearch, 'like', '%'.$request->search.'%'],
                   
               // ])->get();
                ])->Paginate(5);
*/
        return $suministros;
       // return response()->json($suministros, 200);
      ///  return response()->json($suministros);

        //$suministros = Suministro::paginate(10);
       // return response()->json($suministros);

        //return view('theme.backoffice.supply.index' );
        //return Suministro::orderBy('CodigoSuministro','desc')->paginate(5); 
        //return 
        //$suministro = Suministro::orderBy('CodigoSuministro','desc')->get();
       // dd('excelente'); 
       // return Suministro::orderBy('CodigoSuministro','desc')->take(3)->get();
       // return Suministro::orderBy('CodigoSuministro','desc')->get();
    }

   

    public function buscar(Request $request)
    {
       
        $suministro= Suministro::name($name=$request->get('nombre'),$namee=$request->get('nombrelist'))->paginate(5);  

        if($request->ajax()){
            
            return response()->json(view('theme.backoffice.supply.supplyajax',['supply' => $suministro])->render());
        }
       

        return view('theme.backoffice.supply.buscar', ['supply' => $suministro] );
        //return view('suministro.index',compact('suministro'));
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



    public function getSuministro(Request $request)
    {
        //dd($request);
        $suministros= Suministro::where('CodigoSuministro',$request->suministroID)->first();
        return $suministros;
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
    public function storeextraordinario(StoreRequest $request){
           
       

        if($request->ajax()){ 
            $result=Person::create($request->all());
            if($result){
                session::flash('save','se a creado correctamente');
                return response()->json(['success'=>'true']);
            }
            else
            {
                return response()->json(['success'=>'false']);
            }
            
                
        }
    }

    public function supplyextraordinarycreate(Suministro $suministro){
        $suministro=Suministro::find($suministro->id);
       
        $typeExtraordinaries=TypeExtraordinary::pluck('description','id');
         return view('theme.backoffice.supply.supplyextraordinarycreate',compact('supply','typeExtraordinaries'));
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

    public function map()
    {
     //  $config['center'] = 'Sydney Airport,Sydney';
     //  $config['zoom'] = '14';
     //  $config['map_height'] = '400px';

     //  $gmap = new GMaps();
     //  $gmap->initialize($config);
     
     //  $map = $gmap->create_map();
////////////////////////////////////////////
        //configuaración

        $gmap = new GMaps();
        $config = array();
        $config['center'] = '37.4419, -122.1419';
//$config['zoom'] = 'auto';
//$this->googlemaps->initialize($config);

       // $config['center'] = 'auto';
        $config['map_width'] = 400;
        $config['map_height'] = 400;
        $config['zoom'] = 15;
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
 
            });
        }
        centreGot = true;';
 

  $gmap->initialize($config);
   //     \Gmaps::initialize($config);
 
        // Colocar el marcador 
        // Una vez se conozca la posición del usuario
$marker = array();
$marker['position'] = '37.429, -122.1419';
//$this->googlemaps->add_marker($marker);
$gmap->add_marker($marker);
//$map['map'] = $this->googlemaps->create_map();
$map = $gmap->create_map();

     //   $marker = array();
     //    $gmap->add_marker($marker);
     //   \Gmaps::add_marker($marker);
 // $map = $gmap->create_map();
     //   $map = \Gmaps::create_map();
 
        //Devolver vista con datos del mapa
    //    return view('gmaps', compact('map'));
    ////////////////////////////////      
        return view('theme.backoffice.supply.map',compact('map'));


    }
}
