<?php 
/************************************************************/
/*                       CLASS SECURITY                     */
/************************************************************/
/*

Author: Ozan UYKUN
Site: http://www.zntr.net
Copyright 2012-2015 zntr.net - Tüm hakları saklıdır.

*/
class Sec
{
	
	public static function nc_encode($string = '', $badwords = '', $changechar = '[badwords]')
	{
		if( ! is_string($string)) return false;
		import::library('Regex');
		
		if( empty($badwords) )
		{
			$secnc = config::get("Security", "nc_encode");
			$badwords = $secnc['bad_words'];
			$changechar = $secnc['change_bad_words'];
		}
		if(!is_array($badwords)) return  $string = reg::replace($badwords, $changechar, $string, '<inspace><insens>');
		
		$ch = '';
		$i = 0;	
		
		foreach($badwords as $value)
		{		
			if( ! is_array($changechar))
			{
				$ch = $changechar;
			}
			else
			{
				if(isset($changechar[$i]))
				{
					$ch = $changechar[$i];	
					$i++;
				}
			}

			$string = reg::replace($value, $ch, $string, '<inspace><insens>');
		}
	
		return $string;
	}	
		
		
	public static function nail_encode($string = '')
	{
		if( ! is_string($string)) return false;
		return addslashes(trim($string));
	}
	public static function nail_decode($string = '')
	{
		if( ! is_string($string)) return false;
		return stripslashes(trim($string));
	}
	
	public static function general_encode($string = '')
	{
		if( ! is_string($string)) return false;
		$secnc = config::get("Security", "nc_encode");
		return self::nc_encode(htmlspecialchars(trim($string)), $secnc['bad_words'], $secnc['change_bad_words']);
	}
		
	public static function injection_encode($string = '')
	{
		if( ! is_string($string)) return false;
		import::library('Database');
		return db::real_escape_string(trim($string));
	}
	
	public static function injection_decode($string = '')
	{
		if( ! is_string($string)) return false;
		return stripslashes(trim($string));
	}
	
	public static function html_encode($string, $type = 'quotes')
	{
		if( ! is_string($string)) return false;
		if( ! is_string($type)) $type = 'quotes';
		if($type === 'quotes') $tp = ENT_QUOTES; else if($type === 'nonquotes')$tp = ENT_NOQUOTES; else $tp = ENT_COMPAT;
		return htmlspecialchars(trim($string), $tp);
	}
	public static function html_decode($string, $type = 'quotes')
	{
		if( ! is_string($string)) return false;
		if( ! is_string($type)) $type = 'quotes';
		
		if($type === 'quotes') $tp = ENT_QUOTES; else if($type === 'nonquotes')$tp = ENT_NOQUOTES; else $tp = ENT_COMPAT;
		return htmlspecialchars_decode(trim($string), $tp);
	}
}