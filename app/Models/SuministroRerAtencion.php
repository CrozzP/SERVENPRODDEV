<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuministroRerAtencion extends Model
{
    protected $connection = 'mysql2';
	protected $table = "suministroreratencion";

	protected $fillable=['id','suministrorer_id','persona_id','comprobante_id','user_id','sede_id','fechaRegistro',];
}
