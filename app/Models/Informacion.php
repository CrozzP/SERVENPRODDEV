<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Informacion extends Model
{
    //
    protected $connection = 'mysql3';
    protected $table = "informacion";

   protected $fillable=['mt', 'bt', 'no_residencial', 'cero_treinta', 'treinta_cien', 'cien_ccincuenta', 'ccincuenta_trecientos', 'trecientos_quinientos', 'mas_quinientos', 'residencial_bt', 'st_regulado', 'st_libre', 'total', 'porcentaje', 'tareareporte_id','periodo_id', 'user_id', 'estado', 'created_at', 'updated_at', ];




}
