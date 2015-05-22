<?php
/************************************************************/
/*                    CACHE(ÖN BELLEKLEME)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* CACHE                                                                            	  	  *
*******************************************************************************************
| Genel Kullanım: Ön bellekleme işlemlerini gerçekleştirmek için kullaılır.       		  |
******************************************************************************************/	

/******************************************************************************************
* OB GZHANDLER                                                                         	  *
*******************************************************************************************
| Genel Kullanım: Tamponlamada ob_gzhandler işlevini aktif etmek için kullanılır.         |
| Parametre: Gzip modu açık(true), gzip modu kapalı(false).  							  |
| Örnek: true veya false.														          |
******************************************************************************************/
$config['Cache']['ob_gzhandler'] = false;

/******************************************************************************************
* MOD GZIP                                                                            	  *
*******************************************************************************************
| Genel Kullanım: Gzip sıkıştırmayı aktif hale getirmek için kullanılır.                  |
| Parametreler																			  |
| 1-status: Gzip sıkıştırmanın kullanılıp kullanılmayacağı belirlenir.   				  |
| 2-included_file_extension: Hangi uzantılı dosyaların ön belleklemeye dahil edileceğidir.|
| Örnek: array('status' => true, 'included_file_extension' => 'txt|css')	              |
******************************************************************************************/
$config['Cache']['mod_gzip'] = array
(
	// Ön bellekleme durumu.
	'status' => false,
	// Ön belleğe alınacak dahil edilebilir dosya uzantıları.
	'included_file_extension' => 'html?|txt|css|js|php|pl'
); 

/******************************************************************************************
* MOD EXPIRES                                                                          	  *
*******************************************************************************************
| Genel Kullanım: Tarayıcı ön belleklemenin aktif hale getirmek için kullanılır.          |
| Parametreler																			  |
| 1-status: Tarayıcı ön belleklemenin kullanılıp kullanılmayacağı belirlenir.   		  |
| 2-file_type_time: Hangi tür dosyaların ne kadar süre ile belleğe alınacağı belirtilir.  |
| 3-defaul_time: Tarayıcı ön bellekleme için dosyaların var sayılan ön bellekleme süresi. |
| Örnek: array('status' => true, 'file_type_time' => array('text/html' => 20))	          |
******************************************************************************************/
$config['Cache']['mod_expires'] = array
(
	// Ön bellekleme durumu.
	'status' => false,
	// Ön belleğe alınacak dahil edilebilir dosya uzantıları.
	'file_type_time' => array
	(
		'text/html' 				=> 1,		// 1 Saniye
		'image/gif' 				=> 2592000,	// 1 Ay
		'image/jpeg' 				=> 2592000,	// 1 Ay
		'image/png' 				=> 2592000,	// 1 Ay
		'text/css' 					=> 604800, 	// 1 Hafta
		'text/javascript' 			=> 216000, 	// 2.5 Gün
		'application/x-javascript' 	=> 216000	// 2.5 Gün
	),
	'default_time' => 1 // 1 Saniye
); 

/******************************************************************************************
* MOD HEADERS                                                                          	  *
*******************************************************************************************
| Genel Kullanım: Header belleklemenin aktif hale getirmek için kullanılır.               |
| Parametreler																			  |
| 1-status: Tarayıcı ön belleklemenin kullanılıp kullanılmayacağı belirlenir.   		  |
| 2-file_extension_time_access: Hangi uzantılı dosyaların ne kadar süre ile ve hangi      |
| erişim yöntemi ile belleğe alınacağı belirtilir.  									  |
******************************************************************************************/
$config['Cache']['mod_headers'] = array
(
	// Ön bellekleme durumu.
	'status' => false,
	'file_extension_time_access' => array
	(
		// Ön belleğe alınacak uzantılar    => Ön bellekleme süresi   , Erişim yöntemi
		'ico|pdf|flv|jpg|jpeg|png|gif|swf' 	=> array('time' => 2592000, 'access' => 'public'),
		'css' 								=> array('time' => 604800, 	'access' => 'public'),
		'js' 								=> array('time' => 216000, 	'access' => 'private'),
		'xml|txt'							=> array('time' => 216000, 	'access' => 'public, must-revalidate'),
		'html|htm|php' 						=> array('time' => 1, 		'access' => 'private, must-revalidate')
	)
);
//--------------------------------------------------------------------------------------------------------------------------
