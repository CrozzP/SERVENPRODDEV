<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
     protected $table = "tipoDocumento";
    
    protected $fillable = ['nombre', 'estado', ];




}
