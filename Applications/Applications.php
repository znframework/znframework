<?php return
[
	//--------------------------------------------------------------------------------------------------
	// Application Directory                                                                  
	//--------------------------------------------------------------------------------------------------
	//
	// Uygulama dizinlerinin kullanımına yönelik ayarlar yer alır.	     			 	  		  
	//
	//--------------------------------------------------------------------------------------------------
	'directory' => 
	[
        //----------------------------------------------------------------------------------------------
        // Default                                                                                  
        //----------------------------------------------------------------------------------------------
        //
        // URI' da herhangi bir uzantı gerektirmeden kullanılması istenilen uygulama dizini belirtilir.
        // Ön tanımlı olarak Applications/Frontend/ dizini kullanılmıştır.	  								                    														 						
        //
        //----------------------------------------------------------------------------------------------
        'default' => 'Frontend',
		
        //----------------------------------------------------------------------------------------------
        // Others                                                                                  
        //----------------------------------------------------------------------------------------------
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
        //----------------------------------------------------------------------------------------------
        'others'  => 
        [
            'backend'   => 'Backend'
        ]
     ],
	
    //--------------------------------------------------------------------------------------------------
    // Application Containers                                                                  
    //--------------------------------------------------------------------------------------------------
    //
    // Uygulamaların birbirlerini kapsaması üzerine oluşturulmuş ayardır. Bu ayar sayesinde kapsayıcı 
    // olarak belirlenen uygulamadaki yer alan Config/, Languages/, Libraries/, Models/, Resources/ ve 
    // Starting/ dizinlerini referans göstererek ortak dizinler haline gelmesi sağlanır. Bu ayar 
    // kullanılırsa kapsanan dizindeki bu belirtilen dizinler kullanılamaz olup kapsayıcı dizinde yer 
    // alan bu dizinler hem kendi hemde kapsanan dizin için ortak dizinler haline gelir.
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
    //--------------------------------------------------------------------------------------------------
    'containers' => 
    [
        'Backend' => 'Frontend'
    ]
];