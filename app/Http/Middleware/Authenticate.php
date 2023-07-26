<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;

use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
      //dd('diomio');
       // dd($request);
        if (! $request->expectsJson()) {
            return route('login');

            //return redirect('/login');
        }
    }


    public function handle($request, Closure $next)
    {
      //dd('diomio');
        //dd(auth()->user()->isActivated);
       // dd(auth()->user()->colaborador);
        //Evaluar si e l usuario esta identificado
        // Evaluar si el usuario tiene un determinado rol

       // if (!auth()->check()) abort(403);
        //dd($role);
//dd('probar');
        if (auth()->check() && auth()->user()->isActivated == 1){
         //dd('diomio');
            return $next($request);
        } else if(auth()->check()){
                 Auth::logout();
                 //return redirect('/login')->with('error', 'Looks Like Your status is InActive');
                 //abort(403);
            } else{

                return redirect('/login');
                }
    }




    }

    

