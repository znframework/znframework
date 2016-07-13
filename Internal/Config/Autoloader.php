<?php 
//----------------------------------------------------------------------------------------------------
// AUTOLOADER 
//----------------------------------------------------------------------------------------------------
//
// Author     : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.znframework.com
// License    : The MIT License
// Copyright  : Copyright (c) 2012-2016, ZN Framework
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Autoloader Directory Scanning                                                             
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Çağrılan bir sınıf bulunamadığında tarama yapıp classMap yapısının      
// yeniden oluşturulmasını sağlamak içindir. Bu ayar true olarak kalırsa yeni 		      
// oluşturduğunuz sınıfların kullanıma hazır hale gelmesi için belirtilen dizinleri		  
// arar kullandığınız sınıf bulunrsa classmap yeniden oluşturularak sınıfınız çalışması	  
// sağlanır. False olarak ayarlanırsa böyle bir tarama yapmaz.							  
//											     			 	  						  
//----------------------------------------------------------------------------------------------------
$config['Autoloader']['directoryScanning'] = true;

//----------------------------------------------------------------------------------------------------
// Autoloader Directory Permission                                                             
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Dosyalar otomatik yükleme ile oluşturulurken oluşturulduğu dizine ait yetki
// derecesi ayarlanır.							  
//											     			 	  						  
//----------------------------------------------------------------------------------------------------
$config['Autoloader']['directoryPermission'] = 0755;

//----------------------------------------------------------------------------------------------------
// Autoloader Class Map                                                                   
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Sınıf yolları oluşturulacak dizinler belirtiliyor.				      
// Dizi içerisinde dizin bilgileri yer alır. 				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Autoloader']['classMap'] = 
[
	INTERNAL_LIBRARIES_DIR,
	LIBRARIES_DIR,
	EXTERNAL_LIBRARIES_DIR,
	MODELS_DIR,
	EXTERNAL_MODELS_DIR
];

//----------------------------------------------------------------------------------------------------
// Autoloader Aliases                                                               
//----------------------------------------------------------------------------------------------------
//
// Genel Kullanım: Sınıflara takma isimler vermek için kullanılır.
//
// Example: ['aliasName' => 'originName', ...] 				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Autoloader']['aliases'] = [];