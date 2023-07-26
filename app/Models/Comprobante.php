<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comprobante extends Model
{
    
	protected $connection = 'mysql2';
	protected $table = "comprobantes";

	protected $fillable=['Bloque_id','Suministro_id','CodigoUsuario','IDPROV','NOMBPROV','IDDIST','NOMBDIST','CCPP','Documento','PERIODOCOMERCIAL','FECHADEEMISIONDECOMPROBANTE','FECHADEVENCIMIENTO','MONTOAFECTO','MONTOIMPUESTO','MONTODEUDA','MONTOTOTAL','CUOTAS','NUMERODESERIEDECOMPROBANTE','NumeroComprobante','SerieSuministro','RUC','estadoPago'];
	


///	public function comprobante(){
///        //return $this->hasOne('App\Persona','id','persona_id');
///      // return $this->belongsTo(Extraordinario::class,'CodigoSuministro','suministro_id');
///       return $this->belongsTo(Comprobante::class,'id','suministro_id');
///
///        //return $this->hasOne(Extraordinario::class,'suministro_id','codigoSuministro');
///    }
///


}
