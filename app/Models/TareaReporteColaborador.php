<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TareaReporteColaborador extends Model
{
    //

    protected $connection = 'mysql3';
    protected $table = "tareareportecolaborador";


    protected $fillable=['empresacolaborador_id','tareareporte_id','estado', 'dericont','created_at','updated_at','solcont',];



    
      public function tareaReporte(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->hasOne('App\Models\TareaReporte','id','tareareporte_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }
    
      public function colaborador(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->hasOne('App\Models\Colaborador','id','empresacolaborador_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }

    public function documentos(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->belongsTo('App\Models\Documento','id','tareareportecolaborador_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }

    public function periodo(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       return $this->hasOne('App\Models\Periodo','id','periodo_id');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }

   

}
