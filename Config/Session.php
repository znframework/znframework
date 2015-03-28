<?php
/************************************************************/
/*                     SESSION(OTURUM)                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-start
2-encode
3-set_htaccess_file
4-settings
*/

/*
*-------------------------------------------------------------
*/

// İşlev: session değerlerini tutan anahtar ifadeler şifrelnsin mi?
// true olması durumunda session bilgisini tutan anahtar ifadeler şifrelenir.
// false olması durumunda anahtar ifadeler şifrelenmez.
$config['Session']['encode'] = true;

// İşlev: Değişiklik yapılan ini ayarlarını .htacess dosyasına eklesin mi?
// true olması durumunda alttaki ayarlar .htaccess  dosyasına eklenir.
// false olması durumunda alttaki ayarlar ini_set() yöntemi ile set edilmeye çalışılır.
$config['Session']['set_htaccess_file'] = false; 

//---------------------------------------------// VARSAYILAN DEĞERLER
$config['Session']['settings'] = array(
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
	'session.cache_limiter' 			=> '', //nocache
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
);