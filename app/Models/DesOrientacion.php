<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesOrientacion extends Model
{
    
    protected $table = "desOrientacion";
    
    protected $fillable = ['id', 'descripcion', 'estado','orientacion_id','' ];



}
