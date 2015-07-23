<?php 
class __USE_STATIC_ACCESS__Cookie
{
	/***********************************************************************************/
	/* COOKIE LIBRARY						                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: Cookie
	/* Versiyon: 1.0
	/* Tanımlanma: Statik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: cookie::, $this->cookie, zn::$use->cookie, uselib('cookie')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Error Değişkeni
	 *  
	 * Çerez işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $error;
	
	/* Config Değişkeni
	 *  
	 * Çerez ayar bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	protected $config;
	
	public function __construct()
	{
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
		
		$this->config = Config::get("Cookie");	
	}
	
	/******************************************************************************************
	* INSERT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Çerez oluşturmak için kullanılır.										  |
	|															                              |
	| Parametreler: 7 parametresi vardır.                                                     |
	| 1. string var @name => Oluşturulacak çerezin adı.		    					          |
	| 2. mixed var @value => Oluşturulacak çerezin tutacağı değer.         					  |
	| 3. numeric var @time => Oluşturulacak çerezin var olacağı süre. Varsayılan:604800       |
	| 4. string var @path => Oluşturulacak çerezin kaydedilecği dizin. Varsayılan:/           |
	| 5. string var @domain => Oluşturulacak çerezin geçerli olacağı domain.          		  |
	| 6. boolean var @secure => Çerezin istemciye güvenli bir HTTPS bağlantısı üzerinden mi   |
	| aktarılması gerektiğini belirtmek için kullanılır. Varsayılan:false					  |
	| 7. boolean var @httponly => TRUE olduğu takdirde çerez sadece HTTP protokolü            |
	| üzerinden erişilebilir olacaktır. Varsayılan:true					 					  |
	|          																				  |
	| Örnek Kullanım: insert('isim', 'Değer');       										  |
	| Not: Application/Config/Cookie.php dosyası üzerinden ayarlarını yapılandırabilirsiniz.  |
	|          																				  |
	******************************************************************************************/
	public function insert($name = '', $value = '', $time = '', $path = '', $domain = '', $secure = false, $httpOnly = true) // varsayılan süre 1 hafta
	{	
		/************************************************************************************************/
		// Parametrelerin geçerlilik kontrolü yapılıyor.
		/************************************************************************************************/
		if( ! isValue($name) ) 
		{
			return Error::set('Cookie', 'insert', lang('Error', 'valueParameter', 'name'));
		}
		if( ! is_numeric($time) ) 
		{
			$time = 0;
		}
		if( ! is_string($path) )
		{
			$path = '';
		}
		if( ! is_string($domain) )
		{
			$domain = '';
		}
		if( ! is_bool($secure) ) 
		{
			$secure = false;
		}
		if( ! is_bool($httpOnly))
		{
			$httpOnly = false;
		}
		if( empty($name) )
		{			
			$this->error = lang('Cookie', 'nameParameterEmptyError');
			return Error::set('Cookie', 'insert', $this->error);
		}
		if( empty($value) )
		{
			$this->error = lang('Cookie', 'valueParameterEmptyError');
			return Error::set('Cookie', 'insert', $this->error);
		}
		/************************************************************************************************/
		
		$cookieConfig = $this->config;
		
		/************************************************************************************************/
		// Parametreler değer almamışsa gereken değerleri config dosyasından alınması sağlanıyor.
		/************************************************************************************************/
		if( empty($time) ) 
		{
			$time = $cookieConfig["time"];
		}
		if( empty($path) )
		{
			$path = $cookieConfig["path"];
		}
		if( empty($domain) ) 
		{
			$domain = $cookieConfig["domain"];
		}
		if( empty($secure) ) 
		{
			$secure = $cookieConfig["secure"];
		}
		if( empty($httpOnly) )
		{
			$httpOnly = $cookieConfig['httpOnly'];
		}
		// Veri güvenliği için çerezlerin anahtar değerleri şifrelenmektedir.
		// Bu ayarın değiştirilmesini isterseniz. Config/Cookie.php dosyasına bakınız.
		if( isHash($cookieConfig["encode"]) )
		{
			$name = hash($cookieConfig["encode"], $name);
		}
		/************************************************************************************************/
		
		// Çerez dosyası oluşturuluyor ve session id yeniden biçimlendiriyor.
		// Çerez oluşturulması sırasında hata olursa hata loglanıyor.
		if( setcookie($name, $value, time() + $time, $path, $domain, $secure, $httpOnly) )
		{
			if( $cookieConfig['regenerate'] === true )
			{
				session_regenerate_id();
			}
			
			return true;
		}
		else
		{
			$this->error = getMessage('Cookie', 'setError');
			return Error::set('Cookie', 'insert', $this->error);
		}
		
	}
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulan çerezi seçmek için kullanılır.							  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Seçilecek çerezin ismi.		    					          |
	|          																				  |
	| Örnek Kullanım: select('isim');       										          |
	|          																				  |
	******************************************************************************************/
	public function select($name = '')
	{
		if( ! isValue($name) ) 
		{
			return Error::set('Cookie', 'select', lang('Error', 'valueParameter', 'name'));
		}

		if( empty($name) )
		{
			$this->error = lang('Cookie', 'nameParameterEmptyError');
			return Error::set('Cookie', 'select', $this->error);
		}
		
		$cookieConfig = $this->config;
		
		// Veri güvenliği için çerezlerin anahtar değerleri şifrelenmektedir.
		// Bu ayarın değiştirilmesini isterseniz. Config/Cookie.php dosyasına bakınız.
		if( isHash($cookieConfig["encode"]) )
		{
			$name = hash($cookieConfig["encode"], $name);
		}

	    if( isset($_COOKIE[$name]) )
		{ 
			return $_COOKIE[$name]; 
		}
		else 
		{
			$this->error = lang('Cookie', 'notSelectError');
			return Error::set('Cookie', 'select', $this->error);
		}
	}
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulan çerezi silmek için kullanılır.							  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Silinecek çerezin ismi.		    					          |
    | 2. string var @path => Silinecek çerezin bulunduğu dizin. Varsayılan:/                  |
	|          																				  |
	| Örnek Kullanım: delete('isim');       										          |
	|          																				  |
	******************************************************************************************/
	public function delete($name = '', $path = '')
	{
		if( ! isValue($name) ) 
		{
			return false;
		}
		if( ! is_string($path) )
		{
			$path = '';
		}
		
		if( empty($name) )
		{
			$this->error = lang('Cookie', 'nameParameterEmptyError');
			return Error::set('Cookie', 'delete', $this->error);
		}
		
		$cookieConfig = $this->config;
		
		if( empty($path) )
		{
			$path =  $cookieConfig["path"];	
		}
		// Veri güvenliği için çerezlerin anahtar değerleri şifrelenmektedir.
		// Bu ayarın değiştirilmesini isterseniz. Config/Cookie.php dosyasına bakınız.
		if( isHash($cookieConfig["encode"]) )
		{
			$name = hash($cookieConfig["encode"], $name);
		}
		
		if( isset($_COOKIE[$name]) ) 
		{
			setcookie($name,"",(time() - 1), $path); 
		}
		else
		{ 
			$this->error = lang('Cookie', 'notDeleteError');
			return Error::set('Cookie', 'delete', $this->error);	
		}
	}
	
