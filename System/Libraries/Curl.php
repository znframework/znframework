<?php 
/************************************************************/
/*                     CLASS  CURL                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* CURL                                                                                	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	curl::													      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/
class Curl
{
	/* Inıt Değişkeni
	 *  
	 * Curl Inıt oturum bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $init;
	
	/* Setting Değişkeni
	 *  
	 * Ayar yapılandırmalarını
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $setting;

	/******************************************************************************************
	* OPEN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Curl oturumunu başlatmak için kullanılır.								  |
	|															                              |
	| Parametreler: 7 parametresi vardır.                                                     |
	| 1. string var @url => Oturumun bağlantı kurucağı url bilgisi. İsteğe bağlıdır.		  |
	|          																				  |
	| Örnek Kullanım: open('http://www.example.xxx/');       							      |
	| Not: Bu parametrenin kullanımı isteğe bağlıdır.  										  |
	|          																				  |
	******************************************************************************************/
	public static function open($url = NULL)
	{
		self::$init = curl_init($url);
	}
	
	/******************************************************************************************
	* SETTINGS                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Curl oturumun ayarlarını yapılandırmak için kullanılır.				  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string/array var @settings => Oturum bağlantı ayarları yapılandırılır. Bu parametre  |
	| 2 farklı türde veri içerir tek bir ayar kullanılacaksa string, birden falza ayar        |
	| kullanılacaksa veriler dizi olarak gönderilir. Veriler dizi olarak gönderildiğinde      |
	| 2. parametrenin kullanımı gerekmez.       											  |
	| 2. string var @value => ayarın içereği değer. Bu parametre ancak 1. parametrenin string |
	| olması durumun kullanılır.          													  |
	|          																				  |
	| 1. Parametre için 2 tür kullanım mümkündür.         									  |
	|          																				  |
	| Örnek Kullanım: settings('url', 'http://www.example.xxx/');       				      |
	| Örnek Kullanım: settings(array('url' => 'http://www.example.xxx/', ...));   			  |
	|          																				  |
	******************************************************************************************/
	public static function settings($settings = '', $value = '')
	{	
		//Ayar boş veya oturum başlatılmamışsa false değeri döndürme işlemi yapılıyor.
		if( empty($settings) || ! isset(self::$init) ) 
		{
			return false;
		}
		
		$options = config::get('Curl','options');
		
		// settings parametresinin dizi olma veya string olma durumuna göre işleniyor.
		if( is_array($settings) )
		{
			// settings parametresinin dizi olması durumunda
			// çoklu setopt ayarı yapılmaktadır.
			foreach($settings as $key => $val)
			{	
				// İster standart CURLOPT ayar parametreleri
				// istersenizde Config/Curl.php dosyasında
				// belirlenen ayar parametrelerini kullanabilirsiniz. 
				if( ! is_int($key) )
				{
					$opt = $options[$key];
				}
				else
				{
					$opt = $key;
				}
				curl_setopt(self::$init,$opt,$val);			
			}
		}
		else
		{
			if( ! (is_string($value) || is_numeric($value)) )
			{
				$value = '';
			}
			
			// İster standart CURLOPT ayar parametreleri
			// istersenizde Config/Curl.php dosyasında
			// belirlenen ayar parametrelerini kullanabilirsiniz. 
			if( ! is_int($settings) )
			{
				if(isset($options[$settings]))
				{
					$opt = $options[$settings];
				}
				else
				{ 
					return false;
				}
			}
			else
			{
				$opt = $settings;
			}
			
			curl_setopt(self::$init,$opt,$value);
		}
		
	}
	
	/******************************************************************************************
	* EXECUTE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Belirlenen oturum işlemlerinin çalıştırılmasını sağlar.				  |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	******************************************************************************************/
	public static function execute()
	{
		if( ! isset(self::$init) ) 
		{
			return false;
		}
		
		return curl_exec(self::$init);
	}

	/******************************************************************************************
	* INFO                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Curl işlemleri hakkında bilgi almak için kullanılır.				      | 
	|															                              |
	| Parametreler: 1 parametresi vardır.                                                     |
	| 1. string var @data => Bilgi almak istediğiniz veri. Hangi verileri kullanabilceğiniz	  |
	| liste Config/Curl.php dosyasında yer almaktadır.         								  |
	|          																				  |
	| Örnek Kullanım: info('speed_download');  // CURLINFO_SPEED_DOWNLOAD    				  |
	|          																				  |
	******************************************************************************************/
	public static function info($data = '')
	{
		if( ! isValue($data) )
		{
			$data = '';
		}
		
		// İster standart CURLOPT ayar parametreleri
		// istersenizde Config/Curl.php dosyasında
		// belirlenen ayar parametrelerini kullanabilirsiniz. 
		if( ! is_int($data) )
		{	
			$infos = config::get('Curl','info');
			
			if( isset($infos[$data]) ) 
			{
				$info = $infos[$data]; 
			}
			else 
			{
				$info = 0;
			}
		}
		else
		{
			$info = $data;	
		}
		
		return curl_getinfo(self::$init, $info);	
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Curl işlemleri sırasında oluşan hatalar hakkında bilgi almak içindir.	  | 
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: error();  // 															  |
	|          																				  |
	******************************************************************************************/
	public static function error()
	{
		if( ! isset(self::$init) ) 
		{
			return false;
		}
		
		return curl_error(self::$init);
	}
	
	/******************************************************************************************
	* ERROR NO                                                                                *
	*******************************************************************************************
	| Genel Kullanım: Curl işlemleri sırasında oluşan hatalar hakkında bilgi almak içindir.	  | 
	|														                                  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: errno();  // 															  |
	|          																				  |
	******************************************************************************************/
	public static function errno()
	{
		if( ! isset(self::$init) ) 
		{
			return false;
		}
		
		return curl_errno(self::$init);
	}
	
	/******************************************************************************************
	* ERROR VAL                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Curl işlemleri sırasında oluşan hatalar hakkında bilgi almak içindir.	  | 
	|														                                  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: errno();  // 															  |
	|          																				  |
	******************************************************************************************/
	public static function errval()
	{
		if( ! isset(self::$init) )
		{ 
			return false;
		}
		
		$errors = config::get('Curl','errors');
		$errno  = curl_errno(self::$init);
		
		if( isset($errno) ) 
		{
			if( isset($errors[$errno]) )
			{
				return $errors[$errno]; 
			}
		}
		else 
		{
			return false;
		}
	}

	/******************************************************************************************
	* 	VERSION                                                                               *
	*******************************************************************************************
	| Genel Kullanım: Curl versiyonunu öğrenmek için kullanılır.	 						  | 
	|														                                  |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @info => Versiyon hakkındaki bilgiler içinden istenilen veriye ulaşılır.  |
	|          																				  |
	| Örnek Kullanım: errno();  // 															  |
	|          																				  |
	******************************************************************************************/
	public static function version($info = '')
	{
		if( ! is_string($info)) 
		{
			$info = '';
		}
		
		$version_info = curl_version();
		
		if( ! empty($info) )
		{
			return $version_info[$info];
		}	
		else
		{
			return $version_info;
		}
	}
	
	/******************************************************************************************
	* 	CLOSE                                                                                 *
	*******************************************************************************************
	| Genel Kullanım: Açılan curl oturumunu kapatır.	 						              | 
	|														                                  |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|														                                  |
	******************************************************************************************/
	public static function close()
	{
		if( isset(self::$init) ) 
		{
			curl_close(self::$init);
		}
		else
		{
			return false;
		}
	}
}