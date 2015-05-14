<?php 
/************************************************************/
/*                     CLASS  COOKIE                   	    */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Cook
{
	private static $error;
	//	insert() ?
	/*
		Yeni bir çerez oluşturmak için kullanılır.
		Oluşturulan çerezin varsayılan değeri 1 hafta olrak belirlenmiştir.
		Çerezler oluşturulurken şifrelenerek oluştururlur.
		Kullanılırken yine şifrelenerek kullanılmaktadırlar.
	*/
	
	public static function insert($name = '', $value = '', $time = '', $path = '', $domain = '', $secure = false, $httponly = false) // varsayılan süre 1 hafta
	{	
		if( ! (is_string($name) || is_numeric($name))) return false;
		if( ! is_numeric($time)) $time = 0;
		if( ! is_string($path)) $path = '';
		if( ! is_string($domain)) $domain = '';
		if( ! is_bool($secure)) $secure = false;
		if( ! is_bool($httponly)) $httponly = false;
		
		if(empty($name))
		{			
			self::$error = get_message('Cookie', 'cook_name_parameter_empty_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		if(empty($value))
		{
			self::$error = get_message('Cookie', 'cook_value_parameter_empty_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		
		$cookie_config = config::get("Cookie");
		
		if(empty($time)) $time = $cookie_config["time"];
		if(empty($path)) $path = $cookie_config["path"];
		if(empty($domain)) $domain = $cookie_config["domain"];
		if(empty($secure)) $secure = $cookie_config["secure"];
		if(empty($httponly)) $httponly = $cookie_config["httponly"];
		
		if($cookie_config["encode"] === true)
		{
			$name = md5($name);
		}
		
		if(setcookie($name, $value, time() + $time, $path, $domain, $secure, $httponly))
		{
			session_regenerate_id();
			return true;
		}
		else
		{
			self::$error = get_message('Cookie', 'cook_set_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
	}
	
	//	select() ?
	/*
		Oluşturulan çerezi seçmek için kullanılır.
	*/	
	
	public static function select($name = '')
	{
		if( ! (is_string($name) || is_numeric($name))) return false;
		
		import::language('Cookie');
		
		if(empty($name))
		{
			self::$error = get_message('Cookie', 'cook_name_parameter_empty_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		
		if(config::get("Cookie","encode"))
		{
			$name = md5($name);
		}

	    if(isset($_COOKIE[$name])) 
			return $_COOKIE[$name]; 
		else 
		{
			self::$error = get_message('Cookie', 'cook_not_select_error');
			report('Error',self::$error,'CookieLibrary');
			return false;	
		}
	}
	
	//	delete() ?
	/*
		Oluşturulan çerezi silmek için kullanılır.
	*/	
	
	public static function delete($name = '', $path = '')
	{
		if( ! (is_string($name) || is_numeric($name))) return false;
		if( ! is_string($path)) $path = '';
		
		import::language('Cookie');

		if(empty($name))
		{
			self::$error = get_message('Cookie', 'cook_name_parameter_empty_error');
			report('Error',self::$error,'CookieLibrary');
			return false;
		}
		
		if(empty($path)) $path = config::get("Cookie","path");
		
		if(config::get("Cookie","encode"))
		{
			$name = md5($name);
		}
		
		if(isset($_COOKIE[$name])) 
			setcookie($name,"",(time() - 1), $path); 
		else
		{ 
			self::$error = get_message('Cookie', 'cook_not_delete_error');
			report('Error',self::$error,'CookieLibrary');
			return false;		
		}
	}
	
	
	public static function select_all()
	{
		if( ! empty($_COOKIE) ) return $_COOKIE; else false;
	}
	
	
	public static function delete_all()
	{	
		$path = config::get('Cookie', 'path');
		
		if( ! empty($_COOKIE) ) foreach ($_COOKIE as $key => $val)
		{			
			setcookie($key, '', time() - 1, $path);
		}
		else return false;
	}
	
	
	public static function error()
	{
		if(self::$error)
			return self::$error;
		else
			return false;	
	}
	
}

/* ---------------------------------------CLASS COOKIE SON---------------------------------------------*/