<?php
//----------------------------------------------------------------------------------------------------
// FTP 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Ftp
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Ftp bağlantı ayarları yapılır.	         						  
//
//----------------------------------------------------------------------------------------------------
$config['Services']['ftp'] = array
(
	'host' 			=> '',   // Bağlantının sağlanacağı host bilgisi
	'user' 			=> '',   // Sunucu kullanıcı adı.
	'password' 		=> '',   // Sunucu kullanıcı şifresi.
	'timeout' 		=> 90,   // Sunucu bağlantı zaman aşımı süresi.
	'port' 			=> 21,   // Bağlantı port numarası.
	'sslConnect' 	=> false // SSL kullanılarak sunucu bağlantısı kurulsun mu?.	
);

//----------------------------------------------------------------------------------------------------
// SSH
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Ftp bağlantı ayarları yapılır.	         						  
//
//----------------------------------------------------------------------------------------------------
$config['Services']['ssh'] = array
(
	'host' 			=> '',      // Bağlantının sağlanacağı host bilgisi
	'user' 			=> '',      // Bağlantı kullanıcı adı.
	'password' 		=> '',      // Bağlantı kullanıcı şifresi.
	'port' 			=> 22,      // Bağlantı port numarası.
	'methods' 		=> array(), // Yöntemler belirtilir.
	'callbacks' 	=> array()  // Geri çağrım işlevleri belirtilir.	
);


//----------------------------------------------------------------------------------------------------
// Cookie
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Çerez ayarları yapılır.	         						  
//
//----------------------------------------------------------------------------------------------------
$config['Services']['cookie'] = array
(
	//------------------------------------------------------------------------------------------------
	// Encode                                                                             	  
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Cookie değerlerini tutan anahtar ifadelerin hangi şifreleme algoritması 
	// ile şifreleneceği belirtilir. Şifrelenmesini istediğini hash algorimatsını yazmanız     
	// yeterlidir. Boş bırakılması halinde herhangi bir şifreleme yapmayacaktır.				  
	//
	//------------------------------------------------------------------------------------------------
	'encode'      => '',
	
	//------------------------------------------------------------------------------------------------
	// Regenerate                                                                          
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Çerez oluşturulurken farklı bir PHPSESSID oluşturmasını			      
	// sağlamak için bu değerin true olması gerekir. Güvenlik açısındanda			          
	// true olması önerilir.			                                                          								
	//------------------------------------------------------------------------------------------------
	'regenerate' => true,
	
	//------------------------------------------------------------------------------------------------
	// Time                                                                                    
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Çerez süresini ayarlamak için kullanılır.								  
	// Parametre:Saniye cinsinden sayısal zaman değeri girilir.		                          								
	//
	//------------------------------------------------------------------------------------------------
	'time' => 604800, // Integer / Numeric / String Numeric
	
	//------------------------------------------------------------------------------------------------
	// Path                                                                                    
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Çerez nesnelerinin hangi dizinde tutulacağını ayarlamak için kullanılır.						
	//
	//------------------------------------------------------------------------------------------------
	'path' => '/', // String
	
	//------------------------------------------------------------------------------------------------
	// Domain                                                                                  
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Çerezlerin hangi domain adresiden geçerli olacağını belirlemek için 	  
	// kullanılır.			      														      						
	//
	//------------------------------------------------------------------------------------------------
	'domain' => '', // String
	
	//------------------------------------------------------------------------------------------------
	// Secure                                                                                  
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Çerezin istemciye güvenli bir HTTPS bağlantısı üzerinden mi aktarılması 
	// gerektiğini belirtmek için kullanılır.	  								                    														 						
	//
	//------------------------------------------------------------------------------------------------
	'secure' => false,
	
	//------------------------------------------------------------------------------------------------
	// HTTP Only                                                                                
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: TRUE olduğu takdirde çerez sadece HTTP protokolü üzerinden erişilebilir 
	// olacaktır. Yani çerez, JavaScript gibi betik dilleri tarafından erişilebilir 			  
	// olmayacaktır.   								             							      															 						
	//
	//------------------------------------------------------------------------------------------------
	'httpOnly' => true // Boolean
);

