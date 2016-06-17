<?php
//----------------------------------------------------------------------------------------------------
// Application Mode                                                                  
//----------------------------------------------------------------------------------------------------
//
// Uygulama modu belirtilir. Kullanılabilir modlar: publication, restoration, development				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$application['mode'] = 'Development';

//----------------------------------------------------------------------------------------------------
// Application Directory                                                                  
//----------------------------------------------------------------------------------------------------
//
// Uygulamanın çalışcağı dizini belirtilir.		
// Eğer birden fazla uygulama aynı dizin üzerinde çalıştırılacaksa bu ayarı dizi biçiminde 
// kullanabilirsiniz. 
//
// Kullanımlar
// String: Uygulamanın çalıştırılacağı dizin.
// Array : Birden fazla uygulama çalıştırılacaksa hostname => appdir şeklinde anahtar değer içeren
// dizi kullanılır.
//
// array
// (
//     'www.hostname.xxx' => 'HostApp',
//     'localhost'        => 'Application'
// )	     			 	  		  
//
// Bu işlemler Restoration:directory ayarı içinde geçerlidir.
//
//----------------------------------------------------------------------------------------------------
$application['directory'] = 'Local';

//----------------------------------------------------------------------------------------------------
// Benchmarking Test                                                                  
//----------------------------------------------------------------------------------------------------
//
// Bu ayarın true olarak seçilmesi durumunda sistemin açılış hızını
// ve yüklenme zamanını gösteren bir tablo gösterilir.				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$application['benchmark'] = false;

//----------------------------------------------------------------------------------------------------
// Restoration                                                                 
//----------------------------------------------------------------------------------------------------
//
// Uygulamanın restore edileceği dizini belirtilir.				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$application['restoration'] = array
(
	// Uygulamanın restore edileceği dizini belirtilir.	
	'directory'  => 'Local',
	
	// Uygulama üzerinde restore işlemlerinin yapıldığı makinelere ait ip adresleri belirtilir.
	'machinesIP' => array(),
	
	// Çalışmayan, hata oluşmuş kullanıcıların karşılasması istenmeyen sayfalar belirtilir.	
	'pages'		 => array(),
	
	// Restoration Pages ayarına belirtilmiş sayfalarından herhangi birine istek yapıldığında
	// bu ayarın belirtildiği sayfaya yönlendirilir.
	'routePage'  => ''
);

//----------------------------------------------------------------------------------------------------
// Directory Index                                                                  
//----------------------------------------------------------------------------------------------------
//
// Varsayılan açılış sayfası ayarlanır.				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$application['directoryIndex'] = 'zeroneed.php';