<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestImport extends Model
{
    //

   protected $table = "testimport";
    
    protected $fillable = ['id','nombre', 'estado','tipo','created_at','updated_at','fechaAtencion', ];




}
