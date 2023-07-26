<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;
class Role extends Model
{
    protected $fillable = [
    	'roleName', 'description', 'slug',
    ];




//RELACIONES

    public function permissions(){
    	return $this->hasMany('App\Permission');
    }

    public function users(){
        return $this->belongsToMany('App\User')->withTimeStamps();
    }


//ALMACENAMIENTO

    public function crearRole($request){
       // return 'xdfg';
    	//$slug = str_slug($request->roleName,'-');
         $slug = Str::slug($request->roleName, '-');
         
    	return self::create($request->all() + [
    		'slug'=> $slug,
    	]);
    }

    public function my_update($request){
        //$slug = str_slug($request->name,'-');
        $slug = Str::slug($request->roleName, '-');
        self::update($request->all() + [
            'slug'=> $slug,
        ]);
    }

//VALIDACION

//RECUPERACION DE INFORMACION

//OTRAS OPERACIONES





}
