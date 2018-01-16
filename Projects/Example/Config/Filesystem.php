<?php return
[
   /*
    |--------------------------------------------------------------------------
    | File
    |--------------------------------------------------------------------------
    |
    | It contains several settings for the File library.
    |
    | realPath: The methods of the File class specify whether to access 
    |           the file relative to the absolute path or not.
    | parentDirectoryAccess: Set whether to allow parent directory(../) access.
    |
    */

    'file' =>
    [
        'realPath'              => true,
        'parentDirectoryAccess' => false
    ],

    /*
    |--------------------------------------------------------------------------
    | FTP
    |--------------------------------------------------------------------------
    |
    | Includes FTP connection settings.
    |
    */

    'ftp' =>
    [
        'host'       => '',  
        'user'       => '',   
        'password'   => '',   
        'timeout'    => 90, 
        'port'       => 21, 
        'sslConnect' => false 
    ]
];
