<?php
//----------------------------------------------------------------------------------------------------
// TEMEL YAPI 
//----------------------------------------------------------------------------------------------------
//
// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
// Site       : www.zntr.net
// Lisans     : The MIT License
// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
//
//----------------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------------
// Structre                                                                        
//----------------------------------------------------------------------------------------------------
//
// Sistemin temel sınıfıdır.														  		  
//
//----------------------------------------------------------------------------------------------------
class Structure
{
	//----------------------------------------------------------------------------------------------------
	// DATAS                                                                                   
	//----------------------------------------------------------------------------------------------------
	//
	// Genel Kullanım: Çalıştırılmak istenen yapının ihtiyaç duyduğu verileri döndürür.		  
	//         																				  
	//----------------------------------------------------------------------------------------------------
	public static function data()
	{
		/* Page Değişkeni
		 *
		 * Controller/page.php bilgisini
		 * tutması çin oluşturulmuştur.
		 */
		$page 			= ''; 
		
		/* Function Değişkeni
		 *
		 * Page/Function bilgisini
		 * tutaması için oluşturulmuştur.
		 */
		$function 		= 'index'; 	
		
		/* Parameters Dizi Değişkeni
		 *
		 * Url adresindeki parametre bilgilerini
		 * tutması için oluşturulmuştur.
		 */  	
		$parameters 	= array();
		
		/* Segments Değişkeni
		 *
		 * Url adresinin parametre bölümlerini
		 * tutması için oluşturulmuştur.
		 */
		$segments  		= '';	
		
		/* Is Fıle Değişkeni
		 *
		 * Girilen Url adresinin geçerli bir.
		 * sayfa olma durumun kontrol etmesi için oluşturulmuştur.
		 */  
		$isFile 		= ''; 
		
		/* Request Uri Değişkeni
		 *
		 * Ziyaretçi URL adresini
		 * tutması için oluşturulmuştur.
		 */
		$requestUri 	= requestUri();
		
		// -------------------------------------------------------------------------------
		//  $_GET kontrolü yapılarak temel URL bilgisi elde ediliyor.
		// -------------------------------------------------------------------------------
		$url 			= explode('?', $requestUri);
		
		// -------------------------------------------------------------------------------
		//  Temel URL adresi / karakteri ile bölümlere ayrılıyor.
		// -------------------------------------------------------------------------------
		$segments 		= explode('/', $url[0]);
		
		// -------------------------------------------------------------------------------
		//  Controller/Sayfa: Controller/ dizini içinde çalıştırılacak dosya adı.
		// -------------------------------------------------------------------------------
		if( isset($segments[0]) )
		{
			$page   = $segments[0];
			$isFile = restorationPath(CONTROLLERS_DIR.suffix($page, '.php'));
			
			// Kontrolcüler Controllers/ dizini içinde 
			// farklı bir dizinde yer alıyorsa bu bölüm
			// ile o kontrolcülere erişim sağlanıyor.
			if( ! is_file($isFile) )
			{
				$if 	   = '';
				$nsegments = $segments;
				
				for( $i = 0; $i < count($segments); $i++ )
				{
					$if    .= $segments[$i].'/';
					$ifTrim = rtrim($if, '/');
					$isF    = restorationPath(CONTROLLERS_DIR.suffix($ifTrim , '.php'));

					if( is_file($isF) )
					{
						$page     = divide($ifTrim, '/', -1);
						$isFile   = $isF;
						$segments = $nsegments;
						
						break;
					}
					
					array_shift($nsegments);
				}	
			}
			
			unset($segments[0]);
			
			$pageControl = strtolower($page);
			
			// Bir Controller/ dosyası index kelimesi ile isimlendirilemez!
			if( $pageControl === 'index' || $pageControl === 'main')
			{
				// Hatayı ekrana yazdır.
				echo Error::message('Error', 'controllerNameError', $pageControl);
				
				// Hatayı rapor et.
				report('Error', getMessage('Error', 'controllerNameError'), 'ControllerNameError');
				
				// Çalışmayı durdur.
				return false;
			}
		}
		
		// -------------------------------------------------------------------------------
		//  Fonksiyon: Çalıştırılacak dosyaya ait yöntem adı.
		// -------------------------------------------------------------------------------
		if( isset($segments[1]) )
		{
			$function = $segments[1];
			
			unset($segments[1]);
		}
		
		// -------------------------------------------------------------------------------
		//  Parametreler: Çalıştırılacak yönteme gönderilecek parametreler.
		// -------------------------------------------------------------------------------
		if( isset($segments[2]) )
		{
			$parameters = $segments;
		}
		
		return array
		(
			'parameters' => $parameters,
			'page'		 => $page,
			'file'	 	 => $isFile,
			'function'	 => $function
		);
	}
}