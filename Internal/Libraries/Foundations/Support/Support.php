<?php
namespace ZN\Foundations;

class InternalSupport extends \CallController implements SupportInterface
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
	// Protected Loaded
	//----------------------------------------------------------------------------------------------------
	// 
	// @param string $name
	// @param string $value
	// @param string $func
	// @param string $error
	//
	//----------------------------------------------------------------------------------------------------
	protected function _loaded($name, $value, $func, $error)
	{
		if( empty($value) )
		{
			$value = ucfirst($name);
		}

		if( ! $func($name) )
		{
			die(getErrorMessage('Error', $error, $value));	
		}

		return true;
	}

	//----------------------------------------------------------------------------------------------------
	// Func
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $name
	// @param  string  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function func(String $name, String $value = NULL)
	{
		return $this->_loaded($name, $value, 'function_exists', 'undefinedFunctionExtension');
	}

	//----------------------------------------------------------------------------------------------------
	// Extension
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $name
	// @param  string  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function extension(String $name, String $value = NULL)
	{
		return $this->_loaded($name, $value, 'extension_loaded', 'undefinedFunctionExtension');
	}

	//----------------------------------------------------------------------------------------------------
	// Library
	//----------------------------------------------------------------------------------------------------
	// 
	// @param  string  $name
	// @param  string  $value
	//
	//----------------------------------------------------------------------------------------------------
	public function library(String $name, String $value = NULL)
	{
		return $this->_loaded($name, $value, 'class_exists', 'classError');
	}
}