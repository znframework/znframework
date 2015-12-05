<?php
//----------------------------------------------------------------------------------------------------
// CAPTCHA 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Settings                                                                           	  
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Güvenlik kodu ayarlarını yapmak içindir.                                
// Parametreler												  							  
// 1-char_count: Resmin karakter sayısı. Varsayıllan:6									  
// 2-bg_color: Resmin arkplan rengi. Varsayıllan:80|80|80								  
// 3-background: Resmin arkplan resmi. Varsayıllan:empty								      
// 4-font_color: Resmin yazı rengi. Varsayıllan:255|255|255								  
// 5-border: Resimde çerçeve olsun mu?. Varsayıllan:false								  
// 6-border_color: Çerçeve rengi. Varsayıllan:0|0|0								 		  
// 7-width: Resmin piksel cinsinden genişliği. Varsayıllan:180							  
// 8-height: Resmin piksel cinsinden yüksekliği. Varsayıllan:40							  
// 9-image_string: 3 ayar parametresinden oluşur											  
// 	  9.1-size: Yazının boyutu. Varsayılan:5												  
// 	  9.2-x: Yazının yataydaki konumu. Varsayılan:65										  
// 	  9.3-y: Yazının dikeydeki boyutu. Varsayılan:13										  
// 10-grid: Resimde ızgara olsun mu?. Varsayılan:true									  
// 11-grid_space: 2 ayar parametresinden oluşur.											  
// 	  11.1-x: Yataydaki ızgara sayısı. Varsayılan:12										  
// 	  11.2-y: Dikeydeki ızgara sayısı. Varsayılan:4										  
// 11-grid_color: Izgara rengi. Varsayılan:50|50|50	
//									  
//----------------------------------------------------------------------------------------------------
$config['Captcha']['charLength'] 	= '6';   
$config['Captcha']['bgColor']   	= '80|80|80';
$config['Captcha']['background'] 	= array(); 
$config['Captcha']['textColor'] 	= '255|255|255'; 
$config['Captcha']['border'] 	 	= false; 
$config['Captcha']['borderColor'] 	= '0|0|0';
$config['Captcha']['width']			= '180'; 
$config['Captcha']['height'] 		= '40'; 
$config['Captcha']['imageString'] 	= array('size' => '5', 'x' => '65', 'y' => '13');
$config['Captcha']['grid']			= true; 
$config['Captcha']['gridSpace']		= array('x' => 12, 'y' => 4);
$config['Captcha']['gridColor'] 	= '50|50|50'; 
//-------------------------------------------------------------------------------------------------------------------------------------------