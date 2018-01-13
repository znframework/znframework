<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Cookie
    |--------------------------------------------------------------------------
    |
    | Contains settings related to cookies. 
    | Configures the parameters of the setcookie function.
    | 
    | encode: The cookie keys are set to which algorithm to encrypt.
    |
    */

    'cookie' =>
    [
        'encode'     => 'super',
        'regenerate' => true,
        'time'       => 604800,
        'path'       => '/',
        'domain'     => '',
        'secure'     => false,
        'httpOnly'   => true
    ],

    /*
    |--------------------------------------------------------------------------
    | Session
    |--------------------------------------------------------------------------
    |
    | Contains settings related to session. 
    | 
    | encode: The cookie keys are set to which algorithm to encrypt.
    |
    */

    'session' =>
    [
        'encode'     => 'super',
        'regenerate' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Includes configurations for the Cache library.
    |
    | drivers       : apc, memcache, wincache, file, redis
    | driverSettings: Configurations by driver
    |
    */
   
    'cache' =>
    [
        'driver'         => 'file',
        'driverSettings' =>
        [
            'memcache' =>
            [
                'host'   => '127.0.0.1',
                'port'   => '11211',
                'weight' => '1',
            ],
            'redis' =>
            [
                'password'   => NULL,
                'socketType' => 'tcp',
                'host'       => '127.0.0.1',
                'port'       => 6379,
                'timeout'    => 0
            ]
        ]
    ]
];
