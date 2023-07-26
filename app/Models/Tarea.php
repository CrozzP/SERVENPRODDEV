<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{


    protected $connection = 'mysql3';
    protected $table = "tareas";


    protected $fillable=['nombre','estado','created_at','updated_at','estadoasignado','user_id','estador','tipoinformacion',];




    //



   public function tareas(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->hasOne('App\Models\Tarea','id','tarea_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }
   public function tareaReportes(){
       return $this->hasMany('App\Models\TareaReporte','tarea_id','id');

        
    }

   public function tareaPeriodo(){
       return $this->belongsTo('App\Models\TareaPeriodo','id','tarea_id');

        
    }


}
