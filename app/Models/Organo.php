<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organo extends Model
{
    //

   protected $connection = 'mysql';
   protected $table = "organos";


   protected $fillable=['id','nombre','slug','empresa_id','estado','created_at','updated_at',];


}
