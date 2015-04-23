<?php 
/************************************************************/
/*                     CLASS  CURL                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Curl
{
	private static $init;
	private static $setting;

	//oturumu başlatıyor
	
	public static function open($url = NULL)
	{
		self::$init = curl_init($url);
	}
	
	//iletişim ayarları yapılıyor
	
	public static function settings($settings = '', $value = '')
	{	
		
		if(empty($settings) || ! isset(self::$init)) return false;
		
		$options = config::get('Curl','options');
		
		if(is_array($settings))
		{
			foreach($settings as $key => $val)
			{	
				if( ! is_int($key))
					$opt = $options[$key];
				else
					$opt = $key;
				curl_setopt(self::$init,$opt,$val);			
			}
		}
		else
		{
			if( ! (is_string($value) || is_numeric($value))) $value = '';
			
			if( ! is_int($settings))
				if(isset($options[$settings]))
					$opt = $options[$settings];
				else 
					return false;
			else
				$opt = $settings;
			curl_setopt(self::$init,$opt,$value);
		}
		
	}
	
	//oturum çalıştırılıyor
	
	public static function execute()
	{
		if( ! isset(self::$init)) return false;
		return curl_exec(self::$init);
	}

	
	public static function info($data = '')
	{
		if( ! is_string($data)) $data = '';
		$infos = config::get('Curl','info');
		if( isset($infos[$data]) ) $info = $infos[$data]; else $info = 0;
		return curl_getinfo(self::$init, $info);	
	}
	
	
	public static function error()
	{
		if( ! isset(self::$init)) return false;
		
		return curl_error(self::$init);
	}
	
	//hata numarası döndürür.
	
	public static function errno()
	{
		if( ! isset(self::$init)) return false;
		
		return curl_errno(self::$init);
	}
	
	
	public static function errval()
	{
		if( ! isset(self::$init)) 
			return false;
		
		$errors = config::get('Curl','errors');
		$errno = curl_errno(self::$init);
		
		if(isset($errno)) 
			return  @$errors[$errno]; 
		else 
			return false;
	}

	
	public static function version($info = '')
	{
		if( ! is_string($info)) $info = '';
		$version_info = curl_version();
		if($info) return $version_info[$info];
		else return $version_info;
	}
	
	//oturum kapatlıyor
	
	public static function close()
	{
		if(isset(self::$init)) 
			curl_close(self::$init);
		else
			return false;
	}
}