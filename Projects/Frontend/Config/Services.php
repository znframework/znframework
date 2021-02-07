<?php return
[
    /*
    |--------------------------------------------------------------------------
    | Uri
    |--------------------------------------------------------------------------
    |
    | Contains URI related settings.
    |
    | lang: Language abbreviation becomes available at URI.
    |
    */
    
    'uri' =>
    [
        'lang' => false
    ],

   /*
    |--------------------------------------------------------------------------
    | Email
    |--------------------------------------------------------------------------
    |
    | Contains settings related to Email library. 
    | 
    | driver: Email send drivers. [smtp, imap]
    | smtp: Send settings via SMTP.
    | general: General e-mail settings.
    |
    */

    'email' =>
    [
        'driver' => 'smtp',
        'smtp'   =>
        [
            'host'      => '',
            'user'      => '',
            'password'  => '',
            'port'      => 587,
            'keepAlive' => false,
            'timeout'   => 10,
            'encode'    => '',  # empty, tls, ssl
            'dsn'       => false,
            'auth'      => true
        ],
        'imap' => 
        [
            'host'      => '',
            'user'      => '',
            'password'  => '',
            'port'      => 993,
            'flags'     => [],
            'mailbox'   => 'INBOX'
        ],
        'general' =>
        [
            'senderMail'    => '',                  # Default Sender E-mail Address.
            'senderName'    => '',                  # Default Sender Name.
            'priority'      => 3,                   # 1, 2, 3, 4, 5
            'charset'       => 'UTF-8',             # Charset Type
            'contentType'   => 'html',              # plain, html
            'multiPart'     => 'mixed',             # mixed, related, alternative
            'xMailer'       => 'ZN',
            'encoding'      => '8bit',              # 8bit, 7bit
            'mimeVersion'   => '1.0',               # MIME Version
            'mailPath'      => '/usr/sbin/sendmail' # Default Mail Path
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Processor
    |--------------------------------------------------------------------------
    |
    | Contains Processor library related settings.
    |
    | driver: It is specified which function the Processor::exec() method 
    |         will use.
    |         Options: exec, shell, system, ssh
    | path: The current PHP path. Especially necessary for crontab.
    |
    */

    'processor' =>
    [
        'driver' => 'exec',      
        'path'   => '/usr/bin/php'
    ],

    /*
    |--------------------------------------------------------------------------
    | SSH
    |--------------------------------------------------------------------------
    |
    | Includes SSH connection settings.
    |
    */

    'ssh' =>
    [
        'host'          => '', 
        'user'          => '',  
        'password'      => '',  
        'port'          => 22, 
        'methods'       => [],  
        'callbacks'     => []  
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
