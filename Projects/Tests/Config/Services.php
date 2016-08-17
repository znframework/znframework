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
        // Open Page
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Başlangıçta varsayılan açılış sayfasını sağlayan Controller dosyasıdır.
        // Dikkat edilirse açılış sayfası welcome.php'dir ancak bu işlemi yapan home.php              
        // Controller dosyasıdır.                                                                                   
        //
        //----------------------------------------------------------------------------------------------
        'openPage' => 'Tester/syntax',

        //----------------------------------------------------------------------------------------------
        // Show 404
        //----------------------------------------------------------------------------------------------
        //
        // Genel Kullanımı: Geçersiz URI adresi girildiğinde yönlendirilmek istenen URI yoludur.                    
        //
        //----------------------------------------------------------------------------------------------
        'show404' => '',

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
        // array                                                                                      
        // (                                                                                                                                                  
        //     'anasayfa'     => 'home/index'                                                             
        // );                                                                                     
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
    // Crontab
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Crontab ile ilgili ayarlar yer alır.                                   
    //
    //--------------------------------------------------------------------------------------------------
    'crontab' => 
    [
        'driver' => 'exec',                 // exec, shell_exec, system, ssh    
        'path'   => '/usr/local/bin/php',   // Default Path
        'debug'  => false                   // true, false   
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
        'encode'      => '',
        
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
        'encode' => 'md5',
        
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
    ],

    //--------------------------------------------------------------------------------------------------
    // Http                                                                                   
    //--------------------------------------------------------------------------------------------------
    //
    // Genel Kullanım: Http mesaj listesi yer alır.                                               
    //
    //--------------------------------------------------------------------------------------------------
    'http' => 
    [
        'messages' => 
        [
            //1XX Information
            '100|continue'              => '100 Continue',
            '101|switchProtocols'       => '101 Switching Protocols',
            '103|checkpoint'            => '103 Checkpoint',
            
            //2XX Successful
            '200|ok'                    => '200 OK',
            '201|created'               => '201 Created',
            '202|accepted'              => '202 Accepted',
            '203|nonAuthInfo'           => '203 Non-Authoritative Information',
            '204|noContent'             => '204 No Content',
            '205|resetContent'          => '205 Reset Content',
            '206|partialContent'        => '206 Partial Content',
            
            // 3XX Redirection
            '300|multipleChoices'       => '300 Multiple Choices',
            '301|movedPermanent'        => '301 Moved Permanently',
            '302|found'                 => '301 Found',
            '303|seeOther'              => '303 See Other',
            '304|notModified'           => '304 Not Modified',
            '306|switchProxy'           => '306 Switch Proxy',
            '307|temporaryRedirect'     => '307 Temporary Redirect',
            '308|resumeIncomplete'      => '308 Resume Incomplete',
            
            // 4XX Client Error
            '400|badRequest'            => '400 Bad Request',
            '401|unauth'                => '401 Unauthorized',
            '402|paymentRequired'       => '402 Payment Required',
            '403|forbidden'             => '403 Forbidden',
            '404|notFound'              => '404 Not Found',
            '405|methodNotAllowed'      => '405 Method Not Allowed',
            '406|notAccept'             => '406 Not Acceptable',
            '407|proxyAuth'             => '407 Proxy Authentication Required',
            '408|requestTimeout'        => '408 Request Timeout',
            '409|conflict'              => '409 Conflict',
            '410|gone'                  => '410 Gone',
            '411|lengthRequired'        => '411 Length Required',
            '412|preconditionFailed'    => '412 Precondition Failed',
            '413|requestEntity'         => '413 Request Entity Too Large',
            '414|requestUri'            => '414 Request-URI Too Long',
            '415|unsupportedMedia'      => '415 Unsupported Media Type',
            '416|requestedRange'        => '416 Requested Range Not Satisfiable',
            '417|expectFailed'          => '417 Expectation Failed',
            
            // 5XX Server Error
            '500|internalServerError'   => '500 Internal Server Error',
            '501|notImplement'          => '501 Not Implemented',
            '502|badGateway'            => '502 Bad Gateway',
            '503|serviceUnavailable'    => '503 Service Unavailable',
            '504|gatewayTimeout'        => '504 Gateway Timeout',
            '505|versionNotSupported'   => '505 HTTP Version Not Supported',
            '511|authRequired'          => '511 Network Authentication Required'
        ]
    ]
];