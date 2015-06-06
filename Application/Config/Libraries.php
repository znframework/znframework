<?php
/************************************************************/
/*                 LIBRARIES(KÜTÜPHANELER)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* LIBRARIES                                                                        		  *
*******************************************************************************************
| Genel Kullanım: Kütüphaneler ile ilgili ayarları içerir.	     						  |
******************************************************************************************/

/******************************************************************************************
* SHORT NAME                                                                      		  *
*******************************************************************************************
| Genel Kullanım: Kütüphanelerin sınıf isimlerinde dosya isminden farklı bir			  |
| isim kullanılması düşünülüyorsa bu bölüme ilave edilmelidir.							  |
| Dosya Adı => Sınıf Adı																  |
| Kullanımı: array('Database' => 'Db' , ...);	     								  	  |
******************************************************************************************/
$config['Libraries']['short_name'] 	= array
(
	'Benchmark' 	=> 'Bench',
	'Cookie'		=> 'Cook',
	'Pagination'	=> 'Pag',
	'Permission'	=> 'Perm',
	'Regex'			=> 'Reg',
	'Security'		=> 'Sec',
	'Session'		=> 'Sess',
	'Validation'	=> 'Val',
	'Thumbnail'		=> 'Thumb'
);	

/******************************************************************************************
* AUTOLOADER DIRECTORY                                                             		  *
*******************************************************************************************
| Genel Kullanım: Kütüphane olarak çağrılmak istenen dosyaların yer aldığı dizin		  |
| aşağıdaki diziye belirtilerek kütüphane gibi dahil edilibilir hale gelir.			      |
| Veri: array().																		  |
| Kullanımı: array(DB_DIR, 'System/xx/' , a/c/);   								  	      |
******************************************************************************************/
$config['Libraries']['autoloader_directory'] = array
(
	LIBRARIES_DIR,
	SYSTEM_LIBRARIES_DIR,
	CACHE_DIR,
	DB_DIR
);

/******************************************************************************************
* DIFFERENT DIRECTORY                                                             		  *
*******************************************************************************************
| Genel Kullanım: Kütüphane olarak çağrılmak istenen dosyaların yer aldığı dizin		  |
| aşağıdaki diziye belirtilerek kütüphane gibi dahil edilibilir hale gelir.			      |
| Veri: array().																		  |
| Kullanımı: array(DB_DIR, 'System/xx/' , a/c/);   								  	      |
******************************************************************************************/
$config['Libraries']['different_directory'] = array
(
	DB_DIR, 
	CACHE_DIR
);