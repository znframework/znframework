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
* PRELOADED                                                                     		  *
*******************************************************************************************
| Genel Kullanım: Sistem için gerekli ön tanımlı kütüphanelerin listesidir.			      |
| Veri: array().																		  |
******************************************************************************************/
$config['Libraries']['preloaded'] = array('Config', 'Import', 'Uri', 'Benchmark');

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
	COMPONENTS_DIR,
	SYSTEM_LIBRARIES_DIR
);