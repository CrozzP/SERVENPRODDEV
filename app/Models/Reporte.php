<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $connection = 'mysql3';
    protected $table = "reportes";


    protected $fillable=['nombre','estado','created_at','updated_at','tipo','estadoasignado','estador',];




 //public function sede(){
 public function tarea(){
       // return $this->belongsToMany('App\Permission', 'permissionUser')->withTimeStamps();
      //  return $this->belongsToMany('App\Permission', 'permissionUser', 'user_id', 'permission_id')->withTimeStamps();
        //return $this->belongsToMany('App\Models\Sede', 'correoSede', 'sede_id', 'correo_id')->withTimeStamps();
        //return $this->belongsToMany('App\Models\Correo', 'correoSede', 'correo_id', 'sede_id')->withTimeStamps();
        return $this->belongsToMany('App\Models\Reporte', 'tareareporte', 'reporte_id', 'tarea_id')->withTimeStamps();
    }
}
