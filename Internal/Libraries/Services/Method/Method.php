<?php
namespace ZN\Services;

class InternalMethod implements MethodInterface
{
	//----------------------------------------------------------------------------------------------------
	//
	// Yazar      : Ozan UYKUN <ozanbote@windowslive.com> | <ozanbote@gmail.com>
	// Site       : www.zntr.net
	// Lisans     : The MIT License
	// Telif Hakkı: Copyright (c) 2012-2016, zntr.net
	//
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Call Method
	//----------------------------------------------------------------------------------------------------
	// 
	// __call()
	//
	//----------------------------------------------------------------------------------------------------
	use \CallUndefinedMethodTrait;
	
	//----------------------------------------------------------------------------------------------------
	// Error Control
	//----------------------------------------------------------------------------------------------------
	// 
	// $error
	// $success
	//
	// error()
	// success()
	//
	//----------------------------------------------------------------------------------------------------
	use \ErrorControlTrait;	

	//----------------------------------------------------------------------------------------------------
	// Post
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function post($name = '', $value = '')
	{
		return $this->_method($name, $value, $_POST ,__FUNCTION__);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Get
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function get($name = '', $value = '')
	{
		return $this->_method($name, $value, $_GET, __FUNCTION__);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Request
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function request($name = '', $value = '')
	{
		return $this->_method($name, $value, $_REQUEST, __FUNCTION__);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Env
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function env($name = '', $value = '')
	{
		return $this->_method($name, $value, $_ENV, __FUNCTION__);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Server
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function server($name = '', $value = '')
	{
		// Parametreler kontrol ediliyor. --------------------------------------------
		if( ! is_string($name) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'name');
		}
		// ---------------------------------------------------------------------------
		
		// @value parametresi boş değilse
		if( ! empty($value) )
		{
			$_SERVER[$name] = $value;
		}
		
		return server($name);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Files
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $filename
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	public function files($fileName = '', $type = 'name')
	{
		if( ! is_string($fileName) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'fileName');
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'name';
		}
		
		if( empty($fileName) ) 
		{
			return \Errors::set('Error', 'emptyVariable', '@fileName');
		}
		
		return $_FILES[$fileName][$type];
	}
	
	//----------------------------------------------------------------------------------------------------
	// Delete
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $input
	// @param string $name
	//
	//----------------------------------------------------------------------------------------------------
	public function delete($input = '', $name = '')
	{
		if( ! is_scalar($input) || ! is_scalar($name) ) 
		{
			return \Errors::set('Error', 'scalarParameter', '1.(input) && 2.(name)');
		}
		
		switch( $input )
		{
			case 'post' 	: unset($_POST[$name]);    break;
			case 'get' 		: unset($_GET[$name]); 	   break;
			case 'env' 		: unset($_ENV[$name]); 	   break;
			case 'server' 	: unset($_SERVER[$name]);  break;
			case 'request' 	: unset($_REQUEST[$name]); break;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// Protected Method
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param mixed  $value
	// @param var    $input
	// @param string $type
	//
	//----------------------------------------------------------------------------------------------------
	protected function _method($name = '', $value = '', $input = '', $type = '')
	{
		// Parametreler kontrol ediliyor. --------------------------------------------
		if( ! is_string($name) ) 
		{
			return \Errors::set('Error', 'stringParameter', 'name');
		}
		
		if( empty($name) ) 
		{
			return $input;
		}
		// ---------------------------------------------------------------------------
			
		// @value parametresi boş değilse
		if( ! empty($value) )
		{
			switch( $type )
			{
				case 'post'    : $_POST[$name]    = $value; break;
				case 'get'     : $_GET[$name]     = $value; break;
				case 'request' : $_REQUEST[$name] = $value; break;
				case 'env'	   : $_ENV[$name]     = $value; break;
				default  	   : $_POST[$name]    = $value; break;
			}
		}
		
		// Global veri içersinde
		// böyle bir veri yoksa
		if( empty($input[$name]) ) 
		{
			return \Errors::set('Error', 'emptyVariable', '$_'.strtoupper($type)."['name']");
		}
		
		if( $value === false )
		{
			return $input[$name];
		}
		
		if( is_scalar($input[$name]) )
		{
			return htmlspecialchars($input[$name], ENT_QUOTES, "utf-8");
		}
		elseif( is_array($input[$name]) )
		{
			return array_map('Security::htmlEncode', $input[$name]);
		}
		
		return $input[$name];
	}
}