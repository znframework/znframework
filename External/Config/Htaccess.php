<?php
//----------------------------------------------------------------------------------------------------
// HTACCESS 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// CREATE FILE                                                                             
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: .htaccess dosyasının oluşturulup oluşturulmayacağına karar verir.		  
// Parametreler: true veya false															  
// Varsayılan: true																		  
// Url'de zeroneed.php ekini kullanmak istemiyorsanız ve .htaccess yönlendirmesi			  
// sunucunuzda aktifse bu değeri true yapıp bu dosyanın oluşmasını sağlayın.				  
// Bu işlem dışında Config/Uri.php dosyasındaki zeroneed.php ayarını false 					  
// durumuna getirmeyi unutmayın.      												      
//
//----------------------------------------------------------------------------------------------------
$config['Htaccess']['createFile'] = true;

//----------------------------------------------------------------------------------------------------
// URI
//----------------------------------------------------------------------------------------------------
//
// Directory Index
//
// Genel Kullanımı: Url de yer alan zeroneed.php uzantısının görünüm durumunu ayalarmak için kullanılır.		  
// Değer false olursa url'lerde zeroneed.php uzantısı görünmez.								  
// Parametreler: true, false.															  
// Varsayılan: true				                 										  					
//
//
// Index Suffix
//
// Genel Kullanımı: .htaccess dosyasında zeroneed.php bölümü sonuna ? ekler				      
// Parametreler: "", ?																	  
// Varsayılan: "".	
//
//----------------------------------------------------------------------------------------------------
$config['Htaccess']['uri'] = 
[
	DIRECTORY_INDEX  => false,
	'indexSuffix'    => ''
];

//----------------------------------------------------------------------------------------------------
// Headers
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Bu bölümün aktif olabilmesi için yukarıdaki ayar true ayarlanmalıdır.   
// İşlev: .htaccess dosyasına header ayarları eklemek için kullanılır.				      
// Parametreler: [] dizi değerler alır.									              
// Varsayılan: [] 
//     															      
//----------------------------------------------------------------------------------------------------
$config['Htaccess']['headers'] = 
[
	'status'   => false,
	'settings' => 
	[
		'Header set Connection keep-alive'
	]
];

//----------------------------------------------------------------------------------------------------
// Upload
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Dosya yükleme ile ilgili ayarlar yer alır.			     						
//
//----------------------------------------------------------------------------------------------------
$config['Htaccess']['upload'] = 
[
	'status'   => false,
	'settings' => 
	[
		'file_uploads' 				=> '', 	// "1"
		'post_max_size' 			=> '',  // "8M"
		'upload_max_filesize' 		=> '',  // "2M"
		'upload_tmp_dir' 			=> '',  // NULL
		'max_input_nesting_level' 	=> '',	// 64
		'max_input_vars' 			=> '',	// 1000
		'max_file_uploads' 			=> '',	// 20	
		'max_input_time' 			=> '',	// "-1"
		'max_execution_time' 		=> ''	// "30"
	]
];

//----------------------------------------------------------------------------------------------------
// Session
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Oturum ayarları yapılır.	         						  
//
//----------------------------------------------------------------------------------------------------
$config['Htaccess']['session'] = 
[
	'status'   => false,
	'settings' => 
	[
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
	]
];


