<?php
namespace ZN\Services;

class InternalCookie implements SessionInterface, CookieInterface
{
	/***********************************************************************************/
	/* COOKIE COMPONENT		     		                   	                           */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	/*
	/* Sınıf Adı: CCokkie
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->ccookie, zn::$use->ccookie, uselib('ccookie')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	//----------------------------------------------------------------------------------------------------
	// Const CONFIG_NAME
	//----------------------------------------------------------------------------------------------------
	// 
	// @const string
	//
	//----------------------------------------------------------------------------------------------------
	const CONFIG_NAME  = 'Services:cookie';
	
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
	
	/* Http Only Değişkeni
	 *  
	 * Çerez kullanım yeri bilgisini tutması
	 * için oluşturulumuştur.
	 */
	protected $httpOnly;
	
	//----------------------------------------------------------------------------------------------------
	// Construct
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  void
	// @return bool
	//
	//----------------------------------------------------------------------------------------------------
	public function __construct()
	{
		\Session::start();
		
		$this->config();
	}
	
	//----------------------------------------------------------------------------------------------------
	// Session Cookie Common
	//----------------------------------------------------------------------------------------------------
	// 
	// ErrorControlTrait
	// CallUndefinedMethodTrait
	//
	// $config
	// $name
	// $value
	// $regenerate
	// $encode
	//
	// name()
	// encode()
	// decode()
	// regenerate()
	// value()
	// defaultVariable()
	//
	//----------------------------------------------------------------------------------------------------
	use SessionTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Cookie Setting Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
			\Errors::set('Error', 'numericParameter', 'time');
			return $this;	
		}
		
		$this->time = $time;
		
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
			\Errors::set('Error', 'stringParameter', 'path');
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
			\Errors::set('Error', 'stringParameter', 'domain');
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
			\Errors::set('Error', 'booleanParameter', 'secure');
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
			\Errors::set('Error', 'booleanParameter', 'httpOnly');
			return $this;	
		}
		
		$this->httpOnly = $httpOnly;
		
		return $this;
	}
	
	//----------------------------------------------------------------------------------------------------
	// Cookie Setting Methods Bitiş
	//----------------------------------------------------------------------------------------------------

	//----------------------------------------------------------------------------------------------------
	// Insert Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* INSERT                                                                                  *
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
	public function insert($name = '', $value = '', $time = '', $path = '', $domain = '', $secure = '', $httpOnly = '')
	{
		if( ! empty($name) ) 
		{
			if( ! isChar($name) )
			{
				return \Errors::set('Error', 'valueParameter', 'name');
			}
			
			$this->name($name);
		}
		
		if( ! empty($value) ) 	 $this->value($value);	
		if( ! empty($time) )  	 $this->time($time);			
		if( ! empty($path) )  	 $this->path($path);	
		if( ! empty($domain) ) 	 $this->domain($domain);		
		if( ! empty($secure) ) 	 $this->secure($domain);	
		if( ! empty($httpOnly) ) $this->httpOnly($httpOnly);	
		
		if( ! empty($this->encode) )
		{
			if( isset($this->encode['name']) )
			{
				if( isHash($this->encode['name']) )
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
		
		$cookieConfig = $this->config;
		
		if( empty($this->time) ) 		$this->time 	= $cookieConfig['time'];
		if( empty($this->path) ) 		$this->path 	= $cookieConfig['path'];
		if( empty($this->domain) ) 		$this->domain 	= $cookieConfig['domain'];
		if( empty($this->secure) ) 		$this->secure 	= $cookieConfig['secure'];
		if( empty($this->httpOnly) ) 	$this->httpOnly = $cookieConfig['httpOnly'];
		
		if( ! isset($this->encode['name']) )
		{
			$encode = $cookieConfig["encode"];
			
			if( $encode === true )
			{
				$this->name = md5($this->name);
			}
			elseif( is_string($encode) )
			{
				if( isHash($encode) )
				{
					$this->name = hash($encode, $this->name);		
				}	
			}
		}
		
		if( setcookie($this->name, $this->value, time() + $this->time, $this->path, $this->domain, $this->secure, $this->httpOnly) )
		{
			if( $this->regenerate === true )
			{
				session_regenerate_id();	
			}
			
			$this->defaultVariable();
			$this->cookieDefaultVariable();
			
			return true;	
		}
		else
		{
			return \Errors::set('Cookie', 'setError');
		}
	} 
	
	//----------------------------------------------------------------------------------------------------
	// Insert Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Select Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
		if( ! is_scalar($name) )
		{
			return \Errors::set('Error', 'valueParameter', 'name');	
		}
		
		if( empty($name) ) 
		{
			return false;
		}
		
		if( isset($this->encode['name']) )
		{
			if(isHash($this->encode['name']))
			{
				$name = hash($this->encode['name'], $name);		
				$this->encode = [];	
			}		
		}
		else
		{
			$encode = $this->config['encode'];
			
			if( $encode === true )
			{
				$name = md5($name);
			}
			elseif( is_string($encode) )
			{
				if( isHash($encode) )
				{
					$name = hash($encode, $name);		
				}	
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
	
	//----------------------------------------------------------------------------------------------------
	// Select Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Delete Methods Başlangıç
	//----------------------------------------------------------------------------------------------------

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
	public function delete($name = '', $path = '')
	{
		if( ! is_scalar($name) || empty($name) )
		{
			return \Errors::set('Error', 'valueParameter', 'name');	
		}
	
		$cookieConfig = $this->config;
		
		if( ! empty($path) )
		{
			$this->path = $path;
		}
		
		if( empty($this->path) )
		{	
			$this->path = $cookieConfig["path"];
		}
		
		if( isset($this->encode['name']) )
		{
			if( isHash($this->encode['name']) )
			{
				$name = hash($this->encode['name'], $name);	
				$this->encode = [];	
			}		
		}
		else
		{
			$encode = $cookieConfig["encode"];
			
			if( $encode === true )
			{
				$name = md5($name);
			}
			elseif( is_string($encode) )
			{
				if( isHash($encode) )
				{
					$name = hash($encode, $name);		
				}	
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
	
	//----------------------------------------------------------------------------------------------------
	// Delete Methods Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Protected Methods
	//----------------------------------------------------------------------------------------------------
	// 
	// cookieDefaultVariable()
	//
	//----------------------------------------------------------------------------------------------------
	protected function cookieDefaultVariable()
	{
		$this->time 	  = NULL;
		$this->path 	  = NULL;
		$this->domain     = NULL;
		$this->secure     = NULL;
		$this->httpOnly   = NULL;
	}
}