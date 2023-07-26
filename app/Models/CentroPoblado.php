<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CentroPoblado extends Model
{
    //
   protected $table = "centropoblado";
    
    protected $fillable = ['nombreccpp', 'provincia_id', 'nombreprovincia' ,'distrito_id' ,'nombredistrito', 'estado', 'created_at','updated_at' ];

    

   public function distrito()
    {
        //return $this->belongsTo('App\Models\Provincia','id','provincia_id');
        return $this->hasOne('App\Models\Distrito','id','distrito_id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }



}
