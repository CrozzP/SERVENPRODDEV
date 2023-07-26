<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       // dd($request);
     // dd('diomio');

        if ($request->path()=='app/admin_login') {
            return $next($request);
        }
        if (!Auth::check()) {
            return response()->json([
                'msg'=>'Tu no puedes acceder a la ruta',
                'url'=>$request->path()
            ],403);
        }
        $user = Auth::user();
        //if ($user->userType=='User') {
        if ($user->role->isAdmin==1) {
            return response()->json([
                'msg'=>'Tu no puedes acceder a la ruta'
            ],403);
        }

        return $next($request);
    }
}
