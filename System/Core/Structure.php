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
		/* Url Join Değişkeni
		 *
		 * Url parlarını birleştirmek
		 * için oluşturulmuştur.
		 */
		$urlJoin 		= ''; 	
		
		/* Url Parameters Değişkeni
		 *
		 * Url adresinin parametre bölümlerini
		 * tutması için oluşturulmuştur.
		 */
		$urlParameters  = '';	
		
		/* Is Fıle Değişkeni
		 *
		 * Girilen Url adresinin geçerli bir.
		 * sayfa olma durumun kontrol etmesi için oluşturulmuştur.
		 */  
		$isFile 		= ''; 
		
		/* Parameters Dizi Değişkeni
		 *
		 * Url adresindeki parametre bilgilerini
		 * tutması için oluşturulmuştur.
		 */  	
		$parameters 	= array();
		
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
		$urlExplode 	= explode('/', $url[0]);
		
		// -------------------------------------------------------------------------------
		//  Bölümlere ayrılan URL yeniden yapılandırılıyor.
		// -------------------------------------------------------------------------------
		for($i=0; $i < count($urlExplode); $i++)
		{
			$urlJoin .= $urlExplode[$i];
			
			// URL için geçerli bir sayfa bilgisi elde edilirse...
			if( is_file( CONTROLLERS_DIR.suffix($urlJoin, '.php') ) )
			{
				// -------------------------------------------------------------------------------
				//  1. Bölüm:Dosya ve Sınıf ismini oluşturur.
				// -------------------------------------------------------------------------------
				if( isset($urlExplode[$i]) )
				{
					$page = $urlExplode[$i];
				}
				
				// -------------------------------------------------------------------------------
				//  2. Bölüm:Fonksiyon veya Yöntem ismini oluşturur.
				// -------------------------------------------------------------------------------
				if( isset($urlExplode[$i + 1]) )	
				{
					$function = $urlExplode[$i + 1];
				}
				
				// -------------------------------------------------------------------------------
				//  3. Bölüm ve Sonraki Bölümler:Parametreleri oluşturur.
				// -------------------------------------------------------------------------------
				$urlParameters = $i + 2;
				$lastJoin 		= $urlJoin;		
				$isFile 		= CONTROLLERS_DIR.suffix($lastJoin, '.php');
			}
			else
			{
				$urlJoin .= '/';	
			}
		
			// -------------------------------------------------------------------------------
			//  Parametreleri birleştir.
			// -------------------------------------------------------------------------------
			if( isset($urlExplode[$urlParameters]) )
			{
				 array_push( $parameters, $urlExplode[$urlParameters] ); 		 
				 $urlParameters++;
			}
		}
		
		// ----------------------------------------------------------------------
		
		// TAMPONLAMA BAŞLATILIYOR...
		
		if( Config::get('Cache','obGzhandler') && substr_count(server('acceptEncoding'), 'gzip') ) 
		{
			ob_start('obGzhandler');
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
		if( ! empty($isFile) )
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
			//  URL fonksiyon bilgisi içermiyorsa varsayılan olarak index ayarlansın.
			// -------------------------------------------------------------------------------
			if( ! isset($function) ) 
			{
				$function = 'index';		
			}
			
			// -------------------------------------------------------------------------------
			//  Sayfa bilgisi boş ise ya da geçersiz URL bilgisi girilmişse bildir.
			// -------------------------------------------------------------------------------
			if( empty($page) ) 
			{
				if( ! Config::get('Route', 'show404') )
				{
					// Sayfa bilgisine erişilemezse hata bildir.
					echo getErrorMessage('Error', 'callUserFuncClassError');
					
					// Hatayı rapor et.
					report('Error', getMessage('Error', 'callUserFuncClassError'), 'SystemCallUserFuncClassError');
					
					// Çalışmayı durdur.
					return false;
				}
				else
				{
					redirect(Config::get('Route', 'show404'));
				}
			}
				
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
					echo getErrorMessage('Error', 'callUserFuncArrayError');
					
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
				echo getErrorMessage('Error', 'notIsFileError');
				
				// Hatayı rapor et.
				report('Error', getMessage('Error', 'notIsFileError'), 'SystemNotIsFileError');
				
				// Çalışmayı durdur.
				return false;
			}		
		}
		
		// ----------------------------------------------------------------------
		
		// TAMPONLAMA KAPATILIYOR...
		
		ob_end_flush();
		
		// ----------------------------------------------------------------------
	}
}