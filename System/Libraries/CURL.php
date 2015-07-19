<?php 
class __USE_STATIC_ACCESS__CURL
{
	/***********************************************************************************/
	/* CURL LIBRARY   						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Curl
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: curl::, $this->curl, zn::$use->curl, uselib('curl')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Config Değişkeni
	 *  
	 * Curl ayar bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	/* Inıt Değişkeni
	 *  
	 * Curl Inıt oturum bilgisini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $init;
	
	/* Setting Değişkeni
	 *  
	 * Ayar yapılandırmalarını
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $setting;
	
	public function __construct()
	{
		$this->config = Config::get('Curl');	
	}

	/******************************************************************************************
	* OPEN                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Curl oturumunu başlatmak için kullanılır.								  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @url => Oturumun bağlantı kurucağı url bilgisi. İsteğe bağlıdır.		  |
	|          																				  |
	| Örnek Kullanım: open('http://www.example.xxx/');       							      |
	| Not: Bu parametrenin kullanımı isteğe bağlıdır.  										  |
	|          																				  |
	******************************************************************************************/
	public function open($url = NULL)
	{
		$this->init = curl_init($url);
		
		return $this->init;
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
	public function settings($settings = '', $value = '')
	{	
		//Ayar boş veya oturum başlatılmamışsa false değeri döndürme işlemi yapılıyor.
		if( empty($settings) || ! isset($this->init) ) 
		{
			return false;
		}
		
		$options = $this->config['options'];
		
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
				curl_setopt($this->init,$opt,$val);			
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
			
			curl_setopt($this->init,$opt,$value);
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
	public function execute()
	{
		if( ! isset($this->init) ) 
		{
			return false;
		}
		
		return curl_exec($this->init);
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
	public function info($data = '')
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
			$infos = $this->config['infos'];
			
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
		
		return curl_getinfo($this->init, $info);	
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
	public function error()
	{
		if( ! isset($this->init) ) 
		{
			return false;
		}
		
		return curl_error($this->init);
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
	public function errno()
	{
		if( ! isset($this->init) ) 
		{
			return false;
		}
		
		return curl_errno($this->init);
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
	public function errval()
	{
		if( ! isset($this->init) )
		{ 
			return false;
		}
		
		$errors = $this->config['errors'];
		$errno  = curl_errno($this->init);
		
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
	public function version($info = '')
	{
		if( ! is_string($info)) 
		{
			$info = '';
		}
		
		$versionInfo = curl_version();
		
		if( ! empty($info) )
		{
			return $versionInfo[$info];
		}	
		else
		{
			return $versionInfo;
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
	public function close()
	{
		if( isset($this->init) ) 
		{
			return curl_close($this->init);
		}
		else
		{
			return false;
		}
	}
}