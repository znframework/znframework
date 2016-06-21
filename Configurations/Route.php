<?php
//----------------------------------------------------------------------------------------------------
// ROUTE 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Open Page
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Başlangıçta varsayılan açılış sayfasını sağlayan Controller dosyasıdır.
// Dikkat edilirse açılış sayfası welcome.php'dir ancak bu işlemi yapan home.php	          
// Controller dosyasıdır.																  					
//
//----------------------------------------------------------------------------------------------------
$config['Route']['openPage']	= 'home';

//----------------------------------------------------------------------------------------------------
// Show 404
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Geçersiz URI adresi girildiğinde yönlendirilmek istenen URI yoludur.   					
//
//----------------------------------------------------------------------------------------------------
$config['Route']['show404']		= '';

//----------------------------------------------------------------------------------------------------
// Error Document
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanımı: Hatalı istek yapıldığında hangi URI'ye gidileceği ayarlanır.   	
// 
// setHtaccessFile: Rotaların .htaccess dosyasına eklenip eklenmeyeceğidir.
// routes         : Karşılaşılan hata numarsına göre hangi URI'lerin çalıştırılacağıdır. 				
//
//----------------------------------------------------------------------------------------------------
$config['Route']['errorDocument'] = array
(
	// Rotaların .htaccess dosyasına eklenip eklenmeyeceğidir.
	'setHtaccessFile' => false,	
	
	// Karşılaşılan hata numarsına göre hangi URI'lerin çalıştırılacağıdır.
	'routes' => array
	(
		'400' => 'bad-request/code/400',
		'401' => 'bad-request/code/401',
		'403' => 'bad-request/code/403',
		'404' => 'bad-request/code/404',
		'500' => 'bad-request/code/500'
	)
);

//----------------------------------------------------------------------------------------------------
// Pattern Type
//----------------------------------------------------------------------------------------------------
//
// Bu ayar Change URI ayarına yazılacak desenin türünü belirler.
//
// @key string patternType: special, classic
//
// special: Config/Regex.php dosyasında yer alan karakterlerin kullanımlarıdır.
// classic: Düzenli ifadelerdeki standart karakterlerin kullanımlarıdır. 	
//	      						
//----------------------------------------------------------------------------------------------------
$config['Route']['patternType']	= 'classic';

//----------------------------------------------------------------------------------------------------
// Change Uri
//----------------------------------------------------------------------------------------------------
//
// URI adreslerine rota vermek için kullanılır.
//
// Kullanım: @key -> yeni adres, @value -> eski adres										  
//    																			           																		  
// array																					  
// (																						  														  
//     'anasayfa'     => 'home/index'														      
// );																				      
//	      						
//----------------------------------------------------------------------------------------------------
$config['Route']['changeUri'] 	= array
(
	// '(\b)\/(\b)' => '$1/index/$2' // index ibaresini kaldırmak.
);