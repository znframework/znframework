<?php
/************************************************************/
/*                   	 STRUCTURE URL                      */
/************************************************************/
/*
/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
/* Site: www.zntr.net
/* Lisans: The MIT License
/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
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
	/******************************************************************************************
	* DATAS                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Çalıştırılmak istenen yapının ihtiyaç duyduğu verileri döndürür.		  |
	|          																				  |
	******************************************************************************************/
	public static function datas()
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
					$isF    = CONTROLLERS_DIR.suffix($ifTrim , '.php');

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
			
			// Bir Controller/ dosyası index kelimesi ile isimlendirilemez!
			if( strtolower($page) === 'index' )
			{
				// Hatayı ekrana yazdır.
				echo Error::message('Error', 'controllerNameError', $page);
				
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
			'isFile'	 => $isFile,
			'function'	 => $function

		);
	}
	
	/******************************************************************************************
	* RUN                                                                                     *
	*******************************************************************************************
	| Genel Kullanım: Temel yapıyı çalıştırmak için oluşturulmuştur.						  |
	|          																				  |
	******************************************************************************************/
	public static function run()
	{
		$datas = self::datas();
		
		$parameters = $datas['parameters'];
		$page       = $datas['page'];
		$isFile     = $datas['isFile'];
		$function   = $datas['function'];
		
		/******************************************************************************************
		* CURRENT_CFILE: Aktif çalıştırılan kontrolcü dosyasının yol bilgisi                      *
		******************************************************************************************/	
		define('CURRENT_CFILE', $isFile);
		
		/******************************************************************************************
		* CURRENT_CFUNCTION: Aktif çalıştırılan sayfaya ait fonksiyon bilgisi                     *
		******************************************************************************************/
		define('CURRENT_CFUNCTION', $function);
		
		/******************************************************************************************
		* CURRENT_CPAGE: Aktif çalıştırılan sayfaya ait kontrolcü dosyasının ad bilgisini         *
		******************************************************************************************/
		define('CURRENT_CPAGE', $page.".php");
		
		/******************************************************************************************
		* CURRENT_CONTROLLER: Aktif çalıştırılan sayfaya ait kontrolcü bilgisi	                  *
		******************************************************************************************/
		define('CURRENT_CONTROLLER', $page);
		
		/******************************************************************************************
		* CURRENT_CPATH: Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon yolu	bilgisi       *
		******************************************************************************************/
		define('CURRENT_CFPATH', str_replace(CONTROLLERS_DIR, '', CURRENT_CONTROLLER).'/'.CURRENT_CFUNCTION);
		
		/******************************************************************************************
		* CURRENT_CFURI: Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon yolu	bilgisi       *
		******************************************************************************************/
		define('CURRENT_CFURI', CURRENT_CFPATH);
		
		/******************************************************************************************
		* CURRENT_CPATH: Aktif çalıştırılan sayfaya ait kontrolcü ve fonksiyon URL yol bilgisi   *
		******************************************************************************************/
		define('CURRENT_CFURL', siteUrl(CURRENT_CFPATH));
		
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
			if( Config::get('Repair', 'mode') === true ) 
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
			if( class_exists($page, false) )
			{
				$var = new $page;
					
				// -------------------------------------------------------------------------------
				// Sınıf ve yöntem bilgileri geçerli ise sayfayı çalıştır.
				// -------------------------------------------------------------------------------	
				if( is_callable(array($var, $function)) )
				{
					if( APP_TYPE === 'local' )
					{
						set_error_handler('Exceptions::table');	
					}
					
					call_user_func_array( array($var, $function), $parameters);
					
					if( APP_TYPE === 'local' )
					{
						restore_error_handler();
					}
				}
				else
				{
					// Sayfa bilgisine erişilemezse hata bildir.
					if( ! Config::get('Route', 'show404') )
					{				
						// Hatayı ekrana yazdır.
						echo Error::message('Error', 'callUserFuncArrayError', $function);
						
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
				echo Error::message('Error', 'notIsFileError', $isFile);
				
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