<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{

	protected $table = "provincias";
    
    protected $fillable = ['nameProvincia', 'departamento_id','estado', ];

    
	public function distrito()
    {
        return $this->belongsTo('App\Models\Distrito','id','provincia_id');
        //return $this->hasOne('App\Models\Pago','id','pago_id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }

    


}
