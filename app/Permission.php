<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Permission extends Model
{
    
    protected $fillable = [
    	'permissionName', 'slug', 'description', 'role_id',
    ];




 //RELACIONES

    public function role(){
    	return $this->belongsTo('App\Role');
    }




    public function users(){
    	return $this->belongsToMany('App\User')->withTimeStamps();
    }


//ALMACENAMIENTO

    public function store($request){
        $slug = Str::slug($request->permissionName, '-');
    	//$slug = str_slug($request->name, '-');
    	//alert('Exito','El permiso se ha creado', 'success');
    	return self::create($request->all() + [
    		'slug' => $slug,
    	]);
    }

    public function my_update($request){
        $slug = Str::slug($request->permissionName, '-');
       // $slug = str_slug($request->name,'-');
        self::update($request->all() + [
            'slug' =>$slug,
        ]);
       //alert('Exito','El permiso se ha actualizado','success');
    }

//VALIDACION

//RECUPERACION DE INFORMACION

//OTRAS OPERACIONES


}
