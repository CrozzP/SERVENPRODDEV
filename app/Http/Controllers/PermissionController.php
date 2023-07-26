<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('role:'.config('app.admin_role'));
    }

    public function index()
    {
        $this->authorize('index',Permission::class);
        /*return view('theme.permission.index', [
            'permissions' => Permission::all(),
             'roles' => Role::all(),

        ]);*/
        //return [ Permission::orderBy('created_at','desc')->get(), Role::all(), ];
        return Permission::orderBy('created_at','desc')->get();
        //$roles = App\User::find(1)->roles()->orderBy('name')->get();
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Permission::class);
        return view('theme.permission.create',[
            'roles' => Role::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Permission $permission)
    {
       
       // dd($request);
        $permission = $permission->store($request);
        
        return $permission;
        //return redirect()->route('backoffice.permission.show',$permission);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $this->authorize('view', $permission);
        return view('theme.permission.show',[
            'permission' => $permission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        
        $this->authorize('update', $permission);
        return view('theme.permission.edit',[
            'permission' => $permission,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Permission $permission)
    {
       
        $permission->my_update($request);
        //return redirect()->route('backoffice.permission.show',$permission);
        return $permission;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);
        $role = $permission->role;
        $permission->delete();
        return $permission;
        //alert('Exito','Permiso eliminado','success');
        //return redirect()->route('backoffice.role.show',$role);
    }
}
