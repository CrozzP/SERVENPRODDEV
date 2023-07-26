<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioSede extends Model
{
    //
      protected $connection = 'mysql3';
    protected $table = "usersede";

   protected $fillable=['id','user_id', 'sede_id','created_at','updated_at' ];

}
