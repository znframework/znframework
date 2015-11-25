<?php
class __USE_STATIC_ACCESS__Method implements MethodInterface
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
	use CallUndefinedMethodTrait;
	
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
	use ErrorControlTrait;	

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
		// Parametreler kontrol ediliyor. --------------------------------------------
		if( ! is_string($name) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'name'));
		}
		
		if( empty($name) ) 
		{
			return $_POST;
		}
		// ---------------------------------------------------------------------------
		
		// @value parametresi boş değilse
		if( ! empty($value) )
		{
			$_POST[$name] = $value;
		}
		
		// Global veri içersinde
		// böyle bir veri yoksa
		if( empty($_POST[$name]) ) 
		{
			return Error::set(lang('Error', 'emptyVariable', '@$_POST[\'name\']'));
		}
		
		return htmlspecialchars($_POST[$name], ENT_QUOTES, "utf-8");
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
		// Parametreler kontrol ediliyor. --------------------------------------------
		if( ! is_string($name) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'name'));
		}
		
		if( empty($name) ) 
		{
			return $_GET;
		}
		// ---------------------------------------------------------------------------
		
		// @value parametresi boş değilse
		if( ! empty($value) )
		{
			$_GET[$name] = $value;
		}
		
		// Global veri içersinde
		// böyle bir veri yoksa
		if( empty($_GET[$name]) ) 
		{
			return Error::set(lang('Error', 'emptyVariable', '@$_GET[\'name\']'));
		}
		
		return htmlspecialchars($_GET[$name], ENT_QUOTES, "utf-8");
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
		// Parametreler kontrol ediliyor. --------------------------------------------
		if( ! is_string($name) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'name'));
		}
		
		if( empty($name) ) 
		{
			return $_REQUEST;
		}
		// ---------------------------------------------------------------------------
		
		// @value parametresi boş değilse
		if( ! empty($value) )
		{
			$_REQUEST[$name] = $value;
		}
		
		// Global veri içersinde
		// böyle bir veri yoksa
		if( empty($_REQUEST[$name]) ) 
		{
			return Error::set(lang('Error', 'emptyVariable', '@$_REQUEST[\'name\']'));
		}
		
		return htmlspecialchars($_REQUEST[$name], ENT_QUOTES, "utf-8");
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
		// Parametreler kontrol ediliyor. --------------------------------------------
		if( ! is_string($name) ) 
		{
			return Error::set(lang('Error', 'stringParameter', 'name'));
		}
		
		if( empty($name) ) 
		{
			return $_ENV;
		}
		// ---------------------------------------------------------------------------
		
		// @value parametresi boş değilse
		if( ! empty($value) )
		{
			$_ENV[$name] = $value;
		}
		
		// Global veri içersinde
		// böyle bir veri yoksa
		if( empty($_ENV[$name]) ) 
		{
			return Error::set(lang('Error', 'emptyVariable', '@$_ENV[\'name\']'));
		}
		
		return htmlspecialchars($_ENV[$name], ENT_QUOTES, "utf-8");
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
			return Error::set(lang('Error', 'stringParameter', 'name'));
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
			return Error::set(lang('Error', 'stringParameter', 'fileName'));
		}
		
		if( ! is_string($type) ) 
		{
			$type = 'name';
		}
		
		if( empty($fileName) ) 
		{
			return Error::set(lang('Error', 'emptyVariable', '@fileName'));
		}
		
		return $_FILES[$fileName][$type];
	}
}