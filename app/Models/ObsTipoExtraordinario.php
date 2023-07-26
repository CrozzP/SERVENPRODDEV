<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObsTipoExtraordinario extends Model
{
	//protected $connection = 'sqlsrv';
    protected $table='obsTipoExtraordinario';
    protected $fillable = ['id','tipoExtraordinario_id','descripcion'];

    public static function Obstypeextraordinary($id){
    	return ObsTipoExtraordinario::where('tipoExtraordinario_id','=',$id)
    	->get();
    }

    public function tipoExtraordinario(){
	  //return $this->belongsTo(TipoEtraordinario::class,'tipoExtraordinario_id','id');
      return $this->hasOne('App\Models\TipoExtraordinario', 'id', 'tipoExtraordinario_id');

	}

    


	public function extraordinary(){
    return $this->hasOne(Extraordinario::class,'obsTipoExtraordinario_id','id');
    
  }

  
  



}
