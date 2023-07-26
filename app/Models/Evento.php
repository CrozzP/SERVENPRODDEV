<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    //
   protected $connection = 'mysql';
   protected $table = "eventos";
    
   protected $fillable = ['id', 'nombre', 'descripcion', 'fechapublicacion', 'fechaejecucion','fechalimite','fechainicio','estadoevento','estado','oficina_id','user_id','created_at','updated_at', ];


   public function contenidoEvento(){
         //return $this->belongsTo(Persona::class,'personas_dni_id','dni');

        // return $this->belongsTo(Persona::class,'id','persona_id');
         
      return $this->hasMany('App\Models\ContenidoEvento','evento_id','id');

    

   }
    


}
