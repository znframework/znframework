<?php	
namespace ZN\Core;

class Config
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
	// Config Priority
	//----------------------------------------------------------------------------------------------------
	// Primary: Internal Config
	// Secondary: Applications Config
	// Tertiary: External Config
	//----------------------------------------------------------------------------------------------------
	
	//----------------------------------------------------------------------------------------------------
	// $setConfigs
	//----------------------------------------------------------------------------------------------------
	//
	// Set edilen ayarları tutacak dizi değişken
	//
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	private static $setConfigs = [];
	
	//----------------------------------------------------------------------------------------------------
	// $config
	//----------------------------------------------------------------------------------------------------
	// 
	// Ayarları tutacak dizi değişken
	//
	// @var array
	//
	//----------------------------------------------------------------------------------------------------
	private static $config = [];
	
	//----------------------------------------------------------------------------------------------------
	// _config()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $file
	// @return void
	// 
	//----------------------------------------------------------------------------------------------------
	private static function _config($file)
	{
		global $config;
		
		$path = restorationPath(INTERNAL_CONFIG_DIR.suffix($file,".php"));
		
		if( ! is_file($path) ) 
		{
			$path = CONFIG_DIR.suffix($file,".php");
			
			if( ! is_file($path) ) 
			{
				$path = EXTERNAL_CONFIG_DIR.suffix($file,".php");
				
				if( ! is_file($path) ) 
				{
					return false;
				}
			}
		}
		
		if( ! isImport($path) ) 
		{
			require_once $path;
			
			self::$config = $config;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// get()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $file
	// @param  string $configs
	// @return array
	// 
	//----------------------------------------------------------------------------------------------------
	public static function get($file = '', $configs = '')
	{	
		if( ! is_string($file) || empty($file) ) 
		{
			return false;
		}
		
		self::_config($file);
		
		if( isset(self::$setConfigs[$file]) )
		{
			if( ! empty(self::$setConfigs[$file]) ) foreach( self::$setConfigs[$file] as $k => $v )
			{
				if( isset(self::$config[$file][$k]) && is_array(self::$config[$file][$k]) )
				{
					self::$config[$file][$k] = array_merge(self::$config[$file][$k], self::$setConfigs[$file][$k]);
				}
				else
				{
					self::$config[$file][$k] = self::$setConfigs[$file][$k];
				}
			}
		}
		
		if( empty($configs) )  
		{
			if( isset(self::$config[$file]) ) 
			{
				return self::$config[$file]; 
			}
			else 
			{
				return false;
			}
		}
		if( isset(self::$config[$file][$configs]) ) 
		{
			return self::$config[$file][$configs]; 
		}
		else 
		{
			return false;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// set()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $file
	// @param  string $configs
	// @return array
	// 
	//----------------------------------------------------------------------------------------------------
	public static function set($file = '', $configs = '', $set = '')
	{
		if( ! is_string($file) || empty($file) ) 
		{
			return false;
		}
		
		if( empty($configs) ) 
		{
			return false;
		}
		
		self::_config($file);
		
		if( ! is_array($configs) )
		{
			self::$setConfigs[$file][$configs] = $set;
		}
		else
		{
			foreach( $configs as $k => $v )
			{
				self::$setConfigs[$file][$k] = $v;
			}	
		}
		
		return self::$setConfigs;
	}
	
	//----------------------------------------------------------------------------------------------------
	// iniSet()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $key
	// @param  string $val
	// @return void
	// 
	//----------------------------------------------------------------------------------------------------
	public static function iniSet($key = '', $val = '')
	{
		if( empty($key) ) 
		{
			return false;
		}
		
		if( ! is_array($key) )
		{	
			if( is_array($val) )
			{
				return false;
			}
			
			if( $val !== '' ) 
			{
				ini_set($key, $val);
			}
		}
		else
		{
			foreach( $key as $k => $v )
			{
				if( $v !== '' ) 
				{
					ini_set($k, $v); 			
				}
			}
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// iniGet()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  mixed  $key
	// @return mixed
	// 
	//----------------------------------------------------------------------------------------------------
	public static function iniGet($key = '')
	{
		if( empty($key) ) 
		{
			return false;
		}
		
		if( ! is_array($key) )
		{	
			return ini_get($key);
		}
		else
		{
			$keys = [];
			
			foreach( $key as $k )
			{
				$keys[$k] = ini_get($k);	
			}
			
			return $keys;
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// iniGetAll()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $key
	// @param  bool   $details
	// @return array
	// 
	//----------------------------------------------------------------------------------------------------
	public static function iniGetAll($extension = '', $details = true)
	{
		if( empty($extension) ) 
		{
			return ini_get_all();	
		}
		else
		{
			return ini_get_all($extension, $details);	
		}
	}
	
	//----------------------------------------------------------------------------------------------------
	// iniRestore()
	//----------------------------------------------------------------------------------------------------
	//
	// @param  string $str
	// @return bool
	// 
	//----------------------------------------------------------------------------------------------------
	public static function iniRestore($str = '')
	{
		return ini_restore($str);	
	}
}