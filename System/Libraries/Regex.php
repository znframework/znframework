<?php
/************************************************************/
/*                         CLASS REGEX                      */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Reg
{

	public static function match($pattern = '', $str = '', $ex = '', $delimiter = '/')
	{
		if( ! is_string($pattern)) return false;
		if( ! is_string($str)) return false;
		if( ! is_string($ex)) $ex = '';
		if( ! is_string($delimiter)) $delimiter = '/';
		
		$pattern = str_replace(array_keys(config::get('Regex','special_chars')), array_values(config::get('Regex','special_chars')), $pattern);
		
		import::tool('Array');	
		
		$regex_chars = multi_key_array(config::get('Regex','regex_chars'));
		
		$setting_chars = multi_key_array(config::get('Regex','setting_chars'));
		
		$pattern = str_replace(array_keys($regex_chars), array_values($regex_chars), $pattern);	
		
		if($ex) $ex = str_replace(array_keys($setting_chars), array_values($setting_chars), $ex);
		
		$pattern = $delimiter.$pattern.$delimiter.$ex;	
		preg_match($pattern, $str , $return);	
		return $return;
	}
	
	public static function match_all($pattern = '', $str = '', $ex = '', $delimiter = '/')
	{
		if( ! is_string($pattern)) return false;
		if( ! is_string($str)) return false;
		if( ! is_string($ex)) $ex = '';
		if( ! is_string($delimiter)) $delimiter = '/';
		
		$pattern = str_replace(array_keys(config::get('Regex','special_chars')), array_values(config::get('Regex','special_chars')), $pattern);
		
		import::tool('Array');	
		
		$regex_chars = multi_key_array(config::get('Regex','regex_chars'));
		
		$setting_chars = multi_key_array(config::get('Regex','setting_chars'));
		
		$pattern = str_replace(array_keys($regex_chars), array_values($regex_chars), $pattern);	
		
		if($ex) $ex = str_replace(array_keys($setting_chars), array_values($setting_chars), $ex);
		
		$pattern = $delimiter.$pattern.$delimiter.$ex;	
		preg_match_all($pattern, $str , $return);	
		return $return;
	}
	
	public static function replace($pattern = '', $rep = '', $str = '', $ex = '', $delimiter = '/')
	{
		if( ! is_string($pattern)) return false;
		if( ! is_string($rep)) return false;
		if( ! is_string($str)) return false;
		if( ! is_string($ex)) $ex = '';
		if( ! is_string($delimiter)) $delimiter = '/';
		
		$pattern = str_replace(array_keys(config::get('Regex','special_chars')), array_values(config::get('Regex','special_chars')), $pattern);
		
		import::tool('Array');	
		
		$regex_chars = multi_key_array(config::get('Regex','regex_chars'));
		$setting_chars = multi_key_array(config::get('Regex','setting_chars'));
		
		$pattern = str_replace(array_keys($regex_chars), array_values($regex_chars), $pattern);	
		if($ex) $ex = str_replace(array_keys($setting_chars), array_values($setting_chars), $ex);
		
		$pattern = $delimiter.$pattern.$delimiter.$ex;	
		return preg_replace($pattern, $rep, $str);
	}
	
	public static function group($str = '')
	{
		if( ! is_string($str)) return false;
		return "(".$str.")";
	}
	
	public static function recount($str = '')
	{
		if( ! is_string($str)) return false;
		return "{".$str."}";
	}
	
	public static function to($str = '')
	{
		if( ! is_string($str)) return false;
		return "[".$str."]";
	}	
}