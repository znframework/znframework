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
	// Post Method Başlangıç
	//----------------------------------------------------------------------------------------------------

	/******************************************************************************************
	* POST                                                                                    *
	*******************************************************************************************
	| Genel Kullanım:$_POST Global değişkeninin kullanımıdır.                                 |
	|															                              |
	| Parametreler: 2 parametresi vardır.                                              	      |
	| 1. string var @name => Post değişkeninin anahtar ismidir. $_POST['isim']       	  	  |
	| 2. string var @value => Anahtarın tutacağı veri. $_POST['isim'] = 'Değer'               |
	|          																				  |
	| Örnek Kullanım: post('isim', 'Değer');        	  					                  |
	| // $_POST['isim'] = 'Değer'      													      |
	|          																				  |
	******************************************************************************************/	
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
		
		return htmlentities($_POST[$name]);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Post Method Bitiş
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// Get Method
	//----------------------------------------------------------------------------------------------------
	// 
	// get()
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
		
		return htmlentities($_GET[$name]);
	}	
	
	//----------------------------------------------------------------------------------------------------
	// Request Method
	//----------------------------------------------------------------------------------------------------
	// 
	// request()
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
		
		return htmlentities($_REQUEST[$name]);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Env Method
	//----------------------------------------------------------------------------------------------------
	// 
	// env()
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
		
		return htmlentities($_ENV[$name]);
	}
	
	//----------------------------------------------------------------------------------------------------
	// Files Method
	//----------------------------------------------------------------------------------------------------
	// 
	// files()
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