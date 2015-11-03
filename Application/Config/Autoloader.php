<?php 
/************************************************************/
/*                       AUTOLOADER                         */
/************************************************************/
/*

Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* AUTOLOADER FOLDER SCAN                                                                  *
*******************************************************************************************
| Genel Kullanım: Çağrılan bir sınıf bulunamadığında tarama yapıp classMap yapısının      |
| yeniden oluşturulmasını sağlamak içindir. Bu ayar true olarak kalırsa yeni 		      |
| oluşturduğunuz sınıfların kullanıma hazır hale gelmesi için belirtilen dizinleri		  |
| arar kullandığınız sınıf bulunrsa classmap yeniden oluşturularak sınıfınız çalışması	  |
| sağlanır. False olarak ayarlanırsa böyle bir tarama yapmaz.							  |
| 											     			 	  						  |
******************************************************************************************/	
$config['Autoloader']['directoryScanning'] = true;

/******************************************************************************************
* AUTOLOADER CLASS MAP                                                                    *
*******************************************************************************************
| Genel Kullanım: Sınıf yolları oluşturulacak dizinler belirtiliyor.				      |
| Dizi içerisinde dizin bilgileri yer alır. 				     			 	  		  |
| 											     			 	  						  |
******************************************************************************************/	
$config['Autoloader']['classMap'] = array
(
	LIBRARIES_DIR,
	MODELS_DIR,
	SYSTEM_LIBRARIES_DIR
);
//--------------------------------------------------------------------------------------------------------------------------