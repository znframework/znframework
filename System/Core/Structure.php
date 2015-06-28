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
		$url_join 		= ''; 	
		
		/* Url Parameters Değişkeni
		 *
		 * Url adresinin parametre bölümlerini
		 * tutması için oluşturulmuştur.
		 */
		$url_parameters = '';	
		
		/* Is Fıle Değişkeni
		 *
		 * Girilen Url adresinin geçerli bir.
		 * sayfa olma durumun kontrol etmesi için oluşturulmuştur.
		 */  
		$is_file 		= ''; 
		
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
		$request_uri 	= requestUri();
		
		
		// -------------------------------------------------------------------------------
		//  $_GET kontrolü yapılarak temel URL bilgisi elde ediliyor.
		// -------------------------------------------------------------------------------
		$url 			= explode('?', $request_uri);
		
		// -------------------------------------------------------------------------------
		//  Temel URL adresi / karakteri ile bölümlere ayrılıyor.
		// -------------------------------------------------------------------------------
		$url_explode 	= explode('/', $url[0]);
		
		// -------------------------------------------------------------------------------
		//  Bölümlere ayrılan URL yeniden yapılandırılıyor.
		// -------------------------------------------------------------------------------
		for($i=0; $i < count($url_explode); $i++)
		{
			$url_join .= $url_explode[$i];
			
			// URL için geçerli bir sayfa bilgisi elde edilirse...
			if( is_file( CONTROLLERS_DIR.suffix($url_join, '.php') ) )
			{
				// -------------------------------------------------------------------------------
				//  1. Bölüm:Dosya ve Sınıf ismini oluşturur.
				// -------------------------------------------------------------------------------
				if( isset($url_explode[$i]) )
				{
					$page = $url_explode[$i];
				}
				
				// -------------------------------------------------------------------------------
				//  2. Bölüm:Fonksiyon veya Yöntem ismini oluşturur.
				// -------------------------------------------------------------------------------
				if( isset($url_explode[$i + 1]) )	
				{
					$function = $url_explode[$i + 1];
				}
				
				// -------------------------------------------------------------------------------
				//  3. Bölüm ve Sonraki Bölümler:Parametreleri oluşturur.
				// -------------------------------------------------------------------------------
				$url_parameters = $i + 2;
				$last_join 		= $url_join;		
				$is_file 		= CONTROLLERS_DIR.suffix($last_join, '.php');
			}
			else
			{
				$url_join .= '/';	
			}
		
			// -------------------------------------------------------------------------------
			//  Parametreleri birleştir.
			// -------------------------------------------------------------------------------
			if( isset($url_explode[$url_parameters]) )
			{
				 array_push( $parameters, $url_explode[$url_parameters] ); 		 
				 $url_parameters++;
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
		if( ! empty($is_file) )
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
			require_once $is_file;
				
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
					$error = getMessage('System', 'callUserFuncClassError');
					
					// Sayfa bilgisine erişilemezse hata bildir.
					echo $error;
					
					// Hatayı rapor et.
					report('Error', $error, 'SystemCallUserFuncClassError');
					
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
					$error = getMessage('System', 'callUserFuncArrayError');
					
					// Hatayı ekrana yazdır.
					echo $error;
					
					// Hatayı rapor et.
					report('Error', $error, 'SystemCallUserFuncArrayError');
					
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
				$error = getMessage('System', 'notIsFileError');
				
				// Hatayı ekrana yazdır.
				echo $error;
				
				// Hatayı rapor et.
				report('Error', $error, 'SystemNotIsFileError');
				
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