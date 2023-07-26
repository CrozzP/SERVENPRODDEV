<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Permission;
use App\Models\Colaborador;
use App\Models\PuestoColaborador;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Http\Request;
use App\Http\Requests\User\ChangePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    



     public function getPrueba()
    {
        
        //return view('users');
        return User::orderBy('created_at','desc')->get();
         
    }
     public function index()
    {
      //dd('holi');
      
        $this->authorize('index', User::class);
       
        //return User::orderBy('created_at','desc')->get();
       
        $user = auth()->user()->visible_users();

        
                     $i = 0;


                    foreach ($user as $tareasReporte) {
                        
                        //dd($correo->correo);
                       // echo $correo->correo;
                        //$tareasReporteIds[$i]=$tareasReporte->value;
                        $uEmpresa[$i]=$tareasReporte->empresas;
                        $uSede[$i]=$tareasReporte->sedes;
                        $uRole[$i]=$tareasReporte->roles;

                        $ie = 0;

                        foreach ($uEmpresa[$i] as $empresa) {
                           // code...
                           $uEmpresa_id=$empresa->id;
                           //$cc[$i] = $tareasReporteIdss;
                           $user[$i]->empresaR = $uEmpresa_id;
                        $ie++;
                        }

                        $is = 0;

                        foreach ($uSede[$i] as $sede) {
                           // code...
                           $uSede_id[$is]=$sede->id;
                           //$cc[$i] = $tareasReporteIdss;
                           $user[$i]->sedeR = $uSede_id;
                        $is++;
                        }

                        $ir = 0;

                        foreach ($uRole[$i] as $role) {
                           // code...
                           $uRole_id[$ir]=$role->id;
                           //$cc[$i] = $tareasReporteIdss;
                           $user[$i]->roleR = $uRole_id;
                        $ir++;
                        }
                        
                        $i++;
                        unset($uRole_id);
                        //unset($uRole_id);
                    }





        //dd('xddd',$uRole);
       //dd('xddd',$user);


        if (empty($user)) {
            //dd(Auth::user());
            return ['users' =>Auth::user()];
        } else {
            return [
            'users' => $user,
            'userLogged' => Auth::user()

        ];

        }
        //return $user;
        
        //return (['users'=> auth()->user()->visible_users()]);

    }

    
