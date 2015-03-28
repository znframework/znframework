<?php
/************************************************************/
/*                  CAPTCHA(GÜVENLİK KODU)                  */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

//--------------------------------------------------------------------------------------------------------------------------
SETTINGS
//--------------------------------------------------------------------------------------------------------------------------
1-char_count
2-bg_color
3-background
4-font_color
5-border
6-border_color
7-width
8-height
9-image_string
10-grid
11-grid_space
12-grid_color
//--------------------------------------------------------------------------------------------------------------------------

/* SETTINGS	*/
// İşlev:Güvenlik kodu görselinin ayarlarını yapmak için kullanılır
// Parametre:Anahtar değer çifti içeren bir dizi ayar bilgisi içerir
// Örnek: array('char_count' => '6');
$config['Captcha']['settings'] = array // Array
(
		'char_count'	=> '6', //Resmin kaç karakter olacağını belirlemek için kullanılır = 0-12
		'bg_color'		=> '80|80|80', //Arkaplan rengini ayarlamak için renk kodu kullanılır = 0-255|0-255|0-255
		'background'	=> array(), //Arkaplana resim/resimler eklemek için kullanılır = 'DosyaYolu1', 'DosyaYolu2'
		'font_color' 	=> '255|255|255', //Yazının rengini ayarlamak için renk kodu kullanılır = 0-255|0-255|0-255
		'border' 		=> false, //Güvenlik kodu görselinde çerçevenin olup olmamasını belirlemek için kullanılır = true-false
		'border_color' 	=> '0|0|0', //Çerçeve rengini ayarlamak için renk kodu kullanılır = 0-255|0-255|0-255
		'width'			=> '180', //Güvenlik kodu görselinin piksel cinsinden genişlik değeri = 0-9999
		'height' 		=> '40', //Güvenlik kodu görselinin piksel cinsinden yükseklik değeri = 0-9999
		'image_string' 	=> array('size' => '5', 'x' => '65', 'y' => '13'), //Yazının Boyutu, Yataydaki Konumu, Dikeydeki Konumu
		'grid'			=> true, //Güvenlik kodu görselinde gridlerin olup olmamasını belirlemek için kullanılır = ttue-false
		'grid_space'	=> array('x' => 12, 'y' => 4), //Gridler arası boşluğu ayarlamak için kullanılır
		'grid_color' 	=> '50|50|50' //Gridin rengini ayarlamak için renk kodu kullanılır = 0-255|0-255|0-255
);
//--------------------------------------------------------------------------------------------------------------------------