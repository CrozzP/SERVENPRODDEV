<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class EstadoExtraordinario extends Model
{

    protected $table = "estadoExtraordinarios";

    protected $fillable = [ 'extraordinario_id', 'fechaInicio', 'fechaFinal', 'fechaAtencion', 'referencia', 'tecnico', 'estado', 'tipo', 'fechaAceptadoT','fechaDerivado','atencion_excel' ,'atencion_appweb'];

//ALMACENAMIENTO

    public function store($request){

        $estadoExtraordinario = self::create($request->all());
        
        //alert('Exito','Usuario creado con exito','success');
        return $estadoExtraordinario;

    }

	public function my_update($request){
		
        self::update($request->all());
        //alert('Exito','Usuario actualizado','success');
    }

     public function departamento()
    {
        //return $this->belongsTo('App\Persona');
        return $this->belongsTo('App\Models\Departamento','departamento_id','id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }
    /*public function extraordinario(){
      return $this->hasMany(Extraordinario::class,'extraordinario_id','id');

    }*/

    public function provincia()
    {
        //return $this->belongsTo('App\Persona');
        return $this->belongsTo('App\Models\Provincia','provincia_id','id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }

    public function distrito()
    {
        //return $this->belongsTo('App\Persona');
        return $this->belongsTo('App\Models\Distrito','distrito_id','id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }



     public function extraordinario()
    {
        //return $this->belongsTo('App\Persona');
        return $this->hasOne('App\Models\Extraordinario','id','extraordinario_id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }



}