//----------------------------------------------------------------------------------------------------
// Session
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Oturum ayarları yapılır.	         						  
//
//----------------------------------------------------------------------------------------------------
$config['Services']['session'] = array
(
	//------------------------------------------------------------------------------------------------
	// Encode
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: Session değerlerini tutan anahtar ifadeler şifrelensin mi?			  
	// Şifrelenmesini istediğini hash algorimatsını yazmanız yeterlidir.					      
	// Boş bırakılması halinde herhangi bir şifreleme yapmayacaktır.			                  					
	//
	//------------------------------------------------------------------------------------------------
	'encode' => 'md5',
	
	//------------------------------------------------------------------------------------------------
	// Regenerate
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: Oturum oluşturulurken farklı bir PHPSESSID oluşturmasını				  
	// sağlamak için bu değerin true olması gerekir. Güvenlik açısındanda				      
	// true olması önerilir.			                                                          					
	//
	//------------------------------------------------------------------------------------------------
	'regenerate' => true,
	
	//------------------------------------------------------------------------------------------------
	// Set Htaccess File
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: Değişiklik yapılan ini ayarlarını .htacess dosyasına eklesin mi?		  
	// true olması durumunda alttaki ayarlar .htaccess  dosyasına eklenir.				      
	// false olması durumunda alttaki ayarlar ini_set() yöntemi ile set edilmeye çalışılır.	 						
	//
	//------------------------------------------------------------------------------------------------
	'setHtaccessFile' => false, 
	
	//------------------------------------------------------------------------------------------------
	// Settings
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanımı: Kullanılabilir oturum ayarları.	  									  					
	//
	//------------------------------------------------------------------------------------------------
	'settings' => array
	(
		'session.save_path'					=> '', // NULL
		'session.name' 						=> '', // PHPSESSID
		'session.save_handler'				=> '', // files
		'session.auto_start' 				=> '', // 0
		'session.gc_probability' 			=> '', // 1
		'session.gc_divisor' 				=> '', // 100
		'session.gc_maxlifetime'			=> '', // 1440
		'session.serialize_handler' 		=> '', // php
		'session.cookie_lifetime' 			=> '', // 0
		'session.cookie_path' 				=> '', // /
		'session.cookie_domain' 			=> '', // NULL
		'session.cookie_secure' 			=> '', // NULL
		'session.cookie_httponly' 			=> '', // NULL
		'session.use_strict_mode' 			=> '', // 0
		'session.use_cookies' 				=> '', // 1
		'session.referer_check' 			=> '', // NULL
		'session.entropy_file' 				=> '', // NULL
		'session.entropy_length' 			=> '', // 0
		'session.cache_limiter' 			=> '', // nocache
		'session.cache_expire'				=> '', // 180
		'session.use_trans_sid'				=> '', // 0
		'session.hash_function'				=> '', // 0
		'session.hash_bits_per_character' 	=> '', // 4
		'session.upload_progress.enabled'	=> '', // 1
		'session.upload_progress.cleanup' 	=> '', // 1
		'session.upload_progress.prefix' 	=> '', // upload_progress
		'session.upload_progress.name'		=> '', // PHP_SESSION_UPLOAD_PROGRESS
		'session.upload_progress.freq' 		=> '', // 1%
		'session.upload_progress.min_freq'  => ''  // 1
	)
);

