<?php

namespace App\Models;




use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Extraordinario extends Model
{
    //protected $connection = 'sqlsrv';
    protected $table="extraordinarios";

    
    protected $fillable = [ 'id', 'obsTipoExtraordinario_id', 'suministro_id', 'users_id',  ];
  

   // protected $dates = ['date_start', 'date_finish'];

  /*    public function provincia()
    {
        //return $this->belongsTo('App\Persona');
        return $this->belongsTo('App\Models\Provincia','provincia_id','id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }*/

   

    public function usuario(){
     // return $this->hasMany(User::class,'users_id','id');
      return $this->belongsTo('App\User','users_id','id');

    }

    public function suministro(){
      return $this->belongsTo(Suministro::class,'suministro_id','CodigoSuministro');

    }

    public function obsTipoExtraordinario(){
      return $this->belongsTo(ObsTipoExtraordinario::class,'obsTipoExtraordinario_id','id');

    }

    public function personaExtraordinario(){
      return $this->belongsTo(PersonaExtraordinario::class,'id','extraordinario_id');

    }

    public function estadoExtraordinario(){
      return $this->belongsTo(EstadoExtraordinario::class,'id','extraordinario_id');

    }

    

    public function person(){
      return $this->belongsTo(Persona::class,'personas_dni_id','dni');

  }

  public function supply(){
    return $this->belongsTo(Suministro::class,'suministro_id','codigoSuministro');

  }

  public function typeExtraordinary(){
    return $this->belongsTo(TipoExtraordinario::class,'tipoExtraordinario_id','id');

  }

  public function obsTypeExtraordinary(){
    return $this->belongsTo(ObsTipoExtraordinario::class,'obsTipoExtraordinario_id','id');

  }

   public function scopeExtraordinarioexcel($query, $exco){
      //dd('desde modelo ',$exco);
    
        if (trim($exco) != ""){

       // $query->where(\DB::raw("CONCAT(personas_dni_id,' ',suministro_id,' ',direccion, ' ',ruta)"),"LIKE","%$name%");

        $query = DB::table('extraordinarios')
            ->select('extraordinarios.id','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud')

            ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
            ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
            ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
            ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
            ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
            ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')


            ->where([
                ['obsTipoExtraordinario.tipoExtraordinario_id', '=', $exco]
               // ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio]

                //['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
            ])
            //->whereBetween('estadoExtraordinarios.fechaInicio', [$request->FechaInicio, $request->FechaFinal])
            
            
            ->get();
            //dd('desde modelo ',$query);
            return $query;

        
        }
        else {
          
        }

    }

   public function scopeName($query, $name){
        if (trim($name) != ""){

        $query->where(\DB::raw("CONCAT(personas_dni_id,' ',suministro_id,' ',direccion, ' ',ruta)"),"LIKE","%$name%");
        
        }
        else {
          
        }

    }

    public function scopeFiltro($query,$filtro){
        if (trim($filtro) != ""){

        //$query->where('nombre',$name);
          //busca la fecha
        $query->where("fecha_inicio",">=","$filtro");
        //$query->whereBetween("date_start","=",["$filtro","$filtro2"]);
        }
        else {
          
        }

    }
    public function scopeFiltro2($query,$filtro2){
        if (trim($filtro2) != ""){

        //$query->where('nombre',$name);
          //busca la fecha
        $query->where("fecha_final","<=","$filtro2");
        //$query->whereBetween("date_start","=",["$filtro","$filtro2"]);
        }
        else {
          
        }

    }
      public function scopeFiltro3($query, $filtro3){
        if (trim($filtro3) != ""){

        //$query->where('nombre',$name);
        $query->where("tipoExtraordinario_id","=","$filtro3");
        }
        else {
          
        }

    }

    public function scopeDateini($query, $dateini){
        if (trim($dateini) != ""){

        //$query->where('nombre',$name);
       // $query->where("date_start","=","$dateini");
      //  $query->whereBetween("date_start","=",["$dateini","$datefin"]);
        $query->where("fecha_inici",">=","$dateini");
        }
        else {
          
        }

    }

    public function scopeDatefin($query, $datefin){
        if (trim($datefin) != ""){

        //$query->where('nombre',$name);
       // $query->where("date_start","=","$dateini");
       // $query->whereBetween("date_start","=",["$dateini","$datefin"]);
         $query->where("fecha_final","<=","$datefin");
        }
        else {
          
        }

    }

    public function scopeTypeExtraordinaries($query, $tipoex){
        if (trim($tipoex) != ""){

        //$query->where('nombre',$name);
       // $query->where("date_start","=","$dateini");
       // $query->whereBetween("date_start","=",["$dateini","$datefin"]);
         $query->where("tipoExtraordinario_id","=","$tipoex");
        }
        else {
          
        }

    }
    public function scopeEsta($query, $estado){
        if (trim($estado) != ""){

        //$query->where('nombre',$name);
       // $query->where("date_start","=","$dateini");
       // $query->whereBetween("date_start","=",["$dateini","$datefin"]);
         $query->where("estado","=","$estado");
        }
        else {
          
        }

    }






}
