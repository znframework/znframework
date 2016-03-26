<?php 
//----------------------------------------------------------------------------------------------------
// AUTOLOADER 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
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
$config['Autoloader']['classMap'] = array
(
	LIBRARIES_DIR,
	MODELS_DIR,
	SYSTEM_LIBRARIES_DIR
);