<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $connection = 'mysql';

    protected $table = "colaboradores";
    
    protected $fillable = ['nombre', 'descripcion','estado','imagen','cv','user_id' ];




    

    public function empresaColaborador(){
       // return $this->belongsToMany('App\Permission', 'permissionUser')->withTimeStamps();
      //  return $this->belongsToMany('App\Permission', 'permissionUser', 'user_id', 'permission_id')->withTimeStamps();
        //return $this->belongsToMany('App\Models\Sede', 'correoSede', 'sede_id', 'correo_id')->withTimeStamps();
       // return $this->belongsToMany('App\Models\EmpresaColaborador', 'sedeEmpresa', 'empresa_id', 'sede_id')->withTimeStamps();
        return $this->belongsToMany('App\Models\EmpresaColaborador', 'empresacolaborador', 'empresa_id', 'colaborador_id')->withTimeStamps();
    }

    public function colaboradorEmpresa(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      return $this->hasMany('App\Models\EmpresaColaborador','id','colaborador_id');

    }

    public function colaboradorEmp(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      return $this->hasOne('App\Models\EmpresaColaborador','colaborador_id','id');

    }

    public function usuario(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      return $this->hasOne('App\User','id','user_id');

    }



}
