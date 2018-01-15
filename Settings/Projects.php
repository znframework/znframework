<?php $default = is_dir(PROJECTS_DIR . ($host = ZN\Base::host())) ? $host : NULL; return
[
    /*
    |--------------------------------------------------------------------------
    | Directory
    |--------------------------------------------------------------------------
    |
    | Contains settings related to the Projects/ directory.
    |
    | default: The default boot directory. If the same name directory as the 
    |          host name exists, the default boot directory is that directory.
    |
    | others : It is specified which domain will run which project directory.
    |          The project directory can be given a alias.
    |  
    |          Example: ['admin' => 'Backend', 'cast.site.com' => 'Cast'] 
    |
    */

    'directory' =>
    [
        'default' => $default ?: 'Frontend',
        'others'  =>
        [
            'backend' => 'Backend'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Containers
    |--------------------------------------------------------------------------
    |
    | Projects contain settings on each other's scope.
    | That is, it is possible to use common files for the projects mentioned.
    | Every directory except Controller and View directories can be used as a 
    | common directory.
    | 
    | Example: child => parent
    */

    'containers' =>
    [
        'Backend' => 'Frontend'
    ]
];
