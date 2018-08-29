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
    | Shopping
    |--------------------------------------------------------------------------
    |
    | Contains settings related to shopping. 
    | 
    | driver: It is specified in which structure the cart information will be 
    | stored.
    |
    */
    
    'shopping' =>
    [
        'driver' => 'session'
    ],

    /*
    |--------------------------------------------------------------------------
    | Compression
    |--------------------------------------------------------------------------
    |
    | Contains settings related to compression. 
    | 
    | driver: It is specified which drive to compress.
    |
    */

    'compression' =>
    [
        'driver' => 'gz'
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
                'password' => NULL,
                'host'     => '127.0.0.1',
                'port'     => 6379,
                'timeout'  => 0
            ]
        ]
    ]
];
