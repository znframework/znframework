<?php
/************************************************************/
/*                   	 STRUCTURE URL                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/* 
	ZN FRAMEWOK URL SİSTEMİ
						                      
	httpx://www.xxxx.xxx/[dizin/dizin/.../][index.php/]['dil/']sayfa(sınıf)/fonksiyon[/parametre1/parametre2/.../parametreN] 

*/

/* STRUCTURE RUN *
 *
 * 
 * System running
 */
Structure::run();

/******************************************************************************************
* STRUCTURE CLASS                                                                         *
*******************************************************************************************
| Sistemin temel sınıfıdır.														  		  |
******************************************************************************************/
class Structure
{
	/* STRUCTURE RUN
	 *
	 *
	 *
	 */
	
	public static function run()
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
			$isFile = CONTROLLERS_DIR.suffix($page, '.php');
			
			unset($segments[0]);
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
	
		// ----------------------------------------------------------------------
		
		// TAMPONLAMA BAŞLATILIYOR...
		
		if( Config::get('Cache','obGzhandler') && substr_count(server('acceptEncoding'), 'gzip') ) 
		{
			ob_start('ob_gzhandler');
		}
		else
		{
			ob_start();
		}
		
		// ----------------------------------------------------------------------

		// BAŞLIK BİLGİLERİ DÜZENLENİYOR...
		
		headers(Config::get('Headers', 'settings'));
		
		// ----------------------------------------------------------------------
	
		// SAYFA KONTROLÜ YAPILIYOR...
		// -------------------------------------------------------------------------------
		//  Sayfa bilgisine erişilmişse sayfa dahil edilir.
		// -------------------------------------------------------------------------------
		if( file_exists($isFile) )
		{
			// -------------------------------------------------------------------------------
			//  Tadilat modu açıksa bu ayarlar geçerli olacaktır.
			// -------------------------------------------------------------------------------
			if( Config::get('Repair', 'mode') ) 
			{
				Repair::mode();
			}
			
			// -------------------------------------------------------------------------------
			//  Sayfa dahil ediliyor.
			// -------------------------------------------------------------------------------
			require_once $isFile;
				
			// -------------------------------------------------------------------------------
			// Sayfaya ait controller nesnesi oluşturuluyor.
			// -------------------------------------------------------------------------------
			 $var = new $page;
				
			// -------------------------------------------------------------------------------
			// Sınıf ve yöntem bilgileri geçerli ise sayfayı çalıştır.
			// -------------------------------------------------------------------------------	
			if( is_callable(array($var, $function)) )
			{
				call_user_func_array( array($var, $function), $parameters);
			}
			else
			{
				// Sayfa bilgisine erişilemezse hata bildir.
				if( ! Config::get('Route', 'show404') )
				{				
					// Hatayı ekrana yazdır.
					echo getErrorMessage('Error', 'callUserFuncArrayError', $function);
					
					// Hatayı rapor et.
					report('Error', getMessage('Error', 'callUserFuncArrayError'), 'SystemCallUserFuncArrayError');
					
					// Çalışmayı durdur.
					return false;
				}
				else
				{
					redirect(Config::get('Route', 'show404'));
				}
			}
		}
		else
		{	
			// Sayfa bilgisine erişilemezse hata bildir.
			if( Config::get('Route','show404') ) 
			{				
				redirect(Config::get('Route','show404'));		
			}
			else
			{
				// Hatayı ekrana yazdır.
				echo getErrorMessage('Error', 'notIsFileError', $isFile);
				
				// Hatayı rapor et.
				report('Error', getMessage('Error', 'notIsFileError'), 'SystemNotIsFileError');
				
				// Çalışmayı durdur.
				return false;
			}		
		}
		
		// Local modda hataları özel bir 
		// çerçeve ile gösterilmesini sağlar.
		if( APP_TYPE === 'local' )
		{
			echo ZNException::getLastError();	
		}
		
		// ----------------------------------------------------------------------
		
		// TAMPONLAMA KAPATILIYOR...
		
		ob_end_flush();
		
		// ----------------------------------------------------------------------
	}
}