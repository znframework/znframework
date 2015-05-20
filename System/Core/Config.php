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
	/*
	 * Set edilen ayarları tutacak dizi değişken
	 *
	 * array @set_configs
	 *
	 */
	private static $set_configs = array();
	
	/*
	 * Ayarları tutacak dizi değişken
	 *
	 * array @config
	 *
	 */
	private static $config = array();
	
	/*
	 * Ayarın daha önce yüklenip yüklenilmediğinin kontrolü.
	 *
	 * boolean @load_control
	 *
	 */
	private static $load_control = false;
	
	private static function _config($file)
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
	
	/* GET FUNCTION
	 *
	 * Ayar çağırmak için kullanılır.
	 *
	 * 2 Parametresi vardır.
	 *
	 * 1. Parametre string @file: Çağrılacak config dosyasının adı.
	 * 2. Parametre string @configs: Dosya içerisinden çağrılmak istenen dizi anahtarı.
	 */
	public static function get($file = '', $configs = '')
	{	
		if( ! is_string($file)) return false;
		
		if(empty($file)) return false;	
		
		self::_config($file);
		
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
	
	/* SET FUNCTION
	 *
	 * Ayar bilgisini değiştirmek için kullanılır.
	 *
	 * 3 Parametresi vardır.
	 *
	 * 1. Parametre string @file: Çağrılacak config dosyasının adı.
	 * 2. Parametre string @configs: Dosya içerisinden değiştirilmek istenen dizi anahtarı.
	 * 3. Parametre mixed @set: Eski ayarın yerini alması istenilen yeni değer.
	 */
	public static function set($file = '', $configs = '', $set = '')
	{
		if( ! is_string($file)) return false;
		
		if(empty($file) || empty($configs)) return false;
	
		self::_config($file);
		
		self::$set_configs[$file][$configs] = $set;
		
		if(isset(self::$config[$file][$configs])) return self::$config[$file][$configs] = $set;	
	}
	
	/* INISET FUNCTION
	 *
	 * PHP INI ayarlarını yapılandırmak için kullanılır.
	 *
	 * 2 Parametresi vardır.
	 *
	 * 1. Parametre string or array @key: Değiştirilmek istenen ini ayarının adı.
	 * 2. Parametre string @val: Yeni ayar
	 *
	 * Birden fazla ayarın aynı anda değiştirilmesi istenirse
	 * 2. parametre dizi olarak belirtilir. Bu durumda 2. parametre kullanılmaz.
	 * array(key1 => val1, key2 => val2 ...) kullanılır.
	 */
	public static function iniset($key = '', $val = '')
	{
		
		if(empty($key)) return false;
		
		if( ! is_array($key))
		{	
			if(is_array($val))
			{
				return false;
			}
			
			if($val !== '') 
			{
				ini_set($key, $val);
			}
		}
		else
		{
			foreach($key as $k => $v)
			{
				if($v !== '') 
				{
					ini_set($k, $v); 			
				}
			}
		}
	}
	
	/* INIGET FUNCTION
	 *
	 * PHP INI ayar veya ayarlarının değerlerini öğrenmek için kullanılır.
	 *
	 * 1 Parametresi vardır.
	 *
	 * 1. Parametre string or array @key: Çağrılması istenilen ayarın adı
	 *
	 * Birden fazla ayarın aynı anda değer bilgisinin alınması isteniyorsa.
	 * 2. parametre dizi olarak belirtilir.
	 * array(key1, key2 ...) kullanılır.
	 */
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
	
	/* INIGET ALL FUNCTION
	 *
	 * Tüm yapılandırılmış ini ayarlarını almak için kullanılır.
	 */
	public static function iniget_all($extension = '', $details = true)
	{
		if(empty($extension)) 
			return ini_get_all();	
		else
			return ini_get_all($extension, $details);	
	}
	
	/* INI RESTORE FUNCTION
	 *
	 * Tüm yapılandırılmış ini ayarlarını sıfırlamak için kullanılır.
	 */
	public static function inirestore($str = '')
	{
		return ini_restore($str);	
	}

}