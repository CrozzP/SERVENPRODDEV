<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcaster that will be used by the
    | framework when an event needs to be broadcast. You may set this to
    | any of the connections defined in the "connections" array below.
    |
    | Supported: "pusher", "redis", "log", "null"
    |
    */

    'default' => env('BROADCAST_DRIVER', 'null'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the broadcast connections that will be used
    | to broadcast events to other systems or over websockets. Samples of
    | each available type of connection are provided inside this array.
    |
    */

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                //'cluster' => 'us2',
                //'useTLS' => true,

               // 'cluster' => env('PUSHER_APP_CLUSTER'),
               // //'useTLS' => true,
//
               // 'encrypted' => true,
               // 'host' => '127.0.0.1',
               // //'host' => 'https://192.168.236.231',
               // 'port' => 6001,
               // //'scheme' => 'http'
               // 'scheme' => env('PUSHER_APP_SCHEME'),
               // //'scheme' => 'http'


               'cluster' => env('PUSHER_APP_CLUSTER'),
               //'encrypted' => env('PUSHER_APP_ENCRYPTED'),
               'encrypted' => true,
               'host' => env('PUSHER_APP_HOST'),
               'port' => env('PUSHER_APP_PORT',6001),
               //'host' => '127.0.0.1',
               //'port' =>  6001,
               'scheme' => env('PUSHER_APP_SCHEME'),
               //'scheme' => 'http',
               //'useTLS' => false,
              // 'useTLS' => env('PUSHER_APP_SCHEME')==='https',

             'curl_options' => [
                 CURLOPT_SSL_VERIFYHOST => 0,
                 CURLOPT_SSL_VERIFYPEER => 0,
            ]

              

                 


            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
