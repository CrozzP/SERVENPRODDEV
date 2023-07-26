<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    //
         protected $connection = 'mysql3';
    protected $table = "periodo";


    protected $fillable=['nombre','estado','año',];





}
