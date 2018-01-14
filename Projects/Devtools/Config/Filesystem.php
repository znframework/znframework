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
    // File
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Ftp bağlantı ayarları yapılır.
    //
    //--------------------------------------------------------------------------------------------------
    'file' =>
    [
        //----------------------------------------------------------------------------------------------
        // Real Path
        //----------------------------------------------------------------------------------------------
        //
        // File ve Folder kütüphanelerinin kullanımında dosya işlemleri tam yolları ile mi yapılsın?
        // Sorusuna yanıt vermek için oluşturulmuştur. Bu ayarın true olması durumunda dosyalara gerçek
        // yolları ile erişim sağlanır. Aksi halde yalın yollar ile erişim sağlanır.
        //
        //----------------------------------------------------------------------------------------------
        'realPath'              => true,

        //----------------------------------------------------------------------------------------------
        // Parent Directory Access
        //----------------------------------------------------------------------------------------------
        //
        // File ve Folder kütüphanelerinin kullanımında ../ sembolü ile bir üst dizine erişim sağlanıp
        // sağlanayamacağıdır. Mevcut kütüphane güvenlik problemleri nedeni ile bu erişimi kapatmıştır.
        // Bu durumundan kurtulmak için bu ayarın değerini true olarak ayarlayabilirsiniz.
        //
        //----------------------------------------------------------------------------------------------
        'parentDirectoryAccess' => false
    ],

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
