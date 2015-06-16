<?php
/************************************************************/
/*                   UPLOAD(DOSYA YÜKLEME)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* UPLOAD                                                                                  *
*******************************************************************************************
| Genel Kullanımı: Dosya yükleme ile ilgili ayarların yer aldığı dosyadır.                |						
******************************************************************************************/

/******************************************************************************************
* SET HTACCESS FILE                                                                       *
*******************************************************************************************
| Genel Kullanımı: Değişiklik yapılan ini ayarlarını .htacess dosyasına eklesin mi?		  |
| true olması durumunda alttaki ayarlar .htaccess  dosyasına eklenir.					  |
| false olması durumunda alttaki ayarlar ini_set() yöntemi ile set edilmeye çalışılır.    |						
******************************************************************************************/
$config['Upload']['set-htaccess-file'] = false;

/******************************************************************************************
* SETTINGS                                                                                *
*******************************************************************************************
| Genel Kullanımı: Kullanılabilir ini dosya yükleme ayarları.						      |						
******************************************************************************************/
$config['Upload']['settings'] = array
(
	'file_uploads' 				=> '', 	// "1"
	'post_max_size' 			=> '',  // "8M"
	'upload_max_filesize' 		=> '',  // "2M"
	'upload_tmp_dir' 			=> '',  // NULL
	'max_input_nesting_level' 	=> '',	// 64
	'max_input_vars' 			=> '',	// 1000
	'max_file_uploads' 			=> '',	// 20	
	'max_input_time' 			=> '',	// "-1"
	'max_execution_time' 		=> ''	// "30"
);