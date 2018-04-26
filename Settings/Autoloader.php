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
        # INTERNAL_DIR,
        LIBRARIES_DIR,
        EXTERNAL_LIBRARIES_DIR,
        CONTROLLERS_DIR,
        EXTERNAL_CONTROLLERS_DIR,
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
    | Alias Name => Origin Name
    |
    */

    'aliases' => 
    [
        # ZN\StaticAccess
        'StaticAccess'           => 'ZN\StaticAccess',
        
        # ZN\Request
        'Http'    => 'ZN\Request\Http',
        'Server'  => 'ZN\Request\Server',
        'Request' => 'ZN\Request\Request',
        'Post'    => 'ZN\Request\Post',
        'Get'     => 'ZN\Request\Get',
        'Method'  => 'ZN\Request\Method',

        # ZN\Inclusion\Projection
        'Project\Controllers\Masterpage' => 'ZN\Inclusion\Project\Masterpage',
        'Project\Controllers\View'       => 'ZN\Inclusion\Project\View',
        'Project\Controllers\Theme'      => 'ZN\Inclusion\Project\Theme',

        # ZN\Controller
        'Project\Controllers\Controller' => 'ZN\Controller',

        # ZN\Database
        'Model'          => 'ZN\Model',
        'GrandModel'     => 'ZN\Database\GrandModel',
        'RelevanceModel' => 'ZN\Database\RelevanceModel',

        # ZN\Command
        'Project\Commands\Command'  => 'ZN\Command',
        'External\Commands\Command' => 'ZN\ExternalCommand'
    ],

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