//*********************************************************

        public function usuarioFiltrar(Request $request)
    {
       // dd("dentro del conrtoller-search");
       //dd($request);
        $user = auth()->user()->visible_userss($request);

       // $user = Auth::user();

        $tipoBusqueda = $request->tipoSearch;
      

       /* switch ($tipoBusqueda) {
            case 'name':
               
                $extraordinarios = Extraordinario::with('suministro','usuario', 'obsTipoExtraordinario.tipoExtraordinario','personaExtraordinario.persona','estadoExtraordinario')
                    ->whereHas('estadoExtraordinario', function($query) use ($user)  {
                        $query->where('sede_id','=', $user->sede_id);
                    })
                    ->whereHas('personaExtraordinario.persona', function($query) use ($request)  {
                        $query->where('dni','=', $request->search);
                    })
                    
                    ->Paginate(10);

            break;
            case 'fullName':

            break;

            case 'email':

            break;
           
            
            default:

            break;

        }*/

     
        return $user;
      
    }




    //***************************************************************
    public function list()
    {
        return response()->json([
            'users' => \App\User::latest()->get()
        ], Response::HTTP_OK);
         
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('theme.user.create', [
            'roles' => Role::all(),

        ]);
    }

    public function store(StoreRequest $request, User $user)
    {
        //dd($request);
        
        $user = $user->store($request);


        $user->empresas()->sync($request->empresa_id);
        $user->sedes()->sync($request->sede_id);
        $user->roles()->sync($request->roleR);


        return $user;
        //return redirect()->route('backoffice.user.show', $user);
    }

    public function show(User $user, Request $request)
    {
        //dd($request);
        $this->authorize('view', $user);
       // $user = User::with('sedes')->orderBy('created_at','DESC')->where('id',$user->id)->get();
        
        //$user = User::where('id',$user->id)->with('sedes')->get();

      


       // dd($user);


     //  return $user;     

       return view('admin.user.showuser',[
            'user' => $user,
        ]);
        //return $user;
    }

    public function getShowUser(Request $request)
    {
        //dd('holita',$request);

        $users = User::with('sedes','empresas','roles','colaborador','permissions')->orderBy('created_at','DESC')->where('id',$request->user_id)->first();
        return $users;
    }

    public function edit(User $user)
    {
     // dd('editar', $request);

        $this->authorize('update', $user);
        //$view = (isset($_GET['view'])) ? $_GET['view'] : null;
        return view($user->edit_view($view), [
            'user' => $user,
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
      //dd('o por dios', $request);
        //dd('$request->empresaR', [$request->empresaR],'$request->sede_i',$request->sede_i);
        $user->my_update($request);
        $user->empresas()->sync([$request->empresaR]);
        $user->sedes()->sync($request->sede_i);
        $user->roles()->sync($request->roleR);
       // $view = (isset($_GET['view'])) ? $_GET['view'] : null;
        //return redirect()->route($user->user_show(),$user);
        return $user;
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
 
        $user->delete();
        //alert('Exito','Usuario eliminado','success');
        //return redirect()->route('backoffice.user.index');
        return $user;
    }

    //Mostrar formulario para asignar rol
    public function assign_role(User $user)
    {
        $this->authorize('assign_role', $user);
        //dd($user);
        /*return [
            'user' => $user,
            'roles' => Role::all(),
        ];*/
        return view('admin.user.assign_role',[
            'user' => $user,
            'roles' => Role::all(),

        ]);
    }

    
    //Asigna los roles a la DB

   /* public function welcome6(Request $request,User $user){
        //dd($request->roles);
        //dd(has_role($id));
        $user->roles()->sync($request->roles);
        //$user->role_assignment($request);
       // return redirect()->route('welcome5',$user);
        return view('welcome5',$user);
        //return $user;
    }*/

    public function role_assignment(Request $request,User $user)
    {
        $this->authorize('assign_role', $user);
       // dd($request->roles);
        //dd(has_role($id));
       /* $user->roles()->sync($request->roles);*/
        $user->role_assignment($request);
        return redirect()->route('user.show',$user);
        ///return $user;
    }

    //Mostrar el formulario de los permisos
    public function assign_permission(User $user)
    {
        $this->authorize('assign_permission', $user);

        return view('admin.user.assign_permission',[
            'user' => $user,
            'roles' => $user->roles,
        ]);
       /* return ['user' => $user,
            'roles' => $user->roles,];*/

    }


    //Asignar permisos tabla pivote a la DB
    public function permission_assignment(Request $request, User $user){
        //dd($request->user);
        $this->authorize('assign_permission', $user);
        $user->permissions()->sync($request->permissions);
        //alert('Exito','Permisos asignados correctamente','success');
        return redirect()->route('user.show',$user);

    }

    //mostrar el formulario para importar usuarios

    public function import(){
        $this->authorize('import', $user);
        return view('theme.user.import');
    }

    //IMORTAR USUARIO DESDE UN EXCEL
    public function make_import(Request $request){
        $this->authorize('import', $user);

        Excel::import(new UsersImport, $request->file('excel'));
       // Excel::import(new UsersImport,request()->file('excel'));
        //Excel::import(new UsersImport, request()->file('your_file'));
        alert('Exito','Usuarios importador','success');
        return redirect()->route('backoffice.user.index');
    }


    public function profile()
    {


        $user = auth()->user();
       /* return view('theme.frontoffice.user.profile',[
            'user' => $user,
        ]);*/

        return $user;
    }

    public function edit_password(){
       // $this->authorize('update', $user);
        $this->authorize('update_password',auth()->user());
        return view('theme.frontoffice.user.edit_password');
    }

    public function change_password(ChangePasswordRequest $request)
    {
        //dd($request);
        $request->user()->password = \Hash::make($request->password);
        $request->user()->save();
        //alert('Exito','Contraseña modificada','success');
        return redirect()->back();
    }

    public function userEst(Request $request)
    {
      //dd('holitas');
     // $user = auth()->user()->colaborador;
      $users = Auth::user();
      //dd($users->id);
     //$usersaa = User::with('sedes','empresas','roles')->orderBy('created_at','DESC')->where('id','=',1)->first();
     $usersedes = User::with('sedes')->orderBy('created_at','DESC')->where('id','=',$users->id)->first();
      //dd('diomioooo',$usersaa->sedes);
     $colaboradores = Colaborador::with('colaboradorEmp.empresa')->where('user_id','=',$users->id)->where('estado','=','1')->first();
     $puestosColaboradores = PuestoColaborador::with('puesto')->where('colaborador_id','=',$colaboradores->id)->where('estado','=','1')->first();
//dd($users->roles->id);
      $i = 0;
        foreach ($users->roles as $user) {
         //$xd[$i]=$user->id;
         $xd[$i]=Permission::where('role_id','=',$user->id)->get();
            //$userSede[$io]=$sedeId->id;
       
     $users->roles[$i]->permisos = $xd[$i];
            $i++;
        }
            //dd($xd);

     $users->colaborador = $colaboradores;
     $users->puestoColaborador = $puestosColaboradores;

     $users->usersedes = $usersedes->sedes;
   

      /*$extraordinarios = DB::table('extraordinarios')
      ->select('extraordinarios.id', 'suministros.CodigoSuministro','tipoExtraordinario.nombreTipoExt','estadoExtraordinarios.created_at','suministros.CodigoRutaSuministro', 'suministros.NombreSuministro', 'personas.nombres', 'personas.nombre', 'personas.apellPat', 'personas.apellMat', 'suministros.DireccionPredio', 'personas.telefono', 'estadoExtraordinarios.referencia', 'suministros.Longitud', 'suministros.Latitud', 'suministros.NombreZonaAdministrativa','suministros.SerieMedidor','suministros.NombreTipoSistema')

      ->join('estadoExtraordinarios', 'extraordinarios.id', '=', 'estadoExtraordinarios.extraordinario_id')
      ->join('personaExtraordinario', 'extraordinarios.id', '=', 'personaExtraordinario.extraordinario_id')
      ->join('personas', 'personaExtraordinario.persona_id', '=', 'personas.id')
      ->join('suministros', 'extraordinarios.suministro_id', '=', 'suministros.CodigoSuministro')
      ->join('obsTipoExtraordinario', 'extraordinarios.obsTipoExtraordinario_id', '=', 'obsTipoExtraordinario.id')
      ->join('tipoExtraordinario', 'obsTipoExtraordinario.tipoExtraordinario_id', '=', 'tipoExtraordinario.id')
      //->whereIn('estadoExtraordinarios.sede_id',$userSede)
      ->whereIn('estadoExtraordinarios.sede_id',$request->sedes)

      ->where([
          ['obsTipoExtraordinario.tipoExtraordinario_id', '=', 1],
          ['estadoExtraordinarios.fechaInicio', '>=', $request->FechaInicio],
          ['estadoExtraordinarios.fechaInicio', '<=', $request->FechaFinal],
      ])
      
      ->get();*/
               
               


        return $users;
    }

}
