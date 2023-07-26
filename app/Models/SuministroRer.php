<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuministroRer extends Model
{
    
	protected $connection = 'mysql2';
	protected $table = "suministros";

	protected $fillable=['Suministro','CodigoUsuario','Departamento_id','Departamento','Provincia_id','Provincia','Distrito_id','Distrito','CentroPoblado','LatitudWG','LongitudWG','ApellidoPaterno','ApellidoMaterno','Nombre','Nombres','dni','Reniec','Sexo','FechaNacimiento','ruc','Razon Social','NombreInstitucion','CodigoTipoInstalacion','FechaInstalacion','Funcionando',];

   //solo para pagos estadoPago= 0
	public function comprobante(){
        //return $this->hasOne('App\Persona','id','persona_id');
      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
       //return $this->hasMany('App\Models\Comprobante','Suministro_id','Id');
       return $this->hasMany('App\Models\Comprobante','Suministro_id','Id')->where('estadoPago','=','0');

        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
    }





}
