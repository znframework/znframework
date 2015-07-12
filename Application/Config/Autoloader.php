<?php 
/************************************************************/
/*                       AUTOLOADER                         */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

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
	SYSTEM_LIBRARIES_DIR,
	COMPONENTS_DIR
);
//--------------------------------------------------------------------------------------------------------------------------