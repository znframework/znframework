<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Individual Structures
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Compress
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Sıkıştırma kütüphanesine ait sürücü ayarını içerir.
    //
    //--------------------------------------------------------------------------------------------------
    'compress' =>
    [
        //----------------------------------------------------------------------------------------------
        // Driver
        //----------------------------------------------------------------------------------------------
        //
        // Options: bz, gz, lzf, zip, zlib, rar.
        //
        //----------------------------------------------------------------------------------------------
        'driver' => 'gz'
    ],

    //--------------------------------------------------------------------------------------------------
    // Cache
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Ön bellekleme kütüphanesine ait ayarları içerir.
    //
    //--------------------------------------------------------------------------------------------------
    'cache' =>
    [
        //----------------------------------------------------------------------------------------------
        // Driver
        //----------------------------------------------------------------------------------------------
        //
        // Options: apc, memcache, wincache, file, redis
        //
        //----------------------------------------------------------------------------------------------
        'driver' => 'file',

        //----------------------------------------------------------------------------------------------
        // Driver Settings
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Ön bellekleme sürücüleri için bağlantı ayarlarını yapmak için kullanılır
        // Parametre: Sürücüler.
        // Drivers: apc, memcache, wincache
        //
        //----------------------------------------------------------------------------------------------
        'driverSettings' =>
        [
            //------------------------------------------------------------------------------------------
            // Memcache Connection Settings
            //------------------------------------------------------------------------------------------
            //
            // Memcache sürücüsü için gerekli olan bağlantı ayarları yer alır.
            //
            //------------------------------------------------------------------------------------------
            'memcache' =>
            [
                'host'   => '127.0.0.1',
                'port'   => '11211',
                'weight' => '1',
            ],

            //------------------------------------------------------------------------------------------
            // Redis Connection Settings
            //------------------------------------------------------------------------------------------
            //
            // Redis sürücüsü için gerekli olan bağlantı ayarları yer alır.
            //
            //------------------------------------------------------------------------------------------
            'redis' =>
            [
                'password'   => NULL,
                'socketType' => 'tcp',
                'host'       => '127.0.0.1',
                'port'       => 6379,
                'timeout'    => 0
            ]
        ],

        //----------------------------------------------------------------------------------------------
        // OB Gzhandler
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Tamponlamada ob_gzhandler işlevini aktif etmek için kullanılır.
        // Parametre: Gzip modu açık(true), gzip modu kapalı(false).
        // Örnek: true veya false.
        //
        //----------------------------------------------------------------------------------------------
        'obGzhandler' => false
    ],

    //--------------------------------------------------------------------------------------------------
    // Cart
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Sepet kütüphanesine ait ayarları içerir.
    //
    //--------------------------------------------------------------------------------------------------
    'cart' =>
    [
        //----------------------------------------------------------------------------------------------
        // Driver
        //----------------------------------------------------------------------------------------------
        //
        // Verinin hangi yöntemle tutulacağını belirleyebilirsiniz.
        //
        // Options: session, cookie
        //
        //----------------------------------------------------------------------------------------------
        'driver' => 'session'
    ],

    //--------------------------------------------------------------------------------------------------
    // Permission
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Yetki kütüphanesine ait ayarları içerir.
    //
    //--------------------------------------------------------------------------------------------------
    'permission' =>
    [
        //----------------------------------------------------------------------------------------------
        // Page
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: İzin verilen sayfaları belirlemek için "perm->|s1|s2" şeklinde kullanın.
        // İzin vermek istemediğiniz sayfaları belirlemek için "noperm->|s1|s2" şeklinde kullanın.
        // Hiç bir sayfaya izin vermemek için any parametresini kullanın.
        // Her sayfaya izin vermek için all parametresiniz kullanın
        // Tek bir sayfaya izin vermek istediğinide normal olarak yazın.
        // Tek bir sayfaya izin vermek istemediğinizde ise başına "!" işareti koyarak yazın.
        //
        //----------------------------------------------------------------------------------------------
        'page' =>
        [
            //'1' => 'any',
            //'2' => 'any',
            //'3' => ['noperm'  => ['sayfa1', 'sayfa2']],
            //'4' => ['perm'    => ['sayfa3', 'sayfa4']],
            //'5' => ['noperm'  => ['sayfa5', 'sayfa6']],
            //'6' => 'all'
        ],

        //----------------------------------------------------------------------------------------------
        // Process
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: İzin verilen nesneleri belirlemek için "perm->|s1|s2" şeklinde kullanın.
        // İzin vermek istemediğiniz nesneleri belirlemek için "noperm->|s1|s2" şeklinde kullanın.
        // Hiç bir nesneye izin vermemek için any parametresini kullanın.
        // Her nesneye izin vermek için all parametresiniz kullanın
        // Tek bir nesneye izin vermek istediğinide normal olarak yazın.
        // Tek bir nesneye izin vermek istemediğinizde ise başına "!" işareti koyarak yazın.
        //
        //----------------------------------------------------------------------------------------------
        'process' =>
        [
            //'1' => 'any',
            //'2' => 'any',
            //'3' => ['noperm'  => ['yetki1', 'yetki2']],
            //'4' => ['noperm'  => ['yetki3', 'yetki4']],
            //'5' => ['noperm'  => ['yetki5', 'yetki6']],
            //'6' => 'all'
        ]
    ],

    //--------------------------------------------------------------------------------------------------
    // USER
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Kullanıcı sıfına ait ayarları içerir.
    //
    //--------------------------------------------------------------------------------------------------
    'user' =>
    [
        //----------------------------------------------------------------------------------------------
        // Encode
        //----------------------------------------------------------------------------------------------
        //
        // Kullanıcı kaydı yapılırken şifrenin hangi algoritma ile şifreleneceği ayarlanır. md5, sha1
        // geçerli hash algoritmalarından biri tercih edilir. Şifrenin, kodlanmasını istemiyorsanız.
        // boş bırakmanız yeterlidir.
        //
        //----------------------------------------------------------------------------------------------
        'encode' => 'super',

        //----------------------------------------------------------------------------------------------
        // Matching
        //----------------------------------------------------------------------------------------------
        //
        // Veritabanında yer alan tablo ile ilgili sütunları eşleştirmek için kullanılır. Tablo ismini
        // table bölümüne diğer sütunlardan mevcut olanlarıda ilgili anahtarlarla eşleştirmelisiniz.
        //
        // table: Eşleştirme yapılacak tablo adı.
        //
        // columns: Eşleştirme yapılacak sütunlar.
        //     username  : Kullanıcı adı bilgisini tutan sütun adı.
        //     password  : Kullanıcı şifresini tutan sütun adı.
        //     email     : Kullanıcı adı bilgisi e-posta adresi içermiyorsa e-posta
        //                 sütunu olarak kullanılır. bu nedenle kullanımı görecelidir.
        //     active    :   Kullanıcıların aktif olup olmadığı bilgisini tutan sütun adı.
        //                 0 ve 1 değeri alacak şekilde veri türü seçilmelidir.
        //     banned    : Kullanıcıların banlı olup olmadığı bilgisini tutan sütun adı.
        //                 0 ve 1 değeri alacak şekilde veri türü seçilmelidir.
        //     otherLogin: Kullanıcı girişini username sütunu dışında başka sütunlardan
        //                 da yapılabilmesini sağlamak için bu ayara diğer sütunlar eklenebilir
        //
        //----------------------------------------------------------------------------------------------
        'matching' =>
        [
            'table'   => '',

            'columns' =>
            [
                'username'   => '', // Required
                'password'   => '', // Required
                'email'      => '', // Relative
                'active'     => '', // Relative
                'banned'     => '', // Relative
                'activation' => '', // Relative
                'otherLogin' => []  // Relative
            ]
        ],

        //----------------------------------------------------------------------------------------------
        // Joining
        //----------------------------------------------------------------------------------------------
        //
        // Kullanıcılar tablonuz birleştirilmiş tablolardan oluşuyorsa bu bölüm kullanılır.
        //
        // column: Yukarıda belirtilen tabloya ait birleştirme için kullanılacak sütun bilgisidir.
        //         Genellik id sütunu değer olarak verilir.
        //
        // tables: Birleştirme yapılacak diğer tablo ve sütun bilgileri. table => column formatında
        //         kullanılır.
        //
        //----------------------------------------------------------------------------------------------
        'joining' =>
        [
            'column' => '',
            'tables' => []
        ],

        //----------------------------------------------------------------------------------------------
        // Email Sender Info
        //----------------------------------------------------------------------------------------------
        //
        // Aktivasyon işlemleri veya şifremini unuttum işlemleri esnasından
        // gönderilecek e-posta'ya ait gönderen ismi ve e-posta bilgilerini belirtmek içindir.
        // Genellikle site adı ve e-posta adresi tercih edilir.
        //
        // name: Gönderici adı.
        // mail: Gönderici e-posta adresi.
        //
        //----------------------------------------------------------------------------------------------
        'emailSenderInfo' =>
        [
            'name' => '',
            'mail' => ''
        ]
    ]
];
