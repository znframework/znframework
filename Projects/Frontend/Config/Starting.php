<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Controller
    |--------------------------------------------------------------------------
    | 
    | Controllers that will run before the system and before the controllers.
    |
    | Example: 
    | [
    |     'starting/starting:main', 'starting:otherMethod',
    |     'otherController/otherController:main', 'otherController:otherMethod'
    | ]
    |
    */

    'controller' => 'initialize',

    /*
    |--------------------------------------------------------------------------
    | Controller
    |--------------------------------------------------------------------------
    |
    | It is the controllers that will go into the circuit after the 
    | controllers work.
    |
    */

    'destruct' => '',

    /*
    |--------------------------------------------------------------------------
    | Extract View Data
    |--------------------------------------------------------------------------
    |
    | It sends data to the controllers working under it with the View library.
    | Sent data is accessed with [$this] object.
    |
    */

    'extractViewData' => false,

    /*
    |--------------------------------------------------------------------------
    | Autoload
    |--------------------------------------------------------------------------
    |
    | Allows the files in the Starting/Autoload/ folder to be installed 
    | automatically.
    |
    */

    'autoload' =>
    [
        'status'    => true,
        'recursive' => false
    ]
];
