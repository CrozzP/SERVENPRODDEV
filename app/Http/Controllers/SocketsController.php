<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;
use Pusher\Pusher;

class SocketsController extends Controller
{
    //
   public function connect(Request $request){

     // dd("gooood");
      $broadcaster = new PussherBroadcaster(
         new Pusher(
            env("PUSHER_APP_ID"),
            env("PUSHER_APP_KEY"),
            env("PUSHER_APP_SECRET"),
            []
         )
      );

      return $broadcaster->validAuthenticationResponse($request, []);
   }

}
