<?php 
/************************************************************/
/*              AUTOLOAD(OTOMATİK DAHİL ETME)               */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* AUTOLOAD                                                                            	  *
*******************************************************************************************
| Genel Kullanım: Otomatik yüklemeleri belirlemek için kullanılır.       				  |
******************************************************************************************/	

/******************************************************************************************
* LIBRARY                                                                            	  *
*******************************************************************************************
| Genel Kullanım: Otomatik olarak kütüphane yüklemek için kullanılır.       		      |
| Parametre: Dahil etmek istediğiniz kütüphaneleri diziye elaman olarak sırayla ekleyin.  |
| Örnek: array("l1", "l2");															      |
******************************************************************************************/	
$config['Autoload']['library'] 	= array(); // Array

/******************************************************************************************
* COMPONENT                                                                            	  *
*******************************************************************************************
| Genel Kullanım: Otomatik olarak bileşen yüklemek için kullanılır.       		          |
| Parametre: Dahil etmek istediğiniz bileşenleri diziye elaman olarak sırayla ekleyin.    |
| Örnek: array("c1", "c2");															      |
******************************************************************************************/	
$config['Autoload']['component'] = array(); // Array

/******************************************************************************************
* TOOL                                                                               	  *
*******************************************************************************************
| Genel Kullanım: Otomatik olarak araç yüklemek için kullanılır.       		              |
| Parametre: Dahil etmek istediğiniz araçları diziye elaman olarak sırayla ekleyin.       |
| Örnek: array("t1", "t2");															      |
******************************************************************************************/	
$config['Autoload']['tool'] 	= array(); // Array

/******************************************************************************************
* TOOL                                                                               	  *
*******************************************************************************************
| Genel Kullanım: Otomatik olarak model dosyası yüklemek için kullanılır.       		  |
| Parametre: Dahil etmek istediğiniz modelleri diziye elaman olarak sırayla ekleyin.      |
| Örnek: array("m1", "m2");															      |
******************************************************************************************/	
$config['Autoload']['model'] 	= array(); // Array

/******************************************************************************************
* LANGUAGE                                                                            	  *
*******************************************************************************************
| Genel Kullanım: Otomatik olarak dil dosyası yüklemek için kullanılır.       		  	  |
| Parametre: Dahil etmek istediğiniz dil dosyalarını diziye elaman olarak sırayla ekleyin.|
| Örnek: array("lang1", "lang2");														  |
******************************************************************************************/	
$config['Autoload']['language'] = array(); // Array

/******************************************************************************************
* COMPOSER AUTOLOAD                                                                       *
*******************************************************************************************
| Genel Kullanım: Composer autoload dosyasının yüklenip yüklenilmeyeceğine karar verir.   |
| Parametre: True, false veya yol değeri alır. True, vendor/autoload.php dosyasının       |
| yüklenmesi anlamına gelir. Parametre olarak yol değeri belirtilebilir. 				  |
| Örnek: example/vendor/autoload.php													  |
| Örnek: true veya false														          |
******************************************************************************************/	
$config['Autoload']['composer'] = false;
//--------------------------------------------------------------------------------------------------------------------------