<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suministro extends Model
{

    //protected $connection = 'sqlsrv2';
    //protected $connection = 'sqlsrv2';
    protected $table = "suministros";

    protected $fillable=['CodigoSuministro','CodigoRutaSuministro','NombreSuministro','Doumento','Telefono','DireccionPredio','Longitud','Latitud','Serie','nombreTipoSistema','nombreTarifa','longitud','latitud','SerieMedidor','Tarifa','NombreZonaAdministrativa','NombreDepartamento','NombreProvincia','NombreDistrito','Nombre','ApellidoPaterno','ApellidoMaterno','Documento','CodigoMedidor','NombreTarifa','CodigoZonaAdministrativa','IdDistrito','IdProvincia','Fases','NombreTipoSistema','NombreTipoDocumentoIdentidad','TipoDocumento',];


    private $namee;
    public function construct() {

        $this->namee = $namee;
     }

     public function scopeName($query, $name,$namee=""){
      // public function scopeName($query, $name){
     // protected $namee;
        if (trim($namee) != ""){

                //$query->where('nombre',$name);
                //$query->where(\DB::raw("CONCAT(nombre,' ',direccion,' ',codigoSuministro, ' ',codigoRutaSuministro, ' ',dni)"),"LIKE","%$name%");
                $query->where(\DB::raw($namee),"LIKE","%$name%");
                //$query->where(\DB::raw($namee),"LIKE","%$name%");
               // $query->where(\DB::raw("CONCAT(namee)"),"LIKE","%$name%");
                }
                else {
                  
                }
     }

   /*  public function provincia()
    {
        //return $this->belongsTo('App\Persona');
        return $this->belongsTo('App\Models\Provincia','provincia_id','id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }*/

    public function correoSuministro(){
        //return $this->hasOne('App\Persona','id','persona_id');
       return $this->belongsTo(CorreoSuministro::class,'CodigoSuministro','suministro_id')->where('estado','=',1);
       //return $this->belongsTo(CorreoSuministro::class,'CodigoSuministro','suministro_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }

    public function extraordinario(){
        //return $this->hasOne('App\Persona','id','persona_id');
       return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }

    public function extraordinary(){
       return $this->hasOne(ExtraordinarIO::class,'suministro_id','codigoSuministro');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }



    //
}
