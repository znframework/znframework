<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Project
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Proje Cache
    //--------------------------------------------------------------------------------------------------
    // Proje genelinde ön bellekleme oluşturmak kullanılır.
    //
    // status    : ön bellekleme işlemini devreye sokar.
    // time      : belleklenen dosyaların saniye cinsinden ne kadar zaman saklanacağıdır.
    // prefix    : bellekleme adına ön ek ekler.
    // driver    : bellekleme sürücülerinden biri.
    // compress  : sıkıştırma sürücülerinden biri.
    // exclude   : belleklemeye girmeyecek olan controller/method bilgisi.
    // include   : belleklemeye girecek olan controller/method bilgisi.
    // machinesIp: belleklemeden etkilenmeyecek ip adreserleri tanımlanır.
    //--------------------------------------------------------------------------------------------------
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

    //----------------------------------------------------------------------------------------------
    // Key
    //----------------------------------------------------------------------------------------------
    // Genel Kullanım: Encode sınıfına ait super() yöntemi için oluşturulmuş şifrelemeye
    // dahil edilecek ilave karakter ayarıdır. Böyle bir kullanımın oluşturulmasının temel
    // amacı her projede yer alan kullanıcı şifrelerinin birbirlerinden farklı olmasını
    // sağlayarak şifre güvenliğini sağlamaktır.
    //----------------------------------------------------------------------------------------------
    'key' => ZN\In::defaultProjectKey(),

    //--------------------------------------------------------------------------------------------------
    // Benchmarking Test
    //--------------------------------------------------------------------------------------------------
    //
    // Bu ayarın true olarak ayarlanması durumunda ekranın sağ alt köşesinde sayfa açılış hızı
    // gibi bir takım verilerin yer aldığı bir tablo görüntülenir.
    //
    //--------------------------------------------------------------------------------------------------
    'benchmark' => false,

    //--------------------------------------------------------------------------------------------------
    // Mode
    //--------------------------------------------------------------------------------------------------
    //
    // Proje modu belirtilir. Kullanılabilir modlar: publication, restoration, development
    //
    //--------------------------------------------------------------------------------------------------
    'mode' => 'development',

    //--------------------------------------------------------------------------------------------------
    // Log
    //--------------------------------------------------------------------------------------------------
    //
    // Log Configs
    //
    //--------------------------------------------------------------------------------------------------
    'log' =>
    [
        //--------------------------------------------------------------------------------------------------
        // Create File
        //--------------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Çalışma esnasında oluşan kod hatalarını kayıt altına alır.
        // Parametreler: true veya false
        // Varsayılan: false
        // Kayıtlar Logs/ dizini içerisinde kayıt altına alınmaktadır.
        //
        //--------------------------------------------------------------------------------------------------
        'createFile' => false,

        //--------------------------------------------------------------------------------------------------
        // File Time
        //--------------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Log dosyalarının ne kadar süre ile kayıtları tutacağı ayarlanır.
        // Parametreler: Metinsel türde zaman bilgileri day, month, year
        // Varsayılan: 30 day
        // Sürenin dolması durumunda herhangi bir hata oluştuğunda eski kayıtlar
        // silinir ve yeni hata kaydı eklenir. Böylece Log dosyalarının şismesinin
        // önüne geçilmiş olur.
        //
        //--------------------------------------------------------------------------------------------------
        'fileTime' => '30 day'
    ],

    //--------------------------------------------------------------------------------------------------
    // Headers
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: header() fonksiyonuna parametreler göndermek için kullanılır.
    // parametreler param1, param2, param3 .... paramN şeklinde kullanılır.
    //
    // Varsayılan: "content-type: text/html; charset=utf-8"
    //
    //--------------------------------------------------------------------------------------------------
    'headers' =>
    [
        'content-type: text/html; charset=utf-8'
    ],

    //--------------------------------------------------------------------------------------------------
    // Error Reporting
    //--------------------------------------------------------------------------------------------------
    //
    // Mevcut hata durumu.
    //
    //--------------------------------------------------------------------------------------------------
    'errorReporting' => E_ALL,

    //--------------------------------------------------------------------------------------------------
    // Escape Errors
    //--------------------------------------------------------------------------------------------------
    //
    // Hata gösterimi engellenecek hata numaraları belirtilir.
    //
    //--------------------------------------------------------------------------------------------------
    'escapeErrors' => [],

    //--------------------------------------------------------------------------------------------------
    // Exit Errors
    //--------------------------------------------------------------------------------------------------
    //
    // Hata seviyesine göre kod akışını durdurmak için hata numaraları belirtilir. Yani numara olarak
    // belirtilen seviyede hata oluştması durumunda kod akışı hatadan sonra kesilir.
    //
    //--------------------------------------------------------------------------------------------------
    'exitErrors' => [0, 2],

    //--------------------------------------------------------------------------------------------------
    // Argument Passed Error Type
    //--------------------------------------------------------------------------------------------------
    //
    // Geçersiz parametre hatalarından kaynaklanan hata mesajlarını konum olarak kullanılan
    // kütüphanelerin iç yapısında mı yoksa dış yapımısında mı göstereceğini belirler.
    //
    // Kullanılabilir Seçenekler: external, internal
    //
    //--------------------------------------------------------------------------------------------------
    'invalidParameterErrorType' => 'external', // external, internal

    //--------------------------------------------------------------------------------------------------
    // Restoration
    //--------------------------------------------------------------------------------------------------
    //
    // Restorasyon işlemlerini başlatmak için yukarıdaki Projects:mode ayarını 'Restoration' olarak
    // ayarlamanı gerekmektedir. Bu ayarlamadan sonra aşağıdaki ayarları yapabilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------
    'restoration' =>
    [
        //----------------------------------------------------------------------------------------------
        // Machines IP
        //----------------------------------------------------------------------------------------------
        //
        // Uygulama üzerinde restore işlemlerinin yapıldığı makinelere ait ip adresleri belirtilir.
        // Example: ['215.213.21.32', '10.131.18.21', ...]
        //
        //----------------------------------------------------------------------------------------------
        'machinesIP' => ['127.0.0.1'],

        //----------------------------------------------------------------------------------------------
        // Pages
        //----------------------------------------------------------------------------------------------
        // Çalışmayan, hata oluşmuş kullanıcıların karşılasması istenmeyen sayfalar belirtilir.
        // Example: ['employee/profile', 'home/comments', ...]
        //
        //----------------------------------------------------------------------------------------------
        'pages' => [],

        //----------------------------------------------------------------------------------------------
        // Route Page
        //----------------------------------------------------------------------------------------------
        // Restoration Pages ayarına belirtilmiş sayfalarından herhangi birine istek yapıldığında
        // bu ayarın belirtildiği sayfaya yönlendirilir.
        // Example: 'restoration/page'
        //
        //----------------------------------------------------------------------------------------------
        'routePage' => ''
    ]
];
