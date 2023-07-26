<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoInformacion extends Model
{
    //
      protected $connection = 'mysql3';
    protected $table = "tipoinformacion";

   protected $fillable=['nombre','estado', 'descripcion' ];

}
