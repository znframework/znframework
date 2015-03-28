<?php 
/************************************************************/
/*                      CLASS JSON                          */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Json
{
	private static $key = "+-?||?-+" ;
	private static $seperator = "|?-++-?|";
	
	public static function encode($data = array(), $key = '', $seperator = '')
	{
		if( ! is_array($data) ) return false;
			
		if( ! is_string($key)) $key = '';
		
		if( ! is_string($seperator)) $seperator = '';
		
		$word = "";
		
		if(empty($key)) $key = self::$key;
		
		if(empty($seperator)) $seperator = self::$seperator;
		
		foreach($data as $k => $v)
		{
			$word .= $k.$key.$v.$seperator;	
		}
		
		return substr($word,0,-(strlen($seperator)));
	}
	
	public static function decode($word = '', $key = '', $seperator = '')
	{
		if( ! is_string($word)) return false;
		
		if( empty($word)) return false;
			
		if( ! is_string($key)) $key = '';
		
		if( ! is_string($seperator)) $seperator = '';
		
		if(empty($key)) $key = self::$key;
		
		if(empty($seperator)) $seperator = self::$seperator;
		
		$keyval = explode($seperator, $word);
		$splits = array();
		$object = array();
		
		if(is_array($keyval))foreach($keyval as $v)
		{
			 $splits = explode($key, $v);
			 if( isset($splits[1]) )
				$object[$splits[0]] = $splits[1];
		}
		
		return (object)$object;
	}
}