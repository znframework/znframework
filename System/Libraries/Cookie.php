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
		
		if(empty($time)) $time = config::get("Cookie","time");
		if(empty($path)) $path = config::get("Cookie","path");
		if(empty($domain)) $domain = config::get("Cookie","domain");
		if(empty($secure)) $secure = config::get("Cookie","secure");
		if(empty($httponly)) $httponly = config::get("Cookie","httponly");
		if(config::get("Cookie","encode") == true)
		{
			$name = md5($name);
		}
		
		$_COOKIE[$name] = $value;
		
		if(setcookie($name, $value, time() + $time, $path, $domain, $secure, $httponly))
			return true;
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
	
	public static function delete($name = '', $path = '', $domain = '')
	{
		if( ! (is_string($name) || is_numeric($name))) return false;
		if( ! is_string($path)) $path = '';
		if( ! is_string($domain)) $domain = '';
		
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
		$time = config::get("Cookie","time");
		
		if( ! empty($_COOKIE) ) foreach ($_COOKIE as $key => $val)
		{			
			setcookie($key, "", time() - $time);
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