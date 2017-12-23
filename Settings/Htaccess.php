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
    | status: If this value is true, the changes are processed in 
    |         the .htaccess file.
    |
    | settings: HTTP headers to be sent.
    |
    */

    'headers' =>
    [
        'status'   => false,
        'settings' =>
        [
            'Header set Connection keep-alive'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Upload
    |--------------------------------------------------------------------------
    |
    | Contains settings related to file uploads.
    |
    | status: If this value is true, the changes are processed in 
    |         the .htaccess file.
    |
    | settings: File upload settings.
    |
    */

    'upload' =>
    [
        'status'   => false,
        'settings' =>
        [
            'file_uploads'            => '', # "1"
            'post_max_size'           => '', # "8M"
            'upload_max_filesize'     => '', # "2M"
            'upload_tmp_dir'          => '', # NULL
            'max_input_nesting_level' => '', # 64
            'max_input_vars'          => '', # 1000
            'max_file_uploads'        => '', # 20
            'max_input_time'          => '', # "-1"
            'max_execution_time'      => ''  # "30"
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Session
    |--------------------------------------------------------------------------
    |
    | Contains settings related to session.
    |
    | status: If this value is true, the changes are processed in 
    |         the .htaccess file.
    |
    | settings: Session settings.
    |
    */

    'session' =>
    [
        'status'   => false,
        'settings' =>
        [
            'session.save_path'                => '', # NULL
            'session.name'                     => '', # PHPSESSID
            'session.save_handler'             => '', # files
            'session.auto_start'               => '', # 0
            'session.gc_probability'           => '', # 1
            'session.gc_divisor'               => '', # 100
            'session.gc_maxlifetime'           => '', # 1440
            'session.serialize_handler'        => '', # php
            'session.cookie_lifetime'          => '', # 0
            'session.cookie_path'              => '', # /
            'session.cookie_domain'            => '', # NULL
            'session.cookie_secure'            => '', # NULL
            'session.cookie_httponly'          => '', # NULL
            'session.use_strict_mode'          => '', # 0
            'session.use_cookies'              => '', # 1
            'session.referer_check'            => '', # NULL
            'session.entropy_file'             => '', # NULL
            'session.entropy_length'           => '', # 0
            'session.cache_limiter'            => '', # nocache
            'session.cache_expire'             => '', # 180
            'session.use_trans_sid'            => '', # 0
            'session.hash_function'            => '', # 0
            'session.hash_bits_per_character'  => '', # 4
            'session.upload_progress.enabled'  => '', # 1
            'session.upload_progress.cleanup'  => '', # 1
            'session.upload_progress.prefix'   => '', # upload_progress
            'session.upload_progress.name'     => '', # PHP_SESSION_UPLOAD_PROGRESS
            'session.upload_progress.freq'     => '', # 1%
            'session.upload_progress.min_freq' => ''  # 1
        ]
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
        'obGzhandler' => false,
        'modGzip'     =>
        [
            'status'                => false,
            'includedFileExtension' => 'html?|txt|css|js|php|pl'
        ],
        'modExpires' =>
        [
            'status'       => false,
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
            'status'                  => false,
            'fileExtensionTimeAccess' =>
            [
                'ico|pdf|flv|jpg|jpeg|png|gif|swf' => ['time' => 2592000, 'access' => 'public'],
                'css'                              => ['time' => 604800,  'access' => 'public'],
                'js'                               => ['time' => 216000,  'access' => 'private'],
                'xml|txt'                          => ['time' => 216000,  'access' => 'public, must-revalidate'],
                'html|htm|php'                     => ['time' => 1,       'access' => 'private, must-revalidate']
            ]
        ]
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
    | settings: INI settings.
    |   
    |     Example: [upload_max_filesize => "10M"]
    |
    */

    'ini' =>
    [
        'status' => false,
        'settings' => []
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
        'IfModule mod_headers.c' => ['Options -Indexes'],

        #'IfModule mod_rewrite.c'  =>
        #[
        #    'RewriteCond %{HTTPS} !=on',
        #    'RewriteRule ^.*$ https://%{SERVER_NAME}%{REQUEST_URI} [R=301,L]'
        #],
        #'IfModule mod_security.c' => ['SecFilterEngine Off', 'SecFilterScanPOST Off'],
        #'IfModule mime_module'    => ['AddType application/x-httpd-ea-php70 .php .php7 .phtml'],
    ]
];
