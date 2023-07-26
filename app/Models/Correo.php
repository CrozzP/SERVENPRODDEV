<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{

	protected $table = "correos";
    
    protected $fillable = ['id', 'correo', 'estado', 'correoNombre', 'cargo','empresa_id', ];

    


	public function empresa()
    {
        //return $this->belongsTo('App\Models\Provincia','id','provincia_id');
        return $this->hasOne('App\Models\Empresa','id','empresa_id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }

    public function sede(){
       // return $this->belongsToMany('App\Permission', 'permissionUser')->withTimeStamps();
      //  return $this->belongsToMany('App\Permission', 'permissionUser', 'user_id', 'permission_id')->withTimeStamps();
        //return $this->belongsToMany('App\Models\Sede', 'correoSede', 'sede_id', 'correo_id')->withTimeStamps();
        return $this->belongsToMany('App\Models\Correo', 'correoSede', 'correo_id', 'sede_id')->withTimeStamps();
    }



}
