<?php return
[
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
            'verification' => '', # Relative
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
];
