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
| Dahil(Import) Edilirken : Cookie     							                          |
| Sınıfı Kullanırken      :	cookie::													      |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
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
	public static function insert($name = '', $value = '', $time = '', $path = '', $domain = '', $secure = false, $httponly = true) // varsayılan süre 1 hafta
	{	
		/************************************************************************************************/
		// Parametrelerin geçerlilik kontrolü yapılıyor.
		/************************************************************************************************/
		if( ! is_value($name) ) 
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
		if( ! is_bool($httponly))
		{
			$httponly = false;
		}
		if( empty($name) )
		{			
			self::$error = get_message('Cookie', 'cook_name_parameter_empty_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		if( empty($value) )
		{
			self::$error = get_message('Cookie', 'cook_value_parameter_empty_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		/************************************************************************************************/
		
		$cookie_config = config::get("Cookie");
		
		/************************************************************************************************/
		// Parametreler değer almamışsa gereken değerleri config dosyasından alınması sağlanıyor.
		/************************************************************************************************/
		if( empty($time) ) 
		{
			$time = $cookie_config["time"];
		}
		if( empty($path) )
		{
			$path = $cookie_config["path"];
		}
		if( empty($domain) ) 
		{
			$domain = $cookie_config["domain"];
		}
		if( empty($secure) ) 
		{
			$secure = $cookie_config["secure"];
		}
		if(empty($httponly))
		{
			$httponly = $cookie_config["httponly"];
		}
		// Veri güvenliği için çerezlerin anahtar değerleri şifrelenmektedir.
		// Bu ayarın değiştirilmesini isterseniz. Config/Cookie.php dosyasına bakınız.
		if(is_hash($cookie_config["encode"]))
		{
			$name = hash($cookie_config["encode"], $name);
		}
		/************************************************************************************************/
		
		// Çerez dosyası oluşturuluyor ve session id yeniden biçimlendiriyor.
		// Çerez oluşturulması sırasında hata olursa hata loglanıyor.
		if( setcookie($name, $value, time() + $time, $path, $domain, $secure, $httponly) )
		{
			if($cookie_config['regenerate'] === true)
			{
				session_regenerate_id();
			}
			return true;
		}
		else
		{
			self::$error = get_message('Cookie', 'cook_set_error');
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
		if( ! is_value($name) ) 
		{
			return false;
		}
		
		import::language('Cookie');
		
		if( empty($name) )
		{
			self::$error = get_message('Cookie', 'cook_name_parameter_empty_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		
		$cookie_config = config::get("Cookie");
		
		// Veri güvenliği için çerezlerin anahtar değerleri şifrelenmektedir.
		// Bu ayarın değiştirilmesini isterseniz. Config/Cookie.php dosyasına bakınız.
		if( is_hash($cookie_config["encode"]) )
		{
			$name = hash($cookie_config["encode"], $name);
		}

	    if( isset($_COOKIE[$name]) )
		{ 
			return $_COOKIE[$name]; 
		}
		else 
		{
			self::$error = get_message('Cookie', 'cook_not_select_error');
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
		if( ! is_value($name)) 
		{
			return false;
		}
		if( ! is_string($path))
		{
			$path = '';
		}
		
		import::language('Cookie');

		if( empty($name) )
		{
			self::$error = get_message('Cookie', 'cook_name_parameter_empty_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		
		$cookie_config = config::get("Cookie");
		
		if( empty($path) )
		{
			$path =  $cookie_config["path"];	
		}
		// Veri güvenliği için çerezlerin anahtar değerleri şifrelenmektedir.
		// Bu ayarın değiştirilmesini isterseniz. Config/Cookie.php dosyasına bakınız.
		if( is_hash($cookie_config["encode"]) )
		{
			$name = hash($cookie_config["encode"], $name);
		}
		
		if( isset($_COOKIE[$name]) ) 
		{
			setcookie($name,"",(time() - 1), $path); 
		}
		else
		{ 
			self::$error = get_message('Cookie', 'cook_not_delete_error');
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
	| Örnek Kullanım: select_all();       										              |
	|          																				  |
	******************************************************************************************/
	public static function select_all()
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
	| Örnek Kullanım: delete_all();       										              |
	|          																				  |
	******************************************************************************************/
	public static function delete_all()
	{	
		$path = config::get('Cookie', 'path');
		
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