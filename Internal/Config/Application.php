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
// Uygulama dizinlerinin kullanımına yönelik ayarlar yer alır.	     			 	  		  
//
//----------------------------------------------------------------------------------------------------
$config['Application']['directory'] = 
[
	//------------------------------------------------------------------------------------------------
	// Default                                                                                  
	//------------------------------------------------------------------------------------------------
	//
	// URI' da herhangi bir uzantı gerektirmeden kullanılması istenilen uygulama dizini belirtilir.
	// Ön tanımlı olarak Applications/Frontend/ dizini kullanılmıştır.	  								                    														 						
	//
	//------------------------------------------------------------------------------------------------
	'default' => 'Frontend',
	
	//------------------------------------------------------------------------------------------------
	// Others                                                                                  
	//------------------------------------------------------------------------------------------------
	//
	// Bu ayar 2 formda kullanılır. 
	//
	// 1 - Çoklu Domain Kullanımı	
	// Eğer bir host için birden fazla domain kullanıyorsanız hangi hostun hangi uygulama dizinini
	// kullanacağını belirtmeniz gerekir.
	// Example: ['www.example.com' => 'ExampleApp', 'localhost' => 'LocalApp']
	//
	// 2 - Takma Ad Kullanımı
	// Applications/ dizini altında yer alan uygulama dizinine takma ad verip site.com/ dan sonraki
	// bölüm için uygulama dizinin adı yerine takma adını kullanabilirsiniz.
	// Applications/UygulamaDizini gibi bir uygulamamız olduğunu varsayarsak normalde bu dizini
	// çalıştırmak için site.com/UygulamaDizini olarak kullanmamız gerekirdi. Ancak siz buna takma
	// isim vererek yani ['uygulama-dizini' => 'UygulamaDizini'] şeklinde ayarlarsanız artık
	// site.com/uygulama-dizini formunda bu uygulamanın çalıştırılmasını sağlayabilirsiniz.
	// Example:	['panel' => 'Panel']	                    														 						
	//
	//------------------------------------------------------------------------------------------------
	'others'  => 
	[
		'backend'   => 'Backend',
		'example'   => 'Example',
		'generator' => 'Generator'
	]
];

//----------------------------------------------------------------------------------------------------
// Application Containers                                                                  
//----------------------------------------------------------------------------------------------------
//
// Uygulamaların birbirlerini kapsaması üzerine oluşturulmuş ayardır. Bu ayar sayesinde kapsayıcı olarak 
// belirlenen uygulamadaki yer alan Config/, Languages/, Libraries/, Models/, Resources/ ve Starting/
// dizinlerini referans göstererek ortak dizinler haline gelmesi sağlanır. Bu ayar kullanılırsa
// kapsanan dizindeki bu belirtilen dizinler kullanılamaz olup kapsayıcı dizinde yer alan bu dizinler
// hem kendi hemde kapsanan dizin için ortak dizinler haline gelir.
// 
// Örnek
// [
//     'Kapsanan' => 'Kapsayan',
//     'Backend'  => 'Frontend'
// ]	     			 	  		  
//
// Yukarıdaki ayar ile Frontend/ altında bulunan
// Config/, Languages/, Libraries/, Models/, Resources/ ve Starting/ dizinleri
// hem Backend hemde Frontend için ortak hale getirilmiş oldu.
// Example: ['Backend' => 'Frontend', 'TestBackend' => 'TestFrontend', ...]
//
//----------------------------------------------------------------------------------------------------
$config['Application']['containers'] = 
[
	'Backend' => 'Frontend'
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
	//------------------------------------------------------------------------------------------------
	// Machines IP                                                                                  
	//------------------------------------------------------------------------------------------------
	//
	// Uygulama üzerinde restore işlemlerinin yapıldığı makinelere ait ip adresleri belirtilir.
	// Example: ['215.213.21.32', '10.131.18.21', ...]
	//
	//------------------------------------------------------------------------------------------------
	'machinesIP' => [],
	
	//------------------------------------------------------------------------------------------------
	// Pages                                                                                  
	//------------------------------------------------------------------------------------------------
	// Çalışmayan, hata oluşmuş kullanıcıların karşılasması istenmeyen sayfalar belirtilir.	
	// Example: ['employee/profile', 'home/comments', ...]
	//
	//------------------------------------------------------------------------------------------------
	'pages'      => [],
	
	//------------------------------------------------------------------------------------------------
	// Route Page                                                                                 
	//------------------------------------------------------------------------------------------------
	// Restoration Pages ayarına belirtilmiş sayfalarından herhangi birine istek yapıldığında
	// bu ayarın belirtildiği sayfaya yönlendirilir.
	// Example: 'restoration/page'
	//
	//------------------------------------------------------------------------------------------------
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