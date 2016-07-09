<?php
//----------------------------------------------------------------------------------------------------
// Application Mode                                                                  
//----------------------------------------------------------------------------------------------------
//
// Uygulama modu belirtilir. Kullanılabilir modlar: publication, restoration, development				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Application']['mode'] = 'Development';

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
// dizi kullanılır. Dizideki anatarlar host adından değerler ise o hostun hangi uygulama dizini
// çalıştıracağını gösterir. Hostu yanlış yazıyorsanız Controllerin herhangi birindehost() yöntemini 
// kullanarak host adını öğrenebilirsiniz.
//
// others
// [
//     'www.hostname.xxx' => 'HostApp',
//     'localhost'        => 'Local'
// ]	     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Application']['directory'] = 
[
	// Varsayılan Açılış Dizini
	'default' => 'Frontend',
	
	// Çalıştırılacak Diğer Dizinler
	'others'  => 
	[
		'backend' => 'Backend'
	]
];

//----------------------------------------------------------------------------------------------------
// Benchmarking Test                                                                  
//----------------------------------------------------------------------------------------------------
//
// Bu ayarın true olarak seçilmesi durumunda sistemin açılış hızını
// ve yüklenme zamanını gösteren bir tablo gösterilir.				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Application']['benchmark'] = false;

//----------------------------------------------------------------------------------------------------
// Restoration                                                                 
//----------------------------------------------------------------------------------------------------
//
// Restorasyon işlemlerini başlatmak için yukarıdaki Application:mode ayarını 'Restoration' olarak
// ayarlamanı gerekmektedir. Bu ayarlamadan sonra aşağıdaki ayarları yapabilirsiniz.				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Application']['restoration'] = 
[
	// Uygulama üzerinde restore işlemlerinin yapıldığı makinelere ait ip adresleri belirtilir.
	'machinesIP' => [],
	
	// Çalışmayan, hata oluşmuş kullanıcıların karşılasması istenmeyen sayfalar belirtilir.	
	'pages'      => [],
	
	// Restoration Pages ayarına belirtilmiş sayfalarından herhangi birine istek yapıldığında
	// bu ayarın belirtildiği sayfaya yönlendirilir.
	'routePage'  => ''
];

//----------------------------------------------------------------------------------------------------
// Directory Index                                                                  
//----------------------------------------------------------------------------------------------------
//
// Varsayılan açılış sayfası ayarlanır.				     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Application']['directoryIndex'] = 'zeroneed.php';