<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Directory Scanning
    |--------------------------------------------------------------------------
    |
    | Determines whether class scans should be performed after the class 
    | definition. If this setting is set to true, the newly created classes 
    | search the specified directories for readiness. 
    | 
    | It is recommended to be true.
    |
    */

    'directoryScanning' => true,

    /*
    |--------------------------------------------------------------------------
    | Directory Permission
    |--------------------------------------------------------------------------
    |
    | With auto loader, the permissions of the folders where 
    | the classes are created are set.
    |
    */

    'directoryPermission' => 0755,

    /*
    |--------------------------------------------------------------------------
    | Class Map
    |--------------------------------------------------------------------------
    |
    | Which directories will be scanned for auto loader.
    |
    */

    'classMap' =>
    [
        INTERNAL_DIR,
        LIBRARIES_DIR,
        EXTERNAL_LIBRARIES_DIR,
        MODELS_DIR,
        EXTERNAL_MODELS_DIR,
        COMMANDS_DIR,
        EXTERNAL_COMMANDS_DIR
    ],

    /*
    |--------------------------------------------------------------------------
    | Aliases
    |--------------------------------------------------------------------------
    |
    | Used to give alias to classes.
    |
    */

    'aliases' => [],

    /*
    |--------------------------------------------------------------------------
    | Composer
    |--------------------------------------------------------------------------
    |
    | Set whether the Composer auto loader can be used or not.
    |
    | Option1: true[vendor/autoload.php]
    | Option2: false
    | Option3: vendor autoload path
    |
    */

    'composer' => true
];