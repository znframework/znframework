<?php return 
[
    //--------------------------------------------------------------------------------------------------
    // FileSystem 
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Ftp
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Ftp bağlantı ayarları yapılır.	         						  
    //
    //--------------------------------------------------------------------------------------------------
    'ftp' => 
    [
        'host'       => '',   // Bağlantının sağlanacağı host bilgisi
        'user'       => '',   // Sunucu kullanıcı adı.
        'password'   => '',   // Sunucu kullanıcı şifresi.
        'timeout'    => 90,   // Sunucu bağlantı zaman aşımı süresi.
        'port'       => 21,   // Bağlantı port numarası.
        'sslConnect' => false // SSL kullanılarak sunucu bağlantısı kurulsun mu?.	
    ]
];