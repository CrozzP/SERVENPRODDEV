<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{

	protected $table = "departamentos";
    
    protected $fillable = ['nameDepartamento', '' ];

    

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia','id','departamento_id');
        //return $this->hasOne('App\Models\Pago','id','pago_id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }

}
