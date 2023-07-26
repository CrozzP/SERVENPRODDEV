<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnidadOrganica extends Model
{
    //

   protected $connection = 'mysql';
   protected $table = "unidadesorganicas";


   protected $fillable=['id','nombre','slug','organo_id','estado','created_at','updated_at',];


}
