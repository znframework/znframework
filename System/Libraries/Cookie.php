<?php 
/************************************************************/
/*                     CLASS  COOKIE                   	    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* COOKIE                                                                               	  *
*******************************************************************************************
| Sınıfı Kullanırken      :	Cookie:: , $this->cookie , uselib('cookie') , zn::$use->cookie|
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Namespace.php bakınız.     |
******************************************************************************************/	
class Cookie
{
	/* Error Değişkeni
	 *  
	 * Sepet işlemlerinde oluşan hata bilgilerini
	 * tutması için oluşturulmuştur.
	 *
	 */
	private static $error;
	
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
	public static function insert($name = '', $value = '', $time = '', $path = '', $domain = '', $secure = false, $httpOnly = true) // varsayılan süre 1 hafta
	{	
		/************************************************************************************************/
		// Parametrelerin geçerlilik kontrolü yapılıyor.
		/************************************************************************************************/
		if( ! isValue($name) ) 
		{
			return false;
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
			self::$error = getMessage('Cookie', 'nameParameterEmptyError');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		if( empty($value) )
		{
			self::$error = getMessage('Cookie', 'valueParameterEmptyError');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		/************************************************************************************************/
		
		$cookieConfig = Config::get("Cookie");
		
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
		if(empty($httpOnly))
		{
			$httpOnly = $cookieConfig['httpOnly'];
		}
		// Veri güvenliği için çerezlerin anahtar değerleri şifrelenmektedir.
		// Bu ayarın değiştirilmesini isterseniz. Config/Cookie.php dosyasına bakınız.
		if(isHash($cookieConfig["encode"]))
		{
			$name = hash($cookieConfig["encode"], $name);
		}
		/************************************************************************************************/
		
		// Çerez dosyası oluşturuluyor ve session id yeniden biçimlendiriyor.
		// Çerez oluşturulması sırasında hata olursa hata loglanıyor.
		if( setcookie($name, $value, time() + $time, $path, $domain, $secure, $httpOnly) )
		{
			if($cookieConfig['regenerate'] === true)
			{
				session_regenerate_id();
			}
			return true;
		}
		else
		{
			self::$error = getMessage('Cookie', 'setError');
			report('Error',self::$error,'CookieLibrary');
			return false;
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
	public static function select($name = '')
	{
		if( ! isValue($name) ) 
		{
			return false;
		}

		if( empty($name) )
		{
			self::$error = getMessage('Cookie', 'nameParameterEmptyError');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		
		$cookieConfig = Config::get("Cookie");
		
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
			self::$error = getMessage('Cookie', 'notSelectError');
			report('Error',self::$error,'CookieLibrary');
			return false;	
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
	public static function delete($name = '', $path = '')
	{
		if( ! isValue($name)) 
		{
			return false;
		}
		if( ! is_string($path))
		{
			$path = '';
		}
		
		if( empty($name) )
		{
			self::$error = getMessage('Cookie', 'nameParameterEmptyError');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		
		$cookieConfig = Config::get("Cookie");
		
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
			self::$error = getMessage('Cookie', 'notDeleteError');
			report('Error',self::$error,'CookieLibrary');
			return false;		
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
	public static function selectAll()
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
	public static function deleteAll()
	{	
		$path = Config::get('Cookie', 'path');
		
		if( ! empty($_COOKIE) ) foreach ($_COOKIE as $key => $val)
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
	public static function error()
	{
		if(self::$error)
		{
			return self::$error;
		}
		else
		{
			return false;	
		}
	}
	
}

/* ---------------------------------------CLASS COOKIE SON---------------------------------------------*/