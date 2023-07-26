<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonaExtraordinario extends Model
{
    protected $table = "personaExtraordinario";

    protected $fillable = [ 'extraordinario_id', 'persona_id','relacion_id', ];


//ALMACENAMIENTO

    public function store($request){

        $personaExtraordinario = self::create($request->all());
        
        //alert('Exito','Usuario creado con exito','success');
        return $personaExtraordinario;

    }

	public function my_update($request){
		
        self::update($request->all());
        //alert('Exito','Usuario actualizado','success');
    }


    public function extraordinario(){
      //return $this->hasMany(Extraordinario::class,'id','extraordinario_id');
      return $this->belongsTo(Extraordinario::class,'extraordinario_id','id');
      //return $this->hasMany('App\Models\Extraordinario','id','extraordinario_id');

    }
    public function estadoExtraordinario(){
     //return $this->hasMany(EstadoExtraordinario::class,'extraordinario_id','id');
      //return $this->belongsTo(EstadoExtraordinario::class,'extraordinario_id','id');
      return $this->belongsTo('App\Models\EstadoExtraordinario','id','extraordinario_id');

    }

    public function persona(){
     // return $this->hasMany(Persona::class,'persona_id','id');
      //return $this->belongsTo(Persona::class,'persona_id','id');
      return $this->hasOne('App\Persona', 'id', 'persona_id');

    }

    public function relacion(){
     // return $this->hasMany(Persona::class,'persona_id','id');
      //return $this->belongsTo(Persona::class,'persona_id','id');
      return $this->hasOne('App\Models\Relacion', 'id', 'relacion_id');

    }
   

     public function departamento()
    {
        //return $this->belongsTo('App\Persona');
        return $this->belongsTo('App\Models\Departamento','departamento_id','id');

        //return $this->belongsTo(Profession::class, 'id_profession');


    }

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



}
