<?php
/************************************************************/
/*                   UPLOAD(DOSYA YÜKLEME)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

1-settings

*/

/*
*-------------------------------------------------------------
*/
// İşlev: Değişiklik yapılan ini ayarlarını .htacess dosyasına eklesin mi?
// true olması durumunda alttaki ayarlar .htaccess  dosyasına eklenir.
// false olması durumunda alttaki ayarlar ini_set() yöntemi ile set edilmeye çalışılır.
$config['Upload']['set_htaccess_file'] = false;

//------------------------------------------------------------------// VARSAYILAN DEĞERLER
$config['Upload']['settings']['file_uploads'] 				= ''; 	// "1"
$config['Upload']['settings']['post_max_size'] 				= '';   // "8M"
$config['Upload']['settings']['upload_max_filesize'] 		= '';   // "2M"
$config['Upload']['settings']['upload_tmp_dir'] 			= '';   // NULL
$config['Upload']['settings']['max_input_nesting_level'] 	= '';	// 64
$config['Upload']['settings']['max_input_vars'] 			= '';	// 1000
$config['Upload']['settings']['max_file_uploads'] 			= '';	// 20	
$config['Upload']['settings']['max_input_time'] 			= '';	// "-1"
$config['Upload']['settings']['max_execution_time'] 		= '';	// "30"

