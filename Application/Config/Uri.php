<?php
/************************************************************/
/*                             URI                          */
/************************************************************/
/*

Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* URI                                                                                     *
*******************************************************************************************
| Genel Kullanımı: URI ile ilgili ayarlar yer almaktadır.				                  |						
******************************************************************************************/

/******************************************************************************************
* INDEX.PHP                                                                               *
*******************************************************************************************
| Genel Kullanımı: Url de yer alan index.php uzantısını kaldırmak için kullanılır.		  |
| Değer false olursa url'lerde index.php uzantısı görünmez.								  |
| Parametreler: true, false.															  |
| Varsayılan: true				                 										  |						
******************************************************************************************/
$config['Uri']['index.php'] 	= true;

/******************************************************************************************
* INDEX SUFFIX                                                                            *
*******************************************************************************************
| Genel Kullanımı: .htaccess dosyasında index.php bölümü sonuna ? ekler				      |
| Parametreler: "", ?																	  |
| Varsayılan: "".				                 										  |						
******************************************************************************************/
$config['Uri']['indexSuffix']  = '';

/******************************************************************************************
* LANG		                                                                              *
*******************************************************************************************
| Genel Kullanımı: Url de aktif dilin görüntülenmesi için kullanılır.					  |
| Değer false olursa url'lerde dil uzantısı görünmez.									  |
| Parametreler: true, false.														      |
| Varsayılan: false.				                 									  |						
******************************************************************************************/
$config['Uri']['lang'] 			= false;

/******************************************************************************************
* SSL		                                                                              *
*******************************************************************************************
| Genel Kullanımı: http, ssl aktif olduğunda https olarak değiştirilir.					  |
| Parametreler: true, false.															  |
| Varsayılan: false.				                 									  |						
******************************************************************************************/
$config['Uri']['ssl'] 			= false;