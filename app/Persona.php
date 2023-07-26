<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['dni', 'nombre', 'apellPat', 'apellMat', 'sexo', 'fechaNacimiento', 'direccion', 'telefono', 'email', 'departamento_id', 'provincia_id', 'distrito_id', 'user_id', 'tipoDocumento_id',];



//RELACIONES

   /* public function estudiante()
    {
        return $this->belongsTo('App\Estudiante');
        //return $this->belongsTo('App\Estudiante', 'persona_id');
    }*/
/*
    public function estudiante(){
       // return $this->belongsToMany('App\Permission', 'permissionUser')->withTimeStamps();
       // return $this->belongsToMany('App\Permission', 'permissionUser', 'user_id', 'permission_id')->withTimeStamps();
       // return $this->belongsToMany('App\Persona', 'persona', 'persona_id', 'persona_id')->withTimeStamps();
        return $this->belongsTo('App\Estudiante', 'persona_id')->withTimeStamps();
    }
*/
    

//ALMACENAMIENTO

    public function store($request){

        $persona = self::create($request->all());
        
        //alert('Exito','Usuario creado con exito','success');
        return $persona;

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


    public function personaExtraordinario()
    {
        //return $this->belongsTo('App\Persona');
        //return $this->belongsTo('App\Models\PersonaExtraordinario','id','persona_id');
        return $this->hasMAny('App\Models\PersonaExtraordinario','persona_id','id');
        //return $this->belongsTo(Profession::class, 'id_profession');


    }



}
