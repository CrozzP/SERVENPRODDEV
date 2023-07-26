<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motivo extends Model
{
    //
   protected $connection = 'mysql3';
    protected $table = "motivos";


    protected $fillable=['nombre','descripcion','estado', 'created_at','updated_at',];

}
