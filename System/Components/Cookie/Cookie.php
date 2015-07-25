<?php
class __USE_STATIC_ACCESS__CCookie
{
	/***********************************************************************************/
	/* COOKIE COMPONENT		     		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CCokkie
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->ccookie, zn::$use->ccookie, uselib('ccookie')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	/* Name Değişkeni
	 *  
	 * Çerez adı bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $name;
	
	/* Value Değişkeni
	 *  
	 * Çerez değeri bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $value;
	
	/* Time Değişkeni
	 *  
	 * Çerez süre bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $time;
	
	/* Path Değişkeni
	 *  
	 * Çerez dizin bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $path;
	
	/* Doman Değişkeni
	 *  
	 * Çerez domain bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $domain;
	
	/* Secure Değişkeni
	 *  
	 * Çerez https durum bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $secure;
	
	/* Regenerate Değişkeni
	 *  
	 * Çerez id bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $regenerate = true;
	
	/* Encode Değişkeni
	 *  
	 * Çerez şifreleme bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $encode = array();
	
	/* Http Only Değişkeni
	 *  
	 * Çerez kullanım yeri bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $httpOnly;
	
	/* Error Değişkeni
	 *  
	 * Çerez işlemlerinde hata bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $error;
	
	/******************************************************************************************
	* NAME                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak çerezin adını belirtmek için kullanılır.                  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Çerez adı.					          							  |
	|          																				  |
	| Örnek Kullanım: ->name('yeni_cerez')										              |
	|          																				  |
	******************************************************************************************/
	public function name($name = '')
	{
		if( ! isChar($name) )
		{
			Error::set(lang('Error', 'valueParameter', 'name'));
			return $this;
		}
		
		$this->name = $name;
		
		return $this;
	}
	
	/******************************************************************************************
	* TIME                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak çerezin süresini belirtmek için kullanılır.               |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @time => Çerezin ne kadar süre ile kalacağı.					          |
	|          																				  |
	| Örnek Kullanım: ->time(3600) // 1 saat. 										          |
	|          																				  |
	******************************************************************************************/
	public function time($time = '')
	{
		if( ! is_numeric($time))
		{
			Error::set(lang('Error', 'numericParameter', 'time'));
			return $this;	
		}
		
		$this->time = $time;
		
		return $this;
	}
	
	/******************************************************************************************
	* ENCODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Çerez anahtarını veya tuttuğu değer şifrelemek için kullanılır.         |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. string var @name => Çerezin adını şifrelemek için geçerli olan şifreleme             |
	| algoritmalarından biri girilir. Örnek: md5									          |
	| 2. string var @value => Çerezin değerini şifrelemek için geçerli olan şifreleme         |
	| algoritmalarından biri girilir. Örnek: md5									          |
	|          																				  |
	| Örnek Kullanım: ->encode('md5', 'sha1') 			 									  |
	|          																				  |
	******************************************************************************************/
	public function encode($name = '', $value = '')
	{
		if( ! ( isHash($name) || isHash($value) ) )
		{
			Error::set(lang('Error', 'hashParameter', 'name | value'));
			
			return $this;	
		}
		
		$this->encode['name'] = $name;
		$this->encode['value'] = $value;
		
		return $this;
	}
	
	/******************************************************************************************
	* DECODE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Şifrelenen çerez anahtarını decode etmek için kullanılır. Ancak değer   |
	| decode edilemez. Aslında tam anlamıyla anahtarında decode edildiğinden bahsedilemez.	  |
	| bu nedenle sadece anahtar için decode kullanımı mevcuttur. 					          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @hash => Çerezin anahtarı hangi şifreleme algorimatsı ile şifrelenmişse	  |
	| o algoritma kullanılarak çerezin değerine ulaşılabilir.				                  |
	|          																				  |
	| Örnek Kullanım: ->decode('md5') 			 									  		  |
	|          																				  |
	******************************************************************************************/
	public function decode($hash = '')
	{
		if( ! isHash($hash))
		{
			Error::set(lang('Error', 'hashParameter', 'hash'));
			return $this;	
		}
		
		$this->encode['name'] = $name;
		
		return $this;
	}
	
	/******************************************************************************************
	* VALUE                                                                                   *
	*******************************************************************************************
	| Genel Kullanım: Oluşturulacak çerezin değerini belirtmek için kullanılır.               |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. mixed var @value => Çerez tutacağı veri.					          				  |
	|          																				  |
	| Örnek Kullanım: ->value('Çerezin Değeri')										          |
	|          																				  |
	******************************************************************************************/
	public function value($value = '')
	{
		$this->value = $value;
		
		return $this;
	}
	
