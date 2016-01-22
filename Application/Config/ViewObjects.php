<?php
//----------------------------------------------------------------------------------------------------
// CSS3 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Css3                                                                            	  
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Css3 kütüphanesi ile ilgili gerekli ayarları içerir.					  			  
//
//----------------------------------------------------------------------------------------------------
$config['ViewObjects']['css3'] = array
(
	//------------------------------------------------------------------------------------------------
	// Browser                                                                            	  
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Css3 kütüphanesi ile ilgili gerekli ayarları içerir.					  
	// Aşağıda css3 komutlarının uygulanacağı tarayıcı listesi mevcuttur.                      
	// Aşağıda boş bir eleman girilmesinin nedeni tarayıcılar dışında standart css3 komutlarını
	// da kullanması içindir.																  
	// Örnek: box-shadow, -ms-box-shadow, -moz-box-shadow, -webkit-box-shadow				  
	//
	//------------------------------------------------------------------------------------------------
	'browsers' => array('', '-o-', '-ms-', '-moz-', '-webkit-')
);

//----------------------------------------------------------------------------------------------------
// Font
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Fontlarla ilgili ayarlar yer alır.   										     					  
//
//----------------------------------------------------------------------------------------------------
$config['ViewObjects']['font'] = array
(
	//------------------------------------------------------------------------------------------------
	// Different Font Extensions
	//------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: SVG, WOFF, EOT, OTF, TTF uzantılı fontlar dışında başka bir uzantılı    
	// font kullanacaksınız aşağıdaki diziye eklemeniz gerekmektedir. Uzantı başında (.) nokta 
	// karakteri kullanmanıza gerek yoktur. Örnek array('ufo', 'fon') şeklinde yazmanız        
	// yeterlidir.	 												     					  
	//
	//------------------------------------------------------------------------------------------------
	'differentFontExtensions' => array()
);

//----------------------------------------------------------------------------------------------------
// Cdn
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Uzaktan linklerin kullanımına yönelik ayarları içerir.           	      										  
//
//----------------------------------------------------------------------------------------------------
$config['ViewObjects']['cdn'] = array
(
	//----------------------------------------------------------------------------------------------------
	// Script                                                                     	  	  
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Script URL bilgilerini tutmak için oluşturulmuştur.               	      
	// Bu linkleri güncelleyerek dışardan script dosyaları çağırabilirsiniz.					  
	// Bu stilleri import ederken anahtar ifadeler kullanılarak dahil etme işlemi yapılır.     
	// Örnek Kullanım: Import::script('style');									     		  
	//
	//----------------------------------------------------------------------------------------------------
	'scripts' => array
	(
		'jquery'    => 'https://code.jquery.com/jquery-latest.js',
		'jqueryUi'  => 'https://code.jquery.com/ui/1.11.3/jquery-ui.js',
		'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js',
		'bootlint'  => 'https://maxcdn.bootstrapcdn.com/bootlint/0.14.1/bootlint.min.js',
		'angular'   => 'https://ajax.googleapis.com/ajax/libs/angularjs/1.2.29/angular.min.js'
	),
	
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
	'styles' => array
	(
		'bootstrap' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css',
		'awesome'   => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'
	),
	
	//----------------------------------------------------------------------------------------------------
	// Font                                                                     	  	  
	//----------------------------------------------------------------------------------------------------
	//
	// Harici sunuculardan çağırmayı düşündüğünüz fontların anahtar ismi ve url bilgisini eklemek için.	
	// Import::font('anahtar') ile direk import ettirebilirsiniz.						     		  
	//
	//----------------------------------------------------------------------------------------------------
	'fonts' => array
	(
		// 'font1' => 'http://xx.xx.xxx/image/font1.ttf'
	),
	
	//----------------------------------------------------------------------------------------------------
	// Image                                                                     	  	  
	//----------------------------------------------------------------------------------------------------
	//
	// Harici sunuculardan çağırmayı düşündüğünüz resimlerin anahtar ismi ve url bilgisini eklemek için.
	// CND::image('anahtar') ile anahtarın değerini döndürebilirsiniz.
	// Html::image(CND::image('image1'));								     		  
	//
	//----------------------------------------------------------------------------------------------------
	'images' => array
	(
		// 'image1' => 'http://xx.xx.xxx/image/image1.jpg'
	),
	
	//----------------------------------------------------------------------------------------------------
	// File                                                                     	  	  
	//----------------------------------------------------------------------------------------------------
	//
	// Harici sunuculardan çağırmayı düşündüğünüz dosyaların anahtar ismi ve url bilgisini eklemek için.	
	// CND::file('anahtar') ile anahtarın değerini döndürebilirsiniz.	
	// File::contents(CND::file('anahtar'));					     		  
	//
	//----------------------------------------------------------------------------------------------------
	'files' => array
	(
		// 'file1' => 'http://xx.xx.xxx/files/file1.txt'
	)
);

//----------------------------------------------------------------------------------------------------
// Doctype                                                                         	  	  
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Döküman türleri listesi.      			  							  
//
//----------------------------------------------------------------------------------------------------
$config['ViewObjects']['doctype'] = array
(
	'xhtml1Strict'			=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
	'xhtml1Transitional'	=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
	'xhtml1Frameset' 		=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//TR" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
	'xhtml11'				=> '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//TR" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">',
	'html4Strict'			=> '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//TR" "http://www.w3.org/TR/html4/strict.dtd">',
	'html4Transitional' 	=> '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//TR" "http://www.w3.org/TR/html4/loose.dtd">',
	'html4Frameset'			=> '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//TR" "http://www.w3.org/TR/html4/frameset.dtd">',
	'html5'					=> '<!DOCTYPE html>'
);

