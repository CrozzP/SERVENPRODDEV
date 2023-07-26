<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoAtencion extends Model
{
    protected $table = "tipoatencion";
    
    protected $fillable = ['id', 'nombre', 'descripcion', 'estado',  ];








}
