<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Services
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------
    // Route
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------
    'route' =>
    [
        //----------------------------------------------------------------------------------------------
        // Open Controller
        //----------------------------------------------------------------------------------------------
        //
        // Sürümsel Faaliyetler
        // ZN >= 4.3.0 'openController'
        // ZN <= 4.2.9 'openPage'
        //
        // Genel Kullanımı: Başlangıçta varsayılan açılış sayfasını sağlayan Controller dosyasıdır.
        // Dikkat edilirse açılış sayfası welcome.php'dir ancak bu işlemi yapan home.php
        // Controller dosyasıdır.
        //
        //----------------------------------------------------------------------------------------------
        'openController' => 'home',

        //----------------------------------------------------------------------------------------------
        // Open Function
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: URL üzerinde fonksiyon belirtilmediğinde ön tanımlı olarak devreye giren
        // açılış fonksiyonudur.
        //
        //----------------------------------------------------------------------------------------------
        'openFunction' => 'main',

        //----------------------------------------------------------------------------------------------
        // Show 404
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Geçersiz URI adresi girildiğinde yönlendirilmek istenen URI yoludur.
        //
        //----------------------------------------------------------------------------------------------
        'show404' => '',

        //----------------------------------------------------------------------------------------------
        // Request Methods -> ZN >= 4.3.1
        //----------------------------------------------------------------------------------------------
        //
        // Eğer formlar dışında curl ile veya url üzerinden yapılan isteği engellemek için kullanılır.
        //
        // Page           : Eğer konrolden sonra geçersiz istek tespit edilirse hangi sayfaya gideceği
        //                  belirlenebilr.
        // DisallowMethods: Bu ayara girilecek olan anahtarlar, controller/function bilgisi içerirken
        //                  değerler, hangi methodların sayfada geçersiz olacağını belirtir.
        //                  Örnek: 'home/contact' => ['post', 'get']
        // AllowMethods   : Bu ayara girilecek olan anahtarlar, controller/function bilgisi içerirken
        //                  değerler, hangi methodların sayfada geçerli olacağını belirtir.
        //                  Örnek: 'home/contact' => ['post', 'get']
        //
        //----------------------------------------------------------------------------------------------
        'requestMethods' =>
        [
            'page'            => '',
            'disallowMethods' => [], // ZN >= 4.3.1 Updated
            'allowMethods'    => []  // ZN >= 4.3.1
        ],

        //----------------------------------------------------------------------------------------------
        // Pattern Type
        //----------------------------------------------------------------------------------------------
        //
        // Bu ayar Change URI ayarına yazılacak desenin türünü belirler.
        //
        // @key string patternType: special, classic
        //
        // special: Config/Regex.php dosyasında yer alan karakterlerin kullanımlarıdır.
        // classic: Düzenli ifadelerdeki standart karakterlerin kullanımlarıdır.
        //
        //----------------------------------------------------------------------------------------------
        'patternType' => 'classic',

        //----------------------------------------------------------------------------------------------
        // Change Uri
        //----------------------------------------------------------------------------------------------
        //
        // URI adreslerine rota vermek için kullanılır.
        //
        // Kullanım: @key -> yeni adres, @value -> eski adres
        //
        // changeUri =>
        // [
        //     'home' => 'homepage'
        // ];
        //
        //----------------------------------------------------------------------------------------------
        'changeUri' => []
    ],

    //--------------------------------------------------------------------------------------------------
    // URI
    //--------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : Copyright (c) 2012-2016, ZN Framework
    //
    //--------------------------------------------------------------------------------------------------
    'uri' =>
    [
        //----------------------------------------------------------------------------------------------
        // Lang
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Url de aktif dilin görüntülenmesi için kullanılır.
        // Değer false olursa url'lerde dil uzantısı görünmez.
        // Parametreler: true, false.
        // Varsayılan: false.
        //
        //----------------------------------------------------------------------------------------------
        'lang' => false,

        //----------------------------------------------------------------------------------------------
        // SSL
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: http, ssl aktif olduğunda https olarak değiştirilir.
        // Parametreler: true, false.
        // Varsayılan: false.
        //
        //----------------------------------------------------------------------------------------------
        'ssl' => false
    ],

    //--------------------------------------------------------------------------------------------------
    // Processor
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Processor ile ilgili ayarlar yer alır.
    //
    //--------------------------------------------------------------------------------------------------
    'processor' =>
    [
        'driver' => 'exec',        // exec, shell_exec, system, ssh
        'path'   => 'php'
    ],

    //--------------------------------------------------------------------------------------------------
    // Crontab
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Crontab ile ilgili ayarlar yer alır.
    //
    //--------------------------------------------------------------------------------------------------
    'crontab' =>
    [
        'debug'  => false            // true, false
    ],

    //--------------------------------------------------------------------------------------------------
    // SSH
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Ftp bağlantı ayarları yapılır.
    //
    //--------------------------------------------------------------------------------------------------
    'ssh' =>
    [
        'host'          => '',  // Bağlantının sağlanacağı host bilgisi
        'user'          => '',  // Bağlantı kullanıcı adı.
        'password'      => '',  // Bağlantı kullanıcı şifresi.
        'port'          => 22,  // Bağlantı port numarası.
        'methods'       => [],  // Yöntemler belirtilir.
        'callbacks'     => []   // Geri çağrım işlevleri belirtilir.
    ],

    //--------------------------------------------------------------------------------------------------
    // Cookie
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Çerez ayarları yapılır.
    //
    //--------------------------------------------------------------------------------------------------
    'cookie' =>
    [
        //----------------------------------------------------------------------------------------------
        // Encode
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Cookie değerlerini tutan anahtar ifadelerin hangi şifreleme algoritması
        // ile şifreleneceği belirtilir. Şifrelenmesini istediğini hash algorimatsını yazmanız
        // yeterlidir. Boş bırakılması halinde herhangi bir şifreleme yapmayacaktır.
        //
        //----------------------------------------------------------------------------------------------
        'encode'      => 'super',

        //----------------------------------------------------------------------------------------------
        // Regenerate
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Çerez oluşturulurken farklı bir PHPSESSID oluşturmasını
        // sağlamak için bu değerin true olması gerekir. Güvenlik açısındanda
        // true olması önerilir.
        //----------------------------------------------------------------------------------------------
        'regenerate' => true,

        //----------------------------------------------------------------------------------------------
        // Time
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Çerez süresini ayarlamak için kullanılır.
        // Parametre:Saniye cinsinden sayısal zaman değeri girilir.
        //
        //----------------------------------------------------------------------------------------------
        'time' => 604800, // Integer / Numeric / String Numeric

        //----------------------------------------------------------------------------------------------
        // Path
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Çerez nesnelerinin hangi dizinde tutulacağını ayarlamak için kullanılır.
        //
        //----------------------------------------------------------------------------------------------
        'path' => '/', // String

        //----------------------------------------------------------------------------------------------
        // Domain
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Çerezlerin hangi domain adresiden geçerli olacağını belirlemek için
        // kullanılır.
        //
        //----------------------------------------------------------------------------------------------
        'domain' => '', // String

        //----------------------------------------------------------------------------------------------
        // Secure
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: Çerezin istemciye güvenli bir HTTPS bağlantısı üzerinden mi aktarılması
        // gerektiğini belirtmek için kullanılır.
        //
        //----------------------------------------------------------------------------------------------
        'secure' => false,

        //----------------------------------------------------------------------------------------------
        // HTTP Only
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanım: TRUE olduğu takdirde çerez sadece HTTP protokolü üzerinden erişilebilir
        // olacaktır. Yani çerez, JavaScript gibi betik dilleri tarafından erişilebilir
        // olmayacaktır.
        //
        //----------------------------------------------------------------------------------------------
        'httpOnly' => true // Boolean
    ],

    //--------------------------------------------------------------------------------------------------
    // Session
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Oturum ayarları yapılır.
    //
    //--------------------------------------------------------------------------------------------------
    'session' =>
    [
        //----------------------------------------------------------------------------------------------
        // Encode
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Session değerlerini tutan anahtar ifadeler şifrelensin mi?
        // Şifrelenmesini istediğini hash algorimatsını yazmanız yeterlidir.
        // Boş bırakılması halinde herhangi bir şifreleme yapmayacaktır.
        //
        //----------------------------------------------------------------------------------------------
        'encode' => 'super',

        //----------------------------------------------------------------------------------------------
        // Regenerate
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Oturum oluşturulurken farklı bir PHPSESSID oluşturmasını
        // sağlamak için bu değerin true olması gerekir. Güvenlik açısındanda
        // true olması önerilir.
        //
        //----------------------------------------------------------------------------------------------
        'regenerate' => true,
    ],

    //--------------------------------------------------------------------------------------------------
    // Email
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Oturum ayarları yapılır.
    //
    //--------------------------------------------------------------------------------------------------
    'email' =>
    [
        //----------------------------------------------------------------------------------------------
        // Driver
        //----------------------------------------------------------------------------------------------
        // E-posta gönderiminin hangi platform ile gönderileceğidir.
        //
        // @driver -> mail (standart mail yöntemini kullanır).
        // @driver -> imap (imap_mail yöntemini kullanır).
        // @driver -> send (mb_send_mail yöntemini kullanır).
        // @driver -> smtp (soket ve dosya yöntemlerini kullanılır).
        // @driver -> pipe (popen yöntemini kullanır).
        //
        //----------------------------------------------------------------------------------------------
        'driver' => 'smtp',

        //----------------------------------------------------------------------------------------------
        // Smtp
        //----------------------------------------------------------------------------------------------
        //
        // SMTP ayarlarını yapılandırmak için kulanılan ayarlar dizisidir.
        //
        //----------------------------------------------------------------------------------------------
        'smtp' =>
        [
            'host'          => '',
            'user'          => '',
            'password'      => '',
            'port'          => 587,
            'keepAlive'     => false,
            'timeout'       => 10,
            'encode'        => '',  // empty, tls, ssl
            'dsn'           => false,
            'auth'          => true
        ],

        //----------------------------------------------------------------------------------------------
        // General
        //----------------------------------------------------------------------------------------------
        //
        // Genel e-posta ayarlarını yapılandırmak için kulanılan ayarlar dizisidir.
        //
        //----------------------------------------------------------------------------------------------
        'general' =>
        [
            'senderMail'    => '',      // Default Sender E-mail Address.
            'senderName'    => '',      // Default Sender Name.
            'priority'      => 3,       // 1, 2, 3, 4, 5
            'charset'       => 'UTF-8', // Charset Type
            'contentType'   => 'html',  // plain, html
            'multiPart'     => 'mixed', // mixed, related, alternative
            'xMailer'       => 'ZN',
            'encoding'      => '8bit',  // 8bit, 7bit
            'mimeVersion'   => '1.0',   // MIME Version
            'mailPath'      => '/usr/sbin/sendmail' // Default Mail Path
        ]
    ]
];
