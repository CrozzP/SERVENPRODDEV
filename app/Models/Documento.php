<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //


    protected $connection = 'mysql3';
    protected $table = "documentos";


    protected $fillable=['tareareportecolaborador_id','archivo','estadoarchivo','estado','created_at','updated_at','nombre',];




}
