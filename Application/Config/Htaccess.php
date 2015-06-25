<?php
/************************************************************/
/*                     HTACCESS(ERİŞİM)                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* HTACCESS                                                                         		  *
*******************************************************************************************
| Genel Kullanım: .htaccess dosyası ile ilgili ayarları yapabilmek için kullanılır.	      |
******************************************************************************************/

/******************************************************************************************
* CREATE FILE                                                                             *
*******************************************************************************************
| Genel Kullanım: .htaccess dosyasının oluşturulup oluşturulmayacağına karar verir.		  |
| Parametreler: true veya false															  |
| Varsayılan: true																		  |
| Url'de index.php ekini kullanmak istemiyorsanız ve .htaccess yönlendirmesi			  |
| sunucunuzda aktifse bu değeri true yapıp bu dosyanın oluşmasını sağlayın.				  |
| Bu işlem dışında Config/Uri.php dosyasındaki index.php ayarını false 					  |
| durumuna getirmeyi unutmayın.      												      |
******************************************************************************************/
$config['Htaccess']['createFile'] = true;

/******************************************************************************************
* SET FILE                                                                                *
*******************************************************************************************
| Genel Kullanım: .ini_set() yöntemiyle yapamadığınız ayarlamaları buradan yapabilirsiniz.|
| .htaccess dosyasında ini ayarları yapılabilsin mi?   									  |
******************************************************************************************/
$config['Htaccess']['setFile'] = false;

/******************************************************************************************
* SETTINGS                                                                                *
*******************************************************************************************
| Genel Kullanım: Bu yöntemin kullanılabilmesi için yukarıdaki ayarın true olması 		  |
| gerekmektedir. htaccess dosyasına header ayarları eklemek için kullanılır.			  |
| Parametreler: array( '<module>' => array('setting1', 'setting2' ...))				      |
| Varsayılan: array()																	  |
| Bu yöntemi kullanırken < > işaretlerini kullanmayınız.							      |
| Modülü kapatma işlemini kendisi gerçekleştirmektedir.                                   |
| Dizi içerisindeki birinci parametre modül adı ve tip									  |
| İkinci parametre ise bu aralıkta olması gereken kodlar.  							      |
******************************************************************************************/
$config['Htaccess']['settings'] = array
(
	 //'ifmodule mod_headers.c' => array('Header set Connection keep-alive')
);