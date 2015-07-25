<?php
class __USE_STATIC_ACCESS__CSession
{
	/***********************************************************************************/
	/* SESSION COMPONENT	   	     		                   	                       */
	/***********************************************************************************/
	/* Yazar: Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	/* Site: www.zntr.net
	/* Lisans: The MIT License
	/* Telif Hakkı: Copyright (c) 2012-2015, zntr.net
	/*
	/* Sınıf Adı: CSession
	/* Versiyon: 1.2
	/* Tanımlanma: Dinamik
	/* Dahil Edilme: Gerektirmez
	/* Erişim: $this->csession, zn::$use->csession, uselib('csession')
	/* Not: Büyük-küçük harf duyarlılığı yoktur.
	/***********************************************************************************/
	
	protected $name;
	protected $value;
	protected $regenerate = true;
	protected $encode = array();
	protected $error;
	
	public function __construct()
	{
		Config::iniSet(Config::get('Session','settings'));
		
		if( ! isset($_SESSION) ) 
		{
			session_start();
		}
	}
	
	public function name($name = '')
	{
		if( ! isChar($name))
		{
			Error::set(lang('Error', 'valueParameter', 'name'));
			return $this;		
		}
		
		$this->name = $name;
		
		return $this;
	}
	
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
	
	public function decode($hash = '')
	{
		if( ! isHash($hash))
		{
			Error::set(lang('Error', 'hashParameter', 'hash'));
			return $this;	
		}
		
		$this->encode['name'] = $hash;
		
		return $this;
	}
	
	public function value($value = '')
	{
		$this->value = $value;
		
		return $this;
	}

	public function regenerate($regenerate = true)
	{
		if( ! is_bool($regenerate) )
		{
			Error::set(lang('Error', 'booleanParameter', 'regenerate'));
			return $this;		
		}
		
		$this->regenerate = $regenerate;
		
		return $this;
	}
	
	public function create($name = '', $value = '')
	{
		if( ! empty($name) ) 
		{
			if( ! isChar($name) )
			{
				Error::set(lang('Error', 'valueParameter', 'name'));
				return false;
			}
			
			$this->name($name);
		}
		
		if( ! empty($value) )
		{
			$this->value($value);	
		}
		
		if( ! empty($this->encode) )
		{
			if(isset($this->encode['name']))
			{
				if(isHash($this->encode['name']))
				{
					$this->name = hash($this->encode['name'], $this->name);		
				}		
			}
			
			if(isset($this->encode['value']))
			{
				if(isHash($this->encode['value']))
				{
					$this->value = hash($this->encode['value'], $this->value);	
				}
			}
		}
		
		$sessionConfig = Config::get("Session");
	
		if( ! isset($this->encode['name']))
		{
			if($sessionConfig["encode"] === true)
			{
				$this->name = md5($this->name);
			}
		}
		
		$_SESSION[$this->name] = $this->value;
		
		if($_SESSION[$this->name])
		{
			if($this->regenerate === true)
			{
				session_regenerate_id();	
			}
			
			$this->_defaultVariable();
			
			return true;	
		}
		else
		{
			return false;
		}
	} 
	
	public function select($name = '')
	{
		if( ! isValue($name))
		{
			Error::set(lang('Error', 'valueParameter', 'name'));
			return false;	
		}
		
		if(empty($name)) 
		{
			$name = $this->name;
			$this->name = NULL;	
		}
		
		if( empty($name) ) 
		{
			return $_SESSION;
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
			if( Config::get("Session", "encode") === true )
			{
				$name = md5($name);
			}
		}
		
		if( isset($_SESSION[$name]) )
		{
			return $_SESSION[$name];
		}
		else
		{
			return false;	
		}
	}
	
	public function delete($name = '')
	{
		if( ! isValue($name) )
		{
			Error::set(lang('Error', 'valueParameter', 'name'));
			return false;	
		}
	
		if( empty($name) ) 
		{
			$name = $this->name;
			$this->name = NULL;	
		}
	
		if( empty($name) ) 
		{
			if( isset($_SESSION) )
			{
				session_destroy();
			}
		}	
		
		$sessionConfig = Config::get("Session");
		
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
			if( $sessionConfig["encode"] === true )
			{
				$name = md5($name);
			}
		}
		
		if( isset($_SESSION[$name]) )
		{ 	
			unset($_SESSION[$name]);
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
		if( ! empty($this->name)) 	  $this->name 	  	= NULL;
		if( ! empty($this->value)) 	  $this->value 	  	= NULL;
		if( ! empty($this->encode))   $this->encode   	= array();
		if($this->regenerate !== true)$this->regenerate  = true;
	}
}