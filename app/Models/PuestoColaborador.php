<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuestoColaborador extends Model
{
    //

    protected $connection = 'mysql';
    protected $table = "puestocolaborador";


    protected $fillable=['puesto_id','colaborador_id','created_at','updated_at','fechaAsignada','fechaAsignadah','fechaFinal','fechaFinal','fechaFinalh','estado','estados',];




    //



  public function puesto(){
       //return $this->hasOne('App\Persona','id','persona_id');
     // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
      return $this->hasOne('App\Models\Puesto','id','puesto_id');
       //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
   }

}
