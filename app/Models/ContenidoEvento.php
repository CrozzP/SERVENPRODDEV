<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContenidoEvento extends Model
{
    //
   protected $connection = 'mysql';
   protected $table = "contenidoevento";
    
   protected $fillable = ['id', 'evento_id', 'tipocontenido_id', 'contenido', 'estado','user_id','created_at','updated_at','archivo', ];

   public function tipoContenido(){
         //return $this->belongsTo(Persona::class,'personas_dni_id','dni');

        // return $this->belongsTo(Persona::class,'id','persona_id');
         
      return $this->hasOne('App\Models\TipoContenido','id','tipocontenido_id');

    

   }
    


}
