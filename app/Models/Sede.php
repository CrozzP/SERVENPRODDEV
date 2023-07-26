<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{

	protected $table = "sedes";
    
    protected $fillable = ['nombre', 'empresa','estado', ];

    

	public function provincia()
    {
        //return $this->belongsTo('App\Models\Provincia','id','provincia_id');
        return $this->hasOne('App\Models\Provincia','id','provincia_id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }

    

    public function empresa(){
       // return $this->belongsToMany('App\Permission', 'permissionUser')->withTimeStamps();
      //  return $this->belongsToMany('App\Permission', 'permissionUser', 'user_id', 'permission_id')->withTimeStamps();
        //return $this->belongsToMany('App\Models\Sede', 'correoSede', 'sede_id', 'correo_id')->withTimeStamps();
        return $this->belongsToMany('App\Models\Sede', 'sedeEmpresa', 'sede_id', 'empresa_id')->withTimeStamps();
    }

    

}
