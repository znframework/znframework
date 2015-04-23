<?php
/************************************************************/
/*                       CLASS  ENCODE                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Encode
{
	private static $pass;
	private static $type;
	
	
	public static function create($count = 6)
	{
		if( ! is_numeric($count)) $count = 6;
		
		$password   	= '';
		$characters 	= "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOQPRSTUVWXYZ";
		for($i=0; $i < $count; $i++)
		{
			$password .= substr( $characters, rand( 0, strlen($characters)), 1 );	
		}
		return $password;
	}	
	
	
	public static function golden($string = '', $config = 'default')
	{
		if( ! (is_string($string) || is_numeric($string))) return false;
		
		if( ! (is_string($config) || is_numeric($config))) $config = 'default';
		
		if(empty($string)) return false;
		
		$config = md5($config);
		
		$string = md5($string);
		
		return md5($string.$config);

		
	}	
	
	public static function super($string = '')
	{
		if( ! (is_string($string) || is_numeric($string))) return false;
		
		if(empty($string)) return false;
		
		$project_key = config::get('Encode','project_key');
		
		if(empty($project_key)) $config = md5(server('host')); else $config = md5($project_key);
		
		$string = md5($string);
		
		return md5($string.$config);

	}
	
	public static function type($str = '', $type = 'md5')
	{
		if( ! (is_string($str) || is_numeric($str))) return false;
		if( ! is_string($type)) $type = 'md5';
		if($type === 'md5')
			return md5($str);
		else if($type === 'sha1')
			return sha1($str);	
		else
		{
			if(in_array($type, hash_algos()))
				return hash($type, $str);
			else
				return md5($str);
		}
	}

}