<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


use App\Models\Colaborador;
use App\Models\PuestoColaborador;



use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $connection = 'mysql';

    protected $table = "users";

    protected $fillable = [
        'name', 'email', 'password', 'fullName', 'userType', 'role_id', 'permission_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    


    //RELACIONES


    public function permissions(){
       // return $this->belongsToMany('App\Permission', 'permissionUser')->withTimeStamps();
        return $this->belongsToMany('App\Permission', 'permissionUser', 'user_id', 'permission_id')->withTimeStamps();
    }

    public function roles(){
       // return $this->belongsToMany('App\Role')->withTimeStamps();
      //  return $this->belongsToMany('App\Role', 'roleUser')->withTimeStamps();
        return $this->belongsToMany('App\Role', 'roleUser', 'user_id', 'role_id')->withTimeStamps();

    }

    

    public function empresas(){
       // return $this->belongsToMany('App\Role')->withTimeStamps();
      //  return $this->belongsToMany('App\Role', 'roleUser')->withTimeStamps();
        return $this->belongsToMany('App\Models\Empresa', 'userEmpresa', 'user_id', 'empresa_id')->withTimeStamps();

    }
   
    public function sedes(){
       // return $this->belongsToMany('App\Role')->withTimeStamps();
      //  return $this->belongsToMany('App\Role', 'roleUser')->withTimeStamps();
        return $this->belongsToMany('App\Models\Sede', 'userSede', 'user_id', 'sede_id')->withTimeStamps();

    }
   
    public function colaborador(){
       // return $this->belongsToMany('App\Role')->withTimeStamps();
      //  return $this->belongsToMany('App\Role', 'roleUser')->withTimeStamps();
     // dd(Auth::user()->id);
        return $this->hasOne('App\Models\Colaborador', 'user_id', 'id');
        //dd($xd);
       // $colaborador=Colaborador::where('user_id','=','1')
       //             ->first();

    }
   
    
//ALMACENAMIENTO

    public function store($request){

        $user = self::create($request->all());
        $user->update(['password' => Hash::make($request->password)]);
        //$roles = [$request->role];
        $roles = $request->role;
        $user->role_assignment(null, $roles);
        //alert('Exito','Usuario creado con exito','success');
        return $user;

    }

    public function my_update($request){
        self::update($request->all());
        //alert('Exito','Usuario actualizado','success');
    }


    public function role_assignment($request, array $roles = null){
        $roles = (is_null($roles)) ? $request->roles : $roles ;
        $this->permission_mass_assignment($roles);
        $this->roles()->sync($roles);
        $this->verify_permission_integrity($roles);
        //alert('Exito','roles asignados','success');
    }

    //OTRAS OPERACIONES

    PUBLIC FUNCTION verify_permission_integrity(array $roles){
        $permissions = $this->permissions;
        foreach($permissions as $permission){
            /*if (!$this->has_role($permission->role->id)) {
                $this->permissions()->detach($permission->id);
            }*/
            
            if(!in_array($permission->role->id, $roles)){
                $this->permissions()->detach($permission->id);
            }
        }
    }

    public function permission_mass_assignment(array $roles){
        foreach($roles as $role){
            if(!$this->has_role($role)){
                $role_obj = \App\Role::findOrFail($role);
                $permissions = $role_obj->permissions;
                $this->permissions()->syncWithoutDetaching($permissions);
            }
        }
    }

//VISTAS

    //VALIDACION
    
     public function is_admin(){
        $admin = config('app.admin_role');
        if($this->has_role($admin)){
            return true;
        }else{
            return false;
        }

    }


    public function has_role($id){
        foreach($this->roles as $role){
           if($role->id == $id || $role->slug == $id) 
            return true;
        }
        return false;
    }



    public function has_any_role(array $roles){
        foreach ($roles as $role) {
            if($this->has_role($role)) return true;
        }
        return false;
    }

     public function has_permission($id){
        //dd($id);
        foreach ($this->permissions as $permission) {
            if($permission->id == $id || $permission->slug == $id) return true;

        }
        return false;
       
    }




//VISTAS

/*

    public function visible_users(){
        if($this->has_role(config('app.admin_role'))) $users = self::orderBy('created_at','desc')->get();
        if($this->has_role(config('app.coord_role'))) {
            $users = self::whereHas('roles', function($q){
                $q->whereIn('slug', [
                    config('app.auxil_role'),
                    'secretario',
                    config('app.logis_role'),
                ]);
            })->get();
        }
        if($this->has_role(config('app.auxil_role'))) {
            $users = self::whereHas('roles', function($q){
                $q->whereIn('slug', [
                    config('app.logis_role'),
                ]);
            })->get();
        }

        return $users;


    }

*/

/*

    

    public function visible_users(){
        if($this->has_role(config('app.admin_role'))) $users = self::orderBy('created_at','desc')->get();
            if($this->has_role(config('app.coord_role'))) {
                $users = self::whereHas('roles', function($q){
                    $q->whereIn('slug', [
                        config('app.auxil_role'),
                        'secretario',
                        config('app.logis_role'),
                    ]);
                })->get();
            }
            if($this->has_role(config('app.auxil_role'))) {
                $users = self::whereHas('roles', function($q){
                    $q->whereIn('slug', [
                        config('app.logis_role'),
                    ]);
                })->get();
            }

        return $users;


    }

*/

 

    public function visible_users(){
        
        if($this->has_role(config('app.admin_role'))) $users = self::with('sedes','empresas','roles','colaborador','permissions')->orderBy('created_at','desc')->Paginate(10);
        if($this->has_role(config('app.jefesupervisor_role'))) {
            $users = self::with('sedes','empresas','roles','colaborador','permissions')->whereHas('roles', function($q){
                $q->whereIn('slug', [
                    config('app.supervisor_role'),
                    
                    config('app.modul_role'),
                ]);
            })->Paginate(10);
        }
        if($this->has_role(config('app.supervisor_role'))) {
            $users = self::with('sedes','empresas','roles','colaborador','permissions')->whereHas('roles', function($q){
                $q->whereIn('slug', [
                    config('app.modul_role'),
                ]);
            })->Paginate(10);
        }
        if($this->has_role(config('app.modul_role'))) {
            /*$users = self::whereHas('roles', function($q){
                $q->whereIn('slug', [
                    config('app.modul_role'),
                ]);
            })->get();*/
            //$users = Auth::user();
          //  $userid = Auth::user()->id;
            //return User::orderBy('created_at','desc')->get();
            //return Flight::findOrFail($id);
           // $users = User::find(Auth::user()->id)->get();
            $users = User::with('sedes','empresas','roles','colaborador','permissions')->where('id',Auth::user()->id)->Paginate(10);

            /*return [
                'id'=> Auth::user()->id,
            ];*/
            //$users = $usersd->id;
            //$users = $usersd->name;
        }
        //dd(auth()->user());

        return $users;


    }
       public function visible_userss($request){
        //dd($request);
       // if($this->has_role(config('app.admin_role'))) $users = self::orderBy('created_at','desc')->get();
        if(empty($request->sedesBus) && empty($request->tipoSearch) ){
            //dd('si datos',$request);
            if($this->has_role(config('app.admin_role'))) $users = self::with('sedes','empresas','roles','colaborador','permissions')->orderBy('created_at','desc')->Paginate(5);
           if($this->has_role(config('app.jefesupervisor_role'))) {
               $users = self::with('sedes','empresas','roles','colaborador','permissions')->whereHas('roles', function($q){
                   $q->whereIn('slug', [
                       config('app.supervisor_role'),
                       
                       config('app.modul_role'),
                   ]);
               })->Paginate(5);
           }
           if($this->has_role(config('app.supervisor_role'))) {
               $users = self::with('sedes','empresas','roles','colaborador','permissions')->whereHas('roles', function($q){
                   $q->whereIn('slug', [
                       config('app.modul_role'),
                   ]);
               })->Paginate(5);
           }
           if($this->has_role(config('app.modul_role'))) {
              
               $users = User::with('sedes','empresas','roles','colaborador','permissions')->where('id',Auth::user()->id)->Paginate(5);

          
           }
        } else if(empty($request->sedesBus) && !empty($request->tipoSearch) && !empty($request->search) ){
         //dd('si datos__',$request);
            if($this->has_role(config('app.admin_role'))) $users = self::with('sedes','empresas','roles','colaborador','permissions')->where($request->tipoSearch,'like' ,"%{$request->search}%")->orderBy('created_at','desc')->Paginate(5);
               if($this->has_role(config('app.jefesupervisor_role'))) {
                    $users = self::with('sedes','empresas','roles','colaborador','permissions')->where($request->tipoSearch,'like' ,"%{$request->search}%") 
                        ->whereHas('roles', function($q){
                            $q->whereIn('slug', [
                                config('app.supervisor_role'),
                            
                                config('app.modul_role'),
                                ]);
                            })
                        ->Paginate(5);
                }
                if($this->has_role(config('app.supervisor_role'))) {
                    $users = self::with('sedes','empresas','roles','colaborador','permissions')->where($request->tipoSearch,'like' ,"%{$request->search}%") 
                        ->whereHas('roles', function($q){
                            $q->whereIn('slug', [
                                config('app.modul_role'),
                                ]);
                            })
                        ->Paginate(5);
                }
                if($this->has_role(config('app.modul_role'))) {
                    
                    $users = User::with('sedes','empresas','roles','colaborador','permissions')->where('id',Auth::user()->id)->Paginate(5);

                }

         }else{
            //dd('con datos',$request);

            if(empty($request->tipoSearch)){
                //dd('hola empty');
                if($this->has_role(config('app.admin_role'))){ 
                 //dd('hola con datos',$request->sedesBus);
                    $users = self::with('sedes','empresas','roles','colaborador','permissions')->whereHas('sedes',function($q) use ($request){
                                $q->whereIn('sede_id',$request->sedesBus); 
                                //$q->whereIn('sede_id',['2101','2102','2111']); 
                            })
                            ->orderBy('created_at','desc')
                            ->Paginate(5);
                }
                if($this->has_role(config('app.jefesupervisor_role'))) {
                    $users = self::with('sedes','empresas','roles','colaborador','permissions')->whereHas('roles', function($q){
                            $q->whereIn('slug', [
                                config('app.supervisor_role'),
                            
                                config('app.modul_role'),
                                ]);
                            })
                        ->whereHas('sedes',function($q) use ($request){
                                $q->whereIn('sede_id',$request->sedesBus); 
                                //$q->whereIn('sede_id',['2101','2102','2111']); 
                            })
                        ->Paginate(5);
                }
                if($this->has_role(config('app.supervisor_role'))) {
                    $users = self::with('sedes','empresas','roles','colaborador','permissions')->whereHas('roles', function($q){
                            $q->whereIn('slug', [
                                config('app.modul_role'),
                                ]);
                            })
                        ->whereHas('sedes',function($q) use ($request){
                                $q->whereIn('sede_id',$request->sedesBus); 
                                //$q->whereIn('sede_id',['2101','2102','2111']); 
                            })
                        ->Paginate(5);
                }
                if($this->has_role(config('app.modul_role'))) {
                    
                    $users = User::with('sedes','empresas','roles','colaborador','permissions')->where('id',Auth::user()->id)->Paginate(5);

                }


            } else{

              //  $correos = DB::select('select * from users u inner join userSede us on u.id=us.user_id 
               // WHERE  us.sede_id = ?', [$request->sedesBus]);

                if($this->has_role(config('app.admin_role'))){ 
                     //dd('hola con datos',$request->sedesBus);
                    $users = self::with('sedes','empresas','roles','colaborador','permissions')->where($request->tipoSearch, $request->search) 
                            
                            ->whereHas('sedes',function($q) use ($request){
                                $q->whereIn('sede_id',$request->sedesBus); 
                                //$q->whereIn('sede_id',['2101','2102','2111']); 
                            })
                            ->orderBy('created_at','desc')
                            ->Paginate(5);
                }
                if($this->has_role(config('app.jefesupervisor_role'))) {
                    $users = self::with('sedes','empresas','roles','colaborador','permissions')->where($request->tipoSearch, $request->search) 
                        ->whereHas('roles', function($q){
                            $q->whereIn('slug', [
                                config('app.supervisor_role'),
                            
                                config('app.modul_role'),
                                ]);
                            })
                        ->whereHas('sedes',function($q) use ($request){
                                $q->whereIn('sede_id',$request->sedesBus); 
                                //$q->whereIn('sede_id',['2101','2102','2111']); 
                            })
                        ->Paginate(5);
                }
                if($this->has_role(config('app.supervisor_role'))) {
                    $users = self::with('sedes','empresas','roles','colaborador','permissions')->where($request->tipoSearch, $request->search) 
                        ->whereHas('roles', function($q){
                            $q->whereIn('slug', [
                                config('app.modul_role'),
                                ]);
                            })
                        ->whereHas('sedes',function($q) use ($request){
                                $q->whereIn('sede_id',$request->sedesBus); 
                                //$q->whereIn('sede_id',['2101','2102','2111']); 
                            })
                        ->Paginate(5);
                }
                if($this->has_role(config('app.modul_role'))) {
                    
                    $users = User::with('sedes','empresas','roles','colaborador','permissions')->where('id',Auth::user()->id)->Paginate(5);

                }

            }
        }


            


        


        return $users;


    }

    public function edit_view($view = null){

        $auth = auth()->user();

        if(!is_null($view) && $view == 'frontoffice'){
            return 'theme.frontoffice.user.edit';
        }else if($auth->has_role(config('app.admin_role'))){
            return 'theme.user.edit';
        }else{
            return 'theme.frontoffice.user.edit';
        }   

    }

    public function user_show($view = null){

        $auth = auth()->user();

        if(!is_null($view) && $view == 'frontoffice'){
            return 'frontoffice.user.profile';
        }else if($auth->has_role(config('app.admin_role'))){
            return 'backoffice.user.show';
        }else{
            return 'frontoffice.user.profile';
        } 
    }



}
