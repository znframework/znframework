<?php
/************************************************************/
/*                    CACHE(ÖN BELLEKLEME)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-mod_gzip
2-mod_gzip_item_include_file
3-mod_expires
4-expires_default
5-expires_by_type
6-mod_headers
7-file_match_cache_control
//--------------------------------------------------------------------------------------------------------------------------

/* MOD OB_GZHANDLER	*/
// İşlev:ob_start('ob_gzhandler') yöntemini açmak için kullanılır
// Parametre:Gzip modu açık(true), gzip modu kapalı(false)
// Örnek: true/false
$config['Cache']['ob_gzhandler'] = false;

/* MOD GZIP	*/
// İşlev:Gzip önbelleklemeyi açmak için kullanılır
// Parametre:Gzip modu açık(true), gzip modu kapalı(false)
// Örnek: true/false
$config['Cache']['mod_gzip'] = false; // Boolean 

/* MOD GZIP	ITEM INCLUDE FILE */
// İşlev:Gzip önbelleklemeye alınacak dosya türleri belirlemek için kullanılır.
// Parametre:Önbelleklemeye alınacak dosya türleri "|" işareti ile ayrılacak şekilde yazılır. 
// Örnek: 'html?|txt|css|js|php|pl'
$config['Cache']['mod_gzip_item_include_file'] = 'html?|txt|css|js|php|pl'; // String

/* MOD EXPIRES */
// İşlev:Tarayıcı ön belleklemeyi açmak için kullanılır.
// Parametre:Tarayıcı ön bellekleme modu açık(true), gzip modu kapalı(false)
// Örnek: true/false
$config['Cache']['mod_expires'] = false; // Boolean

/* MOD EXPIRES */
// İşlev:Tarayıcı ön belleklemenin varsayılan zamanını saniye cinsinden belirlemek için kullanılır.
// Parametre:Tarayıcı önbelleklemenin zamanı belirlemek için saniye cinsinden bir sayı girilir.
// Örnek: 1
$config['Cache']['expires_default_time'] = 1; // Integer / Numeric / String Numeric

/* EXPIRES BY TYPE */
// İşlev:Tarayıcı ön belleklemeye alınacak dosya türleri ve süreleri saniye cinsinden belirtilir.
// Parametre:Anahtar değer çifti içeren bir dizi bilgisi içerir.
// Örnek: array('text/html' => 1);
$config['Cache']['expires_by_type'] = array // Array
(
	'text/html' 				=> 1,		// 1 Saniye
	'image/gif' 				=> 2592000,	// 1 Ay
	'image/jpeg' 				=> 2592000,	// 1 Ay
	'image/png' 				=> 2592000,	// 1 Ay
	'text/css' 					=> 604800, 	// 1 Hafta
	'text/javascript' 			=> 216000, 	// 2.5 Gün
	'application/x-javascript' 	=> 216000	// 2.5 Gün
);

/* MOD HEADERS */
// İşlev:Header önbelleklemeyi açmak için kullanılır
// Parametre:Header modu açık(true), gzip modu kapalı(false)
// Örnek: true/false
$config['Cache']['mod_headers'] = false;

/* FILE MATCH CACHE CONTROL */
// İşlev:Belirtilen türlerden eşleşenlerin karşılarında belirtilen süreler kadar ön belleğe alınması için kullanılır.
// Parametre:Anahtar değer çifti içeren bir dizi bilgisi içerir.
// Örnek: array('DosyaTuru1|DosyaTuru2' => array('time' => Saniye Cinsinden Zaman ,  'access' => 'ErisimYontemi')
$config['Cache']['file_match_cache_control'] = array
(
	'ico|pdf|flv|jpg|jpeg|png|gif|swf' 	=> array('time' => 2592000 , 	'access' => 'public'),
	'css' 								=> array('time' => 604800 , 	'access' => 'public'),
	'js' 								=> array('time' => 216000 , 	'access' => 'private'),
	'xml|txt'							=> array('time' => 216000 , 	'access' => 'public, must-revalidate'),
	'html|htm|php' 						=> array('time' => 1 , 			'access' => 'private, must-revalidate')
);
//--------------------------------------------------------------------------------------------------------------------------