	/******************************************************************************************
	* REGENERATE                                                                              *
	*******************************************************************************************
	| Genel Kullanım: PHPSESSID değerinin yeninden oluşturuması için kullanılır. True olarak  |
	| ayarlanması durumunda çerezin her çalıştırıldığında farklı bir id alması güvenliği 	  |
	| artırmış olacaktır.		     												          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @regenerate => True veya false değeri alır. Varsayılan:true              |
	|          																				  |
	| Örnek Kullanım: ->regenerate(false)										              |
	|          																				  |
	******************************************************************************************/
	public function regenerate($regenerate = true)
	{
		if( ! is_bool($regenerate))
		{
			Error::set(lang('Error', 'booleanParameter', 'regenerate'));
			return $this;		
		}
		
		$this->regenerate = $regenerate;
		
		return $this;
	}
	
	/******************************************************************************************
	* PATH                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Çerezlerin oluşturulacağı dizini belirlemek için kullanılır.	          |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @path => Dizinin var olacağı dizin yolu. Varsayılan:/                     |
	|          																				  |
	| Örnek Kullanım: ->path('cerezler/')										              |
	|          																				  |
	******************************************************************************************/
	public function path($path = '')
	{
		if( ! is_string($path))
		{
			Error::set(lang('Error', 'stringParameter', 'path'));
			return $this;	
		}
		
		$this->path = $path;
		
		return $this;
	}
	
	/******************************************************************************************
	* PATH                                                                                    *
	*******************************************************************************************
	| Genel Kullanım: Çerezlerin kullanılabilir olacağı domaini belirtmek için kullanılır.    |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @domain => Domain ismi.                   								  |
	|          																				  |
	| Örnek Kullanım: ->domain('http://www.zntr.net')										  |
	|          																				  |
	******************************************************************************************/
	public function domain($domain = '')
	{
		if( ! is_string($domain))
		{
			Error::set(lang('Error', 'stringParameter', 'domain'));
			return $this;	
		}
		
		$this->domain = $domain;
		
		return $this;
	}
	
	/******************************************************************************************
	* SECURE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Çerezler için https bağlantısının kullanılıp kullanılmayacağıdır.       |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @secure => True olarak ayarlanması durumunda sadece https bağlantısı	  |
	| için geçerli olacaktır. Varsayılan:false                  							  |
	|          																				  |
	| Örnek Kullanım: ->secure(true)										 				  |
	|          																				  |
	******************************************************************************************/
	public function secure($secure = false)
	{
		if( ! is_bool($secure))
		{
			Error::set(lang('Error', 'booleanParameter', 'secure'));
			return $this;	
		}
		
		$this->secure = $secure;
		
		return $this;
	}
	
	/******************************************************************************************
	* HTTP ONLY                                                                               *
	*******************************************************************************************
	| Genel Kullanım: TRUE olduğu takdirde çerez sadece HTTP protokolü üzerinden erişilebilir |
    | olacaktır.       																		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. boolean var @httponly => True olarak ayarlanması durumunda sadece http protokülü	  |
	| için geçerli olacaktır. Varsayılan:true                    							  |
	|          																				  |
	| Örnek Kullanım: ->httpOnly(true)										 				  |
	|          																				  |
	******************************************************************************************/
	public function httpOnly($httpOnly = true)
	{
		if( ! is_bool($httpOnly))
		{
			Error::set(lang('Error', 'booleanParameter', 'httpOnly'));
			return $this;	
		}
		
		$this->httpOnly = $httpOnly;
		
		return $this;
	}
	
	/******************************************************************************************
	* CREATE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Çerezi oluşturmak için zincirin son halkası olarak kullanılır. 		  |
	| 2 tane isteğe bağlı parametresi vardır.       										  |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                                     |
	| 1. [ string var @name ] => Çerezin ismi, name() yöntemine alternatifdir.		    	  |
	| 2. [ mixed var @value ] => Çerezin değeri, value() yöntemine alternatifdir.		      |
	|          																				  |
	| Örnek Kullanım: ->create('cerez', 'İçerik');									 		  |
	|          																				  |
	******************************************************************************************/
	public function create($name = '', $value = '')
	{
		if( ! empty($name) ) 
		{
			if( ! isChar($name) )
			{
				return Error::set(lang('Error', 'valueParameter', 'name'));
			}
			
			$this->name($name);
		}
		
		if( ! empty($value) )
		{
			$this->value($value);	
		}
		
		if( ! empty($this->encode) )
		{
			if(isset($this->encode['name']) )
			{
				if(isHash($this->encode['name']) )
				{
					$this->name = hash($this->encode['name'], $this->name);		
				}		
			}
			
			if( isset($this->encode['value']) )
			{
				if( isHash($this->encode['value']) )
				{
					$this->value = hash($this->encode['value'], $this->value);	
				}
			}
		}
		
		$cookieConfig = Config::get("Cookie");
		
		if( empty($this->time) ) 		$this->time 	= $cookieConfig['time'];
		if( empty($this->path) ) 		$this->path 	= $cookieConfig['path'];
		if( empty($this->domain) ) 		$this->domain 	= $cookieConfig['domain'];
		if( empty($this->secure) ) 		$this->secure 	= $cookieConfig['secure'];
		if( empty($this->httpOnly) ) 	$this->httpOnly = $cookieConfig['httpOnly'];
		
		if( ! isset($this->encode['name']) )
		{
			if( $cookieConfig["encode"] === true )
			{
				$this->name = md5($this->name);
			}
		}
		
		if( setcookie($this->name, $this->value, time() + $this->time, $this->path, $this->domain, $this->secure, $this->httpOnly) )
		{
			if( $this->regenerate === true )
			{
				session_regenerate_id();	
			}
			
			$this->_defaultVariable();
			
			return true;	
		}
		else
		{
			$this->error = getMessage('Cookie', 'setError');
			return Error::set($this->error);
		}
	} 
	
