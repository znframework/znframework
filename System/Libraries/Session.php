<?php
/************************************************************/
/*                       CLASS SESSION                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
config::iniset(config::get('Session','settings'));
if(!isset($_SESSION)) session_start();

class Sess
{

	public static function insert($name = '', $values = '')
	{
		if(empty($name)) return false;
		
		if(is_array($name))
		{
			foreach($name as $key => $value)
			{
				if(config::get('Session','encode') == true)
					$_SESSION[md5($key)] = $value;
				else
					$_SESSION[$key] = $value;
			}
		}
		else
		{
			if(config::get('Session','encode') == true)
				$_SESSION[md5($name)] = $values;
			else
				$_SESSION[$name] = $values;
		}
		
		session_regenerate_id();
	}
	
	public static function select($name = '')
	{
		if(empty($name)) return false;
		
		if(is_array($name))
		{
			foreach($name as $key)
			{
				if(config::get('Session','encode') == true)
					$session[$key] = $_SESSION[md5($key)];
				else
					$session[$key] = $_SESSION[$key];
			}
			return $session;
		}
		else
		{
			if(config::get('Session','encode') == true)
				if(isset($_SESSION[md5($name)])) 
					return $_SESSION[md5($name)]; else return false;
			else
				if(isset($_SESSION[$name]))
					return $_SESSION[$name]; else return false;
		}
		
	}
	
	public static function select_all()
	{
		return $_SESSION;	
	}

	
	public static function delete($name = '')
	{
		if(empty($name)) return false;
		
		if(is_array($name))
		{
			foreach($name as $value)
			{
				$val = $value;
				if(config::get('Session','encode') == true)
					if(isset($_SESSION[md5($val)])) 
						unset($_SESSION[md5($val)]);
				else
					if(isset($_SESSION[$val]))
						unset($_SESSION[$val]);
			}	
		}
		else
		{
			$val = $name;
		}
		if(config::get('Session','encode') == true)
			if(isset($_SESSION[md5($val)]))
				unset($_SESSION[md5($val)]);
		else
			if(isset($_SESSION[$val]))
				unset($_SESSION[$val]);
	}
	
	public static function delete_all()
	{
		session_destroy();
	}
}