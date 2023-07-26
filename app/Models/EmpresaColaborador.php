<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmpresaColaborador extends Model
{
    

    protected $table = "empresacolaborador";
    
    protected $fillable = ['empresa_id', 'colaborador_id','fechainicio','fechafin','estado', ];




  public function colaborador(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      return $this->belongsTo('App\Models\Colaborador','colaborador_id','id');
      //return $this->hasOne('App\Models\Colaborador','id','colaborador_id');

    }
  public function empresa(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      return $this->belongsTo('App\Models\Empresa','empresa_id','id');
      //return $this->hasOne('App\Models\Colaborador','id','colaborador_id');

    }






}
