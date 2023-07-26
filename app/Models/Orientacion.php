<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orientacion extends Model
{
    
    protected $table = "orientacion";
    
    protected $fillable = ['id', 'nombre', 'estado','' ];



    public function desOrientacion()
    {
        //return $this->belongsTo('App\Models\Provincia','id','provincia_id');
        return $this->hasMany('App\Models\DesOrientacion','orientacion_id','id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }

}
