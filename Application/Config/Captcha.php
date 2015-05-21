<?php
/************************************************************/
/*                  CAPTCHA(GÜVENLİK KODU)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

/******************************************************************************************
* CAPTCHA                                                                         	  	  *
*******************************************************************************************
| Genel Kullanım: Güvenlik kodu ayarlarını yapmak için kullanılır.       		  	      |
******************************************************************************************/

$config['Captcha']['char_count'] 	= '6'; //Resmin kaç karakter olacağını belirlemek için kullanılır = 0-12
$config['Captcha']['bg_color']   	= '80|80|80'; //Arkaplan rengini ayarlamak için renk kodu kullanılır = 0-255|0-255|0-255
$config['Captcha']['background'] 	= array(); //Arkaplana resim/resimler eklemek için kullanılır = 'DosyaYolu1', 'DosyaYolu2'
$config['Captcha']['font_color'] 	= '255|255|255'; //Yazının rengini ayarlamak için renk kodu kullanılır = 0-255|0-255|0-255
$config['Captcha']['border'] 	 	= false; //Güvenlik kodu görselinde çerçevenin olup olmamasını belirlemek için kullanılır = true-false
$config['Captcha']['border_color'] 	= '0|0|0'; //Çerçeve rengini ayarlamak için renk kodu kullanılır = 0-255|0-255|0-255
$config['Captcha']['width']			= '180'; //Güvenlik kodu görselinin piksel cinsinden genişlik değeri = 0-9999
$config['Captcha']['height'] 		= '40'; //Güvenlik kodu görselinin piksel cinsinden yükseklik değeri = 0-9999
$config['Captcha']['image_string'] 	= array('size' => '5', 'x' => '65', 'y' => '13'); //Yazının Boyutu, Yataydaki Konumu, Dikeydeki Konumu
$config['Captcha']['grid']			= true; //Güvenlik kodu görselinde gridlerin olup olmamasını belirlemek için kullanılır = ttue-false
$config['Captcha']['grid_space']	= array('x' => 12, 'y' => 4); //Gridler arası boşluğu ayarlamak için kullanılır
$config['Captcha']['grid_color'] 	= '50|50|50'; //Gridin rengini ayarlamak için renk kodu kullanılır = 0-255|0-255|0-255
//--------------------------------------------------------------------------------------------------------------------------
