<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Project Language
    |--------------------------------------------------------------------------
    |
    | It is used to change the system's error output or the language used in 
    | language libraries.
    |
    */

    'language' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Mode
    |--------------------------------------------------------------------------
    |
    | The project mode. It is recommended to arrange the publication when the 
    | project is posted.
    | 
    | Options: publication, restoration, development
    |
    */

    'mode' => 'development',

    /*
    |--------------------------------------------------------------------------
    | Key
    |--------------------------------------------------------------------------
    |
    | Project specific encryption key. Affects the Encode::super() method.
    |
    */
    
    'key' => ZN\In::defaultProjectKey(),

    /*
    |--------------------------------------------------------------------------
    | Benchmark
    |--------------------------------------------------------------------------
    |
    | A table with a set of data is displayed in the lower right corner of the 
    | screen.
    |
    */

    'benchmark' => false,

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | It is used to create a project-wide cache.
    | 
    | status: activates the caching process.
    | time: Storage time in seconds.
    | prefix: Adds a prefix to the cache name.
    | driver: Cache driver.
    | compress: Compress driver.
    | exclude: exclude controller/method information.
    | include: include controller/method information.
    | machinesIp: IP addresses that will not be affected from caching.
    |
    */

    'cache' =>
    [
        'status'     => false,
        'time'       => 60,
        'prefix'     => NULL,
        'driver'     => 'file',
        'compress'   => false,
        'exclude'    => [],
        'include'    => [],
        'machinesIP' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Log
    |--------------------------------------------------------------------------
    |
    | Includes settings related to log recording.
    |
    | createFile: Starts the logging process.
    | fileTime: How long it will be stored is specified.
    |
    */

    'log' =>
    [
        'createFile' => false,
        'fileTime'   => '30 day'
    ],

    /*
    |--------------------------------------------------------------------------
    | Header
    |--------------------------------------------------------------------------
    |
    | HTTP headers to be sent.
    |
    */

    'headers' =>
    [
        'content-type: text/html; charset=utf-8'
    ],

    /*
    |--------------------------------------------------------------------------
    | Error Reporting
    |--------------------------------------------------------------------------
    |
    | Includes error reporting settings.
    |
    */

    'errorReporting' => E_ALL,

    /*
    |--------------------------------------------------------------------------
    | Escape Errors
    |--------------------------------------------------------------------------
    |
    | Error numbers for which the error indication is to be prevented.
    |
    */

    'escapeErrors' => [],

    /*
    |--------------------------------------------------------------------------
    | Exit Errors
    |--------------------------------------------------------------------------
    |
    | It is specified which error numbers will stop the code stream.
    |
    */

    'exitErrors' => [0, 2],

    /*
    |--------------------------------------------------------------------------
    | Invalid Parameter Error Type
    |--------------------------------------------------------------------------
    |
    | Invalid parameter error display type.
    |
    | Options: external, internal
    |
    */

    'invalidParameterErrorType' => 'external',

    /*
    |--------------------------------------------------------------------------
    | Restoration
    |--------------------------------------------------------------------------
    |
    | For maintenance, the mode setting must be set to restoration.
    |
    | machinesIP: The IP addresses to be unaffected by restoration are 
    | specified.
    |
    | pages: It is specified on which pages the restoration will be done.
    |
    | routePage: If a request is made to the restored pages, it will be 
    | indicated where it will be directed.
    |
    */

    'restoration' =>
    [
        'machinesIP' => ['127.0.0.1'],
        'pages'      => [],
        'routePage'  => ''
    ]
];
