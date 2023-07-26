<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 'administrador')
    {
        //Evaluar si e l usuario esta identificado
        // Evaluar si el usuario tiene un determinado rol

       // if (!auth()->check()) abort(403);
        //dd($role);

        if (!auth()->check()) return redirect('/login');;

        $roles = explode('-', $role);
        if ($request->user()->has_any_role($roles)) {
         //dd('dentro del la prueba');
            //dd($request->user()->colaborador);
            return $next($request);
        } else {
            abort(403);
            
        }
    }
}
