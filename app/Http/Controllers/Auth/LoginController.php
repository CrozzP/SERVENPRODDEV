<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
 

use Illuminate\Support\Facades\Auth;
//use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   //protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = '/back/home';
   // protected $redirectTo = '/rer/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /*protected function redirectTo()
    {
        if (auth()->user()->role == 'admin') {
            return '/admin';
        }
        return '/xd/home';
    }*/

    /*protected function redirectTo(){
      //if ($user->isActivated == 1) {
        if(Auth::user()->isActivated == 0){ 
         Auth::logout();
            //return '/admin/panel';
        }
         //dd('dentro del if');
        //    return redirect('/admin/panel')->with('error', 'Looks Like Your status is InActive');
       // dd(Auth::user()->roles);

        foreach (Auth::user()->roles as $roli) {
             $st = $roli->slug;
            
         //dd('para verificar',$roli->slug);
        }
             dd('para verificar',$st);

        return '/rer/home';
    }*/

     public function __construct()
    {
    
        $this->middleware('guest')->except('logout');
    }



    protected function authenticated($request , $user){
        //dd($user);
        //dd('datos', $user->roles);
        //dd($user->roles);
      if(Auth::user()->isActivated == 0){ 
         Auth::logout();
            //return '/admin/panel';
            return redirect('/login');
        }else{

           foreach ($user->roles as $roli) {
                $st = $roli->slug;
               
            //dd('para verificar',$roli->slug);
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
        }

        //dd($user->roles);

}


}
