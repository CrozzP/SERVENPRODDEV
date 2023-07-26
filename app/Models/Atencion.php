<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atencion extends Model
{
    protected $table = "atencion";
    
    protected $fillable = ['id', 'user_id', 'tipoAtencion_id', 'fechaRegistro', 'dni', 'observacion',];








}
