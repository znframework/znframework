<?php
//----------------------------------------------------------------------------------------------------
// CDN (Content Delivery Network)
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Script
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Script URL bilgilerini tutmak için oluşturulmuştur.           	      
// Bu linkleri güncelleyerek jquery'nin en son sürümlerini kullanabilirsiniz.			  
// Bu scriptleri import ederken anahtar ifadeler kullanılarak dahil etme işlemi yapılır.   
// Örnek Kullanım: Import::script('jqueryUi');											  
//
//----------------------------------------------------------------------------------------------------
$config['Cdn']['scripts'] = array
(
	'jquery'    => 'https://code.jquery.com/jquery-latest.js',
	'jqueryUi'  => 'https://code.jquery.com/ui/1.11.3/jquery-ui.js',
	'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
	'bootlint'  => 'https://maxcdn.bootstrapcdn.com/bootlint/0.14.1/bootlint.min.js'
	
);

//----------------------------------------------------------------------------------------------------
// Style                                                                     	  	  
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Style URL bilgilerini tutmak için oluşturulmuştur.               	      
// Bu linkleri güncelleyerek dışardan style dosyaları çağırabilirsiniz.					  
// Bu stilleri import ederken anahtar ifadeler kullanılarak dahil etme işlemi yapılır.     
// Örnek Kullanım: Import::style('style');									     		  
//
//----------------------------------------------------------------------------------------------------
$config['Cdn']['styles'] = array
(
	'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
	'awesome'   => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'
);

//----------------------------------------------------------------------------------------------------
// Font                                                                     	  	  
//----------------------------------------------------------------------------------------------------
//
// Harici sunuculardan çağırmayı düşündüğünüz fontların anahtar ismi ve url bilgisini eklemek için.	
// Import::font('anahtar') ile direk import ettirebilirsiniz.						     		  
//
//----------------------------------------------------------------------------------------------------
$config['Cdn']['fonts'] = array
(
	// 'font1' => 'http://xx.xx.xxx/image/font1.ttf'
);

//----------------------------------------------------------------------------------------------------
// Image                                                                     	  	  
//----------------------------------------------------------------------------------------------------
//
// Harici sunuculardan çağırmayı düşündüğünüz resimlerin anahtar ismi ve url bilgisini eklemek için.
// CND::image('anahtar') ile anahtarın değerini döndürebilirsiniz.
// Html::image(CND::image('image1'));								     		  
//
//----------------------------------------------------------------------------------------------------
$config['Cdn']['images'] = array
(
	// 'image1' => 'http://xx.xx.xxx/image/image1.jpg'
);

//----------------------------------------------------------------------------------------------------
// File                                                                     	  	  
//----------------------------------------------------------------------------------------------------
//
// Harici sunuculardan çağırmayı düşündüğünüz dosyaların anahtar ismi ve url bilgisini eklemek için.	
// CND::file('anahtar') ile anahtarın değerini döndürebilirsiniz.	
// File::contents(CND::file('anahtar'));					     		  
//
//----------------------------------------------------------------------------------------------------
$config['Cdn']['files'] = array
(
	// 'file1' => 'http://xx.xx.xxx/files/file1.txt'
);