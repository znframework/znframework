<?php
/************************************************************/
/*                         CONFIG CLASS                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/

class Config
{
	private static $set_configs = array();
	private static $config = array();
	private static $load_control = false;
	
	private static function _config($file, $con)
	{
		global $config;
		
		$path = CONFIG_DIR.suffix($file,".php");
		
		if( ! is_file($path) ) return false;
		
		if( ! is_import($path) ) 
		{
			require_once $path;
			
			self::$config = $config;
		}
	}
	
	// Function: get()
	// İşlev: İstenilen ayarı çağırmak için kullanılır. 
	
	public static function get($file = '', $configs = '')
	{	
		if( ! is_string($file)) return false;
		
		if(empty($file)) return false;	
		
		self::_config($file, $configs);
		
		if(empty($configs))  
		{
			if( isset( self::$set_configs[$file] ) )
			{
				self::$config[$file][key(self::$set_configs[$file])] = current(self::$set_configs[$file]);
			}
			
			if( isset(self::$config[$file]) ) return self::$config[$file]; else return false;
		}
		if( isset(self::$config[$file][$configs]) ) return self::$config[$file][$configs]; else return false;
	}
	
	// Function: get()
	// İşlev: İstenilen ayarı değiştirmek için kullanılır.
	
	public static function set($file = '', $configs = '', $set = '')
	{
		if( ! is_string($file)) return false;
		
		if(empty($file) || empty($configs)) return false;
	
		self::_config($file, $configs);
		
		self::$set_configs[$file][$configs] = $set;
		
		if(isset(self::$config[$file][$configs])) return self::$config[$file][$configs] = $set;	
	}
	
	
	public static function iniset($key = '', $val = '')
	{
		
		if(empty($key)) return false;
		
		if( ! is_array($key))
		{	
			if(is_array($val)) return false;
			
			if($val) ini_set($key, $val);
		}
		else
		{
			foreach($key as $k => $v)
			{
				if($v) ini_set($k, $v); 			
			}
		}
	}
	
	
	public static function iniget($key = '')
	{
		if(empty($key)) return false;
		
		if( ! is_array($key))
		{	
			return ini_get($key);
		}
		else
		{
			$keys = array();
			foreach($key as $k)
			{
				$keys[$k] = ini_get($k);	
			}
			return $keys;
		}
	}
	
	
	public static function iniget_all($extension = '', $details = true)
	{
		if(empty($extension)) 
			return ini_get_all();	
		else
			return ini_get_all($extension, $details);	
	}
	
	
	public static function inirestore($str = '')
	{
		return ini_restore($str);	
	}

}