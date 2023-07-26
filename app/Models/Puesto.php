<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    //

    protected $connection = 'mysql';
    protected $table = "puestos";


    protected $fillable=['unidadorganica_id','oficinal_id','created_at','updated_at','nombre','slug','estado','estados',];


}
