<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    //
   protected $connection = 'mysql';
   protected $table = "oficinas";


   protected $fillable=['id','nombre','slug','unidadorganica_id','estado','created_at','updated_at',];


}
