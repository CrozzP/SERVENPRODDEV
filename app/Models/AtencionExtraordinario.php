<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtencionExtraordinario extends Model
{
    protected $table = "atencionextraordinario";
    
    protected $fillable = ['id', 'fechaAtencion', 'fechaAsignacion', 'observacion', 'estado', 'masinfo','created_at','updated_at',];





}
