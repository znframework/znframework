<?php
/************************************************************/
/*                     COOKIE COMPONENT                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
/******************************************************************************************
* COOOKIE                                                                                 *
*******************************************************************************************
| Dahil(Import) Edilirken : Cookie     							                          |
| Sınıfı Kullanırken      :	$this->cook->       										  |
| 																						  |
| Kütüphanelerin kısa isimlendirmelerle kullanımı için. Config/Libraries.php bakınız.     |
******************************************************************************************/	
class ComponentCook
{
	protected $name;
	protected $value;
	protected $time;
	protected $path;
	protected $domain;
	protected $secure;
	protected $regenerate = true;
	protected $encode = array();
	protected $httponly;
	protected $error;
	
	public function name($name = '')
	{
		if( ! is_char($name))
		{
			return $this;
		}
		
		$this->name = $name;
		
		return $this;
	}
	
	public function time($time = '')
	{
		if( ! is_numeric($time))
		{
			return $this;	
		}
		
		$this->time = $time;
		
		return $this;
	}
	
	public function encode($name = '', $value = '')
	{
		if( ! ( is_hash($name) || is_hash($value) ))
		{
			return $this;	
		}
		
		$this->encode['name'] = $name;
		$this->encode['value'] = $value;
		
		return $this;
	}
	
	public function decode($hash = '')
	{
		if( ! is_hash($hash))
		{
			return $this;	
		}
		
		$this->encode['name'] = $name;
		
		return $this;
	}
	
	public function value($value = '')
	{
		$this->value = $value;
		
		return $this;
	}
	
	public function regenerate($regenerate = true)
	{
		if( ! is_bool($regenerate))
		{
			return $this;		
		}
		
		$this->regenerate = $regenerate;
		
		return $this;
	}
	
	public function path($path = '')
	{
		if( ! is_string($path))
		{
			return $this;	
		}
		
		$this->path = $path;
		
		return $this;
	}
	
	public function domain($domain = '')
	{
		if( ! is_string($domain))
		{
			return $this;	
		}
		
		$this->domain = $domain;
		
		return $this;
	}
	
	public function secure($secure = false)
	{
		if( ! is_bool($secure))
		{
			return $this;	
		}
		
		$this->secure = $secure;
		
		return $this;
	}
	
	public function httponly($httponly = true)
	{
		if( ! is_bool($httponly))
		{
			return $this;	
		}
		
		$this->httponly = $httponly;
		
		return $this;
	}
	
	public function create($name = '', $value = '')
	{
		if( ! empty($name)) 
		{
			if( ! is_char($name))
			{
				return false;
			}
			
			$this->name($name);
		}
		
		if( ! empty($value))
		{
			$this->value($value);	
		}
		
		if( ! empty($this->encode) )
		{
			if(isset($this->encode['name']))
			{
				if(is_hash($this->encode['name']))
				{
					$this->name = hash($this->encode['name'], $this->name);		
				}		
			}
			
			if(isset($this->encode['value']))
			{
				if(is_hash($this->encode['value']))
				{
					$this->value = hash($this->encode['value'], $this->value);	
				}
			}
		}
		
		$cookie_config = config::get("Cookie");
		
		if(empty($this->time)) 		$this->time 	= $cookie_config["time"];
		if(empty($this->path)) 		$this->path 	= $cookie_config["path"];
		if(empty($this->domain)) 	$this->domain 	= $cookie_config["domain"];
		if(empty($this->secure)) 	$this->secure 	= $cookie_config["secure"];
		if(empty($this->httponly)) 	$this->httponly = $cookie_config["httponly"];
		
		if( ! isset($this->encode['name']))
		{
			if($cookie_config["encode"] === true)
			{
				$this->name = md5($this->name);
			}
		}
		
		if(setcookie($this->name, $this->value, time() + $this->time, $this->path, $this->domain, $this->secure, $this->httponly))
		{
			if($this->regenerate === true)
			{
				session_regenerate_id();	
			}
			
			$this->_default_variable();
			
			return true;	
		}
		else
		{
			$this->error = get_message('Cookie', 'cook_set_error');
			report('Error', $this->error, 'CookieComponent');
			return false;
		}
	} 
	
	public function select($name = '')
	{
		if( ! is_value($name))
		{
			return false;	
		}
		
		if(empty($name)) 
		{
			$name = $this->name;
			$this->name = NULL;	
		}
		
		if(empty($name)) 
		{
			return $_COOKIE;
		}
		
		if(isset($this->encode['name']))
		{
			if(is_hash($this->encode['name']))
			{
				$name = hash($this->encode['name'], $name);		
				$this->encode = array();	
			}		
		}
		else
		{
			if(config::get("Cookie", "encode") === true)
			{
				$name = md5($name);
			}
		}
		
		if( ! empty($this->decode))
		{
			$this->decode = NULL;	
		}
		
		if(isset($_COOKIE[$name]))
		{
			return $_COOKIE[$name];
		}
		else
		{
			return false;	
		}
	}
	
	public function delete($name = '')
	{
		if( ! is_value($name))
		{
			return false;	
		}
	
		if(empty($name)) 
		{
			$name = $this->name;
			$this->name = NULL;	
		}
		
		$cookie_config = config::get("Cookie");
		
		if(empty($this->path))
		{	
			$this->path = $cookie_config["path"];
		}
		
		if(empty($name)) 
		{
			if( ! empty($_COOKIE) ) foreach ($_COOKIE as $key => $val)
			{			
				setcookie($key, "", time() - 1, $this->path);
			}
		}	
		
		if(isset($this->encode['name']))
		{
			if(is_hash($this->encode['name']))
			{
				$name = hash($this->encode['name'], $name);	
				$this->encode = array();	
			}		
		}
		else
		{
			if($cookie_config["encode"] === true)
			{
				$name = md5($name);
			}
		}
		
		if(isset($_COOKIE[$name]))
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
		return $this->error;
	}
	
	protected function _default_variable()
	{
		if( ! empty($this->name)) 	  $this->name 	  = NULL;
		if( ! empty($this->value)) 	  $this->value 	  = NULL;
		if( ! empty($this->time)) 	  $this->time 	  = NULL;
		if( ! empty($this->path)) 	  $this->path 	  = NULL;
		if( ! empty($this->domain))   $this->domain   = NULL;
		if( ! empty($this->secure))   $this->secure   = NULL;
		if( ! empty($this->encode))   $this->encode   = array();
		if( ! empty($this->httponly)) $this->httponly = NULL;
		if($this->regenerate !== true)$this->regenerate  = true;
	}
}