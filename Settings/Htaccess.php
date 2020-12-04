<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Create File
    |--------------------------------------------------------------------------
    |
    | Changes in this file are processed in .htaccess file. 
    | Set it to false to turn it off.
    |
    */

    'createFile' => true,

    /*
    |--------------------------------------------------------------------------
    | Headers
    |--------------------------------------------------------------------------
    |
    | Predefined HTTP header submissions are defined in the system.
    |
    */

    'headers' =>
    [
        'Header set Connection keep-alive'
    ],

    /*
    |--------------------------------------------------------------------------
    | INI
    |--------------------------------------------------------------------------
    |
    | Contains settings related to ini.
    |
    | status: If this value is true, the changes are processed in 
    |         the .htaccess file.
    |
    */

    'ini' =>
    [
        'status' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    |
    | It is used to manipulate the .htaccess file.
    | Note: Edit the .htaccess file from this section. Do not make manual 
    | edits on the .htaccess file. The changes will be lost if the value of 
    | createFile is true.
    | 
    */

    'settings' =>
    [
        'IfModule mod_headers.c'                              => ['Options -Indexes'],
	    'FilesMatch "^(?i:docker\-compose\.yml|Dockerfile)$"' => ['deny from all']

        //'IfModule mod_rewrite.c'  =>
        //[
        //    'RewriteCond %{HTTPS} !=on',
        //    'RewriteRule ^.*$ https://%{SERVER_NAME}%{REQUEST_URI} [R=301,L]'
        //],
        //'IfModule mod_security.c' => ['SecFilterEngine Off', 'SecFilterScanPOST Off'],
        //'IfModule mime_module'    => ['AddType application/x-httpd-ea-php70 .php .php7 .phtml'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache
    |--------------------------------------------------------------------------
    |
    | Contains settings related to cache.
    |
    */

    'cache' =>
    [
        'obGzhandler' => true,
        'modGzip'     =>
        [
            'status'                => true,
            'includedFileExtension' => 'html?|txt|css|js|php|pl'
        ],
        'modExpires' =>
        [
            'status'       => true,
            'defaultTime'  => 1, # 1 second
            'fileTypeTime' =>
            [
                'text/html'                => 1,        # 1 second
                'image/gif'                => 2592000,  # 1 month
                'image/jpeg'               => 2592000,  # 1 month
                'image/png'                => 2592000,  # 1 month
                'text/css'                 => 604800,   # 1 week
                'text/javascript'          => 216000,   # 2.5 days
                'application/x-javascript' => 216000    # 2.5 days
            ],
        ],
        'modHeaders' =>
        [
            'status'                  => true,
            'fileExtensionTimeAccess' =>
            [
                'ico|pdf|flv|jpg|jpeg|png|gif|swf' => ['time' => 2592000, 'access' => 'public'],
                'css'                              => ['time' => 604800 , 'access' => 'public'],
                'js'                               => ['time' => 216000 , 'access' => 'private'],
                'xml|txt'                          => ['time' => 216000 , 'access' => 'public, must-revalidate'],
                'html|htm|php'                     => ['time' => 1      , 'access' => 'private, must-revalidate']
            ]
        ]
    ]
];
