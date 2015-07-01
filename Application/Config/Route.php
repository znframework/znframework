<?php
/************************************************************/
/*                   ROUTE(YÖNLENDİRME)                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* ROUTE                                                                                   *
*******************************************************************************************
| Genel Kullanımı: Açılış sayfası, hata sayfası veya URI yönlendirme gibi işlemlerin      |
| yapıldığı ayar dosyasıdır.									  						  |						
******************************************************************************************/

/******************************************************************************************
* OPEN PAGE                                                                               *
*******************************************************************************************
| Genel Kullanımı: Başlangıçta varsayılan açılış sayfasını sağlayan Controller dosyasıdır.|
| Dikkat edilirse açılış sayfası welcome.php'dir ancak bu işlemi yapan home.php	          |
| Controller dosyasıdır.																  |						
******************************************************************************************/
$config['Route']['openPage'] 	= 'home';

/******************************************************************************************
* OPEN PAGE                                                                               *
*******************************************************************************************
| Genel Kullanımı: Geçersiz URI adresi girildiğinde yönlendirilmek istenen URI yoludur.   |						
******************************************************************************************/
$config['Route']['show404'] 	= '';

/******************************************************************************************
* CHANGE URI                                                                              *
*******************************************************************************************
| Genel Kullanımı: URI adreslerinde değişiklik yapmak yani URI yönlendirme yapmak için    |
| kullanılır. Yönlendirmeler bir dizi içerisinde belirtilir. Dizi anahtar verisi olarak   |
| Eski URI bilgisi, değer verisi olarakta yeni URI bilgisi yazılır. Böylece bir sayfaya   |
| birden fazla yönlendirme verisi girilebilir.   										  |	
|    																			          |	
| Örnek Kullanım:  																		  |
| array																					  |
| (																						  |
| 'anasayfa' => 'home/index',															  |
| 'home'     => 'home/index'														      |
| );																				      |
| Yukarıdaki kullanımda home/index için 2 farklı yönlendirme sağlamış olduk.		      |							
******************************************************************************************/
$config['Route']['changeUri'] 	= array();