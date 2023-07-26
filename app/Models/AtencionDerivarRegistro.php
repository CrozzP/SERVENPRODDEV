<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtencionDerivarRegistro extends Model
{
      protected $table = "atencionderivarregistro";
    
    protected $fillable = ['id', 'derivarregistro_id', 'archivoPre1', 'archivoPre2', 'archivoPost1', 'archivoPost2','usuarioImagen','observacion','estado','estadot','latitudAtencion','longitudAtencion','firmaUsuario','firmaTecnico','created_at','updated_at',];






public function derivarRegistro(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo('App\Models\EmpresaColaborador','empresacolaborador_id','id');
      return $this->hasOne('App\Models\DerivarRegistro','id','derivarregistro_id');

    }

}
