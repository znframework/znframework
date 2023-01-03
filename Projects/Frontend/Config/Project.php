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
    | Timezone
    |--------------------------------------------------------------------------
    |
    | Sets the region for the time zone.
    |
    */

    'timezone' => 'Europe/Istanbul',
    
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
    
    'key' => ZN\In::secretProjectKey('Your secret key'),

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

    'exitErrors' => [1],

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