	/******************************************************************************************
	* SELECT ALL                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulmuş tüm çerezlere erişmek için kullanılır.				      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: selectAll();       										              |
	|          																				  |
	******************************************************************************************/
	public function selectAll()
	{
		if( ! empty($_COOKIE) ) 
		{
			return $_COOKIE;
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* DELETE ALL                                                                              *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulmuş tüm çerezleri silmek için kullanılır.				      |
	|															                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|          																				  |
	| Örnek Kullanım: deleteAll();       										              |
	|          																				  |
	******************************************************************************************/
	public function deleteAll()
	{	
		$path = $this->config['path'];
		
		if( ! empty($_COOKIE) ) foreach( $_COOKIE as $key => $val )
		{			
			setcookie($key, '', time() - 1, $path);
		}
		else 
		{
			return false;
		}
	}
	
	/******************************************************************************************
	* ERROR                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Çerez işlemlerinde oluşan hata bilgilerini tutması için oluşturulmuştur.|
	|     														                              |
	| Parametreler: Herhangi bir parametresi yoktur.                                          |
	|     														                              |
	******************************************************************************************/
	public function error()
	{
		if( ! empty($this->error) )
		{
			Error::set('Cookie', 'error', $this->error);
			return $this->error;
		}
		else
		{
			return false;	
		}
	}	
}
/* ---------------------------------------CLASS COOKIE SON---------------------------------------------*/