	/******************************************************************************************
	* SELECT                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Daha önce oluşturulmuş çerezlere erişmek için kullanılır.        		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Çerezin ismi.		    	  									  |
	|          																				  |
	| Örnek Kullanım: ->select('cerez'); // cerez adlı çerezi seçer.		 		  		  |
	| Örnek Kullanım: ->select(); // tüm çerezleri seçer.		 		  		  		 	  |
	|          																				  |
	******************************************************************************************/
	public function select($name = '')
	{
		if( ! isValue($name) )
		{
			return Error::set(lang('Error', 'valueParameter', 'name'));	
		}
		
		if( empty($name) ) 
		{
			$name = $this->name;
			$this->name = NULL;	
		}
		
		if( empty($name) ) 
		{
			return $_COOKIE;
		}
		
		if( isset($this->encode['name']) )
		{
			if(isHash($this->encode['name']))
			{
				$name = hash($this->encode['name'], $name);		
				$this->encode = array();	
			}		
		}
		else
		{
			if( Config::get("Cookie", "encode") === true )
			{
				$name = md5($name);
			}
		}
		
		if( ! empty($this->decode) )
		{
			$this->decode = NULL;	
		}
		
		if( isset($_COOKIE[$name]) )
		{
			return $_COOKIE[$name];
		}
		else
		{
			return false;	
		}
	}
	
	/******************************************************************************************
	* DELETE                                                                                  *
	*******************************************************************************************
	| Genel Kullanım: Daha önce oluşturulmuş çerezleri silmek için kullanılır.        		  |
	|															                              |
	| Parametreler: Tek parametresi vardır.                                                   |
	| 1. string var @name => Çerezin ismi.		    	  									  |
	|          																				  |
	| Örnek Kullanım: ->delete('cerez'); // cerez adlı çerezi siler.		 		  		  |
	| Örnek Kullanım: ->delete(); // tüm çerezleri siler.		 		  		  		 	  |
	|          																				  |
	******************************************************************************************/
	public function delete($name = '')
	{
		if( ! isValue($name) )
		{
			return Error::set(lang('Error', 'valueParameter', 'name'));	
		}
	
		if( empty($name) ) 
		{
			$name = $this->name;
			$this->name = NULL;	
		}
		
		$cookieConfig = Config::get("Cookie");
		
		if( empty($this->path) )
		{	
			$this->path = $cookieConfig["path"];
		}
		
		if( empty($name) ) 
		{
			if( ! empty($_COOKIE) ) foreach ($_COOKIE as $key => $val)
			{			
				setcookie($key, "", time() - 1, $this->path);
			}
		}	
		
		if( isset($this->encode['name']) )
		{
			if( isHash($this->encode['name']) )
			{
				$name = hash($this->encode['name'], $name);	
				$this->encode = array();	
			}		
		}
		else
		{
			if( $cookieConfig["encode"] === true )
			{
				$name = md5($name);
			}
		}
		
		if( isset($_COOKIE[$name]) )
		{ 	
			setcookie($name, '', (time() - 1), $this->path); 
			$this->path = NULL;
		}
		else
		{ 
			return false;		
		}
	}
	
	public function error()
	{
		if( ! empty($this->error) )
		{
			Error::set($this->error);
			return $this->error;
		}
		else
		{
			return false;	
		}
	}
	
	protected function _defaultVariable()
	{
		if( ! empty($this->name)) 	  $this->name 	  = NULL;
		if( ! empty($this->value)) 	  $this->value 	  = NULL;
		if( ! empty($this->time)) 	  $this->time 	  = NULL;
		if( ! empty($this->path)) 	  $this->path 	  = NULL;
		if( ! empty($this->domain))   $this->domain   = NULL;
		if( ! empty($this->secure))   $this->secure   = NULL;
		if( ! empty($this->encode))   $this->encode   = array();
		if( ! empty($this->httpOnly)) $this->httpOnly = NULL;
		if($this->regenerate !== true)$this->regenerate  = true;
	}
}