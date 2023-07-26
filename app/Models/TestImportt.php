<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestImportt extends Model
{
    //

   protected $table = "testimportt";
    
    protected $fillable = ['id','testimport_id', 'descripcion','created_at','updated_at','estado', ];




}
