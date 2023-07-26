<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContenido extends Model
{
    //
   protected $connection = 'mysql';
   protected $table = "tipocontenido";
    
   protected $fillable = ['id', 'nombre', 'estado', 'created_at','updated_at', ];
   
}
