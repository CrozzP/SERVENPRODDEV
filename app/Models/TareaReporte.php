<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TareaReporte extends Model
{
    //


     protected $connection = 'mysql3';
    protected $table = "tareareporte";


    protected $fillable=['tarea_id','reporte_id','estadoasignado','estado','created_at','updated_at','periodo_id',];


    public function tareas(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->hasOne('App\Models\Tarea','id','tarea_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }
   public function reportes(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->hasOne('App\Models\Reporte','id','reporte_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }
   public function periodos(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->hasOne('App\Models\Periodo','id','periodo_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }


   public function tareaReporteColaboradores(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->belongsTo('App\Models\TareaReporteColaborador','id','tareareporte_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }

}
