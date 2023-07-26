<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    
    protected $connection = 'mysql3';
    protected $table = "solicitud";


    protected $fillable=['tareareportecolaborador_id ','user_id ','fechasolicitada','fechasolicitadah','fundamento','tiposolicitud_id ','estado','created_at','updated_at','fechaasignada_old','fechaasignadah_old','fechaasignada_new','fechaasignadah_new','estadosolicitud','solcont',];




    public function tarrepcol(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      return $this->hasOne('App\Models\TareaReporteColaborador','id','tareareportecolaborador_id');

    }


}
