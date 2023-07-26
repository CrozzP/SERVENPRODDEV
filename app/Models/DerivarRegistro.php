<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DerivarRegistro extends Model
{
    

    protected $table = "derivarregistro";
    
    protected $fillable = ['user_id', 'empresacolaborador_id','estadoextraordinario_id','fechaderivacion','estado', 'fechahora',];




    
public function otros(){
    //dd('hola desde');
       // return $this->belongsToMany('App\Permission', 'permissionUser')->withTimeStamps();
      //  return $this->belongsToMany('App\Permission', 'permissionUser', 'user_id', 'permission_id')->withTimeStamps();
        //return $this->belongsToMany('App\Models\Sede', 'correoSede', 'sede_id', 'correo_id')->withTimeStamps();
        //return $this->belongsToMany('App\Models\Correo', 'correoSede', 'correo_id', 'sede_id')->withTimeStamps();
        return $this->belongsToMany('App\Models\estadoExtraordinario', 'derivarregistro', 'empresacolaborador_id', 'estadoextraordinario_id')->withTimeStamps();
    }

public function empresaColaborador(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo('App\Models\EmpresaColaborador','empresacolaborador_id','id');
      return $this->hasOne('App\Models\EmpresaColaborador','id','empresacolaborador_id');

    }

public function estadoExtraordinario(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo('App\Models\EmpresaColaborador','empresacolaborador_id','id');
      return $this->hasOne('App\Models\EstadoExtraordinario','id','estadoextraordinario_id');

    }
 





}
