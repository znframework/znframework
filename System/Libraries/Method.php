<?php
/************************************************************/
/*                       CLASS METHOD                       */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Method
{
	public static function post($name = '', $value = '')
	{
		if( ! is_string($name)) return false;
		
		if(empty($name)) return $_POST;
		
		if( ! empty($value))
		{
			$_POST[$name] = $value;
		}
		
		if(empty($_POST[$name])) return false;
					
		return $_POST[$name];
	}	
	
	public static function get($name = '', $value = '')
	{
		if( ! is_string($name)) return false;
		
		if(empty($name)) return $_GET;
		
		if( ! empty($value))
		{
			$_GET[$name] = $value;
		}
		
		if(empty($_GET[$name])) return false;
		
		return $_GET[$name];	
	}
	
	public static function request($name = '', $value = '')
	{
		if( ! is_string($name)) return false;
		
		if(empty($name)) return $_REQUEST;
		
		if( ! empty($value))
		{
			$_REQUEST[$name] = $value;
		}
		
		if(empty($_REQUEST[$name])) return false;
	
		return $_REQUEST[$name];
	}
	
	public static function files($file_name = '', $type = 'name')
	{
		if( ! is_string($file_name)) return false;
		if( ! is_string($type)) $type = 'name';
		
		if(empty($file_name)) return false;
		return $_FILES[$file_name][$type];
	}
	
	
}