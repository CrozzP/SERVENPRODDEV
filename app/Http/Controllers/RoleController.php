<?php

namespace App\Http\Controllers;

use App\Role;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   /* public function __construct()
    {
        $this->middleware('role:'.config('app.admin_role'));
    }*/

    public function index()
    {
       /* return view('theme.role.index',[
            'roles' => Role::all(),
        ]);*/
        
        $this->authorize('index',Role::class);
        
        return Role::orderBy('created_at','desc')->get();
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Role::class);

        return view('theme.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Role $role)
    {
        //$slug = str_slug($request->roleName,'-');
      /* $slug = Str::slug('Laravel 5 Framework', '-');
        
        $role = new Role([
            'roleName' => $request->input('roleName'),
            'description' => $request->input('description'),
            'slug' => $slug
        ]);
        $role->save();
*/
        //dd($role->crearRole());
        //dd($role->crearRole($request));
       // $this->authorize('create',Role::class);
        $role = $role->crearRole($request);
       // return redirect()->route('backoffice.role.show',$role);
       return $role;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('view',$role);
        return view('theme.role.show',[
            'role' => $role,
            'permissions' => $role->permissions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        return view('theme.role.edit',[
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Role $role)
    {
        //dd($request);
        $role->my_update($request);
        return $role;
        //return redirect()->route('backoffice.role.show',$role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);
       // dd($role);
        $role -> delete();
       // alert('Exito','Rol eliminado','success');
        //return redirect()->route('backoffice.role.index');
        return $role;
    }
}
