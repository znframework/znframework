<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Socialite
    |--------------------------------------------------------------------------
    |
    | Used to create provider configurations for the Socialite library.
    |
    | 'github' => 
    | [
    |     'id'     => 'your-app-id',
    |     'secret' => 'your-app-secret'
    | ],
    |
    | ...
    |
    */

    'socialite' => [],

    /*
    |--------------------------------------------------------------------------
    | Compress
    |--------------------------------------------------------------------------
    |
    | Includes the driver configuration for the Compress library.
    |
    | Drivers: gz, bz, lzf, rar, zip, zlib
    |
    */
  
    'compress' =>
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
                'password'   => NULL,
                'socketType' => 'tcp',
                'host'       => '127.0.0.1',
                'port'       => 6379,
                'timeout'    => 0
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Cart
    |--------------------------------------------------------------------------
    |
    | Includes the driver configuration for the Cart library.
    |
    | Drivers: session, cookie
    |
    */

    'cart' =>
    [
        'driver' => 'session'
    ],

    /*
    |--------------------------------------------------------------------------
    | Permission
    |--------------------------------------------------------------------------
    |
    | Includes configurations for the Permission library.
    | 
    | method : It is used to set which id value will use which method of sending.
    | page   : It is used to set which id value will use which page.
    | process: It is used to set which id value will use which object.
    |
    | Example Usage
    |
    | [
    |     '1' => 'any',
    |     '2' => ['noperm'  => ['delete', 'update']],
    |     '3' => ['perm'    => ['delete', 'update']],
    |     '4' => ['noperm'  => ['delete', 'update', 'add']],
    |     '5' => 'all'
    | ]
    |
    */

    'permission' =>
    [
        'method'  => [],
        'page'    => [],
        'process' => []
    ],

    /*
    |--------------------------------------------------------------------------
    | User
    |--------------------------------------------------------------------------
    |
    | Includes configurations for the User library.
    |
    | encode: When the user is registered in, the algorithm to encrypt the 
    | password is set.
    |
    | matching: It specifies which tables and columns the User class will use.
    |
    | joining: This setting is used if the users table consists of joined 
    | tables.
    |
    | emailSenderInfo: This is to specify the sender name and email 
    | information of the e-mail to be sent during the activation process or 
    | password forgotten operations.
    |
    */

    'user' =>
    [
        'encode'   => 'super',
        'matching' =>
        [
            'table'   => '',
            'columns' =>
            [
                'username'     => '', # Required
                'password'     => '', # Required
                'email'        => '', # Relative
                'active'       => '', # Relative
                'banned'       => '', # Relative
                'activation'   => '', # Relative
                'verification' => '', # Rleative
                'otherLogin'   => []  # Relative
            ]
        ],
        'joining' =>
        [
            'column' => '',
            'tables' => []
        ],
        'emailSenderInfo' =>
        [
            'name' => '',
            'mail' => ''
        ]
    ]
];