//----------------------------------------------------------------------------------------------------
// Email
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Oturum ayarları yapılır.	         						  
//
//----------------------------------------------------------------------------------------------------
$config['Services']['email'] = array
(
	//------------------------------------------------------------------------------------------------
	// Driver
	//------------------------------------------------------------------------------------------------
	// E-posta gönderiminin hangi platform ile gönderileceğidir.		                          
	//
	// @driver -> mail (standart mail yöntemini kullanır).
	// @driver -> imap (imap_mail yöntemini kullanır).
	// @driver -> send (mb_send_mail yöntemini kullanır).
	// @driver -> smtp (soket ve dosya yöntemlerini kullanılır).
	// @driver -> pipe (popen yöntemini kullanır).
	//         																				  
	//------------------------------------------------------------------------------------------------
	'driver' => 'mail',
	
	//------------------------------------------------------------------------------------------------
	// Smtp
	//------------------------------------------------------------------------------------------------
	//
	// SMTP ayarlarını yapılandırmak için kulanılan ayarlar dizisidir.                         
	//         																				  
	//------------------------------------------------------------------------------------------------
	'smtp' => array
	(
		'host'			=> '',
		'user'			=> '',
		'password'		=> '',
		'port'			=> 587,
		'keepAlive'		=> false,
		'timeout'		=> 10,
		'encode'		=> '',	// empty, tls, ssl
		'dsn'			=> false,
		'auth'			=> true
	),
	
	//------------------------------------------------------------------------------------------------
	// General
	//------------------------------------------------------------------------------------------------
	//
	// Genel e-posta ayarlarını yapılandırmak için kulanılan ayarlar dizisidir.                
	//         																				  
	//------------------------------------------------------------------------------------------------
	'general' => array
	(
		'senderMail'    => '', // Ön tanımlı gönderen e-posta adresi.
		'senderName'    => '', // Ön tanımlı gönderen ismi.
		'priority'	   	=> 3,		// 1, 2, 3, 4, 5
		'charset'		=> 'UTF-8',
		'contentType'	=> 'plain',  // plain, html
		'multiPart'		=> 'mixed', // mixed, related, alternative
		'xMailer'		=> 'ZN',
		'encoding'		=> '8bit',
		'mimeVersion'	=> '1.0',
		'mailPath'		=> '/usr/sbin/sendmail'
	)
);

//----------------------------------------------------------------------------------------------------
// Http                                                                          	  	  
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Http mesaj listesi yer alır.	      			  							  
//
//----------------------------------------------------------------------------------------------------
$config['Services']['http'] = array
(
	'messages' => array
	(
		//1XX Information
		'100|continue' 				=> '100 Continue',
		'101|switchProtocols' 		=> '101 Switching Protocols',
		'103|checkpoint' 			=> '103 Checkpoint',
		
		//2XX Successful
		'200|ok' 					=> '200 OK',
		'201|created' 				=> '201 Created',
		'202|accepted' 				=> '202 Accepted',
		'203|nonAuthInfo' 			=> '203 Non-Authoritative Information',
		'204|noContent' 			=> '204 No Content',
		'205|resetContent'			=> '205 Reset Content',
		'206|partialContent' 		=> '206 Partial Content',
		
		// 3XX Redirection
		'300|multipleChoices' 		=> '300 Multiple Choices',
		'301|movedPermanent' 		=> '301 Moved Permanently',
		'302|found'				 	=> '301 Found',
		'303|seeOther' 				=> '303 See Other',
		'304|notModified' 			=> '304 Not Modified',
		'306|switchProxy' 			=> '306 Switch Proxy',
		'307|temporaryRedirect' 	=> '307 Temporary Redirect',
		'308|resumeIncomplete' 		=> '308 Resume Incomplete',
		
		// 4XX Client Error
		'400|badRequest' 			=> '400 Bad Request',
		'401|unauth' 				=> '401 Unauthorized',
		'402|paymentRequired' 		=> '402 Payment Required',
		'403|forbidden' 			=> '403 Forbidden',
		'404|notFound' 				=> '404 Not Found',
		'405|methodNotAllowed' 		=> '405 Method Not Allowed',
		'406|notAccept' 			=> '406 Not Acceptable',
		'407|proxyAuth' 			=> '407 Proxy Authentication Required',
		'408|requestTimeout' 		=> '408 Request Timeout',
		'409|conflict' 				=> '409 Conflict',
		'410|gone' 					=> '410 Gone',
		'411|lengthRequired' 		=> '411 Length Required',
		'412|preconditionFailed' 	=> '412 Precondition Failed',
		'413|requestEntity' 		=> '413 Request Entity Too Large',
		'414|requestUri' 			=> '414 Request-URI Too Long',
		'415|unsupportedMedia' 		=> '415 Unsupported Media Type',
		'416|requestedRange' 		=> '416 Requested Range Not Satisfiable',
		'417|expectFailed' 			=> '417 Expectation Failed',
		
		// 5XX Server Error
		'500|internalServerError' 	=> '500 Internal Server Error',
		'501|notImplement' 			=> '501 Not Implemented',
		'502|badGateway' 			=> '502 Bad Gateway',
		'503|serviceUnavailable' 	=> '503 Service Unavailable',
		'504|gatewayTimeout' 		=> '504 Gateway Timeout',
		'505|versionNotSupported' 	=> '505 HTTP Version Not Supported',
		'511|authRequired' 			=> '511 Network Authentication Required'
	)
);