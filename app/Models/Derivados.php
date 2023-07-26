<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Derivados extends Model
{
    //

    protected $connection = 'mysql3';
    protected $table = "derivados";


    protected $fillable=['tareareportecolaborador_id_old','tareareportecolaborador_id_new','user_id','fechaderivar','fechaderivarh','estado',];




}
