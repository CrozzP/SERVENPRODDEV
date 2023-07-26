<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LugarPago extends Model
{
    //
    protected $table="lugarpago";

    
    protected $fillable = [ 'id','nombre', 'latitude', 'longitude', 'slug', ];


}
