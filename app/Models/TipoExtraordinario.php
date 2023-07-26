<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoExtraordinario extends Model
{
    //protected $connection = 'sqlsrv';
    protected $table='tipoExtraordinario';
    protected $fillable = ['id','descripcion'];

    public function obstypeexs(){
	   return $this->hasMany(ObsTipoExtraordinario::class,'tipoExtraordinario_id','id');
	}

	public function extraordinary(){
		return $this->hasOne(Extraordinario::class,'tyipoExtraordinario_id','id');
	
	}

	public function obsTipoExtraordinario(){
		return $this->hasOne(ObsTipoExtraordinario::class,'tyipoExtraordinario_id','id');
	
	}


}
