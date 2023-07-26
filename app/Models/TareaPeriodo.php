<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TareaPeriodo extends Model
{
    //

   protected $connection = 'mysql3';
    protected $table = "tareaperiodo";

   protected $fillable=['totalasignado','totalatendido','estadoasignado','tarea_id','periodo_id','estado','created_at','updated_at',];



}
