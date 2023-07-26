<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    //protected $redirectTo = '/back/home';
    public function handle($request, Closure $next, $guard = null)
    {
        //dd('holita');
        //dd($request);
        if (Auth::guard($guard)->check()) {
          foreach (Auth::user()->roles as $roli) {
                $st = $roli->slug;
               
            //dd('para verificar',$roli->slug);
                //dd('ddd',$st);
                switch ($st) {
                       
                   case 'administrador':
                      //dd('dentro de ',$st);
                       // $this->$redirectTo = '/rer/home';
                        return redirect('/back/home');
                       break;

                   case 'repositorio':
                      //dd('dentro de ',$st);
                       // $this->$redirectTo = '/back/home';
                        // $redirectTo = '/rer/home';
                         return redirect('/repositorio/home');
                       break;
                   case 'administrar':
                      //dd('dentro de ',$st);
                       // $this->$redirectTo = '/back/home';
                        // $redirectTo = '/rer/home';
                         return redirect('/back/home');
                       break;

                   case 'serven':
                      //dd('dentro de ',$st);
                       // $this->$redirectTo = '/back/home';
                        // $redirectTo = '/rer/home';
                         return redirect('/back/home');
                       break;

                   case 'servenrer':
                      //dd('dentro de ',$st);
                       // $this->$redirectTo = '/back/home';
                        // $redirectTo = '/rer/home';
                         return redirect('/rer/home');
                       break;

                   case 'service':
                      //dd('dentro de ',$st);
                       // $this->$redirectTo = '/back/home';
                        // $redirectTo = '/rer/home';
                         return redirect('/service/home');
                       break;
                   
                   default:
                       # code...
                   return redirect('/login');
                       break;
               }
           }


        // dd('dentro del app');
            //return redirect(RouteServiceProvider::HOME);
            //return redirect('/back/home');

            //protected $redirectTo = RouteServiceProvider::HOME;
            //protected $redirectTo = '/back/home';
            
           // return $redirectTo;
        }

        return $next($request);
    }
}
