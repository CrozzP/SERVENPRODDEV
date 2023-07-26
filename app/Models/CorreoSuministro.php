<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorreoSuministro extends Model
{
    //

    protected $connection = 'mysql';

    protected $table = "correosuministro";
    

    protected $fillable = ['id', 'correo', 'celular','estado','created_at','updated_at', 'suministro_id','codigoConfirmacion','user_id','fechaConfirmacion', 'fechaRegistro', 'estadoConfirmacion', 'persona_id', 'relacion_id', 'fecha_cargaarchivo', 'carga_user_id', 'estadoarchivo', 'archivo','validacionManual', 'validmanu_user_id','fecha_validmanu',];



   public function person(){
         //return $this->belongsTo(Persona::class,'personas_dni_id','dni');

        // return $this->belongsTo(Persona::class,'id','persona_id');
         
      return $this->hasOne('App\Persona','id','persona_id');

    
   }
   public function suministro(){
         //return $this->belongsTo(Persona::class,'personas_dni_id','dni');

        // return $this->belongsTo(Persona::class,'id','persona_id');
         
     // return $this->hasOne('App\Models\Suministro','CodigoSuministro','suministro_id');
      return $this->hasOne(Suministro::class,'CodigoSuministro','suministro_id');

    
   }

 

}
