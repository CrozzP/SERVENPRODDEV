<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

	protected $table = "empresa";
    
    protected $fillable = ['nombreEmpresa', 'estado', ];

    

	public function provincia()
    {
        //return $this->belongsTo('App\Models\Provincia','id','provincia_id');
        return $this->hasOne('App\Models\Provincia','id','provincia_id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }

    public function sede(){
       // return $this->belongsToMany('App\Permission', 'permissionUser')->withTimeStamps();
      //  return $this->belongsToMany('App\Permission', 'permissionUser', 'user_id', 'permission_id')->withTimeStamps();
        //return $this->belongsToMany('App\Models\Sede', 'correoSede', 'sede_id', 'correo_id')->withTimeStamps();
        return $this->belongsToMany('App\Models\Empresa', 'sedeEmpresa', 'empresa_id', 'sede_id')->withTimeStamps();
    }

}