//----------------------------------------------------------------------------------------------------
// Cache
//----------------------------------------------------------------------------------------------------
//
// Mod Gzip
//
// Genel Kullanım: Gzip sıkıştırmayı aktif hale getirmek için kullanılır.                  
// Parametreler																			  
// 1-status: Gzip sıkıştırmanın kullanılıp kullanılmayacağı belirlenir.   				  
// 2-included_file_extension: Hangi uzantılı dosyaların ön belleklemeye dahil edileceğidir.
// Örnek: array('status' => true, 'includedFileExtension' => 'txt|css')	  
//
// Mod Expires
//
// Genel Kullanım: Tarayıcı ön belleklemenin aktif hale getirmek için kullanılır.          
// Parametreler																			  
// 1-status: Tarayıcı ön belleklemenin kullanılıp kullanılmayacağı belirlenir.   		  
// 2-file_type_time: Hangi tür dosyaların ne kadar süre ile belleğe alınacağı belirtilir.  
// 3-defaul_time: Tarayıcı ön bellekleme için dosyaların var sayılan ön bellekleme süresi. 
// Örnek: array('status' => true, 'fileTypeTime' => array('text/html' => 20))	
//
// Mod Headers
//
// Genel Kullanım: Header belleklemenin aktif hale getirmek için kullanılır.               
// Parametreler																			  
// 1-status: Tarayıcı ön belleklemenin kullanılıp kullanılmayacağı belirlenir.   		  
// 2-file_extension_time_access: Hangi uzantılı dosyaların ne kadar süre ile ve hangi      
// erişim yöntemi ile belleğe alınacağı belirtilir.  
//            
//----------------------------------------------------------------------------------------------------
$config['Htaccess']['cache'] = 
[
	'modGzip' => 
	[
		// Ön bellekleme durumu.
		'status' => false,
		// Ön belleğe alınacak dahil edilebilir dosya uzantıları.
		'includedFileExtension' => 'html?|txt|css|js|php|pl'
	],
	
	'modExpires' => 
	[
		// Ön bellekleme durumu.
		'status' => false,
		// Ön belleğe alınacak dahil edilebilir dosya uzantıları.
		'fileTypeTime' => 
		[
			'text/html' 				=> 1,		// 1 Saniye
			'image/gif' 				=> 2592000,	// 1 Ay
			'image/jpeg' 				=> 2592000,	// 1 Ay
			'image/png' 				=> 2592000,	// 1 Ay
			'text/css' 					=> 604800, 	// 1 Hafta
			'text/javascript' 			=> 216000, 	// 2.5 Gün
			'application/x-javascript' 	=> 216000	// 2.5 Gün
		],
		'defaultTime' => 1 // 1 Saniye
	],
	
	'modHeaders' => 
	[
		// Ön bellekleme durumu.
		'status' => false,
		
		'fileExtensionTimeAccess' => 
		[
			// Ön belleğe alınacak uzantılar    => Ön bellekleme süresi   , Erişim yöntemi
			'ico|pdf|flv|jpg|jpeg|png|gif|swf' 	=> ['time' => 2592000,  'access' => 'public'],
			'css' 								=> ['time' => 604800,   'access' => 'public'],
			'js' 								=> ['time' => 216000, 	'access' => 'private'],
			'xml|txt'							=> ['time' => 216000, 	'access' => 'public, must-revalidate'],
			'html|htm|php' 						=> ['time' => 1, 		'access' => 'private, must-revalidate']
		]
	]
]; 

//----------------------------------------------------------------------------------------------------
// INI
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: .htaccess üzerinden hangi ini ayarlarını yapacaksanız onları 			  
// yazıyorsunuz. Anahtar kelime => değeri												  
// Örnek: upload_max_filesize => "10M" 						      						  
//
//----------------------------------------------------------------------------------------------------
$config['Htaccess']['ini'] = 
[
	'status'   => false,
	'settings' => []
];

//----------------------------------------------------------------------------------------------------
// Settings
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Bu yöntemin kullanılabilmesi için yukarıdaki ayarın true olması 		  
// gerekmektedir. htaccess dosyasına header ayarları eklemek için kullanılır.			  
// Parametreler: array( '<module>' => array('setting1', 'setting2' ...))				      																  
// Bu yöntemi kullanırken < > işaretlerini kullanmayınız.							      
// Modülü kapatma işlemini kendisi gerçekleştirmektedir.                                   
// Dizi içerisindeki birinci parametre modül adı ve tip									  
// İkinci parametre ise bu aralıkta olması gereken kodlar.  							      
//
//----------------------------------------------------------------------------------------------------
$config['Htaccess']['settings'] = 
[
	 'ifmodule mod_headers.c' => ['Options -Indexes']
];