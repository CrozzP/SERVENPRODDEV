<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{

	protected $table = "distritos";
    
    protected $fillable = ['nameDistrito', 'provincia_id','estado' ];

    

	public function provincia()
    {
        //return $this->belongsTo('App\Models\Provincia','id','provincia_id');
        return $this->hasOne('App\Models\Provincia','id','provincia_id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }

}
